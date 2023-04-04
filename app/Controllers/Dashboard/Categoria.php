<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
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

        echo view('dashboard/categoria/index', $data);
    }

    public function new()
    {
        $data = [
            'categoria' => [
                'title' => ''
            ]
        ];

        echo view('dashboard/categoria/new', $data);
    }

    public function show($id)
    {
        $data = [
            'categoria' => $this->categoriaModel->find($id)
        ];

        echo view('dashboard/categoria/show', $data);
    }

    public function create()
    {
        $data = [
            'title' => $this->request->getPost('title')
        ];

        $this->categoriaModel->insert($data);

        return redirect()->to('/dashboard/categoria');
    }
    
    public function edit($id)
    {
        $data = [
            'categoria' => $this->categoriaModel->find($id)
        ];

        echo view('dashboard/categoria/edit', $data);   
    }

    public function update($id)
    {
        $data = [
            'title' => $this->request->getPost('title')
        ];

        $this->categoriaModel->update($id, $data);

        return redirect()->to('/dashboard/categoria');
    }

    public function delete($id)
    {
        $this->categoriaModel->delete($id);

        return redirect()->to('/dashboard/categoria');
    }
}

?>