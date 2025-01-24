<?php
// /app/middleware/AuthMiddleware.php

class AuthMiddleware {
    // Método estático para verificar si el usuario está autenticado
    public static function check() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Inicia la sesión solo si no está activa
        }

        // Si el usuario no está autenticado, redirigir al login
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../app/views/login.php");
            exit();
        }
    }

    // Método para verificar si el usuario NO está autenticado
    public static function guest() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Inicia la sesión solo si no está activa
        }

        // Si el usuario está autenticado, redirigir al dashboard
        if (isset($_SESSION['user_id'])) {
            header("Location: /dashboard");
            exit();
        }
    }
}

