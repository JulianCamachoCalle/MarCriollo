<?php
// Incluir archivo de conexión
include '../Controlador/BD/Conexion.php';

// Establecer la conexión
$conexion = new Conexion();
$con = $conexion->getcon();

// Consulta a la base de datos para obtener los productos
$consulta_productos = $con->prepare("SELECT * FROM productos");
$consulta_productos->execute();
$productos = $consulta_productos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo - Productos</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Recursos/style/carrito.css">
    <link rel="icon" href="../Recursos/img/favicon-32x32.png" type="image/png">
</head>

<body>
    <header>
        <div class="contenedorhead">
            <div class="head">
                MarCriollo
            </div>
            <div class="logoprincipal">
                <img src="../Recursos/img/crab.png" alt="Logo">
            </div>
        </div>
    </header>

    <nav class="navbar">
        <ul class="opciones">
            <li><a id="seleccionado" href="../index.php">Inicio</a></li>
            <li><a id="no-seleccionado" href="../nosotros.php">Nosotros</a></li>
            <li><a id="no-seleccionado" href="../servicios.php">Servicios</a></li>
            <li><a id="no-seleccionado" href="../redessociales.php">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="../mapas.php">Mapas</a></li>
            <li><a id="no-seleccionado" href="../contacto.php">Contacto</a></li>
        </ul>
    </nav>

    <main>
        <section id="product-list">
            <!-- Productos desde la base de datos -->
            <?php foreach ($productos as $producto) : ?>
                <div class="product">
                    <div class="product-image-container">
                        <img src="<?php echo $producto['foto']; ?>" alt="<?php echo isset($producto['producto']) ? htmlspecialchars($producto['producto']) : 'Nombre no disponible'; ?>">
                        <button class="description-button" onclick="toggleDescription(this)">Ver Descripción</button>
                    </div>
                    <p><?php echo isset($producto['producto']) ? htmlspecialchars($producto['producto']) : 'Nombre no disponible'; ?></p>
                    <p>$<?php echo isset($producto['precio']) ? number_format($producto['precio'], 2) : 'Precio no disponible'; ?></p>
                    <button onclick="addToCart('<?php echo isset($producto['producto']) ? htmlspecialchars($producto['producto']) : 'Producto'; ?>', <?php echo isset($producto['precio']) ? number_format($producto['precio'], 2) : '0.00'; ?>)">Añadir al Carrito</button>
                    <p class="description"><?php echo isset($producto['detalles']) ? nl2br(htmlspecialchars($producto['detalles'])) : 'Descripción no disponible'; ?></p>
                </div>
            <?php endforeach; ?>
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
                <img src="../Recursos/img/logoig.png" alt="Instagram"></a>
            <a href="https://twitter.com/">
                <img src="../Recursos/img/logotw.png" alt="Twitter"></a>
            <a href="https://Facebook.com/">
                <img src="../Recursos/img/face.png" alt="Facebook"></a>
        </section>
        Jirón Salaverry 110 Magdalena del Mar Municipalidad Metropolitana de Lima LIMA, 17
        <section id="licencias">
            <a href="https://www.google.com/">Términos y Condiciones</a>
            <br>
            <a href="https://www.google.com/">Política de Privacidad</a>
        </section>
        <section id="contacto">
            <a href="tel:+51950661842">
                <img src="../Recursos/img/telef.png" alt="Telefono">
                +51 950 661 842
            </a>
            <a href="mailto:MarCriollo@gmail.com">
                <img src="../Recursos/img/correo.png" alt="Correo">
                MarCriollo@gmail.com
            </a>
        </section>
        &copy; 2024 Creado por Grupo
    </footer>

    <script src="../Modelo/JavaScript/carrito.js"></script>
    <script src="../Modelo/JavaScript/headerfooter.js"></script>
    <script>
        // Función para redirigir a la página de entrega.html al hacer clic en Pagar
        function goToCheckout() {
            // Verificar una última vez si hay productos en el carrito
            if (cart.length === 0) {
                alert('Agrega al menos un producto al carrito antes de proceder al pago.');
                return;
            }

            // Redirigir a la página de entrega.html
            window.location.href = '../entrega.php';
        }
    </script>
</body>

</html>