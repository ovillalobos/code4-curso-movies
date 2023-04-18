<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Database\Migrations\PeliculaEtiqueta;
use App\Models\PeliculaModel;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;

class Pelicula extends BaseController
{    
    private $peliculaModel;
    private $categoriaModel;
    private $etiquetaModel;

    function __construct() {
        $this->peliculaModel = new PeliculaModel();
        $this->categoriaModel = new CategoriaModel();
        $this->etiquetaModel = new EtiquetaModel();
    }

    public function index()
    {   
        //HELP-> PARA VERIFICAR COMO ESTA CONSTRUIDA LA CONSULTA
        /*
        $db = \Config\Database::connect();
        $builder = $db->table('peliculas');
        return $builder->limit(10,20)->getCompiledSelect();
        */

        //CONSULTA SIMPLE
        /*
        $data = [
            'peliculas' => $this->peliculaModel->findAll()
        ];
        */

        $data = [
            'peliculas' => $this->peliculaModel->getCategoriaByPelicula()
                                
        ];        

        echo view('/dashboard/pelicula/index', $data);
    }

    public function new()
    {
        $data = [
            //'pelicula' => new PeliculaModel(),
            'pelicula' => $this->peliculaModel,
            'categorias' => $this->categoriaModel->find()
        ];

        echo view('/dashboard/pelicula/new', $data);
    }

    public function show($id)
    {
        // Podemos hacer esta modificacion al nivel del modelo con  protected $returnType = 'array';
        // var_dump($this->peliculaModel->asArray()->find($id));     //Obtiene los valores como array (default)
        // var_dump($this->peliculaModel->asObject()->find($id));    //Obtiene los valores como objeto
        // var_dump( $this->peliculaModel->getImagesById($id) );     //Test function from Model
        // RELACION INVERSA POR ID DE IMAGEN Y OBTIENES LAS PELICULAS
        // $imagenModel = new ImagenModel();
        // var_dump( $imagenModel->getPeliculasById(2) );

        $data = [
            'pelicula' => $this->peliculaModel->find($id),
            'imagenes' => $this->peliculaModel->getImagesById($id),
            'etiquetas' => $this->peliculaModel->getEtiquetasById($id),
        ];

        echo view('/dashboard/pelicula/show', $data);
    }

    public function create()
    {
        if( $this->validate('peliculas') ){
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ];

            $this->peliculaModel->insert($data);

            return redirect()->to('/dashboard/pelicula')->with(
                'mensaje', 'Registro creado correctamente'
            );
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }
    }
    
    public function edit($id)
    {
        $data = [
            'pelicula' => $this->peliculaModel->find($id),
            'categorias' => $this->categoriaModel->find()
        ];

        echo view('/dashboard/pelicula/edit', $data);   
    }

    public function update($id)
    {        
        if( $this->validate('peliculas') ){
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ];
    
            $this->peliculaModel->update($id, $data);

            //REDIRECCIONE
            //return redirect()->back(); // Regresa a la pagina anterior
            //return redirect()->to('/dashboard/pelicula'); // Regresa a una pagina especifica
            //return redirect()->route('pelicula.test'); // Regresa a una ruta especifica { $routes->get('test', 'Pelicula::test', ['as' => 'pelicula.test']); }
            return redirect()->to('/dashboard/pelicula')->with(
                'mensaje','Registro actualizado correctamente'
            );
        }  else {
            // $this->validator->getError('title')
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }               
    }

    public function delete($id)
    {
        $this->peliculaModel->delete($id);

        echo "deleted";

        return redirect()->to('/dashboard/pelicula')->with(
            'mensaje','Registro eliminado correctamente'
        );;
    }

    /***********************************************************************
     * ETIQUETAS
     ***********************************************************************/
    public function etiquetas($id)
    {        
        $etiquetas = [];

        if( $this->request->getGet('categoria_id') ){
            $etiquetas = $this->etiquetaModel
                            ->where('categoria_id', $this->request->getGet('categoria_id'))
                            ->findAll();
        }

        $data = [
            'pelicula' => $this->peliculaModel->find($id),
            'categorias' => $this->categoriaModel->findAll(),
            'categoria_id' => $this->request->getGet('categoria_id'),
            'etiquetas' => $etiquetas
        ];

        echo view('dashboard/pelicula/etiquetas', $data);
    }

    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel  
            ->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $peliculaId)
            ->first();

        if( !$peliculaEtiqueta ){
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId
            ]);

            return redirect()->back()->with(
                'mensaje', 'Etiqueta agregada correctamente'
            );
        } else {
            return redirect()->back()->with(
                'mensaje', 'No se puede agregar una etiqueta dos veces en la misma pelicula'
            );
        }    
    }

    public function etiqueta_delete($peliculaId, $etiquetaId)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta   ->where('etiqueta_id', $etiquetaId)
                            ->where('pelicula_id', $peliculaId)
                            ->delete();

        echo '{"mensaje":"Eliminado"}';

        /* return redirect()->back()->with(
            'mensaje', 'Etiqueta eliminada correctamente'
        ); */
    }
    /***********************************************************************
     * TEST FUNTIONS
     ***********************************************************************/
    public function test($arr = 0)
    {
        if($arr != 0){
            $testContent = "Hello world <strong>TEST - ".$arr."</strong>";
        } else {
            $testContent = "Hello world <strong>TEST</strong>";
        }        

        echo "<h3>".$testContent."</h3>";
    }

    private function generar_imagen()
    {
        $imagenModel = new ImagenModel();
        $imagenModel->insert([
            'imagen' => date('Y-m-d H:i:s'),
            'extension' => MD5(date('Y-m-d H:i:s')),
            'data' => MD5(date('Y-m-d H:i:s'))
        ]);
    }

    private function asignar_imagen()
    {
        $peliculaImagenModel = new PeliculaImagenModel();
        $peliculaImagenModel->insert([
            'pelicula_id' => 542,
            'imagen_id' => 1
        ]);
    }
}