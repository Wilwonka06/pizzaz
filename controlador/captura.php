<?php 

include("confi.php");
include("conexion.php");

$json= file_get_contents('php://input');
$datos= json_decode($json, true);

print_r($datos);
if(is_array(($datos))){
    $id_transacccion= $datos['detalles']['id'];
    $monto= $datos['detalles']['purcharse_units'][0]['amount']['value'];
    $status= $datos['detalles']['status'];
    $fecha= $datos['detalles']['update_time'];
    $fecha_nueva= date('Y-m-d:i:s', strtotime($fecha));
    $correo= $datos['detalles']['payer']['email_address'];
    
    $sql= $conexion->prepare(("INSERT INTO compra (id_transaccion, fecha, status, correo, total) VALUES (?,?,?,?,?,?)"));
    $sql->execute([$id_transacccion, $fecha_nueva, $status, $correo, $total]);
    $$id= $conexion->lastInsertId();


    if($id >0){
        $productos= isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
        if($productos != null){
            foreach($productos as $clave=> $cantidad){
                // Prepara una consulta SQL para seleccionar productos activos
                $sql = $conexion->prepare("SELECT id, nombrep, precio, descuento, FROM productos WHERE id=? AND activo=1");
                $sql->execute([$clave]);
                // Obtiene los resultados de la consulta en un arreglo asociativo
                $row_prod= $sql->Fetch(PDO::FETCH_ASSOC);

                $precio= $row_prod['precio'];
                $descuento= $row_prod['descuento'];
                $precio_descuento= $precio-(($precio * $descuento)/100);

                $sql_insert= $conexion->prepare("INSERT INTO detalle_compra (idcompra, idproducto, nombre, precio, cantidad) VALUES (?, ?, ?, ?, ?)");
                $sql_insert->execute([$id, $clave, $row_prod['nombre'], $precio_descuento, $cantidad]);
            }
        }

    }unset($_SESSION['carrito']);
}