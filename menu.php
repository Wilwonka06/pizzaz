<body>
    <!-- ***** Comienza el encabezado (header) ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">

                        <!-- ***** Comienza el logo ***** -->
                        <a href="index.php" class="logo">PIZZ <em> AZ</em></a>
                        <!-- ***** Finaliza el logo ***** -->

                        <!-- ***** Comienza el menú principal ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="index.php">INICIO</a></li>
                            <li class="scroll-to-section"><a href="pizzas.php">VER MÁS PIZZAS</a></li>
                            <li class="scroll-to-section"><a href="sucursales.php">SUCURSALES</a></li>
                            <li class="scroll-to-section"><a href="faqs.php">FAQS</a></li>
                            <li>
                                <a href="checkout.php" style="color: #0000;">
                                    <img src="vista/images/agregar-carrito.png">
                                    <span id="num_cart"><?php echo $num_cart; ?></span>
                                </a>
                            </li>
                        </ul>

                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Finaliza el menú principal ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Finaliza el encabezado (header) ***** -->
</body>