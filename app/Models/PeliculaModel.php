<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaModel extends Model
{
    protected $table            = 'peliculas';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object'; //{ array/object }
    protected $allowedFields    = ['title', 'description', 'categoria_id'];

    public function getCategoriaByPelicula($totalPages)
    {
        return $this    ->select('peliculas.*, categorias.title as categoria')
                        ->join('categorias', 'categorias.id = peliculas.categoria_id')
                        ->paginate($totalPages);
                        //->find();
    }
    public function getPeliculaCategoriaByID($id)
    {
        return $this    ->select('  peliculas.id, peliculas.title, peliculas.description, 
                                    categorias.title as categoria')
                        ->join('categorias', 'categorias.id = peliculas.categoria_id')
                        ->where('peliculas.id',$id)
                        ->first($id);
    }
    /************************************************************************************
     * FIND BY ID
     ************************************************************************************/
    public function getPeliCateByPeliId($id)
    {
        return $this    ->select('peliculas.*, categorias.title as categoria')
                        ->join('categorias', 'categorias.id = peliculas.categoria_id')
                        ->where('peliculas.id',$id)
                        ->first($id);
    }
    public function getImagesById($id)
    {
        return $this    ->select("i.*")
                        ->join('pelicula_imagen as pi', 'pi.pelicula_id = peliculas.id')
                        ->join('imagenes as i', 'i.id = pi.imagen_id')
                        ->where('peliculas.id',$id)
                        ->findAll();
    }
    public function getEtiquetasById($id)
    {
        return $this    ->select("e.*")
                        ->join('pelicula_etiqueta as pe', 'pe.pelicula_id = peliculas.id')
                        ->join('etiquetas as e', 'e.id = pe.etiqueta_id')
                        ->where('peliculas.id',$id)
                        ->findAll();
    }    
    /************************************************************************************
     * JOIN
     ************************************************************************************/
    public function getPeliCateEtiImg()
    {
        return $this    ->select('peliculas.*, 
                            categorias.title as categoria,
                            GROUP_CONCAT(DISTINCT(etiquetas.title) order by etiquetas.id) as etiquetas,
                            MAX(imagenes.imagen) as imagen')
                        ->join('categorias', 'categorias.id = peliculas.categoria_id')
                        ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
                        ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
                        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
                        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left');
    }
    /************************************************************************************
     * WHERE
     ************************************************************************************/
    public function wherePeliCategoriaId($categoriaId)
    {
        return $this    ->where('peliculas.categoria_id', $categoriaId);
    }
    public function wherePeliEtiquetaId($etiquetaId)
    {
        return $this    ->where('etiquetas.id', $etiquetaId);
    }
    /************************************************************************************
     * PAGINATE
     ************************************************************************************/

    /************************************************************************************
     * SEARCH LIKE
     ************************************************************************************/
    public function likeTitleAndDesc($buscar)
    {
        //GROUSTART ES RECOMENDABLE PARA HACER CONSULTAS OR
        //SON LOS PARENTESIS ( orLike || orLike )
        return $this    ->groupStart()
                            ->orLike('peliculas.title', $buscar, 'both')
                            ->orLike('peliculas.description', $buscar, 'both')
                        ->groupEnd();
    }
}
