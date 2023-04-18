<?php

namespace App\Models;

use CodeIgniter\Model;

class EtiquetaModel extends Model
{
    protected $table            = 'etiquetas';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['title', 'categoria_id'];

    public function getEtiquetaCategoria()
    {
        return $this    ->select('  etiquetas.id as etiqueta_id, 
                                    etiquetas.title as etiqueta_title,
                                    ca.title as etiqueta_categoria')
                        ->join('categorias as ca', 'etiquetas.categoria_id = ca.id')
                        ->orderBy('etiquetas.id', 'asc')
                        ->findAll();
    }

    public function getEtiquetaCategoriaByID($id)
    {
        return $this    ->select('  etiquetas.id as etiqueta_id, 
                                    etiquetas.title as etiqueta_title,
                                    ca.title as etiqueta_categoria')
                        ->join('categorias as ca', 'etiquetas.categoria_id = ca.id')
                        ->where('etiquetas.id',$id)
                        ->first();
    }
}
