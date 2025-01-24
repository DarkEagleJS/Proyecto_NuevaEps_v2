<?php
// /app/models/ContractModel.php

require_once '../core/database.php';

class ContractModel {
    private $db;

    // Constructor: obtener la conexión de la base de datos
    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Obtener todos los contratos
    public function getAllContracts() {
        $this->db->query("SELECT * FROM Contract");
        return $this->db->resultSet();
    }

    // Obtener un contrato por su ID
    public function getContractById($id) {
        $this->db->query("SELECT * FROM Contract WHERE id_contract = :id_contract");
        $this->db->bind(":id_contract", $id);
        return $this->db->single();
    }

    // Obtener los contratos de un usuario por su ID
    public function getContractsByUserId($userId) {
        $this->db->query("SELECT * FROM Contract WHERE id_user = :id_user");
        $this->db->bind(":id_user", $userId);
        return $this->db->resultSet();
    }

    // Insertar un nuevo contrato
    public function insertContract($userId, $modeId, $regimeId, $startDate, $endDate) {
        $this->db->query("INSERT INTO Contract (id_user, id_mode, id_regime, start_date, end_date) VALUES (:id_user, :id_mode, :id_regime, :start_date, :end_date)");
        $this->db->bind(":id_user", $userId);
        $this->db->bind(":id_mode", $modeId);
        $this->db->bind(":id_regime", $regimeId);
        $this->db->bind(":start_date", $startDate);
        $this->db->bind(":end_date", $endDate);
        return $this->db->execute();
    }

    // Actualizar un contrato existente
    public function updateContract($id, $userId, $modeId, $regimeId, $startDate, $endDate) {
        $this->db->query("UPDATE Contract SET id_user = :id_user, id_mode = :id_mode, id_regime = :id_regime, start_date = :start_date, end_date = :end_date WHERE id_contract = :id_contract");
        $this->db->bind(":id_contract", $id);
        $this->db->bind(":id_user", $userId);
        $this->db->bind(":id_mode", $modeId);
        $this->db->bind(":id_regime", $regimeId);
        $this->db->bind(":start_date", $startDate);
        $this->db->bind(":end_date", $endDate);
        return $this->db->execute();
    }

    // Eliminar un contrato por su ID
    public function deleteContract($id) {
        $this->db->query("DELETE FROM Contract WHERE id_contract = :id_contract");
        $this->db->bind(":id_contract", $id);
        return $this->db->execute();
    }
}
?>
