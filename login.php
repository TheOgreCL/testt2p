<?php
//funcionando, faltan extras basicos, y medidas de seguridad creo
//pa la conexion
session_start();
require_once "conexion.php";
$mensaje = "";

//una vez hecho el registro, te regresa a aca y tira este mensaje
if (isset($_GET["registro"]) && $_GET["registro"] === "ok") {
    $mensaje = "Usuario creado correctamente. Ahora inicia sesión.";
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
//para la recepcion de los datos del formulario, se reciben las crendenciales para su comprobacion
    $correo = isset($_POST["correo"])
    ? trim($_POST["correo"])
    : "";

    $password = isset($_POST["contrasena"])
    ? $_POST["contrasena"]
    : "";

//busca el correo
    $sql = "SELECT correo, contrasena
            FROM usuarios
            WHERE correo = :correo
            LIMIT 1";

//ejecucion de la consulta
    $stmt = $conexion->prepare($sql);
    $stmt->execute([":correo" => $correo]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //verificacion 
    if ($user &&
        password_verify($password, $user["contrasena"])) {
        session_regenerate_id(true);
        $_SESSION["correo"] = $user["correo"];
        header("Location: bienvenido.php");
        exit;

    } else {
        $mensaje = "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>
    Iniciar sesión

    <form method="POST" action="login.php">
        <label>Correo electrónico:</label><br>
        <input type="email" name="correo" required>
        <br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required>
        <br><br>

        <button type="submit">Ingresar</button>
    </form>

    <p><?php echo $mensaje; ?></p>

    <a href="registro.php">Crear una cuenta</a>
</body>
</html>
