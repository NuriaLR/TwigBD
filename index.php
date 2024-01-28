<?php
require_once './db/Database.php';
require_once './vendor/autoload.php';
require_once 'Router.php';

require_once './controller/IndexController.php';
require_once './controller/PedidosController.php';
require_once './controller/ClientesController.php';
require_once './controller/ProductosController.php';

$database = new Database ('root', '', 'localhost', 3307);
$dbConex= $database->conectar();
Database::desconectar();

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
$twig->addGlobal('URL', $_SERVER['REQUEST_URI']);

$route = new Router();
$route->get('/',[IndexController::class,'index'])

->get('/clientes',[ClientesController::class,'index'])
->get('/pedidos',[PedidosController::class,'index'])
->get('/productos',[ProductosController::class,'index'])

->get('/editarProducto',[ProductosController::class,'edit'])
->post('/cambiarProducto',[ProductosController::class,'update'])
->get('/agregarProducto',[ProductosController::class,'create'])
->post('/guardarProducto',[ProductosController::class,'save'])
->get('/eliminarProducto',[ProductosController::class,'destroy'])

->get('/estadosClientes',[PedidosController::class,'estadosClientes']);


$route->resolver_ruta($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

