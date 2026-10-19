<?php
//revienta la conexion y nos regresa al login
session_start();
$_SESSION = [];
session_destroy();
header("Location: login.php");
exit;