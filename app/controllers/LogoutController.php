<?php
// /app/controllers/LogoutController.php

class LogoutController {
    public function logout() {
        session_start();
        session_unset();    // Destruir todas las variables de sesión
        session_destroy();  // Destruir la sesión
        header("Location: /login"); // Redirigir al login
        exit();
    }
}

?>