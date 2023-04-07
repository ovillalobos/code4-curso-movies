<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['usuario', 'email', 'password']; //No se agrega tipo por seguridad, la unica forma sera por base de datos


    /************************************************************
     * FUNCTIONS
    *************************************************************/
    public function passwordHash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function passwordValidate($password, $passwordHash)
    {
        return password_verify($password, $passwordHash);
    }
}
