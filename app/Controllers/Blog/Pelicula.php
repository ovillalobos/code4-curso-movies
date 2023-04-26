<?php

namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{    
    public function index()
    {
        $peliculaModel = new PeliculaModel();        
        $totalRows = 10;

        //UTILIZANDO BASE DE DATOS
        //$db = \Config\Database::connect();
        //$peliculaModel = $db->table('peliculas');
        //$peliculas = $peliculaModel->select('peliculas.*, categorias.title as categoria')
        //->join('categorias', 'categorias.id = peliculas.categoria_id');
        //return var_dump( $peliculas->getCompiledSelect() ); */

        //UTILIZANDO EL MODELO
        $peliculaModel->getPeliCateEtiImg();

        //AGREGANDO CONDICIONES ANIDADAS (FILTROS)
        if( $buscar = $this->request->getGet('buscar') ){
            $peliculaModel->likeTitleAndDesc($buscar);
        }

        if( $categoriaId = $this->request->getGet('categoria_id') ){
            $peliculaModel->wherePeliCategoriaId($categoriaId);
        }

        if( $etiquetaId = $this->request->getGet('etiqueta_id') ){
            $peliculaModel->wherePeliEtiquetaId($etiquetaId);
        }

        //AGRUPACION AND ORDER BY
        $peliculaModel->groupBy('peliculas.id')->orderBy('peliculas.id', 'ASC');

        $data = [
            'peliculas'     => $peliculaModel->paginate($totalRows),
            'categorias'    => $this->getCategorias(),
            'etiquetas'     => $this->getEtiquetas($categoriaId),
            'pager'         => $peliculaModel->pager,
            'oldData'       => $this->setObjetc([
                'buscar'        => $buscar,
                'categoriaId'   => $categoriaId,
                'etiquetaId'    => $etiquetaId,
            ])
        ];

        echo view('blog/pelicula/index', $data);
    }
    public function indexByCategoria($categoriaId)
    {
        $peliculaModel = new PeliculaModel(); 
        $categoriaModel = new CategoriaModel();
        $totalRows = 10;

        //UTILIZANDO EL MODELO
        $peliculaModel->getPeliCateEtiImg();
        $peliculaModel->wherePeliCategoriaId($categoriaId);

        //AGRUPACION AND ORDER BY
        $peliculaModel->groupBy('peliculas.id')->orderBy('peliculas.id', 'ASC');

        $data = [
            'peliculas'     => $peliculaModel->paginate($totalRows),
            'categoria'     => $categoriaModel->find($categoriaId),
            'pager'         => $peliculaModel->pager
        ];

        echo view('blog/pelicula/index_por_categoria', $data);
    }

    public function indexByEtiqueta($etiquetaId)
    {
        $peliculaModel = new PeliculaModel(); 
        $etiquetaModel = new EtiquetaModel();
        $totalRows = 10;

        //UTILIZANDO EL MODELO
        $peliculaModel->getPeliCateEtiImg();
        $peliculaModel->wherePeliEtiquetaId($etiquetaId);

        //AGRUPACION AND ORDER BY
        $peliculaModel->groupBy('peliculas.id')->orderBy('peliculas.id', 'ASC');

        $data = [
            'peliculas'     => $peliculaModel->paginate($totalRows),
            'etiqueta'     => $etiquetaModel->find($etiquetaId),
            'pager'         => $peliculaModel->pager
        ];

        echo view('blog/pelicula/index_por_etiqueta', $data);
    }
    
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        $data = [
            'pelicula' => $peliculaModel->getPeliCateByPeliId($id),
            'imagenes' => $peliculaModel->getImagesById($id),
            'etiquetas' => $peliculaModel->getEtiquetasById($id)
        ];

        echo view('blog/pelicula/show', $data);
    }

    private function getCategorias()
    {
        $categoriaModel = new CategoriaModel();

        return $categoriaModel->findAll();
    }

    private function getEtiquetas($categoriaId)
    {
        $etiquetaModel = new EtiquetaModel();

        if( $categoriaId != '' ) {
            $request = $etiquetaModel->where('categoria_id', $categoriaId)->findAll();
        } else {
            $request = [];
        }

        return $request;
    }
    /************************************************************************************
     * EXTRA FUNCTIONS
     ************************************************************************************/
    public function setObjetc($array)
    {
        return json_decode(json_encode($array));
    }

    public function etiquetasByCategoria($categoriaId)
    {
        $etiquetaModel = new EtiquetaModel();
        return json_encode($etiquetaModel->where('categoria_id', $categoriaId)->findAll());
    }
}

?>