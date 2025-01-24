<?php
// app/dtos/FileDTO.php

class FileDTO {
    private $id;
    private $id_contract;
    private $name_file;
    private $file_path;
    private $upload_date;

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdContract() {
        return $this->id_contract;
    }

    public function setIdContract($id_contract) {
        $this->id_contract = $id_contract;
    }

    public function getNameFile() {
        return $this->name_file;
    }

    public function setNameFile($name_file) {
        $this->name_file = $name_file;
    }

    public function getFilePath() {
        return $this->file_path;
    }

    public function setFilePath($file_path) {
        $this->file_path = $file_path;
    }

    public function getUploadDate() {
        return $this->upload_date;
    }

    public function setUploadDate($upload_date) {
        $this->upload_date = $upload_date;
    }
}
?>
