<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function login()
    {
        echo view('web/usuario/login');
    }    

    public function login_post()
    {
        $email = $this->request->getPost('email'); //email or usuario
        $password = $this->request->getPost('password');

        $usuario = $this->usuarioModel->select('id, usuario, email, password, tipo')
                        ->orWhere('email',$email)
                        ->orWhere('usuario',$email)
                        ->first();

        if( !$usuario ){
            return redirect()->back()->with(
                'mensaje', 'Usuario y/o Password invalido'
            );
        } 
        
        if( $this->usuarioModel->passwordValidate( $password, $usuario->password ) ){
            unset($usuario->password);

            //OPTION BASIC
            //$session = session();        
            //$session->set( 'usuario', $usuario );
            //OPTION CODEIGNITER
            session()->set('usuario', $usuario);

            return redirect()->to('/dashboard/categoria')->with(
                'mensaje', "Bienvenido $usuario->usuario"
            );
        } else {
            return redirect()->back()->with(
                'mensaje', 'Usuario y/o Password invalido');
        }
    }    

    public function register()
    {
        echo view('web/usuario/register');
    }    

    public function register_post()
    {

        if( $this->validate('usuarios') ){
            $this->usuarioModel->insert([
                'usuario'   => $this->request->getPost('usuario'),
                'email'     => $this->request->getPost('email'),
                'password'  => $this->usuarioModel->passwordHash($this->request->getPost('password'))
            ]);
            
            return redirect()->to(route_to('usuario.login'))->with(
                'mensaje', "Usuario creado exitosamente"
            );
        }

        session()->setFlashdata([
            'validation' => $this->validator
        ]);

        return redirect()->back()->withInput();
    }    

    public function logout()
    {
        session()->destroy();

        return redirect()->to(route_to('usuario.login'));
    }
    /************************************************************
     * TESTING FUNCTIONS
    *************************************************************/
    public function crear_usuario_auto()
    {
        $data = [
            'usuario' => 'admin',
            'email' => 'admin@app.com',
            'password' => $this->usuarioModel->passwordHash('123456')
        ];

        $this->usuarioModel->insert($data);
    }

    public function probar_password()
    {
        echo $this->usuarioModel->passwordValidate('123456', '$2y$10$RNfngCJzJwOTri5mrExhJOWwMdH5SN6EnIhlKQoaW/xdtecCJzs2e');
    }
}
