<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
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

        echo view('/dashboard/pelicula/index', $data);
    }

    public function new()
    {
        $data = [
            'pelicula' => [
                'title' => '',
                'description' => ''
            ]
        ];

        echo view('/dashboard/pelicula/new', $data);
    }

    public function show($id)
    {
        $data = [
            'pelicula' => $this->peliculaModel->find($id)
        ];

        echo view('/dashboard/pelicula/show', $data);
    }

    public function create()
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ];

        $this->peliculaModel->insert($data);

        return redirect()->to('/dashboard/pelicula');
    }
    
    public function edit($id)
    {
        $data = [
            'pelicula' => $this->peliculaModel->find($id)
        ];

        echo view('/dashboard/pelicula/edit', $data);   
    }

    public function update($id)
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ];

        $this->peliculaModel->update($id, $data);

        //REDIRECCIONE
        //return redirect()->back(); // Regresa a la pagina anterior
        //return redirect()->to('/dashboard/pelicula'); // Regresa a una pagina especifica
        //return redirect()->route('pelicula.test'); // Regresa a una ruta especifica { $routes->get('test', 'Pelicula::test', ['as' => 'pelicula.test']); }

        return redirect()->to('/dashboard/pelicula');
    }

    public function delete($id)
    {
        $this->peliculaModel->delete($id);

        echo "deleted";

        return redirect()->to('/dashboard/pelicula');
    }

    public function test()
    {
        echo "Hello world";
    }
}