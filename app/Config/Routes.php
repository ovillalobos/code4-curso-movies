<?php

namespace Config;
use App\Controllers\Dashboard\Pelicula;
use CodeIgniter\Router\Router;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('pelicula');
//$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// HTTP get/post/put/patch/delete
// ROUTES(auto) ->presenter (local request{get/post}) 
// ROUTES(auto) ->resource (API rest{get/post/put/delete})

//$routes->get('/', 'Home::index');
//$routes->get('/pelicula', 'PeliculaController::index');


// CRUD HTTP API-REST
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes){
    $routes->resource('pelicula');
    $routes->resource('categoria');
});

// CRUD
$routes->group('dashboard', function($routes){
    //ETIQUETAS
    $routes->get('pelicula/etiqueta/(:num)', [\App\Controllers\Dashboard\Pelicula::class, 'etiquetas/$1'], ['as' => 'pelicula.etiquetas'] );
    $routes->post('pelicula/etiqueta/(:num)', [\App\Controllers\Dashboard\Pelicula::class, 'etiquetas_post/$1'], ['as' => 'pelicula.etiquetas'] );
    $routes->post('pelicula/(:num)/etiqueta/(:num)/delete', [\App\Controllers\Dashboard\Pelicula::class, 'etiqueta_delete/$1/$2'], ['as' => 'pelicula.etiqueta_delete']);    
    //SOLO ELIMINADO IMAGEN Y SU RELACION CON UNA PELICULA
    //$routes->post('pelicula/delete_image/(:num)', [\App\Controllers\Dashboard\Pelicula::class, 'delete_image/$1'], ['as' => 'pelicula.delete_image'] );
    //ELIMINADO LA IMAGEN, PELICULA Y SUS RELACIONES
    $routes->post('pelicula/delete_image/(:num)/(:num)', [\App\Controllers\Dashboard\Pelicula::class, 'delete_image/$1/$2'], ['as' => 'pelicula.delete_image'] );
    $routes->get('pelicula/download_file/(:num)', [\App\Controllers\Dashboard\Pelicula::class, 'download_file/$1'], ['as' => 'pelicula.download_file'] );
    //TEST IMAGE SECURE
    $routes->get('pelicula/openfile/(:any)', [\App\Controllers\Dashboard\Pelicula::class, 'open_fileSecure/$1']);

    $routes->presenter('pelicula', [
        //'controller' => 'Dashboard\Pelicula',
        'namespace' => 'App\Controllers\Dashboard'
    ]);

    $routes->presenter('etiqueta', [
        //'controller' => 'Dashboard\Pelicula',
        'namespace' => 'App\Controllers\Dashboard'
    ]);

    $routes->presenter('categoria',[
        //'only' => ['index','create']
        //'except' => ['show']
        'controller' => 'Dashboard\Categoria'
    ]);

    //RENOMBRAR CONTROLADOR
    //$routes->get('test', 'Dashboard\Pelicula::test', ['as' => 'pelicula.test']);
    //UTILIZAR NAMESPACE EN CONTROLADOR
    //$routes->get('test', 'Pelicula::test', ['namespace' => 'App\Controllers\Dashboacleard']);
    //UTILIZAR ARRAY QUE NOS AYUDA A AGREGAR LOS PARAMETROS AUTOMATICAMENTE
    $routes->get('test', [\App\Controllers\Dashboard\Pelicula::class, 'test']); //Sin usar el USE que esta declarado arriba
    $routes->get('test/(:num)', [Pelicula::class, 'test']); //Utilizando el USE

    //SIN USAR NAMESPACE
    $routes->get('usuario/crear',[\App\Controllers\Web\Usuario::class, 'crear_usuario_auto']);
    $routes->get('usuario/probar/password',[\App\Controllers\Web\Usuario::class, 'probar_password']);

});

$routes->get('login', [\App\Controllers\Web\Usuario::class, 'login'],[
    'as' => 'usuario.login'
]);
$routes->post('login', [\App\Controllers\Web\Usuario::class, 'login_post'],[
    'as' => 'usuario.login_post'
]);
$routes->get('register', [\App\Controllers\Web\Usuario::class, 'register'],[
    'as' => 'usuario.register'
]);
$routes->post('register', [\App\Controllers\Web\Usuario::class, 'register_post'],[
    'as' => 'usuario.register_post'
]);
$routes->get('logout', [\App\Controllers\Web\Usuario::class, 'logout'],[
    'as' => 'usuario.logout'
]);
$routes->get('map', [\App\Controllers\Web\Usuario::class, 'map'],[
    'as' => 'usuario.map'
]);


//TIPOS DE ARGUMENTOS
/*
(:any) Todos los caracteres
(:segmento) Todos los caracteres excepto (/)
(:num) Numero entero
(:alpha) Caracteres alfabeticos
(:alphanum) Caracteres alfabeticos/numeros combinacion
(:hash) Lo mismo que segmento, pero se usa para identificadores

*/
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
