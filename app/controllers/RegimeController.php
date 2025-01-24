<?php
// app/controllers/RegimeController.php

require_once '../app/services/RegimeService.php';
require_once '../app/models/RegimeModel.php';
require_once '../core/database.php';
require_once '../app/middleware/AuthMiddleware.php'; // Importar el middleware
require_once '../core/database.php';

class RegimeController {
    private $regimeService;

    // Constructor: Inyección de dependencia para el servicio de régimen
    public function __construct($db) {
        $db = Database::getInstance();
        $regimeModel = new RegimeModel($db);
        $this->regimeService = new RegimeService($regimeModel);
        AuthMiddleware::check();
    }

    // Mostrar todos los regímenes
    public function listAllRegimes() {
        try {
            $regimesDTOs = $this->regimeService->getAllRegimes();
            require_once '../app/views/regimeList.php'; // Mostrar vista de regímenes
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
