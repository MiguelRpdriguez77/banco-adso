<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Nucleo\Router;

$router = new Router();

$router->registrar('/', 'LoginControlador', 'index');

$router->registrar('/login', 'LoginControlador', 'index');
$router->registrar('/logout', 'LogoutControlador', 'index');
$router->registrar('/panel', 'PanelControlador', 'index');
$router->registrar('/retiro', 'RetiroControlador', 'index');
$router->registrar('/transferencias', 'TransferenciaControlador', 'index');

$url = $_SERVER['REQUEST_URI'];
$router->disparar($url);