<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo</title>
    
    <!-- Estilos -->
    <link rel="stylesheet" href="../style/productos.css"> <!-- Modificar segun tu estillo (css)-->
    <link rel="icon" href="../img/favicon-32x32.png" type="/image/png">
</head>
<body>
    <header>
        <div class="contenedorhead">
            <div class="head">
                MarCriollo
            </div>
            <div class="logoprincipal">
                <img src="../img/crab.png" alt="Logo">
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
            <!-- Modificar -->
            <li><a id="no-seleccionado" href="../../index.php">Inicio</a></li>
            <li><a id="no-seleccionado" href="../../nosotros.php">Nosotros</a></li>
            <li><a id="no-seleccionado" href="../../servicios.php">Servicios</a></li>
            <li><a id="no-seleccionado" href="../../redessociales.php">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="../../mapas.php">Mapas</a></li>
            <li><a id="no-seleccionado" href="../../contacto.php">Contacto</a></li>
            <li><a id="no-seleccionado" href="../../intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="../../Modelo/JavaScript/headerfooter.js"></script> <!-- Script para el funcionamiento de la Hamburguesa -->
    <main>
        <!---->
        <div id="overlayContainer" class="overlay-container" style="display: none;">
            <div class="overlay">
                <div class="overlay-content">
                    <!-- Contenido del overlay -->
                    <div id="container3D">
                        <div id="demoText">- Demostracion Modelo 3D -</div>
                    </div>
                    <script>
                    const modelPath = "../../Recursos/productos/assets/plato/plato.gltf";
                    const model = "";
                    </script>
                </div>
            </div>
            <!-- Botón de cerrar -->
            <button id="closeOverlayButton" class="close-button">×</button>
        </div>
        <div class="productoCarta">
            <div class="ruletaProducto"> <!-- Ruleta de imagenes de referencia -->

                <div class="contenedorImg"><img src="../productos/img/polloChamp_N.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg"><img src="../productos/img/polloChamp_A.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg" id="overlayButton"><img src="../../Recursos/productos/img/ico_3D.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                
            </div>
            <div class="imgProducto">
                <div class="conImagen">
                    <img src="../productos/img/polloChamp_N.png" id="imagen-grande" alt="Imagen">
                </div>
            </div>
            <div class="descProducto">
                <div class="tipo"><h2>Plato de Fondo</h2></div>
                <div class="titulo"><h2>Pollo con Champiñones con Papas</h2></div>
                <div class="descripcion"><p>El pollo con champiñones y papas es un plato reconfortante que combina la suavidad del pollo con la riqueza de los champiñones y la textura perfecta de las papas. Cocinado a la perfección, este plato ofrece una mezcla equilibrada de sabores y texturas que deleitarán tu paladar en cada bocado.</p></div>
                <div class="conPrecio">
                    <div class="precioRegular">
                        <div class="titPrecio"><h2>Precio Regular:</h2></div>
                        <div class="precio"><h2>S/14.99</h2></div>
                    </div>
                    <div class="precioOnline">
                        <div class="titPrecio"><h2>Precio Online:</h2></div>
                        <div class="precio"><h2>S/11.99</h2></div>
                    </div>
                </div>
                <div class="conBoton">
                    <a class="botonPedir" href="../../Vista/carrito.php">pedir ahora</a>
                </div>
            </div>
        </div>
        <div class="linea-separadora"><hr></div>
        <div class="conMain-Descripcion">
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_pollo.png" alt="Imagen"></div>
                <h1>Pollo Tierno y Suculento</h1>
                <P>Trozos de pechuga de pollo jugosa, cocinada a fuego lento con especias, que se deshace en la boca y aporta un sabor profundo y delicioso a este plato clásico.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_champinon.png" alt="Imagen"></div>
                <h1>Champiñones Frescos y Sabrosos</h1>
                <P>Champiñones frescos salteados, que añaden una textura terrosa y un sabor rico y umami, complementando a la perfección la suavidad del pollo.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_papa.png" alt="Imagen"></div>
                <h1>Papas Doradas y Tiernas</h1>
                <P>Papas cortadas en trozos generosos, cocinadas hasta quedar doradas por fuera y tiernas por dentro, absorbiendo los jugos del pollo y los champiñones para una experiencia de sabor completa.</P>
            </div>
        </div>
        <div class="linea-separadora"><hr></div>

        <!-- .ConMain-Ruleta. Clase con-textRuleta fuera de .conMain-Ruleta -->
        <div class="con-textRuleta">Clientes que vieron este plato también vieron:</div>
        <div class="conMain-Ruleta">
            <!--
                Ahora Js genera los contenedores (Tarjeta)
                const numContenedores = 3; <- Cambia este número para generar más contenedores
            -->
        </div>
    </main>
    <script type="module" src="../../Modelo/JavaScript/producto.js"></script>
    <script>
        function cambiarImagen(imagen) {
            var imagenGrande = document.getElementById("imagen-grande");
            imagenGrande.src = imagen.src;
        }
    </script>
    <footer>
        <section id="redes">
            <a href="https://www.instagram.com/">
                <img src="../img/logoig.png" alt="Instagram"></a>
                    <a href="https://twitter.com/">
                <img src="../img/logotw.png" alt="Twitter"></a>
                    <a href="https://Facebook.com/">
                <img src="../img/face.png" alt="Facebook"></a>
        </section>
        Jirón Salaverry 110 Magdalena del Mar Municipalidad Metropolitana de Lima LIMA, 17
        <section id="licencias">
            <a href="https://www.google.com/">Terminos y Condiciones</a>
            <br>
            <a href="https://www.google.com/">Política de Privacidad</a>
        </section>
        <section id="contacto">
            <a href="tel:+51950661842">
                <img src="../img/telef.png" alt="Telefono">
                +51 950 661 842
            </a>
            <a href="mailto:MarCriollo@gmail.com">
                <img src="../img/correo.png" alt="Correo">
                MarCriollo@gmail.com
            </a>                
        </section>
        &copy; 2024 Creado por Grupo
    </footer>
</body>
</html>