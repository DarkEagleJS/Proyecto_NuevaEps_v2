<?php
// /app/models/FileModel.php

require_once '../core/database.php';

class FileModel {
    private $db;

    // Constructor: obtener la conexión de la base de datos
    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Obtener todos los archivos de un contrato
    public function getFilesByContractId($contractId) {
        $this->db->query("SELECT * FROM File WHERE id_contract = :id_contract");
        $this->db->bind(":id_contract", $contractId);
        return $this->db->resultSet();
    }

    // Obtener un archivo por su ID
    public function getFileById($id) {
        $this->db->query("SELECT * FROM File WHERE id_file = :id_file");
        $this->db->bind(":id_file", $id);
        return $this->db->single();
    }

    // Insertar un nuevo archivo
    public function insertFile($contractId, $nameFile, $filePath, $uploadDate) {
        $this->db->query("INSERT INTO File (id_contract, name_file, file_path, upload_date) VALUES (:id_contract, :name_file, :file_path, :upload_date)");
        $this->db->bind(":id_contract", $contractId);
        $this->db->bind(":name_file", $nameFile);
        $this->db->bind(":file_path", $filePath);
        $this->db->bind(":upload_date", $uploadDate);
        return $this->db->execute();
    }

    // Actualizar un archivo existente
    public function updateFile($id, $nameFile, $filePath, $uploadDate) {
        $this->db->query("UPDATE File SET name_file = :name_file, file_path = :file_path, upload_date = :upload_date WHERE id_file = :id_file");
        $this->db->bind(":id_file", $id);
        $this->db->bind(":name_file", $nameFile);
        $this->db->bind(":file_path", $filePath);
        $this->db->bind(":upload_date", $uploadDate);
        return $this->db->execute();
    }

    // Eliminar un archivo por su ID
    public function deleteFile($id) {
        $this->db->query("DELETE FROM File WHERE id_file = :id_file");
        $this->db->bind(":id_file", $id);
        return $this->db->execute();
    }
}
?>
