<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\PeliculaModel;

use CodeIgniter\Database\Seeder;

class DeleteDataSeeder extends Seeder
{
    public function run()
    {        
        // MODELS
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();

        // QUERY
        $peliculaModel->where('id >= 1')->delete();
        $categoriaModel->where('id >= 1')->delete();
        $etiquetaModel->where('id >= 1')->delete();        
    }
}
