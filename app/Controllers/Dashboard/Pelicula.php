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
        //HELP-> PARA VERIFICAR COMO ESTA CONSTRUIDA LA CONSULTA
        /*
        $db = \Config\Database::connect();
        $builder = $db->table('peliculas');
        return $builder->limit(10,20)->getCompiledSelect();
        */

        $data = [
            'peliculas' => $this->peliculaModel->findAll()
        ];

        echo view('/dashboard/pelicula/index', $data);
    }

    public function new()
    {
        $data = [
            'pelicula' => new PeliculaModel()
        ];

        echo view('/dashboard/pelicula/new', $data);
    }

    public function show($id)
    {
        // Podemos hacer esta modificacion al nivel del modelo con  protected $returnType = 'array';
        //var_dump($this->peliculaModel->asArray()->find($id));     //Obtiene los valores como array (default)
        //var_dump($this->peliculaModel->asObject()->find($id));    //Obtiene los valores como objeto
        
        $data = [
            'pelicula' => $this->peliculaModel->find($id)
        ];

        echo view('/dashboard/pelicula/show', $data);
    }

    public function create()
    {
        if( $this->validate('peliculas') ){
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description')
            ];

            $this->peliculaModel->insert($data);

            return redirect()->to('/dashboard/pelicula')->with(
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
            'pelicula' => $this->peliculaModel->find($id)
        ];

        echo view('/dashboard/pelicula/edit', $data);   
    }

    public function update($id)
    {        
        if( $this->validate('peliculas') ){
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description')
            ];
    
            $this->peliculaModel->update($id, $data);

            //REDIRECCIONE
            //return redirect()->back(); // Regresa a la pagina anterior
            //return redirect()->to('/dashboard/pelicula'); // Regresa a una pagina especifica
            //return redirect()->route('pelicula.test'); // Regresa a una ruta especifica { $routes->get('test', 'Pelicula::test', ['as' => 'pelicula.test']); }
            return redirect()->to('/dashboard/pelicula')->with(
                'mensaje','Registro actualizado correctamente'
            );
        }  else {
            // $this->validator->getError('title')
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }               
    }

    public function delete($id)
    {
        $this->peliculaModel->delete($id);

        echo "deleted";

        return redirect()->to('/dashboard/pelicula')->with(
            'mensaje','Registro eliminado correctamente'
        );;
    }

    public function test($arr = 0)
    {
        if($arr != 0){
            $testContent = "Hello world <strong>TEST - ".$arr."</strong>";
        } else {
            $testContent = "Hello world <strong>TEST</strong>";
        }        

        echo "<h3>".$testContent."</h3>";
    }
}