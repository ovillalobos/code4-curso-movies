<?php

namespace App\Controllers;

use App\Models\PeliculaModel;

class Pelicula extends BaseController 
{    
    private $peliculaModel;

    function __construct() {
        $this->peliculaModel = new PeliculaModel();
    }

    public function index()
    {
        $data = [
            'peliculas' => $this->peliculaModel->findAll()
        ];

        echo view('/pelicula/index', $data);
    }

    public function new()
    {
        $data = [
            'pelicula' => [
                'title' => '',
                'description' => ''
            ]
        ];

        echo view('/pelicula/new', $data);
    }

    public function show($id)
    {
        $data = [
            'pelicula' => $this->peliculaModel->find($id)
        ];

        echo view('/pelicula/show', $data);
    }

    public function create()
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ];

        $this->peliculaModel->insert($data);

        echo "created";
    }
    
    public function edit($id)
    {
        $data = [
            'pelicula' => $this->peliculaModel->find($id)
        ];

        echo view('pelicula/edit', $data);   
    }

    public function update($id)
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ];

        $this->peliculaModel->update($id, $data);

        echo "updated";
    }

    public function delete($id)
    {
        $this->peliculaModel->delete($id);

        echo "deleted";
    }
}