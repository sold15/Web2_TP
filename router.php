<?php
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

require_once './app/controllers/UsuarioController.php';
require_once './app/controllers/ViajeController.php';
require_once './app/controllers/AuthController.php';


$action = 'ViajesDestinos'; // acción por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}
$params = explode('/', $action);

AuthHelper::init();
switch ($params[0]) {
    case 'Usuarios':
        $controller = new UsuarioController();
        $controller->showAllUsuarios();
        break;
    
    case 'UsuariosDetalles': 
        $controller = new UsuarioController();
        $controller->showDetailsUsuario($params[1]);
        break;
 
    case 'FormAgregarUsuario':
        $controller = new UsuarioController();
        $controller->formAgregarUsuario();
        break;
    case 'AgregarUsuario':
        $controller = new UsuarioController();
        $controller->addUsuario();
        break;
    case 'FormActualizarUsuario':
        $controller = new UsuarioController();
        $controller->formActualizarUsuario($params[1]);
        break;
    case 'ActualizarUsuario':
        $controller = new UsuarioController();
        $controller->updateUsuario($params[1]);
        break;
    case 'EliminarUsuario':
        $controller = new UsuarioController();
        $controller->deleteUsuario($params[1]);
        break;
    case 'Viajes':
        $controller = new ViajeController();
        $controller->showDestino();
        break;
    case 'ViajesDestinos':
        $controller = new ViajeController();
        $controller->showDestino();
        break;
    case 'ViajeDetalles':
        $controller = new ViajeController();
        $controller->showDetailsViaje($params[1]);
        break;
    case 'FormAgregarViaje':
        $controller = new ViajeController();
        $controller->formAgregarViajes();
        break;
    case 'AgregarViaje':
        $controller = new ViajeController();
        $controller->addViaje();
        break;
    case 'EliminarViaje':
        $controller = new ViajeController();
        $controller->deleteViaje($params[1]);
        break;
    case 'FormActualizarViaje':
        $controller = new ViajeController();
        $controller->formActualizarViajes($params[1]);
        break;
    case 'ActualizarViaje':
        $controller = new ViajeController();
        $controller->updateViaje($params[1]);
        break;
    case 'LogIn':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'Autorizacion':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'LogOut':
        $controller = new AuthController();
        $controller->logOut();
        break;
    default:
        $controller = new ViajeController();
        $controller->showError("404 PAGE NOT FOUND");
        break;
    }