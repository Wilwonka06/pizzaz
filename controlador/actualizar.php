<?php

include('conexion.php'); // Incluye el archivo de conexión
include('confi.php'); // Incluye el archivo de configuración (asumiendo que contiene la definición de MONEDA)

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if ($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;

        // Llama a la función agregar y pasa la conexión como argumento
        $respuesta = agregar($conexion, $id, $cantidad);

        if ($respuesta > 0) {
            $datos['ok'] = true;
        } else {
            $datos['ok'] = false;
        }

        // Formatea la respuesta con el símbolo de la moneda
        $datos['sub'] = MONEDA . number_format($respuesta, 2, '.', '.');
    } else if ($action == 'elimina') {
        $datos['ok'] = elimina($id);
    } else {
        $datos['ok'] = false;
    }
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);

// Función para agregar un producto al carrito
function agregar($conexion, $id, $cantidad)
{
    $res = 0;

    if ($id > 0 && $cantidad > 0 && is_numeric($cantidad)) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            $_SESSION['carrito']['productos'][$id] = $cantidad;

            // Consulta la base de datos para obtener el precio y descuento del producto
            $sql = $conexion->prepare("SELECT precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch();
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_descuento = $precio - (($precio * $descuento) / 100);
            $res = $cantidad * $precio_descuento;

            return $res;
        }
    } else {
        return $res;
    }
}

// Función para eliminar un producto del carrito
function elimina($id)
{
    if ($id > 0) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            unset($_SESSION['carrito']['productos'][$id]);
            return true;
        }
    } else {
        return false;
    }
}
?>
