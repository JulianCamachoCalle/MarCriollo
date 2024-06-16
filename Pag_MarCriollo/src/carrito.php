<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MarCriollo</title>
        <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style/carrito.css">
        <link rel="icon" href="img/favicon-32x32.png" type="image/png">
    </head>
<body>
    <header>
        <div class="contenedorhead">
            <div class="head">
                MarCriollo
            </div>
            <div class="logoprincipal">
                <img src="img/crab.png" alt="Logo">
            </div>
        </div>
    </header>
    <nav class="navbar">
        <button id="menu-desplegable" class="menu-desplegable" aria-label="Menu Desplegable">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <ul class="opciones">
            <li><a id="seleccionado" href="index.html">Inicio</a></li>
            <li><a id="no-seleccionado" href="nosotros.html">Nosotros</a></li>
            <li><a id="no-seleccionado" href="servicios.html">Servicios</a></li>
            <li><a id="no-seleccionado" href="redessociales.html">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="mapas.html">Mapas</a></li>
            <li><a id="no-seleccionado" href="contacto.html">Contacto</a></li>
            <li><a id="no-seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <main>
        <div class="info">
        <?php
        session_start();
        // Verificar el inicio de sesion
        if (isset($_SESSION['usuario'])) {
            $correo = $_SESSION['usuario'];
            // Establecer la conexion
            include 'PHP/conexion.php';
            // Consulta a la base de datos para obtener los datos del usuario
            $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
            $datos_usuario = mysqli_fetch_assoc($consulta);

            // Mostrar los datos del usuario
            echo '<div class="textnombres">';
            echo 'Nombres y Apellidos: ' . $datos_usuario['nombres'];
            echo '</div>';
        }
        ?>
    </div>
        <section id="product-list">
            <!-- Productos para seleccionar -->
            <div class="product">
                <div class="product-image-container">
                    <img src="platos/ceviche_A.png" alt="ceviche">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>ceviche</p>
                <p>$18.99</p>
                <button onclick="addToCart('ceviche', 18.99)">Añadir al Carrito</button>
                <p class="description">Preparado con pescado fresco en cubos, marinado en limón y
                    mezclado con cebolla roja, ají limo y cilantro, cada bocado combina acidez,
                    picante y sabor herbal. Servido con camote y maíz tostado, ofrece una
                    mezcla única de texturas y contrastes que deleitan los sentidos.
                </p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/chaufaCecina_A.png" alt="Chaufa de Cecina c/Platano">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Chaufa de Cecina c/Platano</p>
                <p>$21.99</p>
                <button onclick="addToCart('Chaufa de Cecina c/Platano', 21.99)">Añadir al Carrito</button>
                <p class="description">Este plato combina arroz salteado con cecina ahumada, trozos de
                    plátano frito y otros ingredientes frescos, creando una experiencia culinaria
                    única que cautiva con cada bocado.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/chicharronPollo_A.png" alt="Chicharrón de Pollo c/Papas">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Chicharrón de Pollo c/Papas</p>
                <p>$19.99</p>
                <button onclick="addToCart('Chicharrón de Pollo c/Papas', 19.99)">Añadir al Carrito</button>
                <p class="description">El chicharrón de pollo es un plato popular que consiste en trozos de
                    pollo marinados y fritos hasta obtener una piel crujiente y dorada, con un
                    interior jugoso y lleno de sabor. Esta delicia culinaria es ideal como plato
                    principal o acompañamiento en cualquier comida</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/ensalada_N.png" alt="Ensalada Mixta c/Verduras">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Ensalada Mixta c/Verduras</p>
                <p>$5.99</p>
                <button onclick="addToCart('Ensalada Mixta c/Verduras', 5.99)">Añadir al Carrito</button>
                <p class="description">El secreto de su frescura y sabor reside en la selección cuidadosa de
                    ingredientes frescos de la huerta. Esta ensalada mixta combina una variedad
                    de verduras crujientes y coloridas, creando una armonía de texturas y
                    sabores. Su aderezo ligero y delicioso realza cada ingrediente, haciendo de
                    cada bocado una experiencia refrescante y saludable.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/guisoCerdo_N.png" alt="Guiso de Cerdo con Camote">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Guiso de Cerdo con Camote</p>
                <p>$11.99</p>
                <button onclick="addToCart('Guiso de Cerdo con Camote', 11.99)">Añadir al Carrito</button>
                <p class="description">El guiso de cerdo es un plato reconfortante donde tiernos trozos de
                    carne de cerdo se cocinan lentamente con papas y zanahorias en una salsa
                    abundante y sabrosa. Cada ingrediente contribuye con su textura y sabor,
                    creando una armonía deliciosa que se deshace en la boca, convirtiéndo este
                    plato en un favorito en cualquier mesa.
                </p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/lomo_N.png" alt="Lomo Saltado">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Lomo Saltado</p>
                <p>$21.99</p>
                <button onclick="addToCart('Lomo Saltado', 21.99)">Añadir al Carrito</button>
                <p class="description">El encanto de este plato reside en tiernos trozos de carne de res
                    salteados con cebollas, tomates y ajíes, que aportan un toque picante
                    perfecto. Pero lo que lo eleva es su salsa, una mezcla exquisita que
                    conquista el paladar desde el primer bocado.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/milanesa_A.png" alt="Milanesa de Pollo c/Papas">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Milanesa de Pollo c/Papas</p>
                <p>$19.99</p>
                <button onclick="addToCart('Milanesa de Pollo c/Papas', 19.99)">Añadir al Carrito</button>
                <p class="description">La milanesa de pollo es un clásico que consiste en pollo tierno y
                    jugoso, empanizado y frito hasta obtener una textura crujiente por fuera y
                    suave por dentro. Es una experiencia gastronómica reconfortante y
                    satisfactoria, perfecta para cualquier ocasión.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/papHuancaina_N.png" alt="Papa a la Huancaina">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Papa a la Huancaina</p>
                <p>$5.99</p>
                <button onclick="addToCart('Papa a la Huancaina',5.99)">Añadir al Carrito</button>
                <p class="description">Nuestra papa a la huancaína está preparada con ingredientes frescos
                    y de alta calidad, seleccionados cuidadosamente para asegurar una
                    experiencia gastronómica memorable. Las papas, cocidas a la perfección, se
                    sirven cubiertas con una generosa porción de salsa huancaína, elaborada
                    con ají amarillo, queso fresco, leche y galletas, que le dan su característico
                    sabor y textura.
                </p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/pechugaPlancha_A.png" alt="Pechuga a la Plancha c/Papas">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Pechuga a la Plancha c/Papas</p>
                <p>$19.99</p>
                <button onclick="addToCart('Pechuga a la Plancha c/Papas', 19.99)">Añadir al Carrito</button>
                <p class="description">La pechuga a la plancha con papas es un plato simple y delicioso que
                    destaca por su sabor y frescura. La pechuga de pollo se cocina a la plancha
                    para conservar su jugosidad, y se acompaña con papas doradas que añaden
                    una textura crujiente. Esta combinación clásica y nutritiva es ideal para una
                    comida equilibrada y satisfactoria.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/polloChamp_N.png" alt="Pollo con Champiñones con papas">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Pollo con Champiñones con papas</p>
                <p>$11.99</p>
                <button onclick="addToCart('Pollo con Champiñones con papas', 11.99)">Añadir al Carrito</button>
                <p class="description">El pollo con champiñones y papas es un plato reconfortante que
                    combina la suavidad del pollo con la riqueza de los champiñones y la textura
                    perfecta de las papas. Cocinado a la perfección, ofrece una mezcla
                    equilibrada de sabores y texturas que deleitarán tu paladar en cada bocado.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/sopSemola_A.png" alt="Sopa de Semola">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Sopa de Semola</p>
                <p>$5.99</p>
                <button onclick="addToCart('Sopa de Semola', 5.99)">Añadir al Carrito</button>
                <p class="description">Cada cucharada de nuestra sopa te envuelve en confort y satisfacción.
                    El aroma tentador te lleva a recuerdos cálidos de la infancia, mientras la
                    suavidad de la sémola cocida a la perfección acaricia tu paladar. Lo que
                    destaca en nuestra sopa de sémola es su sabor inigualable: un caldo
                    preparado con vegetales frescos y hierbas aromáticas, que realza el sabor de
                    la sémola y crea una armonía que te dejará queriendo más.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/polloHorno_A.png" alt="Pollo al Horno">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Pollo al Horno</p>
                <p>$10.99</p>
                <button onclick="addToCart('Pollo al Horno', 10.99)">Añadir al Carrito</button>
                <p class="description">Cada bocado de nuestro pollo al horno es un viaje de sabores, desde
                    la crujiente piel dorada hasta la jugosa carne tierna en su interior. Cocinado a
                    la perfección en el horno, su calor envolvente crea una textura irresistible que
                    se derrite en la boca. Nuestra receta especial combina hierbas frescas como
                    romero y tomillo con especias aromáticas y un toque de ajo, creando una
                    sinfonía de sabores única que deleitará tu paladar.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/tallVer_N.png" alt="Tallarin Verde con Pollo al Horno">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Tallarin Verde con Pollo al Horno</p>
                <p>$10.99</p>
                <button onclick="addToCart('Tallarin Verde con Pollo al Horno', 10.99)">Añadir al Carrito</button>
                <p class="description">Este plato es una exquisita elección para quienes deseen deleitarse
                    con un plato nutritivo y lleno de sabor. Este plato emblemático de la
                    gastronomía peruana destaca por su vibrante salsa verde, una deliciosa
                    mezcla de albahaca, espinaca, y queso fresco, fusionada con la cremosidad
                    de la leche evaporada.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/tamal_N.png" alt="Tamalito Criollo">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Tamalito Criollo</p>
                <p>$5.99</p>
                <button onclick="addToCart('Tamalito Criollo', 5.99)">Añadir al Carrito</button>
                <p class="description">Este tamalito criollo combina masa de maíz suave con un relleno
                    sabroso de carne sazonada, envuelto en hojas de plátano y cocido al vapor.
                    Es una experiencia gastronómica única que evoca tradiciones culinarias
                    auténticas, con ingredientes frescos y especias seleccionadas para deleitar
                    en cada bocado.</p>
            </div>

            <div class="product">
                <div class="product-image-container">
                    <img src="platos/trucha_N.png" alt="Trucha Frita c/Yuca y Arroz">
                    <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                </div>
                <p>Trucha Frita c/Yuca y Arroz</p>
                <p>$21.99</p>
                <button onclick="addToCart('Trucha Frita c/Yuca y Arroz', 21.99)">Añadir al Carrito</button>
                <p class="description">La trucha frita con yuca y arroz celebra la frescura y simplicidad de sus
                    ingredientes. La trucha, con piel crujiente y un interior jugoso, se acompaña
                    de yuca dorada y arroz blanco esponjoso. Esta combinación ofrece una
                    variedad deliciosa de texturas y sabores, creando una experiencia culinaria
                    rica y satisfactoria.</p>
            </div>
        </section>

        <aside id="cart-summary">
            <h2>Resumen del Carrito</h2>
            <div id="cart-items">
                <!-- Aquí se mostrarán los productos agregados -->
            </div>
            <div id="total-container">
                <p>Subtotal: <span id="cart-subtotal">$0.00</span></p>
                <p>Descuento: <span id="cart-discount">-$0.00</span></p>
                <p>Total: <span id="cart-total">$0.00</span></p>
            </div>
            <button onclick="goToCheckout()" id="checkout-button">Pagar</button>
        </aside>
    </main>
    <footer>
        <section id="redes">
            <a href="https://www.instagram.com/">
                <img src="img/logoig.png" alt="Instagram"></a>
                    <a href="https://twitter.com/">
                <img src="img/logotw.png" alt="Twitter"></a>
                    <a href="https://Facebook.com/">
                <img src="img/face.png" alt="Facebook"></a>
        </section>
        Jirón Salaverry 110 Magdalena del Mar Municipalidad Metropolitana de Lima LIMA, 17
        <section id="licencias">
            <a href="https://www.google.com/">Terminos y Condiciones</a>
            <br>
            <a href="https://www.google.com/">Política de Privacidad</a>
        </section>
        <section id="contacto">
            <a href="tel:+51950661842">
                <img src="img/telef.png" alt="Telefono">
                +51 950 661 842
            </a>
            <a href="mailto:MarCriollo@gmail.com">
                <img src="img/correo.png" alt="Correo">
                MarCriollo@gmail.com
            </a>                
        </section>
        &copy; 2024 Creado por Grupo
    </footer>

    <script src="JavaScript/carrito.js"></script>
</body>
</html>