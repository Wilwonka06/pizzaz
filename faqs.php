<?php 
include("controlador/confi.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>

       <!-- Configuración de codificación de caracteres -->
        <meta charset="utf-8">
        <!-- Configuración de la ventana gráfica para dispositivos móviles -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Descripción de la página (debe completarse con el contenido real) -->
        <meta name="description" content="">
        <!-- Autor de la página (debe completarse con el contenido real) -->
        <meta name="author" content="">

        <!-- Enlace a la fuente de Google Fonts llamada "Poppins" -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

        <title>PIZZAZ</title>


        <!-- Archivos ccs adicionales -->
        <link rel="stylesheet" type="text/css" href="vista/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="vista/css/font-awesome.css">

        <link rel="stylesheet" href="vista/css/templatemo-training-studio.css">
        <style>
            
            .preguntas {
                display: flex;
                justify-content: space-between;
            }

            .column {
                flex-basis: 48%; /* Esto asegura que cada columna tenga aproximadamente el 48% del ancho total */
            }

            .question {
                font-weight: bold;
            }

            /* Estilos adicionales según tus preferencias */
            .answer {
                margin-top: 5px;
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
                <source src="./vista/images/videopre.mp4" type="video/mp4" />
            </video>
            <div class="video-overlay header-text">
                <div class="caption">
                    <h2>PREGUNTAS<em> FRECUENTES</em></h2>
                    <div class="main-button scroll-to-section">
                    </div>
                </div>
            </div>
        </div>
        <!-- ** TERMINA VIDEO DE FONDO ** -->


        <section class="section" id="features">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="section-heading">
                                <h2>PARA QUE TODOS SE<em>  MANTENGAN INFORMADOS</em></h2>
                                <img src="./vista/images/question.png" alt="waves"> 
                                <p>Nos encanta resolver cada una de las preguntas de nuestros usuarios</p>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    
        <!-- ** section de las preguntas ** -->
        <div class="container">
            <div class="preguntas">
                <div class="column">
                    <div class="question">1. ¿Para qué fue creada la página?</div>
                        <div class="answer">
                            Este sitio web ha sido diseñado para que nuestros clientes puedan acceder a una amplia gama de opciones de pizzas y realizar pedidos de manera rápida y segura. Queremos brindarte una experiencia satisfactoria al proporcionarte información detallada sobre nuestras pizzas y garantizar la seguridad de tus pedidos.
                        </div><br><br>

                    <div class="question">2. ¿Cómo puedo pagar?</div>
                        <div class="answer">
                            Puedes pagar al recoger tu pedido en la sede que elijas, ya que no ofrecemos servicio de entrega a domicilio. Simplemente realiza tu pedido a través de nuestra página web o llámanos directamente y ven a recogerlo cuando esté listo en la tienda.
                        </div>
                        <br><br>

                    <div class="question">3. ¿Cuál es el tiempo de entrega?</div>
                        <div class="answer">
                        Nos esforzamos constantemente en la preparación de los pedidos para asegurar que sean atendidos de manera rápida y eficiente. Esto forma parte de nuestro compromiso de proporcionar a nuestros clientes la mejor experiencia posible al disfrutar de nuestros productos.
                        </div>
                </div>
                <br><br>

                <div class="column">
                    <div class="question">4. ¿Puedo realizar un pedido y recogerlo en la tienda?</div>
                        <div class="answer">
                            Sí, en PIZZAZ ofrecemos la opción de hacer pedidos para recoger en la tienda. Puedes hacer tu pedido con anticipación a través de nuestra página web o llamarnos directamente. Una vez que tu pedido esté listo, simplemente pasa por nuestra tienda y estaremos encantados de tenerlo listo para ti.
                        </div>
                        <br><br>

                    <div class="question">5. ¿Dónde se encuentran ubicados?</div>
                        <div class="answer">
                            Nuestras sedes están estratégicamente ubicadas en diferentes puntos de la ciudad, con la dirección de cada una detallada en nuestra página web. Estamos listos para atenderte y satisfacer tus antojos de pizza en cualquiera de nuestras ubicaciones.
                        </div>
                        <br><br>

                    <div class="question">6. ¿Realizan eventos sociales?</div>
                        <div class="answer">
                            Actualmente, no ofrecemos servicios para eventos sociales, pero siempre estamos abiertos a nuevas oportunidades y sugerencias de nuestros clientes.
                        </div>
                </div>
            </div>
        </div>


        <script src="bootstrap/js/bootstrap.min.js"></script>

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

        <!-- ***** Empieza el footer uwu ***** -->
        <?php include 'pie.php'; ?>
        <!-- ** Empienza el pie  ** --> 
    </body>
</html>


                    
      




