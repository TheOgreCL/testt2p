<?php
session_start();

//revision de si hay un correo en la sesion, de haber se muestra en la pantalla, de lo contrario te manda de una al login 
if (!isset($_SESSION["correo"])) {
    header("Location: login.php");
    exit;
}
$correo = $_SESSION["correo"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
</head>
<body>
    ¡Bienvenido!

    <p>Has iniciado sesión con: 
        <?= htmlspecialchars($correo, ENT_QUOTES, 'UTF-8') ?>
    </p>

</body>
</html>