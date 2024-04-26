<?php
// Incluye archivos de configuración y conexión a la base de datos
include("controlador/confi.php");
include("controlador/conexion.php");

$productos= isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito= array();
if($productos != null){
    foreach($productos as $clave=> $cantidad){
        // Prepara una consulta SQL para seleccionar productos activos
        $sql = $conexion->prepare("SELECT id, nombrep, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        // Obtiene los resultados de la consulta en un arreglo asociativo
        $lista_carrito[] = $sql->Fetch(PDO::FETCH_ASSOC);
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
            <?php include 'menu.php'; ?>
            <!-- ** Termina el header ** -->
            <br><br><br><br>

            <!-- ** empieza la parte blanca ** -->
            <main class="section" id="features">
                <div class="container">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>cantidad</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($lista_carrito == null) {
                                    // Si la lista del carrito está vacía, muestra un mensaje indicando que la lista está vacía.
                                    echo '<tr><td colspan="5" class="text-center"><b>Lista vacía</b></td></tr>';
                                } else {
                                    $total = 0; // Inicializa la variable total en 0

                                    // Itera a través de los productos en la lista del carrito
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
                                            <td>$<?php echo number_format($precio_descuento, 2, '.', '.'); ?></td>
                                            <td>
                                                <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizacan(this.value, <?php echo $_id; ?>)">
                                            </td>
                                            <td>
                                                <div id="subtotal_<?php echo $id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', '.'); ?></div>
                                            </td>
                                            <td>
                                                <!-- Botón que abre el modal -->
                                                <button id="elimina" class="btn btn-danger" data-id="<?php echo $_id; ?>" data-toggle="modal" 
                                                data-target="#eliminaModal" style="border-radius: 0px;">Eliminar</button>

                                            </td>
                                        </tr>
                                <?php
                                    } // Fin del bucle foreach

                                    // Muestra el total de la compra
                                ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2">
                                            <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', '.'); ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                                } // Fin de la comprobación de la lista de carrito
                                ?>
                        </table>
                    </div>
                    <?php if ($lista_carrito != null) { ?>
                        <!-- Comprueba si la lista del carrito no está vacía -->
                        <div class="row">
                            <div class="col-md-5 offset-md-7  ">
                                <!-- Crea un botón para realizar el pago -->
                                <a href="pago.php" class="btn btn-primary btn-dark btn-block" style="border-radius: 0px;">Realizar pago</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </main><br>

           <!-- Modal -->
           <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm"> <!-- Cambié modal-dialog-sm a modal-sm -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Desea eliminar el producto?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger eliminar-producto" data-id="<?php echo $_id; ?>" data-cantidad="<?php echo $cantidad; ?>">Eliminar</button>

                        </div>
                    </div>
                </div>
            </div>

            <script>
            
            let eliminaModal = document.getElementById('eliminaModal');
            eliminaModal.addEventListener('show.bs.modal', function (event) {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-id'); // Cambiado de 'data-bs-id' a 'data-id'
                let buttonElimina = eliminaModal.querySelector('modal-footer #btn-elimina');
                buttonElimina.value = id;
            });


            // Función para agregar un producto al carrito
            function actualizacan(cantidad, id){
                // URL del archivo PHP que procesará la solicitud
                let url = 'controlador/actualizar.php';
                
                // Crear un objeto FormData para enviar datos
                let formData = new FormData();
                formData.append('action', 'agregar'); // Corrección: 'agregar' debe ser una cadena
                formData.append('id', id); // Agregar el 'id' del producto
                formData.append('cantidad', cantidad); // Agregar la cantidad
                
                // Realizar una solicitud POST al servidor
                fetch(url, {
                    method: 'POST', // Método de solicitud POST
                    body: formData, // Datos a enviar en el cuerpo de la solicitud
                    mode: 'cors' // Modo CORS para permitir solicitudes cruzadas
                }).then(response => response.json()) // Convertir la respuesta a JSON
                .then(data => {
                    // Procesar los datos recibidos en 'data'
                    if (data.ok) {
                        const divsubtotal = document.getElementById('subtotal_' + id);
                        divsubtotal.innerHTML = data.sub

                        let total= 0.00
                        let list= document.getElementsByName('subtotal[]')

                        for(let i= 0; i < list.length; i++){
                            total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
                        }

                        total= new Intl.NumberFormat('en-US', {
                            minimunFractionDigits: 2
                        }).format(total)
                        document.getElementById('total').innerHTML= '<?php echo MONEDA; ?>' + total
                    }else {
                        // Manejar el caso en que 'data' no es válido (no se pudo agregar el producto)
                        console.error('No se pudo agregar el producto al carrito.');
                    }
                });
            }

            // Agregue un controlador de eventos para los botones de eliminación
            document.querySelectorAll('.eliminar-producto').forEach(function(button) {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    let cantidad = this.getAttribute('data-cantidad');

                    // Llame a la función para eliminar el producto y pase la cantidad
                    elimina(id, cantidad);
                });
            });

            // Función para eliminar un producto del carrito
            function elimina(id, cantidad) {
                let url = 'controlador/actualizar.php';
                let formData = new FormData();
                formData.append('action', 'elimina');
                formData.append('id', id);
                formData.append('cantidad', cantidad);

                // Resto del código para realizar la solicitud POST
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
