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
            <div class="head">MarCriollo</div>
            <div class="logoprincipal"><img src="Recursos/img/crab.png" alt="Logo"></div>
            <div class="info">
                <?php if (!$usuario_autenticado) : ?>
                    <a href="intranet.php" class="info-link">Iniciar sesión</a>
                    <a href="intranet.php" class="info-link">Registrarse</a>
                <?php else : ?>
                    <a href="intranet.php" class="info-link">
                        <div class="textnombres">Usuario: <?php echo $datos_usuario['nombres']; ?></div>
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
    <main>
        <section id="delivery-details">
            <h2>Detalles de Entrega a Domicilio</h2>
            <form target="_blank" action="https://formsubmit.co/11e9a38095f2b47552d17e6f0fb16ede" method="POST" id="delivery-form">
    <div class="form-group">
      <div class="form-row">
        <div class="col">
        <label for="name">Nombres:</label>
          <input type="text" name="Nombre" class="form-control" placeholder="" value="<?php if ($usuario_autenticado) echo $datos_usuario['nombres']; ?>" required>>
        </div>
        <input type="hidden" name="Dato importante" value="Nuestro conductor estara pronto en su domicilio" >
        <div class="col">
        <label for="email">Correo Electrónico:</label><br><br>
          <input type="email" name="Correo electronico" class="form-control" placeholder="Pon tu correro" value="<?php if ($usuario_autenticado) echo $correo; ?>" required>
        </div>
      </div>
    </div>
    <label for="phone">Teléfono:</label>
    <input type="tel" id="phone" name="Telefono" required placeholder="+51"><br><br>

    <input type="hidden" name="codigo_pedido_(mostrarle a nuestro delivery)" value="<?php echo mt_rand(1000, 9999); ?>">

    <input type="hidden" name="distrito" value="<?php if ($usuario_autenticado) echo ($datos_usuario['distrito']); ?>" required>
    
    <input type="hidden" name="direccion" value="<?php if ($usuario_autenticado) echo ($datos_usuario['direccion']); ?>" required>
        <div id="total-container">
        <input type="hidden" name="Monto a pagar" id="cart-total-hiden">
        </div>
    <button type="submit" class="btn btn-lg btn-dark btn-block" id="confirm-delivery-button" onclick="confirmDelivery()">Pedir pedido</button>

    <button type="button" onclick="goBack()" id="back-button">Volver</button>
    
    <input type="hidden" name="_next" value="http://localhost/MarCriollo12/Pag_MarCriollo/alerta_pedido.php">

    <input type="hidden" name="pagina web" value="http://localhost/MarCriollo12/Pag_MarCriollo/index.php">
    <input type="hidden" name="_captcha" value="false" >

    <input type="hidden" name="Nos encuentras en" value="Jirón Salaverry 110 Magdalena del Mar Municipalidad Metropolitana de Lima LIMA, 17">
    <input type="hidden" name="Numero del restaurante" value="+51 950 661 842 Correo" >
   
  </form>
        </section>
        <aside id="cart-summary">
            <h2>Resumen del Carrito</h2>
            <div id="cart-items">
                <!-- Aquí se mostrarán los productos agregados -->
            </div>
            <div id="total-container">
                <p>Subtotal:</p>
                <span id="subtotal">$0.00</span>
                <p>Descuento:</p>
                <span id="discount">$0.00</span>
                <p>Cargo adicional:</p>
                <span id="extra-charge-amount">$0.00</span>
                <p>Total:</p>
                <span id="cart-total">$0.00</span>
            </div>
        </aside>
    </main>
    <footer>
        <section id="redes">
            <a href="https://www.instagram.com/"><img src="Recursos/img/logoig.png" alt="Instagram"></a>
            <a href="https://twitter.com/"><img src="Recursos/img/logotw.png" alt="Twitter"></a>
            <a href="https://Facebook.com/"><img src="Recursos/img/face.png" alt="Facebook"></a>
        </section>
        Jirón Salaverry 110 Magdalena del Mar Municipalidad Metropolitana de Lima LIMA, 17
        <section id="licencias">
            <a href="https://www.google.com/">Terminos y Condiciones</a>
            <br>
            <a href="https://www.google.com/">Política de Privacidad</a>
        </section>
        <section id="contacto">
            <a href="tel:+51950661842"><img src="Recursos/img/telef.png" alt="Telefono"> +51 950 661 842</a>
            <a href="mailto:MarCriollo@gmail.com"><img src="Recursos/img/correo.png" alt="Correo"> MarCriollo@gmail.com</a>
        </section>
        &copy; 2024 Creado por Grupo
    </footer>

    <script src="Modelo/JavaScript/entrega_domicilio.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Función para volver a la página anterior
        function goBack() {
            window.location.href = 'entrega.php';
        }
    </script>
</body>
</body>
</html>