<?php

$servidor = "localhost";
$bd = "pizzas";
$user = "root";
$password = "";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$bd", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}

?>
