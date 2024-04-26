<?php
// Incluye los archivos de conexión y configuración
include("controlador/conexion.php");
include("controlador/confi.php");

// Obtener el valor de 'id' y 'token' desde la URL, si están presentes
$id = isset($_GET["id"]) ? $_GET["id"] : '';
$token = isset($_GET["token"]) ? $_GET["token"] : '';

// Verificar si 'id' o 'token' están vacíos
if ($id == '' || $token == '') {
    echo 'Error al procesar la petición';
    exit;
} else {
    // Generar un token temporal usando HMAC-SHA256 a partir del 'id' y la clave secreta KEy_TOKEN
    $token_tmp = hash_hmac('sha256', $id, KEy_TOKEN);

    // Comparar el token proporcionado con el token generado
    if ($token == $token_tmp) {
        // Preparar una consulta para contar la cantidad de productos activos con el 'id' proporcionado
        $sql = $conexion->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$id]);

        // Verificar si se encontró al menos un producto
        if ($sql->fetchColumn() > 0) {
            // Preparar una consulta para obtener detalles del producto
            $sql = $conexion->prepare("SELECT nombrep, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);

            // Verificar si se obtuvieron datos del producto
            if (!empty($row)) {
                if (!empty($row)) {
                    // Obtiene el nombre del producto desde la base de datos
                    $nombrep = $row[0]['nombrep'];

                    // Obtiene la descripción del producto desde la base de datos
                    $descripcion = $row[0]['descripcion'];

                    // Obtiene el precio del producto desde la base de datos
                    $precio = $row[0]['precio'];

                    // Obtiene el descuento del producto desde la base de datos
                    $descuento = $row[0]['descuento'];

                    // Calcula el precio con descuento aplicado
                    $precio_descuento = $precio - (($precio * $descuento) / 100);

                    // Establece la ruta del directorio de imágenes del producto
                    $dir_images = 'vista/images/' . $id . '/';

                    // Establece la ruta de la imagen principal del producto
                    $rutaimg = $dir_images . 'pizzaimg.jpg';
                }


                // Verificar si la imagen del producto existe; de lo contrario, usa una imagen de reemplazo
                if (!file_exists($rutaimg)) {
                    $rutaimg = 'vista/images/nofoto.jpg';
                }

                // Crear un arreglo de imágenes del producto si existen
                $imagenes = array();
                if (file_exists($dir_images)) {
                    $dir = dir($dir_images);
                    while (($archivo = $dir->read()) != false) {
                        if ($archivo != 'pizzaimg.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
                            $images[] = $dir_images . $archivo;
                        }
                    }
                    $dir->close();
                }
            } else {
                echo 'No se encontraron datos para este producto.';
            }
        } else {
            echo 'No se encontraron productos activos con el ID proporcionado.';
        }
    } else {
        echo 'Error al procesar la petición.';
        exit;
    }
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
    <?php include('menu.php'); ?>
    <!-- ** Termina el header ** -->
    <br><br><br><br><br>

    <main class="section" id="trainers">
        <div class="container">
            <div class="row">
                <div class="trainer-item col-md-6 order-md-1">
                    <!-- Muestra la imagen del producto -->
                    <?php
                    $images = "vista/images/" . $id . "/pizzaimg.jpg";
                    ?>
                    <img src="<?php echo $images; ?>" alt="">
                </div>
                <div class="col-md-6 order-md-2">
                    <!-- Muestra el nombre del producto -->
                    <h2><?php echo $nombrep; ?></h2><br>

                    <?php if ($descuento > 0) { ?>
                        <!-- Si hay descuento, muestra el precio original tachado y el precio con descuento -->
                        <p><del><?php echo MONEDA . number_format($precio, 2, '.', '.'); ?></del></p>
                        <h3>
                            <?php echo MONEDA . number_format($precio_descuento, 2, '.', '.'); ?>
                            <!-- Muestra el precio con descuento y el porcentaje de descuento -->
                            <small class="text-success"><?php echo $descuento; ?>% descuento</small>
                        </h3>
                    <?php } else { ?>
                        <!-- Si no hay descuento, muestra solo el precio -->
                        <h3><?php echo MONEDA . number_format($precio_descuento, 2, '.', '.'); ?></h3>
                    <?php } ?>
                    <!-- Muestra la descripción del producto -->
                    <p class="">
                        <?php echo $descripcion; ?>
                    </p><br>

                    <!-- Botones para comprar o añadir al carrito -->
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Llama a la función 'addProducto' al hacer clic para añadir el producto al carrito -->
                        <button class="btn btn-outline" type="button" onclick="addProducto(<?php echo $id; ?>, 
                            '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Función para agregar un producto al carrito
        function addProducto(id, token) {
            // URL del archivo PHP que procesará la solicitud
            let url = 'controlador/carrito.php';

            // Crear un objeto FormData para enviar datos
            let formData = new FormData();
            formData.append('id', id); // Agregar el 'id' del producto
            formData.append('token', token); // Agregar el 'token' de seguridad

            // Realizar una solicitud POST al servidor
            fetch(url, {
                    method: 'POST', // Método de solicitud POST
                    body: formData, // Datos a enviar en el cuerpo de la solicitud
                    mode: 'cors' // Modo CORS para permitir solicitudes cruzadas
                }).then(response => response.json()) // Convertir la respuesta a JSON
                .then(data => {
                    // Procesar los datos recibidos en 'data'
                    if (data.ok) {
                        // Actualizar el número de productos en el carrito en la interfaz de usuario
                        const elemento = document.getElementById('num_cart');
                        elemento.innerHTML = data.numero;
                    } else {
                        // Manejar el caso en que 'data' no es válido (no se pudo agregar el producto)
                        console.error('No se pudo agregar el producto al carrito.');
                    }
                });
        }
    </script>



    <!-- jQuery -->
    <script src="vista/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->

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