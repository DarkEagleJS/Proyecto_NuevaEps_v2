<?php
// app/controllers/ContractController.php

require_once '../app/services/ContractService.php';
require_once '../app/models/ContractModel.php';
require_once '../app/dtos/ContractDTO.php';
require_once '../core/database.php';

class ContractController {
    private $contractService;

    // Constructor: Inyección de dependencia para el servicio de contrato
    public function __construct($db) {
        $db = Database::getInstance();
        $contractModel = new ContractModel($db);
        $this->contractService = new ContractService($contractModel);
        AuthMiddleware::check();
    }

    // Registrar un nuevo contrato
    public function registerContract() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger datos del formulario
            $id_user = $_POST['id_user'];
            $id_mode = $_POST['id_mode'];
            $id_regime = $_POST['id_regime'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            // Crear DTO de contrato
            $contractDTO = new ContractDTO();
            $contractDTO->setIdUser($id_user);
            $contractDTO->setIdMode($id_mode);
            $contractDTO->setIdRegime($id_regime);
            $contractDTO->setStartDate($start_date);
            $contractDTO->setEndDate($end_date);

            try {
                // Llamar al servicio para registrar el contrato
                $this->contractService->registerContract($contractDTO);
                echo "Contrato registrado exitosamente!";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        // Mostrar formulario de contrato
        require_once '../app/views/contractForm.php';
    }

    // Listar los contratos de un usuario
    public function listContracts($userId) {
        try {
            $contractsDTOs = $this->contractService->getUserContracts($userId);
            require_once '../app/views/contractList.php'; // Mostrar lista de contratos
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
