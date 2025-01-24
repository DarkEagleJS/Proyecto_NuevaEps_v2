<?php
// /app/models/RegimeModel.php

require_once '../core/database.php';

class RegimeModel {
    private $db;

    // Constructor: obtener la conexión de la base de datos
    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Obtener todos los regimes
    public function getAllRegimes() {
        $this->db->query("SELECT * FROM Regime");
        return $this->db->resultSet();
    }

    // Obtener un régimen por su ID
    public function getRegimeById($id) {
        $this->db->query("SELECT * FROM Regime WHERE id_regime = :id_regime");
        $this->db->bind(":id_regime", $id);
        return $this->db->single();
    }

    // Insertar un nuevo régimen
    public function insertRegime($description) {
        $this->db->query("INSERT INTO Regime (description) VALUES (:description)");
        $this->db->bind(":description", $description);
        return $this->db->execute();
    }

    // Actualizar un régimen existente
    public function updateRegime($id, $description) {
        $this->db->query("UPDATE Regime SET description = :description WHERE id_regime = :id_regime");
        $this->db->bind(":id_regime", $id);
        $this->db->bind(":description", $description);
        return $this->db->execute();
    }

    // Eliminar un régimen por su ID
    public function deleteRegime($id) {
        $this->db->query("DELETE FROM Regime WHERE id_regime = :id_regime");
        $this->db->bind(":id_regime", $id);
        return $this->db->execute();
    }
}
?>
