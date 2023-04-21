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
        $totalPages = 10;

        $data = [
            //'categorias' => $this->categoriaModel->findAll()
            'categorias' => $this->categoriaModel->paginate($totalPages),
            'pager' => $this->categoriaModel->pager
        ];

        echo view('dashboard/categoria/index', $data);
    }

    public function new()
    {
        //session()->destroy();
        $data = [
            'categoria' => new CategoriaModel()
        ];

        echo view('dashboard/categoria/new', $data);
    }

    public function show($id)
    {                
        $req = $this->categoriaModel->find($id);

        $data = [
            'categoria' => $req
        ];

        //session()->set('key', $req['title'] );

        echo view('dashboard/categoria/show', $data);
    }

    public function create()
    {
        if( $this->validate('categorias') ) {
            $data = [
                'title' => $this->request->getPost('title')
            ];

            $this->categoriaModel->insert($data);

            return redirect()->to('/dashboard/categoria')->with(
                'mensaje','Registro creado correctamente'
            );
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }
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
        if( $this->validate('categorias') ) {
            $data = [
                'title' => $this->request->getPost('title')
            ];

            $this->categoriaModel->update($id, $data);

            return redirect()->to('/dashboard/categoria')->with(
                'mensaje','Registro actualizado correctamente'
            );
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $this->categoriaModel->delete($id);

        //MANEJO DE SESSIONES (1)
        session()->setFlashdata('mensaje','Registro eliminado correctamente');
        return redirect()->to('/dashboard/categoria');
        //MANEJO DE SESSIONES (2)
        return redirect()->to('/dashboard/categoria')->with(
            'mensaje','Registro eliminado correctamente'
        );
    }
}

?>