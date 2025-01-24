<?php
// app/services/RegimeService.php

require_once '../app/models/RegimeModel.php';
require_once '../app/dtos/RegimeDTO.php';

class RegimeService {
    private $regimeModel;

    // Constructor: Inyección de dependencia para el modelo de régimen
    public function __construct($regimeModel) {
        $this->regimeModel = $regimeModel;
    }

    // Obtener todos los regímenes
    public function getAllRegimes() {
        return $this->regimeModel->getAllRegimes(); // Retorna todos los regímenes desde el modelo
    }
}
?>
