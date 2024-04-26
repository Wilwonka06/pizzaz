<?php
// Incluye archivos de configuración y conexión a la base de datos
include("controlador/confi.php");
include("controlador/conexion.php");

// Prepara una consulta SQL para seleccionar productos activos
$sql = $conexion->prepare("SELECT id, nombrep, precio FROM productos WHERE activo=1");
$sql->execute();

// Obtiene los resultados de la consulta en un arreglo asociativo
$resultado = $sql->FetchAll(PDO::FETCH_ASSOC);

//session_destroy();

//print_r($_SESSION);
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
        <style>
            /* Establecer un tamaño de fuente base relativo */
            body {
                font-size: 16px; /* Puedes ajustar este valor según tus preferencias */
            }

            /* Hacer que las imágenes sean responsivas */
            img {
                max-width: 100%;
                height: auto;
            }

            /* Ajustar el espaciado entre los elementos en pantallas pequeñas */
            .col-lg-4 {
                flex: 0 0 calc(33.3333% - 1%);
                max-width: calc(33.3333% - 1%);
                padding: 1%;
            }

            /* Aplicar estilos específicos para pantallas más pequeñas */
            @media (max-width: 768px) {
                /* Ajustar el tamaño de fuente y el espaciado en pantallas pequeñas */
                h2 {
                    font-size: 1.5em;
                }

                .col-lg-4 {
                    flex: 0 0 calc(50% - 1%);
                    max-width: calc(50% - 1%);
                    padding: 1%;
                }
            }
        </style>


    </head>
    <body>

 
            <!-- ** Empieza el header ** -->
            <?php include 'menu.php'; ?>
            <!-- ** Termina el header ** -->
    

            <!-- ** Inicia video de fondo ** -->
            <div class="main-banner" id="top">
                <video autoplay muted loop id="bg-video">
                    <source src="vista/images/videopizza.mp4" type="video/mp4" />
                </video>
                <div class="video-overlay header-text">
                    <div class="caption">
                        <h2>NUESTRAs<em> PIZZAS</em></h2>
                        <div class="main-button scroll-to-section">
                        </div>
                    </div>
                </div>
            </div>
            <!-- ** TERMINA VIDEO DE FONDO ** -->


            <!-- ** empieza la parte blanca ** -->
            <section class="section" id="features" >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="section-heading">
                                <h2>ELIGE <em>  TU MEJOR OPCIÓN</em></h2>
                                <img src="vista/images/cajadepizza.png" alt="waves"> 
                                <p>Atrevete a descubrir la pizza que cautive tu corazón, sin limites </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <main class="section" id="trainers">
                <div class="container">
                    <div class="row">
                        <?php 
                        $counter = 0;
                        foreach ($resultado as $row) {
                            if ($counter % 3 === 0) {
                                echo '<div class="row">'; // Abre una nueva fila cada 3 elementos
                            }
                        ?>
                        <div class="col-lg-4">
                            <?php 
                                $id = $row['id'];
                                $images = "vista/images/" . $id . "/pizzaimg.jpg";
                            ?><!-- Obtiene el ID y construye la ruta de la imagen -->

                            <img src="<?php echo $images; ?>" class="d-block w-100"><!-- Muestra la imagen con la ruta construida -->
                            <div class="trainer-item">
                                <div>
                                    <div class="down-content"><br>
                                        <i class="fa fa-star" style="color: yellow;"></i> <i class="fa fa-star" style="color: yellow;"></i>
                                        <i class="fa fa-star" style="color: yellow;"></i><i class="fa fa-star" style="color: yellow;"></i><br>
                                        <h4 class="card-title"><?php echo $row['nombrep']; ?></h4>
                                        <p class="button-text">$<?php echo number_format($row['precio'], 2, '.', '.'); ?></p><!-- Muestra el precio con formato -->
                                        <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <!-- Enlace que dirige a la página de detalles con los parámetros 'id' y 'token' -->
                                            <a href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha256', $row['id'], KEy_TOKEN); ?>" class="btn">Detalles</a>
                                        </div>
                                            <!-- Botón para añadir al carrito llamando a la función 'addProducto' -->
                                            <button class="btn btn-outline" type="button" onclick="addProducto(<?php echo  $row['id']; ?>,
                                                '<?php echo hash_hmac('sha256', $row['id'], KEy_TOKEN); ?>')">Añadir al carrito
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            if ($counter % 3 === 2) {
                                echo '</div>'; // Cierra la fila después de 3 elementos
                            }
                            $counter++;
                        } 
                        // Asegúrate de cerrar la fila final si no hay un múltiplo de 3 elementos
                        if ($counter % 3 !== 0) {
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </main><br><br>

            <script>
            // Función para agregar un producto al carrito
            function addProducto(id, token){
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