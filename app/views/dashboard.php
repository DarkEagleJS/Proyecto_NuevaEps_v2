<!-- /app/views/dashboard.php -->

<?php
// Asegúrate de que el usuario está autenticado
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h1>Bienvenido al Dashboard, <?php echo $_SESSION['user_name']; ?>!</h1>

    <p>Tu correo electrónico: <?php echo $_SESSION['user_email']; ?></p>

    <a href="/logout">Cerrar sesión</a>

</body>
</html>
