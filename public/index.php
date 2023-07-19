<?php
require_once __DIR__ . "/../includes/app.php";

use MVC\Router;
use controllers\PropiedadController;
use controllers\VendedorController;

$router = new Router();


$router->get('/admin',[PropiedadController::class,'index']);

//rutas de propiedades
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
$router->comprobarRutas();