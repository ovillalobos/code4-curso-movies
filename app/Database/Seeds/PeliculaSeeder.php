<?php

namespace App\Database\Seeds;

use App\Models\PeliculaModel;
use App\Models\CategoriaModel;

use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        // MODELS
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        // QUERYS
        $categorias = $categoriaModel->limit(7)->find();        
        // SETTINGS
        $count = 1;
        $totalRecords = 20;

        foreach ($categorias as $categoria) {
            for ($i=0; $i < $totalRecords; $i++) { 
                $peliculaModel->insert(
                    [
                        'title' => "Pelicula $count",
                        'categoria_id' => $categoria->id,
                        'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book"
                    ]
                );
    
                $count++;
            }
        }        
    }
}
