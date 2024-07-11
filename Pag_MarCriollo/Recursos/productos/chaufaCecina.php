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

                <div class="contenedorImg"><img src="../productos/img/chaufaCecina_N.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg"><img src="../productos/img/chaufaCecina_A.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg" id="overlayButton"><img src="../../Recursos/productos/img/ico_3D.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                
            </div>
            <div class="imgProducto">
                <div class="conImagen">
                    <img src="../productos/img/chaufaCecina_N.png" id="imagen-grande" alt="Imagen">
                </div>
            </div>
            <div class="descProducto">
                <div class="tipo"><h2>Plato Ejecutivo</h2></div>
                <div class="titulo"><h2>Chaufa de Cecina c/Platano</h2></div>
                <div class="descripcion"><p>El chaufa de cecina con plátano es una fusión deliciosa entre la cocina peruana y la influencia asiática. Este plato combina arroz salteado con cecina ahumada, trozos de plátano frito y otros ingredientes frescos, creando una experiencia culinaria única que cautiva con cada bocado.</p></div>
                <div class="conPrecio">
                    <div class="precioRegular">
                        <div class="titPrecio"><h2>Precio Regular:</h2></div>
                        <div class="precio"><h2>S/24.99</h2></div>
                    </div>
                    <div class="precioOnline">
                        <div class="titPrecio"><h2>Precio Online:</h2></div>
                        <div class="precio"><h2>S/21.99</h2></div>
                    </div>
                </div>
                <div class="conBoton">
                    <a class="botonPedir" href="../../Vista/carrito.php">Pedir Ahora</a>
                </div>
            </div>
        </div>
        <div class="linea-separadora"><hr></div>
        <div class="conMain-Descripcion">
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_vaca.png" alt="Imagen"></div>
                <h1>Cecina Ahumada, Sabor Intenso</h1>
                <P>Trozos de cecina ahumada, cortados en trozos pequeños y salteados con arroz, que aportan un sabor intenso y ahumado al chaufa, destacando su origen peruano.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_platano.png" alt="Imagen"></div>
                <h1>Plátano Frito, Dulzura Natural</h1>
                <P>Plátano maduro cortado en trozos y frito hasta alcanzar un dorado perfecto, que añade una dulzura natural y un contraste de textura crujiente al chaufa de cecina.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_semilla.png" alt="Imagen"></div>
                <h1>Arroz Salteado, Sabor Tradicional</h1>
                <P>Arroz salteado con cebolla, ajos y huevos revueltos, que forma la base del chaufa y absorbe los sabores de la cecina y el plátano, creando una combinación armoniosa y satisfactoria.</P>
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