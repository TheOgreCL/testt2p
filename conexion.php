<?php
//pa conectar la base con el codigo
$host = "localhost";
$db = "logint2p";
$user = "root";
$password = "";

//pdo= php data object, se crea un objeto que permite la comunicacion
try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $password
    );

//para revisar errores, si hay uno tira una excepcion
    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}