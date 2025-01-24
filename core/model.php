<?php

class Model {
    // Conexión a la base de datos
    protected $db;

    public function __construct($db) {
        // Asumimos que la clase Database gestiona la conexión
        $this->db = $db;
    }

    // Método para ejecutar una consulta SQL
    public function query($sql) {
        return $this->db->query($sql); // Esto llamará al método query de la clase Database
    }

    // Método para ejecutar una consulta preparada (con parámetros)
    public function prepare($sql) {
        return $this->db->prepare($sql); // Esto llamará al método prepare de la clase Database
    }

    // Método para obtener todos los resultados de una consulta
    public function resultSet() {
        return $this->db->resultSet(); // Esto llamará al método resultSet de la clase Database
    }

    // Método para obtener un único resultado de la consulta
    public function single() {
        return $this->db->single(); // Esto llamará al método single de la clase Database
    }

    // Método para contar el número de filas afectadas por la consulta
    public function rowCount() {
        return $this->db->rowCount(); // Esto llamará al método rowCount de la clase Database
    }
}
?>
