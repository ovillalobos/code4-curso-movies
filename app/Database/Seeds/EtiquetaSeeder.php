<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;

use CodeIgniter\Database\Seeder;

class EtiquetaSeeder extends Seeder
{
    public function run()
    {
        // MODELS
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel = new CategoriaModel();
        // QUERYS
        $categorias = $categoriaModel->limit(7)->find();        
        // SETTINGS
        $count = 1;
        $totalRecords = 20;

        foreach ($categorias as $categoria) {
            for ($i=0; $i < $totalRecords; $i++) { 
                $etiquetaModel->insert(
                    [
                        'title' => "Etiqueta $count",
                        'categoria_id' => $categoria->id
                    ]
                );
    
                $count++;
            }
        }
    }
}
