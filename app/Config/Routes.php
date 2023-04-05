<?php

namespace Config;
use App\Controllers\Dashboard\Pelicula;

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

// CRUD
$routes->group('dashboard', function($routes){
    $routes->presenter('pelicula', [
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
    //$routes->get('test', 'Pelicula::test', ['namespace' => 'App\Controllers\Dashboard']);
    //UTILIZAR ARRAY QUE NOS AYUDA A AGREGAR LOS PARAMETROS AUTOMATICAMENTE
    $routes->get('test', [\App\Controllers\Dashboard\Pelicula::class, 'test']); //Sin usar el USE que esta declarado arriba
    $routes->get('test/(:num)', [Pelicula::class, 'test']);
});

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
