<?php
// app/dtos/ContractDTO.php

class ContractDTO {
    private $id;
    private $id_user;
    private $id_mode;
    private $id_regime;
    private $start_date;
    private $end_date;

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function getIdMode() {
        return $this->id_mode;
    }

    public function setIdMode($id_mode) {
        $this->id_mode = $id_mode;
    }

    public function getIdRegime() {
        return $this->id_regime;
    }

    public function setIdRegime($id_regime) {
        $this->id_regime = $id_regime;
    }

    public function getStartDate() {
        return $this->start_date;
    }

    public function setStartDate($start_date) {
        $this->start_date = $start_date;
    }

    public function getEndDate() {
        return $this->end_date;
    }

    public function setEndDate($end_date) {
        $this->end_date = $end_date;
    }
}
?>
