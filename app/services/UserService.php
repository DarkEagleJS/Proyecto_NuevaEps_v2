<?php
// app/services/UserService.php

require_once '../app/dtos/UserDTO.php';
require_once '../app/models/UserModel.php';

class UserService {
    private $userModel;

    // Constructor: Inyección de dependencia para el modelo de usuario
    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    // Registrar un nuevo usuario
    public function registerUser(UserDTO $userDTO) {
        // Validación simple (puedes agregar más validaciones)
        if (empty($userDTO->getName()) || empty($userDTO->getEmail()) || empty($userDTO->getPassword())) {
            throw new Exception("Todos los campos son obligatorios");
        }

        // Comprobamos si el correo ya está registrado
        if ($this->userModel->getUserByEmail($userDTO->getEmail())) {
            throw new Exception("El correo electrónico ya está registrado");
        }

        // Guardar el usuario en la base de datos
        $this->userModel->createUser($userDTO);
    }

    // Autenticar un usuario
    public function authenticateUser($email, $password) {
        $user = $this->userModel->getUserByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new Exception("Correo o contraseña incorrectos");
        }

        return $user; // Retorna los datos del usuario autenticado
    }
}
?>
