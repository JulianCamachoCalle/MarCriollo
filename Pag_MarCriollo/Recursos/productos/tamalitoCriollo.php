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
    <script src="/JavaScript/headerfooter.js"></script> <!-- Script para el funcionamiento de la Hamburguesa -->
    <main>
        <div class="productoCarta">
            <div class="ruletaProducto"> <!-- Ruleta de imagenes de referencia -->

                <div class="contenedorImg"><img src="../productos/img/tamal_N.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg"><img src="../productos/img/tamal_A.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                <div class="contenedorImg"><img src="../productos/img/print_Lomo.png" alt="Imagen" loading="lazy" onclick="cambiarImagen(this)"></div>
                
            </div>
            <div class="imgProducto">
                <div class="conImagen">
                    <img src="../productos/img/tamal_N.png" id="imagen-grande" alt="Imagen">
                </div>
            </div>
            <div class="descProducto">
                <div class="tipo"><h2>Plato de Entrada</h2></div>
                <div class="titulo"><h2>Tamalito Criollo</h2></div>
                <div class="descripcion"><p>El secreto de su encanto está en la perfecta combinación de masa de maíz suave y aromática con un relleno sabroso de carne sazonada. Envuelto en hojas de plátano y cocido al vapor, este tamalito criollo ofrece una experiencia gastronómica única que te transporta a las tradiciones culinarias más auténticas. La fusión de ingredientes frescos y especias cuidadosamente seleccionadas hacen de cada bocado una verdadera delicia.</p></div>
                <div class="conPrecio">
                    <div class="precioRegular">
                        <div class="titPrecio"><h2>Precio Regular:</h2></div>
                        <div class="precio"><h2>S/7.99</h2></div>
                    </div>
                    <div class="precioOnline">
                        <div class="titPrecio"><h2>Precio Online:</h2></div>
                        <div class="precio"><h2>S/5.99</h2></div>
                    </div>
                </div>
                <div class="conBoton">
                    <a class="botonPedir" href="../carrito.html">pedir ahora</a>
                </div>
            </div>
        </div>
        <div class="linea-separadora"><hr></div>
        <div class="conMain-Descripcion">
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_harina.png" alt="Imagen"></div>
                <h1>Masa de Maíz, Textura Perfecta</h1>
                <P>Hecha con maíz molido y un toque de manteca, nuestra masa es suave, ligera y llena de sabor, logrando la base perfecta para este plato tradicional.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_vaca.png" alt="Imagen"></div>
                <h1>Relleno de Carne, Exquisitamente Sazonado</h1>
                <P>Trozos jugosos de carne de cerdo o pollo, marinados con una mezcla de especias criollas, que aportan un sabor profundo y una jugosidad inigualable.</P>
            </div>
            <div class="item">
                <div class="con-img"><img src="../productos/img/ico_verdura.png" alt="Imagen"></div>
                <h1>Hojas de Plátano, Toque Ahumado</h1>
                <P>Envuelto en hojas de plátano, el tamalito adquiere un sutil toque ahumado y una presentación tradicional que preserva todo su aroma y sabor.</P>
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
   <script src="../../Modelo/JavaScript/producto.js"></script>
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