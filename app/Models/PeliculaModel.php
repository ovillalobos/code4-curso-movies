<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaModel extends Model
{
    protected $table            = 'peliculas';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object'; //{ array/object }
    protected $allowedFields    = ['title', 'description', 'categoria_id'];

    public function getCategoriaByPelicula()
    {
        return $this    ->select('  peliculas.id, peliculas.title, peliculas.description, 
                                    categorias.title as categoria')
                        ->join('categorias', 'categorias.id = peliculas.categoria_id')
                        ->find();
    }
    public function getPeliculaCategoriaByID($id)
    {
        return $this    ->select('  peliculas.id, peliculas.title, peliculas.description, 
                                    categorias.title as categoria')
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
}
