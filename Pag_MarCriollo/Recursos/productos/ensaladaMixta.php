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

                <div class="contenedorImg"><img src="../productos/img/ensalada_N.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg"><img src="../productos/img/ensalada_A.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg" id="overlayButton"><img src="../../Recursos/productos/img/ico_3D.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>

            </div>
            <div class="imgProducto">
                <div class="conImagen">
                    <img src="../productos/img/ensalada_N.png" id="imagen-grande" alt="Imagen">
                </div>
            </div>
            <div class="descProducto">
                <div class="tipo"><h2>Plato Ejecutivo</h2></div>
                <div class="titulo"><h2>Ensalada Mixta c/Verduras</h2></div>
                <div class="descripcion"><p>El secreto de su frescura y sabor reside en la selección cuidadosa de los ingredientes más frescos de la huerta. Esta ensalada mixta combina una variedad de verduras crujientes y coloridas, creando una armonía perfecta de texturas y sabores. Lo que realmente distingue a esta ensalada es su aderezo ligero y delicioso, que realza cada ingrediente, haciendo de cada bocado una experiencia refrescante y saludable.</p></div>
                <div class="conPrecio">
                    <div class="precioRegular">
                        <div class="titPrecio"><h2>Precio Regular:</h2></div>
                        <div class="precio"><h2>S/6.99</h2></div>
                    </div>
                    <div class="precioOnline">
                        <div class="titPrecio"><h2>Precio Online:</h2></div>
                        <div class="precio"><h2>S/5.99</h2></div>
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
                <div class="con-img"><img src="../productos/img/ico_verdura.png" alt="Imagen"></div>
                <h1>Lechuga Fresca, Base Crujiente</h1>
                <P>Hojas de lechuga recién cosechadas, lavadas y cortadas, proporcionando una base crujiente y refrescante para la ensalada.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_verdura.png" alt="Imagen"></div>
                <h1>Pepino y Zanahoria, Textura y Frescura</h1>
                <P>Rodajas finas de pepino fresco y tiras de zanahoria crujiente, que aportan una textura crocante y un sabor refrescante.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_crema.png" alt="Imagen"></div>
                <h1>Aderezo Ligero, Sutil y Delicioso</h1>
                <P>Un aderezo ligero y sabroso, elaborado con ingredientes frescos y naturales, que complementa y realza el sabor de cada verdura en la ensalada.</P>
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