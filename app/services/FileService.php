<?php
// app/services/FileService.php

require_once '../app/models/FileModel.php';
require_once '../app/dtos/FileDTO.php';

class FileService {
    private $fileModel;

    // Constructor: Inyección de dependencia para el modelo de archivo
    public function __construct($fileModel) {
        $this->fileModel = $fileModel;
    }

    // Subir un archivo
    public function uploadFile(FileDTO $fileDTO) {
        // Validación de archivo (puedes agregar más validaciones)
        if (!is_uploaded_file($fileDTO->getFilePath())) {
            throw new Exception("El archivo no se ha subido correctamente");
        }

        // Mover el archivo a la carpeta de destino
        if (!move_uploaded_file($fileDTO->getFilePath(), '../uploads/' . $fileDTO->getNameFile())) {
            throw new Exception("Error al mover el archivo");
        }

        // Guardar los detalles del archivo en la base de datos
        $this->fileModel->createFile($fileDTO);
    }

    // Obtener todos los archivos asociados a un contrato
    public function getFilesByContractId($contractId) {
        return $this->fileModel->getFilesByContractId($contractId);
    }
}
?>
