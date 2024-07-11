document.addEventListener('DOMContentLoaded', function() {
    // Cargar carrito desde sessionStorage al cargar la página
    loadCartFromSessionStorage();

    // Mostrar el resumen del carrito y el total con descuento
    displayCartSummary();

    // Configurar eventos para tipo de comprobante
    const boletaRadio = document.getElementById('boleta');
    const facturaRadio = document.getElementById('factura');
    const boletaFields = document.getElementById('boleta-fields');
    const facturaFields = document.getElementById('factura-fields');

    boletaRadio.addEventListener('change', function() {
        boletaFields.style.display = 'block';
        facturaFields.style.display = 'none';
    });

    facturaRadio.addEventListener('change', function() {
        boletaFields.style.display = 'none';
        facturaFields.style.display = 'block';
    });

    // Configurar el evento para el botón "Confirmar Pago"
    const confirmPaymentButton = document.getElementById('confirm-payment-button');
    confirmPaymentButton.addEventListener('click', function() {
        confirmPayment();
    });

    // Configurar el evento para el botón "Regresar al Carrito"
    const backToCartButton = document.getElementById('back-to-cart-button');
    backToCartButton.addEventListener('click', function() {
        window.location.href = 'carrito.php'; // Cambiar 'carrito.php' por la URL correcta
    });
});

// Función para cargar carrito desde sessionStorage
function loadCartFromSessionStorage() {
    const storedCart = sessionStorage.getItem('cart');
    if (storedCart) {
        const cart = JSON.parse(storedCart);
        displayCart(cart);
    }
}

// Función para mostrar el resumen del carrito
function displayCart(cart) {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = ''; // Limpiar el contenido actual del carrito

    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        
        const itemName = document.createElement('p');
        itemName.textContent = `${item.name} x ${item.quantity}`;

        const itemSubtotal = document.createElement('p');
        itemSubtotal.textContent = `$${item.price * item.quantity}`;

        cartItem.appendChild(itemName);
        cartItem.appendChild(itemSubtotal);

        cartItems.appendChild(cartItem);
    });
}

// Función para mostrar el resumen del carrito y el total con descuento
function displayCartSummary() {
    const storedCart = sessionStorage.getItem('cart');
    if (storedCart) {
        const cart = JSON.parse(storedCart);
        const total = calculateTotal(cart);
        const discount = parseFloat(sessionStorage.getItem('discount')) || 0;
        const discountedTotal = total - discount;

        document.getElementById('cart-total').textContent = `$${discountedTotal.toFixed(2)}`;
        document.getElementById('discount').textContent = `$${discount.toFixed(2)}`;
    }
}

// Función para calcular el total del carrito
function calculateTotal(cart) {
    return cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
}

// Función para validar y confirmar el pago
function confirmPayment() {
    // Validar el formulario de pago antes de proceder a la confirmación
    if (validatePaymentForm()) {
        // Simular envío de datos al servidor
        setTimeout(function() {
            // Mostrar la notificación de pago exitoso con SweetAlert
            Swal.fire({
                title: '¡Pago realizado!',
                text: '¡El pago se ha realizado exitosamente!',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                // Redirigir a la página principal después de confirmar
                if (result.isConfirmed || result.isDismissed) {
                    sessionStorage.removeItem('cart'); // Limpiar el carrito después de confirmar el pago
                    window.location.href = 'index.php'; // Cambiar 'index.php' por la URL correcta después del pago
                }
            });
        }, 1000); // Simular un tiempo de espera antes de mostrar la notificación (opcional)
    }
}

// Función para validar el formulario de pago
function validatePaymentForm() {
    const cardNumber = document.getElementById('card-number').value.trim();
    const cardName = document.getElementById('card-name').value.trim();
    const expiryDate = document.getElementById('expiry-date').value.trim();
    const cvv = document.getElementById('cvv').value.trim();

    if (cardNumber === '' || cardName === '' || expiryDate === '' || cvv === '') {
        alert('Por favor completa todos los campos del formulario de pago.');
        return false;
    }

    return true;
}