<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        // MODELS        
        $categoriaModel = new CategoriaModel();

        // SETTINGS
        $count = 1;
        $totalRecords = 20;

        for ($i=0; $i < $totalRecords; $i++) { 
            $categoriaModel->insert(
                [
                    'title' => "Categoria $count"
                ]
            );

            $count++;
        }

        // OPTION 2
        //$this->db->table('categorias');
        /*
        $this->db->table('categorias')->where('id >= 1')->delete();
        $count = 1;
        for ($i=0; $i < 20; $i++) { 
            $this->db->table('categorias')->insert(
                [
                    'title' => "Categoria (Seeder) $count"
                ]
            );

            $count++;
        }
        */
    }
}
