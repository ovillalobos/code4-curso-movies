<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController {

    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json'; // json | xml

    public function index()
    {
        return $this->respond($this->model->findAll(),200);
    }

    public function show($id = null)
    {
        if( $id != null ){
            return $this->respond($this->model->find($id),200);            
        } else {
            return $this->respond('no_data', 400);
        }
    }

    public function create()
    {
        if( $this->validate('peliculas') ){
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description')
            ];

            $id = $this->model->insert($data);

            return $this->respond($id, 200);
        } else {
            return $this->respond($this->validator->getErrors(), 400);
        }
    }

    public function update($id = null)
    {
        if( $id != null ){
            if( $this->validate('peliculas') ){
                $data = [
                    'title' => $this->request->getRawInput()['title'],
                    'description' => $this->request->getRawInput()['description']
                ];
        
                $this->model->update($id, $data);

                return $this->respond($id, 200);
            }  else {
                // SEND ALL ERRORS
                // return $this->respond($this->validator->getErrors(), 400);

                // SEND EACH ERROR
                if( $this->validator->getError('title') ){
                    return $this->respond($this->validator->getError('title'), 400);
                }
                if( $this->validator->getError('description') ){
                    return $this->respond($this->validator->getError('description'), 400);
                }                
            } 
            
        } else {
            return $this->respond('no_data', 400);
        }      
    }

    public function delete($id = null)
    {
        if( $id !=  null ){
            if( $this->model->delete($id) ){
                return $this->respond('deleted', 200);
            } else {
                return $this->respond('invalid_data', 400);
            }
        } else {
            return $this->respond('no_data', 400);
        }      
    }
}

?>