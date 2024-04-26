<?php
// Incluye archivos de configuración y conexión a la base de datos
include("controlador/confi.php");
include("controlador/conexion.php");

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();
if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
        // Prepara una consulta SQL para seleccionar productos activos
        $sql = $conexion->prepare("SELECT id, nombrep, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        // Obtiene los resultados de la consulta en un arreglo asociativo
        $lista_carrito[] = $sql->Fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("Location: index.php");
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>PIZZAZ</title>

    <!-- Archivos ccs adicionales -->
    <link rel="stylesheet" type="text/css" href="vista/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="vista/css/font-awesome.css">
    <link rel="stylesheet" href="vista/css/templatemo-training-studio.css">

</head>

<body>


    <!-- ** Empieza el header ** -->
    <?php include 'menu.php'; ?>
    <!-- ** Termina el header ** -->
    <br><br><br><br>

    <!-- ** empieza la parte blanca ** -->
    <main class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h4>Detalles de pago</h4><br><br>
                    <div id="paypal-button-container"></div>
                </div>
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Comprueba si la lista de carrito está vacía
                                if ($lista_carrito == null) {
                                    echo '<tr><td colspan="2" class="text-center"><b>Lista vacía</b></td></tr>';
                                } else {
                                    $total = 0; // Inicializa la variable de total en 0

                                    // Itera a través de los productos en la lista de carrito
                                    foreach ($lista_carrito as $producto) {
                                        $_id = $producto['id'];
                                        $nombrep = $producto['nombrep'];
                                        $precio = $producto['precio'];
                                        $descuento = $producto['descuento'];
                                        $cantidad = $producto['cantidad'];

                                        // Calcula el precio con descuento
                                        $precio_descuento = $precio - (($precio * $descuento) / 100);

                                        // Calcula el subtotal para este producto
                                        $subtotal = $cantidad * $precio_descuento;

                                        $total += $subtotal; // Actualiza el total acumulando el subtotal
                                ?>
                                        <tr>
                                            <td><?php echo $nombrep; ?></td>
                                            <td>
                                                <div id="subtotal_<?php echo $_id ?>" name="subtotal[]">
                                                    <!-- Muestra el subtotal formateado como una cadena que incluye el símbolo de la moneda y los separadores de miles y decimales-->
                                                </div><?php echo MONEDA . number_format($subtotal, 2, '.', '.'); ?>

                                            </td>
                                        </tr>
                                    <?php
                                    } // Fin del bucle foreach

                                    // Muestra el total de la compra
                                    ?>
                                    <tr>
                                        <td colspan="2">
                                            <p class="h4 text-end" id="total">
                                                <?php echo MONEDA . number_format($total, 2, '.', '.'); ?>
                                            </p>
                                        </td>
                                    </tr>
                                <?php
                                } // Fin de la comprobación de lista de carrito
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main><br>

    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>

    <script>
        // Inicializa los botones de PayPal
        paypal.Buttons({
            style: {
                color: 'blue', // Estilo del botón: color azul
                shape: 'pill', // Estilo del botón: forma de píldora
                label: 'pay' // Etiqueta del botón: "pay"
            },
            // Función para crear una orden
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $total ?>
                        }
                    }]
                });
            },
            // Función que se ejecuta cuando se aprueba el pago
            // Función que se ejecuta cuando se aprueba el pago
            onApprove: function(data, actions) {
                let URL = 'controlador/captura.php'; // URL del controlador de captura

                // Captura la orden y muestra detalles
                actions.order.capture().then(function(detalles) {
                    console.log(detalles); // Muestra los detalles de la orden en la consola
                    alert("Gracias por su compra"); // Muestra una alerta de agradecimiento

                    // Realiza una solicitud POST para enviar los detalles de la orden al servidor
                    fetch(url, {
                            method: 'POST', // Método de solicitud POST
                            headers: {
                                'content-type': 'application/json' // Encabezado que indica el tipo de contenido como JSON
                            },
                            body: JSON.stringify({
                                detalles: detalles // Convierte los detalles de la orden en una cadena JSON y lo incluye en el cuerpo de la solicitud
                            })
                        })
                        .then(function(response) {
                            // Verifica si la solicitud al servidor fue exitosa
                            if (response.ok) {
                                // Borra los productos del carrito en el lado del cliente (en este caso, la sesión)
                                <?php unset($_SESSION['carrito']['productos']); ?>;
                            } else {
                                // Maneja el caso en el que no se pudo eliminar el carrito
                                console.error('No se pudo eliminar el carrito de compras.');
                            }
                        });
                });
            },
            // Función que se ejecuta cuando se cancela el pago
            onCancel: function(data) {
                alert("Pago cancelado!"); // Muestra una alerta indicando que el pago ha sido cancelado
                console.log(data); // Registra los datos relacionados con la cancelación en la consola
            }
        }).render('#paypal-button-container');
    </script>



    <!-- jQuery -->
    <script src="vista/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="vista/js/popper.js"></script>
    <script src="vista/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="vista/js/scrollreveal.min.js"></script>
    <script src="vista/js/waypoints.min.js"></script>
    <script src="vista/js/jquery.counterup.min.js"></script>
    <script src="vista/js/imgfix.min.js"></script>
    <script src="vista/js/mixitup.js"></script>
    <script src="vista/js/accordions.js"></script>

    <!-- Global Init -->
    <script src="vista/js/custom.js"></script>
    <?php include 'pie.php'; ?>
</body>

</html>