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
    <title>MarCriollo</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Recursos/style/entrega.css">
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
        <section id="delivery-details">
            <h2>Detalles de Entrega</h2>
            <form action="Entrega_Domicilio.php" method="POST" id="delivery-form">
                <label for="name">Nombres:</label>
                <input type="text" id="name" name="name" <?php if ($usuario_autenticado) echo 'value="' . htmlspecialchars($datos_usuario['nombres']) . '"'; ?> required><br><br>

                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" <?php if ($usuario_autenticado) echo 'value="' . htmlspecialchars($datos_usuario['direccion']) . '"'; ?> required><br><br>

                <label for="district">Distrito:</label>
                <input type="text" id="district" name="district" <?php if ($usuario_autenticado) echo 'value="' . htmlspecialchars($datos_usuario['distrito']) . '"'; ?> required><br><br>

                <label for="date">Fecha de entrega:</label>
                <input type="date" id="date" name="date" required><br><br>

                <label for="time">Hora de entrega:</label>
                <input type="time" id="time" name="time" required><br><br>

                <label for="delivery-option">Opción de Entrega:</label>
                <select id="delivery-option" name="delivery-option" required>
                    <option value="tienda">Recoger en Tienda </option>
                    <option value="domicilio">Entrega a Domicilio </option>
                </select>
                <br><br>

                <div id="extra-charge-container" style="display: none;">
                    <label for="extra-charge-amount">Cargo Adicional:</label>
                    <span id="extra-charge-amount">$0.00</span>
                    <br><br>
                </div>

                <button type="button" id="delivery-home-button" style="display:none;">Entrega a Domicilio</button>
                <button type="button" id="pay-button">Pagar</button>
                <button type="button" onclick="continueShopping()" id="continue-button">Seguir Comprando</button>
            </form>
        </section>
        <aside id="cart-summary">
            <h2>Resumen del Carrito</h2>
            <div id="cart-items">
                <!-- Aquí se mostrarán los productos agregados -->
            </div>
            <div id="total-container">
                <p>Subtotal</p>
                <span id="subtotal">$0.00</span>
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

    <script src="Modelo/JavaScript/entrega.js"></script>
    <script>
        document.getElementById('delivery-option').addEventListener('change', function() {
            const deliveryHomeButton = document.getElementById('delivery-home-button');
            if (this.value === 'domicilio') {
                deliveryHomeButton.style.display = 'block';
                deliveryHomeButton.addEventListener('click', function() {
                    window.location.href = 'Entrega_Domicilio.php';
                });
            } else {
                deliveryHomeButton.style.display = 'none';
            }
        });

        // Función para continuar comprando desde la página de entrega
        function continueShopping() {
            // Redirigir al usuario a la página de carrito.php
            window.location.href = 'Vista/carrito.php'; 
        }
    </script>
</body>

</html>