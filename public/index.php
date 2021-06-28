<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadControllers;
use Controllers\VendedorController;
use Controllers\PaginasControllers;

$router = new Router();

//Zona privada
$router->get('/admin', [PropiedadControllers::class, 'index']);
$router->get('/propiedades/crear', [PropiedadControllers::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadControllers::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadControllers::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadControllers::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadControllers::class, 'eliminar']);


$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);


//Zona publica
$router->get('/', [PaginasControllers::class, 'index']);
$router->get('/nosotros', [PaginasControllers::class, 'nosotros']);
$router->get('/propiedades', [PaginasControllers::class, 'propiedades']);
$router->get('/propiedad', [PaginasControllers::class, 'propiedad']);
$router->get('/blog', [PaginasControllers::class, 'blog']);
$router->get('/entrada', [PaginasControllers::class, 'entrada']);
$router->get('/contacto', [PaginasControllers::class, 'contacto']);
$router->post('/contacto', [PaginasControllers::class, 'contacto']);

//Login y autentificacion
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->comprobarRutas();
