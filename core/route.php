<?php
class Router {
    private $routes = [];

    // Método para definir rutas GET
    public function get($url, $controllerAction) {
        $this->routes['GET'][$url] = $controllerAction;
    }

    // Método para definir rutas POST
    public function post($url, $controllerAction) {
        $this->routes['POST'][$url] = $controllerAction;
    }

    // Método para despachar la ruta según la solicitud
    public function dispatch($url) {
        $method = $_SERVER['REQUEST_METHOD'];

        // Verificamos si la ruta existe para el método
        if (isset($this->routes[$method][$url])) {
            // Desglosamos el controlador y la acción
            list($controller, $action) = explode('@', $this->routes[$method][$url]);

            // Verificamos que el controlador exista
            if (class_exists($controller)) {
                $controllerInstance = new $controller();
                
                // Verificamos que la acción exista en el controlador
                if (method_exists($controllerInstance, $action)) {
                    $controllerInstance->$action(); // Ejecutamos la acción
                } else {
                    echo "Acción no encontrada: $action";
                }
            } else {
                echo "Controlador no encontrado: $controller";
            }
        } else {
            echo "Ruta no encontrada: $url";
        }
    }
}
