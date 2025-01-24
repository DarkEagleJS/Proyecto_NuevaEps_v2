<?php
// app/services/ContractService.php

require_once '../app/models/ContractModel.php';
require_once '../app/dtos/ContractDTO.php';

class ContractService {
    private $contractModel;

    // Constructor: Inyección de dependencia para el modelo de contrato
    public function __construct($contractModel) {
        $this->contractModel = $contractModel;
    }

    // Registrar un nuevo contrato
    public function registerContract(ContractDTO $contractDTO) {
        // Validación de fechas
        if (strtotime($contractDTO->getStartDate()) > strtotime($contractDTO->getEndDate())) {
            throw new Exception("La fecha de inicio no puede ser posterior a la fecha de fin");
        }

        // Guardar el contrato en la base de datos
        $this->contractModel->createContract($contractDTO);
    }

    // Obtener todos los contratos de un usuario
    public function getUserContracts($userId) {
        return $this->contractModel->getContractsByUserId($userId);
    }
}
?>
