<?php
use App\Http\Controller;
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    // return $router->app->version();
    return "Hello World";
});

/*Correspondiente a Autenticacion*/

/*Correspondiente a Usuario*/

$router->get('/usuario/{pag}[/{busqueda}]',['uses'=>'UsuarioControlador@listarPanel']);

// $router->get('/usuario/lista',['uses'=>'UsuarioControlador@listar']);

$router->post('/usuario',['uses'=>'UsuarioControlador@nuevo']);
$router->post('/usuario/{id}',['uses'=>'UsuarioControlador@modificar']);












?>
