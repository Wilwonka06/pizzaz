<?php
// Definición de una constante llamada "" con un valor específico
define("CLIENT_ID", "AdFPplIPFg138swlDUyjGDo4pUZ_1eGf50WM9pOwkLwpqu0XOiUWOJGdSx7d-SLCX5UZNwTN6kQBws9I");
define("CURRENCY", "USD");
define("KEy_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");

// Iniciar o reanudar una sesión de PHP
session_start();

// Inicializar una variable llamada "$num_cart" con un valor de 0
$num_cart = 0;
// Verificar si existe un array llamado 'productos' dentro de la variable de sesión 'carrito'
if (isset($_SESSION['carrito']['productos'])) {
    // Contar la cantidad de elementos en el array 'productos' y asignarla a la variable "$num_cart"
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>
