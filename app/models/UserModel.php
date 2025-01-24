<?php
// app/models/UserModel.php

require_once '../core/database.php';

class UserModel {
    private $db;
    private $id;
    private $name;
    private $email;
    private $password;

    // Constructor: Se obtiene la conexión a la base de datos
    public function __construct($db) {
        $this->db = $db;
    }

    // Setters y Getters
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    // Obtener usuario por email
    public function getUserByEmail($email) {
        $this->db->query("SELECT * FROM usuarios WHERE email = :email");
        $this->db->bind(":email", $email);
        return $this->db->single();
    }

    // Insertar un nuevo usuario
    public function insertUser($name, $email, $password) {
        $this->db->query("INSERT INTO user (name, email, password) VALUES (:name, :email, :password)");
        $this->db->bind(":name", $name);
        $this->db->bind(":email", $email);
        $this->db->bind(":password", password_hash($password, PASSWORD_DEFAULT));
        return $this->db->execute();
    }
}
?>
