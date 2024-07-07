<?php
session_start();

// Verificar si el usuario está autenticado
$usuario_autenticado = isset($_SESSION['usuario']);

if ($usuario_autenticado) {
    $correo = $_SESSION['usuario'];

    // Incluir el archivo de conexión
    include 'Controlador/BD/Conexion.php';
    
    // Establecer la conexión
    $conexion = new Conexion();
    $con = $conexion->getcon();

    // Consulta a la base de datos para obtener los datos del usuario
    $consulta = $con->prepare("SELECT * FROM usuarios WHERE correo = :correo");
    $consulta->bindParam(':correo', $correo, PDO::PARAM_STR);
    $consulta->execute();
    $datos_usuario = $consulta->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo - Pago</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Recursos/style/pago.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="icon" href="Recursos/img/favicon-32x32.png" type="image/png">
</head>
<body>
<header>
        <div class="contenedorhead">
            <div class="head">
                MarCriollo
            </div>
            <div class="logoprincipal">
                <img src="Recursos/img/crab.png" alt="Logo">
            </div>
            <div class="info">
            <?php if (!$usuario_autenticado) : ?>
                <!-- Mostrar botones de Iniciar sesión y Registrarse si el usuario no está autenticado -->
                <a href="intranet.php" class="info-link">Iniciar sesión</a>
                <a href="intranet.php" class="info-link">Registrarse</a>
            <?php else : ?>
                <!-- Mostrar nombre de usuario y enlace a intranet.php si el usuario está autenticado -->
                <a href="intranet.php" class="info-link">
                    <div class="textnombres">
                        Usuario: <?php echo $datos_usuario['nombres']; ?>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </header>
    <nav class="navbar">
        <button id="menu-desplegable" class="menu-desplegable" aria-label="Menu Desplegable">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <ul class="opciones">
            <li><a id="seleccionado" href="index.php">Inicio</a></li>
            <li><a id="no-seleccionado" href="nosotros.php">Nosotros</a></li>
            <li><a id="no-seleccionado" href="servicios.php">Servicios</a></li>
            <li><a id="no-seleccionado" href="redessociales.php">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="mapas.php">Mapas</a></li>
            <li><a id="no-seleccionado" href="contacto.php">Contacto</a></li>
            <li><a id="no-seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="Modelo/JavaScript/headerfooter.js"></script>
    <main>
        <section id="payment-details">
            <h2>Detalles de Pago</h2>
            <form id="payment-form">
                <div class="card-info">
                    <div class="card-header">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1200px-Visa_Inc._logo.svg.png" alt="Visa Logo" class="card-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1200px-Mastercard-logo.svg.png" alt="Mastercard Logo" class="card-logo">
                        <span class="card-title">Tarjetas de crédito o débito</span>
                    </div>
                    <label for="card-number">Número de tarjeta:</label>
                    <input type="text" id="card-number" name="card-number" required>

                    <label for="card-name">Nombre del titular de la tarjeta:</label>
                    <input type="text" id="card-name" name="card-name" required>

                    <label for="expiry-date">Fecha de caducidad:</label>
                    <input type="month" id="expiry-date" name="expiry-date" required>

                    <label for="cvv">CVC:</label>
                    <input type="text" id="cvv" name="cvv" required>

                    <label for="installments">Número de cuotas:</label>
                    <select id="installments" name="installments" required>
                        <option value="1">1 cuota</option>
                        <option value="3">3 cuotas</option>
                        <option value="6">6 cuotas</option>
                        <option value="12">12 cuotas</option>
                    </select>

                    <label>Tipo de comprobante:</label>
                    <div class="receipt-options">
                        <input type="radio" id="boleta" name="receipt-type" value="boleta" required>
                        <label for="boleta">Boleta</label>
                        <input type="radio" id="factura" name="receipt-type" value="factura">
                        <label for="factura">Factura</label>
                    </div>
                </div>

                <button type="button" id="confirm-payment-button">Confirmar Pago</button>
                <button type="button" id="back-to-cart-button">Regresar al Carrito</button>
            </form>
        </section>
        <aside id="cart-summary">
            <h2>Resumen del Carrito</h2>
            <div id="cart-items">
                <!-- Aquí se mostrarán los productos agregados -->
            </div>
            <div id="total-container">
                <p>Descuento:</p>
                <p id="discount">$0.00</p>
                <p>Total:</p>
                <p id="cart-total">$0.00</p>
            </div>
        </aside>
    </main>
    <footer>
        <section id="redes">
            <a href="https://www.instagram.com/">
                <img src="Recursos/img/logoig.png" alt="Instagram"></a>
                    <a href="https://twitter.com/">
                <img src="Recursos/img/logotw.png" alt="Twitter"></a>
                    <a href="https://Facebook.com/">
                <img src="Recursos/img/face.png" alt="Facebook"></a>
        </section>
        Jirón Salaverry 110 Magdalena del Mar Municipalidad Metropolitana de Lima LIMA, 17
        <section id="licencias">
            <a href="https://www.google.com/">Terminos y Condiciones</a>
            <br>
            <a href="https://www.google.com/">Política de Privacidad</a>
        </section>
        <section id="contacto">
            <a href="tel:+51950661842">
                <img src="Recursos/img/telef.png" alt="Telefono">
                +51 950 661 842
            </a>
            <a href="mailto:MarCriollo@gmail.com">
                <img src="Recursos/img/correo.png" alt="Correo">
                MarCriollo@gmail.com
            </a>                
        </section>
        &copy; 2024 Creado por Grupo
    </footer>

    <script src="Modelo/JavaScript/pago.js"></script>
</body>
</html>