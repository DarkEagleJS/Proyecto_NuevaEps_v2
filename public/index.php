<?php

// Si la URI es exactamente '/Proyecto/public/index.php' o '/Proyecto', redirige a '/Proyecto/login'
if ($_SERVER['REQUEST_URI'] == '/Proyecto/public/index.php' || $_SERVER['REQUEST_URI'] == '/Proyecto') {
    header('Location: /Proyecto/login'); // Redirige a la ruta de login
    exit; // Detiene la ejecución del script después de la redirección
}

require_once '../core/route.php';  // Cargar el enrutador
require_once '../core/routes.php'; // Opcional, si tienes rutas predefinidas

// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Crear una instancia del enrutador
$router = new Router();

// Registrar las rutas
$router->get('/login', 'LoginController@showLoginForm');
$router->post('/login', 'LoginController@processLogin');
$router->get('/dashboard', 'UserController@dashboard');
$router->get('/admin/dashboard', 'AdminController@dashboard');

// Enviar la URL solicitada al enrutador para que la gestione
$router->dispatch($_SERVER['REQUEST_URI']);

?>