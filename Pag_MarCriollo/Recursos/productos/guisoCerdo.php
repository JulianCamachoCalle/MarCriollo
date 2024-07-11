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

                <div class="contenedorImg"><img src="../productos/img/guisoCerdo_N.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg"><img src="../productos/img/guisoCerdo_A.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg" id="overlayButton"><img src="../../Recursos/productos/img/ico_3D.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                
            </div>
            <div class="imgProducto">
                <div class="conImagen">
                    <img src="../productos/img/guisoCerdo_N.png" id="imagen-grande" alt="Imagen">
                </div>
            </div>
            <div class="descProducto">
                <div class="tipo"><h2>Plato de Fondo</h2></div>
                <div class="titulo"><h2>Guiso de Cerdo con Camote</h2></div>
                <div class="descripcion"><p>El guiso de cerdo es un plato reconfortante que combina tiernos trozos de carne de cerdo cocidos lentamente con papas y zanahorias, en una salsa abundante y llena de sabor. Cada ingrediente aporta su propia textura y sabor, creando una armonía deliciosa que se deshace en la boca y que hace de este plato un favorito en cualquier mesa.</p></div>
                <div class="conPrecio">
                    <div class="precioRegular">
                        <div class="titPrecio"><h2>Precio Regular:</h2></div>
                        <div class="precio"><h2>S/15.99</h2></div>
                    </div>
                    <div class="precioOnline">
                        <div class="titPrecio"><h2>Precio Online:</h2></div>
                        <div class="precio"><h2>S/11.99</h2></div>
                    </div>
                </div>
                <div class="conBoton">
                    <a class="botonPedir" href="../../carrito.php">Pedir Ahora</a>
                </div>
            </div>
        </div>
        <div class="linea-separadora"><hr></div>
        <div class="conMain-Descripcion">
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_cerdo.png" alt="Imagen"></div>
                <h1>Carne de Cerdo Tierna y Sabrosa</h1>
                <P>Trozos de carne de cerdo cocidos a fuego lento hasta alcanzar una textura tierna y un sabor profundamente reconfortante, que se deshace en la boca con cada bocado.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_papa.png" alt="Imagen"></div>
                <h1>Papas, Sustancia y Sabor</h1>
                <P>Papas cortadas en trozos generosos, que absorben los jugos del guiso y aportan una textura cremosa y un sabor dulce que complementa perfectamente la carne de cerdo.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_verdura.png" alt="Imagen"></div>
                <h1>Zanahorias, Dulzura Natural</h1>
                <P>Zanahorias cortadas en rodajas, que añaden una dulzura natural al guiso y una textura suave que contrasta con la carne y las papas, creando una experiencia gastronómica equilibrada y satisfactoria.</P>
            </div>
        </div>
        <div class="linea-separadora"><hr></div>

        <!-- .ConMain-Ruleta. Clase con-textRuleta fuera de .conMain-Ruleta -->
        <div class="con-textRuleta">Clientes que vieron este plato también vieron:</div>
        <div class="conMain-Ruleta">
            <div class="conMain-Ruleta">
                <!--
                    Ahora Js genera los contenedores (Tarjeta)
                    const numContenedores = 3; <- Cambia este número para generar más contenedores
                -->
            </div>
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