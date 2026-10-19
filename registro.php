
<?php
require_once "conexion.php";

//evita ejectutar el registro cuando alguien abre la pagina sin enviar la informacion
if ($_SERVER["REQUEST_METHOD"] === "POST") {

//recepcion de datos
    $correo = isset($_POST["correo"])
    ? trim($_POST["correo"])
    : "";
    $password = isset($_POST["contrasena"])
    ? $_POST["contrasena"]
    : "";

 //un pequeño extra que añade condiciones  al creacion del correo y contraseña, si no es uno, es el otro
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Ingresa un correo válido.";
    } elseif (strlen($password) < 8) {
        $mensaje = "La contraseña debe tener al menos 8 caracteres.";
    } else {

//con esta cosita se hashea, quedando registrado de manera segura
        $hash = password_hash($password, PASSWORD_DEFAULT);

//inserta el usuario, se prepara y genera la consulta
            $sql = "INSERT INTO usuarios (correo, contrasena)
                    VALUES (:correo, :contrasena)";

            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ":correo" => $correo,
                ":contrasena" => $hash
            ]);
//pequeño extra que te regresa al login una vez completada la consulta
            header("Location: login.php?registro=ok");
            exit;

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear usuario</title>
</head>
<body>
    Crear cuenta

    <form method="POST" action="registro.php">
        <label>Correo electrónico:</label><br>
        <input type="email" name="correo" required>
        <br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contrasena"
               minlength="8" required>
        <br><br>

        <button type="submit">Registrarse</button>
    </form>

</body>
</html>
