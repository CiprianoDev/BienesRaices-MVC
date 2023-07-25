<?php
require_once __DIR__ . "/../includes/app.php";

use controllers\BlogsController;
use controllers\LoginController;
use controllers\PaginasController;
use MVC\Router;
use controllers\PropiedadController;
use controllers\VendedorController;

$router = new Router();

//rutas de propiedades
$router->get('/admin',[PropiedadController::class,'index']);
$router->get('/propiedades/crear',[PropiedadController::class,'crear']);
$router->post('/propiedades/crear',[PropiedadController::class,'crear']);
$router->get('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->post('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->post('/propiedades/eliminar',[PropiedadController::class,'eliminar']);

// rutas de vendedores
$router->get('/vendedores/crear',[VendedorController::class,'crear']);
$router->post('/vendedores/crear',[VendedorController::class,'crear']);
$router->get('/vendedores/actualizar',[VendedorController::class,'actualizar']);
$router->post('/vendedores/actualizar',[VendedorController::class,'actualizar']);
$router->post('/vendedores/eliminar',[VendedorController::class,'eliminar']);

//paginas
$router->get('/',[PaginasController::class,'index']);
$router->get('/nosotros',[PaginasController::class,'nosotros']);
$router->get('/anuncios',[PaginasController::class,'anuncios']);
$router->get('/anuncio',[PaginasController::class,'anuncio']);
$router->get('/contacto',[PaginasController::class,'contacto']);
$router->post('/contacto',[PaginasController::class,'contacto']);

//blogs
$router->get('/blog',[PaginasController::class,'blog']);
$router->get('/blogs/crear',[BlogsController::class,'crear']);
$router->post('/blogs/crear',[BlogsController::class,'crear']);
$router->get('/blogs/actualizar',[BlogsController::class,'actualizar']);
$router->get('/blogs/entrada',[BlogsController::class,'entrada']);
$router->post('/blogs/actualizar',[BlogsController::class,'actualizar']);
$router->post('/blogs/eliminar',[BlogsController::class,'eliminar']);

//Autenticacion y login 

$router->get('/login',[LoginController::class,'login']);
$router->post('/login',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);

$router->comprobarRutas();