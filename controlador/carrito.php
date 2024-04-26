<?php
// Incluye el archivo de configuración
include('../controlador/conexion.php');
include('../controlador/confi.php');

// Crea un arreglo para almacenar los datos de respuesta
$datos = array();

if (isset($_POST['id'])) {
    // Obtiene el 'id' y el 'token' enviados a través de POST
    $id = $_POST['id'];
    $token = $_POST['token'];

    // Genera un token temporal utilizando HMAC-SHA256
    $token_tmp = hash_hmac('sha256', $id, KEy_TOKEN);

    // Compara el token proporcionado con el token generado
    if ($token == $token_tmp) {
        // Verifica si el producto ya existe en la sesión del carrito
        if (isset($_SESSION['carrito']['productos'][$id])) {
            // Incrementa la cantidad si el producto ya está en el carrito
            $_SESSION['carrito']['productos'][$id] += 1;
        } else {
            // Agrega el producto al carrito si no existe
            $_SESSION['carrito']['productos'][$id] = 1;
        }

        // Actualiza la cantidad de productos en el carrito
        $datos['numero'] = count($_SESSION['carrito']['productos']);
        $datos['ok'] = true;
    } else {
        // El token proporcionado no coincide con el generado, la operación no es válida
        $datos['ok'] = false;
    }
} else {
    // No se proporcionaron 'id' y 'token' en la solicitud
    $datos['ok'] = false;
}

// Devuelve los datos de respuesta en formato JSON
echo json_encode($datos);
?>
