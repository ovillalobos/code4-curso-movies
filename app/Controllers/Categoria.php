<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController 
{    

    private $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new CategoriaModel();
    }

    public function index()
    {
        $data = [
            'categoria' => $this->categoriaModel->findAll()
        ];

        echo view('/categoria/index', $data);
    }

    public function new()
    {
        $data = [
            'categoria' => [
                'title' => ''
            ]
        ];

        echo view('/categoria/new', $data);
    }

    public function show($id)
    {
        $data = [
            'categoria' => $this->categoriaModel->find($id)
        ];

        echo view('/categoria/show', $data);
    }

    public function create()
    {
        $data = [
            'title' => $this->request->getPost('title')
        ];

        $this->categoriaModel->insert($data);

        echo "created";
    }
    
    public function edit($id)
    {
        $data = [
            'categoria' => $this->categoriaModel->find($id)
        ];

        echo view('categoria/edit', $data);   
    }

    public function update($id)
    {
        $data = [
            'title' => $this->request->getPost('title')
        ];

        $this->categoriaModel->update($id, $data);

        echo "updated";
    }

    public function delete($id)
    {
        $this->categoriaModel->delete($id);

        echo "deleted";
    }
}

?>