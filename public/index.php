<?php
require_once '../core/route.php';
require_once '../core/routes.php';

// Iniciar una sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Enviar la URL solicitada al enrutador
$router->dispatch($_SERVER['REQUEST_URI']);

// Configura el controlador y la acción
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'login'; // Asegúrate de que 'home' está bien escrito en minúsculas
$action = isset($_GET['action']) ? $_GET['action'] : 'showLoginForm';

// Verifica si el controlador existe y lo carga
$controllerFile = "../app/controllers/{$controller}Controller.php";
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = ucfirst($controller) . "Controller"; // Capitalizar la primera letra de la clase
    $controllerObj = new $controller();
    $controllerObj->$action();
} else {
    // Si el controlador no existe, carga un controlador por defecto (por ejemplo, Home)
    require_once "../app/controllers/LoginController.php";
    $controllerObj = new LoginController();
    $controllerObj->showLoginForm();
}

?>

