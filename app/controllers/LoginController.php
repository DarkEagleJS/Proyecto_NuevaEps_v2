<?php
// /app/controllers/LoginController.php.php

require_once '../core/database.php';
require_once '../app/middleware/AuthMiddleware.php'; // Importar el middleware
require_once '../core/controller.php';
require_once '../app/models/UserModel.php';
require_once '../app/services/UserService.php';

class LoginController extends Controller {
    // Constructor: Inyección de dependencia para el servicio de usuario
    public function __construct() {
        $db = Database::getInstance();
        // Crear el modelo de usuario con la instancia de la base de datos
        $userModel = new UserModel($db);
        // Crear el servicio de usuario con el modelo
        $this->userService = new UserService($userModel);
        // Verificar si el usuario está autenticado antes de continuar (si es necesario)
        AuthMiddleware::check();
    }

    // Mostrar el formulario de registro
    public function showLoginForm() {
        $this->view->render('login');
    }

}
