<?php

require_once '../core/route.php';
// Crear una instancia del Router
$router = new Router();

// Rutas públicas
$router->post('/register', 'UserController@register'); 
$router->get('/login', 'LoginController@showLoginForm');

// Rutas protegidas (requieren autenticación)
$router->get('/dashboard', 'UserController@dashboard'); // Página de usuario autenticado
$router->get('/admin/dashboard', 'AdminController@dashboard'); // Dashboard del admin

?>