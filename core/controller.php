<?php
class Controller {
    protected $model;
    protected $view;

    public function __construct() {
        $this->view = new View();
    }

    // Método para cargar el modelo
    public function loadModel($model) {
        require_once "./app/models/$model.php";
        $this->model = new $model();
    }
}