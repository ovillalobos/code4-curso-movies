<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    
    public $categorias = [
        'title' => 'required|min_length[3]|max_length[255]'
    ];
    public $peliculas = [
        'title' => 'required|min_length[3]|max_length[255]',
        'description' => 'required|min_length[3]|max_length[255]',
        'categoria_id' => 'required|is_natural'
    ];    
    public $etiquetas = [
        'title' => 'required|min_length[3]|max_length[255]',
        'categoria_id' => 'required|is_natural'
    ];
    public $usuarios =[
        'usuario' => 'required|min_length[3]|max_length[20]|is_unique[usuarios.usuario]',
        'email' => 'required|min_length[3]|max_length[80]|is_unique[usuarios.email]',
        'password' => 'required|min_length[3]|max_length[20]',
    ];
}
