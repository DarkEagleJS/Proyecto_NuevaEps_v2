<?php
// /app/models/ModeModel.php

require_once '../core/database.php';

class ModeModel {
    private $db;

    // Constructor: obtener la conexión de la base de datos
    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Obtener todos los modos
    public function getAllModes() {
        $this->db->query("SELECT * FROM Mode");
        return $this->db->resultSet();
    }

    // Obtener un modo por su ID
    public function getModeById($id) {
        $this->db->query("SELECT * FROM Mode WHERE id_mode = :id_mode");
        $this->db->bind(":id_mode", $id);
        return $this->db->single();
    }

    // Insertar un nuevo modo
    public function insertMode($description) {
        $this->db->query("INSERT INTO Mode (description) VALUES (:description)");
        $this->db->bind(":description", $description);
        return $this->db->execute();
    }

    // Actualizar un modo existente
    public function updateMode($id, $description) {
        $this->db->query("UPDATE Mode SET description = :description WHERE id_mode = :id_mode");
        $this->db->bind(":id_mode", $id);
        $this->db->bind(":description", $description);
        return $this->db->execute();
    }

    // Eliminar un modo por su ID
    public function deleteMode($id) {
        $this->db->query("DELETE FROM Mode WHERE id_mode = :id_mode");
        $this->db->bind(":id_mode", $id);
        return $this->db->execute();
    }
}
?>
