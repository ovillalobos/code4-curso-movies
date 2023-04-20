<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Database\Migrations\PeliculaEtiqueta;
use App\Models\PeliculaModel;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pelicula extends BaseController
{    
    private $peliculaModel;
    private $categoriaModel;
    private $etiquetaModel;
    private $filePath;

    function __construct() {
        $this->peliculaModel = new PeliculaModel();
        $this->categoriaModel = new CategoriaModel();
        $this->etiquetaModel = new EtiquetaModel();

        //WRITEABLE PATH
        //$this->filePath = WRITEPATH.'uploads/peliculas';
        //PUBLIC PATH
        $this->filePath = '../public/uploads/peliculas';
    }

    public function index()
    {   
        //VERIFICAR COMO ESTA CONSTRUIDA LA CONSULTA
        //$db = \Config\Database::connect();
        //$builder = $db->table('peliculas');
        //return $builder->limit(10,20)->getCompiledSelect();

        //CONSULTA SIMPLE
        //$data = [ 'peliculas' => $this->peliculaModel->findAll() ];

        $data = [
            'peliculas' => $this->peliculaModel->getCategoriaByPelicula()
                                
        ];        

        echo view('/dashboard/pelicula/index', $data);
    }

    public function new()
    {
        $data = [
            'pelicula' => $this->peliculaModel,
            'categorias' => $this->categoriaModel->find()
        ];

        echo view('/dashboard/pelicula/new', $data);
    }

    public function show($id)
    {
        // Podemos hacer esta modificacion al nivel del modelo con  protected $returnType = 'array';
        // var_dump($this->peliculaModel->asArray()->find($id));     //Obtiene los valores como array (default)
        // var_dump($this->peliculaModel->asObject()->find($id));    //Obtiene los valores como objeto
        // var_dump( $this->peliculaModel->getImagesById($id) );     //Test function from Model
        // RELACION INVERSA POR ID DE IMAGEN Y OBTIENES LAS PELICULAS
        // $imagenModel = new ImagenModel();
        // var_dump( $imagenModel->getPeliculasById(2) );

        $data = [
            'pelicula' => $this->peliculaModel->getPeliculaCategoriaByID($id),
            'imagenes' => $this->peliculaModel->getImagesById($id),
            'etiquetas' => $this->peliculaModel->getEtiquetasById($id)
        ];

        echo view('/dashboard/pelicula/show', $data);
    }

    public function create()
    {
        if( $this->validate('peliculas') ){
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'categoria_id' => $this->request->getPost('categoria_id')
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
            'pelicula' => $this->peliculaModel->find($id),
            'categorias' => $this->categoriaModel->find()
        ];

        echo view('/dashboard/pelicula/edit', $data);   
    }

    public function update($id)
    {        
        if( $this->validate('peliculas') ){
            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ];
                
            $this->peliculaModel->update($id, $data);
            $uploaded = $this->asignar_imagen($id);
            if( $uploaded === "No_File_Uploaded" || $uploaded === true ){
                return redirect()->to('/dashboard/pelicula/show/'.$id)->with('mensaje','Registro actualizado correctamente');
            } else {
                return redirect()->back()->with('mensaje',$uploaded);
            }

            //OPCIONES PARA REDIRECCION            
            //return redirect()->back(); // Regresa a la pagina anterior
            //return redirect()->to('/dashboard/pelicula'); // Regresa a una pagina especifica
            //return redirect()->route('pelicula.test'); // Regresa a una ruta especifica { $routes->get('test', 'Pelicula::test', ['as' => 'pelicula.test']); }
            //return redirect()->to('/dashboard/pelicula')->with('mensaje','Registro actualizado correctamente');            
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

    /***********************************************************************
     * ETIQUETAS
     ***********************************************************************/
    public function etiquetas($id)
    {        
        $etiquetas = [];

        if( $this->request->getGet('categoria_id') ){
            $etiquetas = $this->etiquetaModel
                            ->where('categoria_id', $this->request->getGet('categoria_id'))
                            ->findAll();
        }

        $data = [
            'pelicula' => $this->peliculaModel->find($id),
            'categorias' => $this->categoriaModel->findAll(),
            'categoria_id' => $this->request->getGet('categoria_id'),
            'etiquetas' => $etiquetas
        ];

        echo view('dashboard/pelicula/etiquetas', $data);
    }

    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel  
            ->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $peliculaId)
            ->first();

        if( !$peliculaEtiqueta ){
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId
            ]);

            return redirect()->back()->with(
                'mensaje', 'Etiqueta agregada correctamente'
            );
        } else {
            return redirect()->back()->with(
                'mensaje', 'No se puede agregar una etiqueta dos veces en la misma pelicula'
            );
        }    
    }

    public function etiqueta_delete($peliculaId, $etiquetaId)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta   ->where('etiqueta_id', $etiquetaId)
                            ->where('pelicula_id', $peliculaId)
                            ->delete();

        echo '{"mensaje":"Eliminado"}';

        /* return redirect()->back()->with(
            'mensaje', 'Etiqueta eliminada correctamente'
        ); */
    }
    /***********************************************************************
     * IMAGENES
     ***********************************************************************/
    private function asignar_imagen($peliculaId)
    {
        if( $file = $this->request->getFile('imagen') ){
            //VALIDAR SI SE PUEDE PROCESAR
            if( $file->isValid() ){
                //FILTRAR ARCHIVO
                $validationRules = [
                    'imagen' => [
                        'label' => 'Image File',
                        'rules' => [
                            'uploaded[imagen]',
                            'mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                            'ext_in[imagen,jpg,jpeg,gif,png,webp]',
                            'max_size[imagen,4096]',
                            'max_dims[imagen,1024,768]',
                        ],
                    ]
                ];

                if( !$this->validate($validationRules) ){
                    return $this->validator->listErrors();
                } 
                
                //OBTENER NOMBRE ALEATORIO (RECOMENDADO)
                $imageName = $file->getRandomName();
                //OBTENER NOMBRE REAL DEL ARCHIVO
                //$imageName = $file->getName();
                $ext = $file->guessExtension();
                //MOVER EL ARCHIVO AL FOLDER WRITABLE PARA PROCESOS INTERNOS (NO PUBLICO) COMO EXCEL
                //$file->move(WRITEPATH.'uploads/peliculas',$imageName);
                //MOVER ARCHIVO AL FOLDER PUBLICO (PARA MOSTRAR AL PUBLICO)
                //$file->move('../public/uploads/peliculas',$imageName);

                //USING PRIVATE VARIABLE
                $file->move($this->filePath,$imageName);
                $this->update_peliculaImagen($peliculaId, $imageName, $ext);

                return true;
            }
        }

        return "No_File_Uploaded";
    }

    private function update_peliculaImagen($peliculaId, $imageName, $ext)
    {
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();

        $imagenId = $imagenModel->insert([
            'imagen' => $imageName,
            'extension' => $ext,
            'data' => MD5($imageName) //Aqui se agerga algo descriptivo de la imagen
        ]);
        
        $peliculaImagenModel->insert([
            'pelicula_id' => $peliculaId,
            'imagen_id' => $imagenId
        ]);
    }

    public function delete_image($pelicula_id, $image_id)
    {
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();

        //Borrar archivo
        $fileName = $imagenModel->find($image_id);
        if( $fileName == null ){
            return redirect()->back()->with(
                'mensaje', 'No exite el archivo por eliminar'
            );
        }                

        //ELIMINA LA RELACION DE LA IMAGEN Y PELICULA SELECCIONADA                
        $peliculaImagenModel->where('pelicula_id', $pelicula_id)->where('imagen_id', $image_id)->delete();

        //ELIMINA LA IMAGEN DE LA BASE DE DATOS Y EL ARCHIVO SIEMPRE Y CUANDO
        //NO HAYA MAS COINCIDENCIAS
        if( $peliculaImagenModel->where('imagen_id', $image_id)->countAllResults() == 0){
            //ELIMINA EL ARCHIVO
            $filePath = $this->filePath.'/'.$fileName->imagen;
            unlink($filePath);
            //ELIMINA LA IMAGEN DE LA BD
            $imagenModel->delete($image_id);
        }        

        return redirect()->back()->with(
            'mensaje', 'Imagen eliminada correctamente'
        );
    }

    public function download_file($image_id)
    {
        date_default_timezone_set('US/Arizona');
        $imagenModel = new ImagenModel();

        $fileName = $imagenModel->find($image_id);
        if( $fileName == null ){
            return redirect()->back()->with(
                'mensaje', 'No exite el archivo por eliminar'
            );
        }

        $filePath = $this->filePath.'/'.$fileName->imagen;
        $setFileName = 'file-name-pelicula-ver-'.date('mdY-His').'.'.$fileName->extension;

        return $this->response->download($filePath, null)->setFileName($setFileName);
    }
    /***********************************************************************
     * TEST FUNTIONS
     ***********************************************************************/
    public function test($arr = 0)
    {
        if($arr != 0){
            $testContent = "Hello world <strong>TEST - ".$arr."</strong>";
        } else {
            $testContent = "Hello world <strong>TEST</strong>";
        }        

        echo "<h3>".$testContent."</h3>";
    }

    //FILE FOLDER WRITEPATH SECURE SIDE (NOT PUBLIC)
    public function open_fileSecure($fileName)
    {
        if(!$fileName){
            $fileName = $this->request->getGet('fileName');
        }

        $file = WRITEPATH.'uploads/peliculas/'.$fileName;

        if(!file_exists($file)){
            //PUEDES REGRESAR CUALQUIER ERROR
            throw PageNotFoundException::forPageNotFound();
        }

        $fp = fopen($file, 'rb');

        //REGRESA LAS CABECERAS CORRECTAS
        header("Content-Type: image/jpg");
        header("Content-Length: ".filesize($file));

        //VUELA LA IMAGEN Y DETIENE EL SCRIPT
        fpassthru($fp);
        exit;
    }
}