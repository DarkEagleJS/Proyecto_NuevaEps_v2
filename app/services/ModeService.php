<?php
// app/services/ModeService.php

require_once '../app/models/ModeModel.php';
require_once '../app/dtos/ModeDTO.php';

class ModeService {
    private $modeModel;

    // Constructor: Inyección de dependencia para el modelo de modo
    public function __construct($modeModel) {
        $this->modeModel = $modeModel;
    }

    // Obtener todos los modos
    public function getAllModes() {
        return $this->modeModel->getAllModes(); // Retorna todos los modos desde el modelo
    }
}
?>
