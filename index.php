<?php
include("controlador/confi.php");
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
    <link rel="stylesheet" type="text/css" href="Vista/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Vista/css/font-awesome.css">
    <link rel="stylesheet" href="Vista/css/templatemo-training-studio.css">

</head>

<body>

    <!-- ***** Empieza el header ***** -->
    <?php include 'menu.php'; ?>
    <!-- ***** Termina el header ***** -->



    <!-- ***** Empieza el articulo ppal ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="vista/images/video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h2>LA CASA DEL<em> VERDADERO PLACER</em></h2>
                <div class="main-button scroll-to-section">
                    <a href="#features">VER MAS</a> <!-- ***** LO TIENE QUE MANDAR PA LAS PIZZAS ***** -->
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Termina el articulo ppal ***** -->

    <!-- ***** Empiezan las clasesitas ***** -->
    <section class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>TU MEJOR<em> OPCIÓN</em></h2>
                        <img src="vista/images/pizzas.png" alt="waves">
                        <p>El sabor que creas hoy será la deliciosa recompensa de mañana en cada bocado de nuestras pizzas</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="vista/images/icono.png" alt="First One">
                            </div>
                            <div class="right-content">
                                <h4>Majestuosas Creaciones Rellenas</h4>
                                <p>En PIZZAZ, llevamos la pizza tradicional a otro nivel con nuestra mezcla majestuosa de sabores y rellenos generosos</p>

                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="vista/images/frutas.png" alt="second one">
                            </div>
                            <div class="right-content">
                                <h4>Variedad natural</h4>
                                <p>Nuestra dedicación a la frescura es insuperable. Utilizamos ingredientes de primera calidad, seleccionados minuciosamente de acuerdo a las estaciones, y colaboramos únicamente con proveedores de confianza</p>

                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="vista/images/entrega.png" alt="third gym training">
                            </div>
                            <div class="right-content">
                                <h4>Instantáneo y Delicioso</h4>
                                <p>Todos nuestros productos son preparados al momento que realizas el pedido, es la única forma de cumplir con nuestra promesa de marca, preparaciones frescas, ingredientes en su punto y en el término que debe de ser.</p>

                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="vista/images/masa.png" alt="fourth muscle">
                            </div>
                            <div class="right-content">
                                <h4>La Promesa de Sabores Desbordantes</h4>
                                <p>Nuestra promesa en PIZZAZ es simple pero poderosa: pizzas rellenas que desbordan de sabor y calidad en cada bocado.</p>

                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="vista/images/cocinando.png" alt="training fifth">
                            </div>
                            <div class="right-content">
                                <h4>Obras Maestras Rellenas de Sabor</h4>
                                <p>Cada pizza de PIZZAZ es una obra maestra culinaria, con una explosión de sabores gracias a nuestra dedicación a los ingredientes y preparaciones de alta calidad.</p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="vista/images/rebanada.png" alt="gym training">
                            </div>
                            <div class="right-content">
                                <h4>Tradición e Innovación en Cada Rebanada </h4>
                                <p>En Stuffed Pizzas, la tradición se encuentra con la innovación en cada rebanada rellena. Descubre el placer culinario en su máxima expresión con nuestras creaciones</p>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Terminan las clasesitas***** -->



    <!-- ***** Empieza sesion de nuestras clases ***** -->
    <section class="section" id="our-classes">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>NUESTRA VARIEDAD<em> DE SABORES</em></h2>
                        <img src="vista/images/pizzas.png" alt="">
                        <p>¡Animate a descubrir el sabor de tus sueños!</p>
                    </div>
                </div>
            </div>
            <div class="row" id="tabs">
                <div class="col-lg-4">
                    <ul>
                        <li><a href='#tabs-1'><img src="vista/images/icono2.png" alt="">Pizza Mozzarella</a></li>
                        <li><a href='#tabs-2'><img src="vista/images/icono2.png" alt="">Pizza Pesto</a></a></li>
                        <li><a href='#tabs-3'><img src="vista/images/icono2.png" alt="">Pizza Italiana</a></a></li>
                        <li><a href='#tabs-4'><img src="vista/images/icono2.png" alt="">Pizza Burrata</a></a></li>
                        <div class="main-rounded-button"><a href="pizzas.php">VER MÁS</a></div><!-- ***** LLEVAR A VER LAS PIZZAS***** -->
                    </ul>
                </div>
                <div class="col-lg-8">
                    <section class='tabs-content'>
                        <article id='tabs-1'>
                            <img src="vista/images/pizzaimg4.jpg" alt="First Class">
                            <h4>Pizza Mozzarella</h4>
                            <p>La "Pizza Mozzarella" es una delicia italiana con una base crujiente, cubierta de queso mozzarella derretido y salsa de tomate, que se combina en una experiencia deliciosa y reconfortante. ¡No puedes resistir su sabor auténtico y su simplicidad clásica! ¡Compra una y disfruta de una experiencia gastronómica inolvidable!</p>
                            <div class="main-button">
                            </div>
                        </article>
                        <article id='tabs-2'>
                            <img src="vista/images/pizzaimg1.jpg" alt="Second Training">
                            <h4>Pizza Pesto</h4>
                            <p>La "Pizza Pesto" combina una masa fina y crujiente con una deliciosa salsa pesto, hecha con albahaca fresca, aceite de oliva y piñones, que imparte un sabor fresco y herbáceo. Esta pizza está coronada con queso mozzarella fundido, tomates cherry y a veces incluso pollo o piñones tostados. Es una explosión de sabores en cada bocado. ¡No te pierdas la oportunidad de probar esta maravilla culinaria!</p>
                            <div class="main-button">
                            </div>
                        </article>
                        <article id='tabs-3'>
                            <img src="vista/images/pizzaimg2.jpg" alt="Third Class">
                            <h4>Pizza Italiana</h4>
                            <p>La "Pizza Italiana" es una pizza que te transportará a las auténticas tradiciones culinarias de Italia. Con una masa fina y crujiente, esta pizza es coronada con los ingredientes más frescos y sabrosos: tomates maduros, mozzarella de calidad, aceite de oliva virgen extra y hierbas aromáticas. Cada bocado es un viaje a la auténtica cocina italiana. ¡No te pierdas la oportunidad de disfrutar de esta delicia clásica!</p>
                            <div class="main-button">
                            </div>
                        </article>
                        <article id='tabs-4'>
                            <img src="vista/images/pizzaimg5.jpg" alt="Fourth Training">
                            <h4>Pizza Burrata</h4>
                            <p>La "Pizza Burrata" es una experiencia gastronómica excepcional. Su base crujiente es el lienzo perfecto para una suave y cremosa burrata, un queso italiano de ensueño que se combina con tomates frescos, albahaca y un toque de aceite de oliva. Cada bocado es una explosión de sabores y texturas que te llevará al cielo culinario italiano. ¡No dejes pasar la oportunidad de probar esta delicia única!</p>
                            <div class="main-button">
                            </div>
                        </article>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Termina seccion de nuestras clases***** -->


    <!-- ***** Presentacion de entrenadores ***** -->
    <section class="section" id="trainers">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Nuestros <em>Creadores</em></h2>
                        <img src="vista/images/pizzas.png" alt="">
                        <p>Nuestros creadores estan certificados profesionalmente para la creacion de este aplicativo</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="vista/images/ela.jpeg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Programadora</span>
                            <h4>Elany Faith Quintero Arias</h4>
                            <p>Especializada en programar el backend y el frontend se caracteriza por ser una buena lider para su equipo y es excelente lider que siempre quiere sacar lo mejor de su equipo.</p>
                            <ul class="social-icons">
                                <li><a href="https://wa.link/2d74ja"><i><img src="vista/images/wasa.png" alt=""> </i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="vista/images/Camilaymanu.jpeg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Programadoras</span>
                            <h4>Camila Ceballos y Manuela Escobar</h4>
                            <p>Le gusta trabajar en equipo, siempre persevera hasta lograr lo que se propone y tiene buenas ideas para compartir</p>
                            <ul class="social-icons">
                                <li><a href="https://wa.link/jte966"><i><img src="vista/images/wasa.png" alt=""> </i></a></li>
                                <li><a href="https://wa.link/f1rpad"><i><img src="vista/images/wasa.png" alt=""> </i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="vista/images/wilsonn.jpeg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Programador</span>
                            <h4>Wilson Rojas</h4>
                            <p>Realiza de manera correcta su trabajo asignado, siempre trata de buscar una buena y solida solución para el proyecto, dispuesto siempre para ayudar a cada integrantes del proyecto.</p>
                            <ul class="social-icons">
                                <li><a href="https://wa.link/fy9zhd"><i><img src="vista/images/wasa.png" alt=""> </i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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


    <!-- ** Empienza el pie  ** -->
    <?php include 'pie.php'; ?>
    <!-- **Termina el pie ** -->

</body>

</html>