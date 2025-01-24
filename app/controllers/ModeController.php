<?php
// app/controllers/ModeController.php

require_once '../app/services/ModeService.php';
require_once '../app/models/ModeModel.php';
require_once '../core/database.php';
require_once '../app/middleware/AuthMiddleware.php'; // Importar el middleware
require_once '../core/controller.php';

class ModeController {
    private $modeService;

    // Constructor: Inyección de dependencia para el servicio de modo
    public function __construct($db) {
        $db = Database::getInstance();
        $modeModel = new ModeModel($db);
        $this->modeService = new ModeService($modeModel);
        AuthMiddleware::check();
    }

    // Mostrar todos los modos
    public function listAllModes() {
        try {
            $modesDTOs = $this->modeService->getAllModes();
            require_once '../app/views/modeList.php'; // Mostrar vista de modos
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
