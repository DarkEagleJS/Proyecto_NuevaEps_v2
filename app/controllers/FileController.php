<?php
// app/controllers/FileController.php

require_once '../app/services/FileService.php';
require_once '../app/models/FileModel.php';
require_once '../app/dtos/FileDTO.php';
require_once '../core/database.php';

class FileController {
    private $fileService;

    // Constructor: Inyección de dependencia para el servicio de archivo
    public function __construct($db) {
        $db = Database::getInstance();
        $fileModel = new FileModel($db);
        $this->fileService = new FileService($fileModel);}
        AuthMiddleware::check();
    }

    // Subir un archivo
    public function uploadFile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
            $id_contract = $_POST['id_contract'];
            $file_name = $_FILES['file']['name'];
            $file_tmp_path = $_FILES['file']['tmp_name'];
            $file_path = '/uploads/' . $file_name;

            // Crear DTO de archivo
            $fileDTO = new FileDTO();
            $fileDTO->setIdContract($id_contract);
            $fileDTO->setNameFile($file_name);
            $fileDTO->setFilePath($file_path);
            $fileDTO->setUploadDate(date('Y-m-d H:i:s'));

            try {
                // Llamamos al servicio para subir el archivo
                $this->fileService->uploadFile($fileDTO);
                echo "Archivo subido exitosamente!";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Mostrar formulario de carga de archivo
        require_once '../app/views/fileUploadForm.php';
    }

    // Listar los archivos asociados a un contrato
    public function listFiles($contractId) {
        try {
            $filesDTOs = $this->fileService->getFilesByContractId($contractId);
            require_once '../app/views/fileList.php'; // Mostrar lista de archivos
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>



