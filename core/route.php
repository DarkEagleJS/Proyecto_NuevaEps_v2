<?php

class Router {
    private $routes = [];

    // Registrar rutas para el método GET
    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    // Registrar rutas para el método POST
    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch($uri) {
        // Eliminar el prefijo '/Proyecto' si está presente en la URI
        $uri = preg_replace('/^\/Proyecto/', '', $uri);
    
        // Recortar las barras al inicio y al final de la URI
        $uri = trim($uri, '/');
    
        // Obtener el método HTTP de la solicitud
        $method = $_SERVER['REQUEST_METHOD'];
    
        // Verificar si la ruta está registrada
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            $this->callAction($action);
        } else {
            echo "Ruta no encontrada: " . $uri; // Si no se encuentra la ruta
        }
    }
    
    private function callAction($action) {
        // Dividir el controlador y el método
        list($controller, $method) = explode('@', $action);

        // Cambiar el nombre del controlador a la forma correcta
        $controller = ucfirst($controller) . "Controller";  // Convierte 'login' en 'LoginController'

        // Incluir el archivo del controlador
        $controllerFile = "../app/controllers/{$controller}.php";
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerObj = new $controller();
            $controllerObj->$method();  // Llamar al método del controlador
        } else {
            echo $controllerFile;
        }
    }
}
?>
