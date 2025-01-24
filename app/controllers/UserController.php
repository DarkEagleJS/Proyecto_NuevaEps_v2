<?php
// /app/controllers/UserController.php

require_once '../app/services/UserService.php';
require_once '../app/models/UserModel.php';
require_once '../app/dtos/UserDTO.php';
require_once '../core/database.php';
require_once '../app/middleware/AuthMiddleware.php'; // Importar el middleware
require_once '../core/controller.php';

class UserController extends Controller {
    private $userService;

    // Constructor: Inyección de dependencia para el servicio de usuario
    public function __construct($db) {
        // Obtener la instancia de la base de datos usando el patrón Singleton
        $db = Database::getInstance();

        // Crear el modelo de usuario con la instancia de la base de datos
        $userModel = new UserModel($db);

        // Crear el servicio de usuario con el modelo
        $this->userService = new UserService($userModel);

        // Verificar si el usuario está autenticado antes de continuar (si es necesario)
        AuthMiddleware::check();
    }

    // Registrar un nuevo usuario
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger datos del formulario
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Crear DTO de Usuario
            $userDTO = new UserDTO();
            $userDTO->setName($name);
            $userDTO->setEmail($email);
            $userDTO->setPassword($password);

            try {
                // Llamar al servicio para registrar el usuario
                $this->userService->registerUser($userDTO);
                echo "Usuario registrado exitosamente!";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        // Mostrar el formulario de registro
        $this->view('login', $data);
    }
 
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm() {
        $data = [
            'title' => 'Iniciar sesión',
            'message' => 'Por favor ingresa tus credenciales'
        ];

        // Delegamos la renderización de la vista a la clase View
        $this->view('login', $data);
    }

    // Iniciar sesión
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            try {
                // Llamamos al servicio para autenticar al usuario
                $user = $this->userService->authenticateUser($email, $password);

                // Si la autenticación fue exitosa, guardamos los datos en la sesión
                if ($user) {
                    session_start(); // Iniciar la sesión
                    $_SESSION['user_id'] = $user['id_user']; // Guardar el ID del usuario
                    $_SESSION['user_name'] = $user['name'];  // Guardar el nombre del usuario
                    $_SESSION['user_email'] = $user['email']; // Guardar el correo electrónico del usuario

                    // Redirigir al dashboard o página principal
                    header("Location: /dashboard");
                    exit();
                } else {
                    throw new Exception("Credenciales incorrectas.");
                }

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        // Mostrar el formulario de login
        require_once '../app/views/loginForm.php';
    }
}
