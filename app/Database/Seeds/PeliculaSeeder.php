<?php

namespace App\Database\Seeds;

use App\Models\PeliculaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->where('id >= 1')->delete();
        $count = 1;
        $totalRecords = 20;
        for ($i=0; $i < $totalRecords; $i++) { 
            $peliculaModel->insert(
                [
                    'title' => "Pelicula (Seeder) $count",
                    'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. - Seeder ($count)"
                ]
            );

            $count++;
        }
    }
}
