<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;

class Etiqueta extends BaseController
{    
    private $categoriaModel;
    private $etiquetaModel;

    function __construct() {
        $this->categoriaModel = new CategoriaModel();
        $this->etiquetaModel = new EtiquetaModel();
    }

    public function index()
    {   
        $totalPages = 10;

        $data = [
            'etiquetas' => $this->etiquetaModel->getEtiquetaCategoria($totalPages),
            'pager' => $this->etiquetaModel->pager
        ];        

        echo view('/dashboard/etiqueta/index', $data);
    }

    public function new()
    {
        $data = [
            'etiqueta' => $this->etiquetaModel,
            'categorias' => $this->categoriaModel->find()
        ];

        echo view('/dashboard/etiqueta/new', $data);
    }

    public function show($id)
    {
        $data = [
            'etiqueta' => $this->etiquetaModel->getEtiquetaCategoriaByID($id)
        ];

        echo view('/dashboard/etiqueta/show', $data);
    }

    public function create()
    {
        if( $this->validate('etiquetas') ){
            $data = [
                'title' => $this->request->getPost('title'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ];

            $this->etiquetaModel->insert($data);

            return redirect()->to('/dashboard/etiqueta')->with(
                'mensaje', 'Registro creado correctamente'
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
            'etiqueta' => $this->etiquetaModel->find($id),
            'categorias' => $this->categoriaModel->find()
        ];

        echo view('/dashboard/etiqueta/edit', $data);   
    }

    public function update($id)
    {        
        if( $this->validate('etiquetas') ){
            $data = [
                'title' => $this->request->getPost('title'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ];
    
            $this->etiquetaModel->update($id, $data);

            return redirect()->to('/dashboard/etiqueta')->with(
                'mensaje','Registro actualizado correctamente'
            );
        }  else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }               
    }

    public function delete($id)
    {
        $this->etiquetaModel->delete($id);

        return redirect()->to('/dashboard/etiqueta')->with(
            'mensaje','Registro eliminado correctamente'
        );;
    }
}