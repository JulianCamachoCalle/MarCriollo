// Función para cargar el carrito desde sessionStorage
function loadCartFromSessionStorage() {
    const storedCart = sessionStorage.getItem('cart');
    if (storedCart) {
        const cart = JSON.parse(storedCart);
        displayCart(cart);
    }

    // Mostrar detalles de entrega guardados en localStorage si existen
    const deliveryDetails = JSON.parse(localStorage.getItem('deliveryDetails'));
    if (deliveryDetails) {
        document.getElementById('name').value = deliveryDetails.name || '';
        document.getElementById('email').value = deliveryDetails.email || '';
        document.getElementById('phone').value = deliveryDetails.phone || '';
    }
}

function displayCart(cart) {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = ''; // Limpiar el contenido actual del carrito

    let subtotal = 0;

    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');

        const itemName = document.createElement('p');
        itemName.textContent = `${item.name} x ${item.quantity}`;

        const itemSubtotal = document.createElement('p');
        itemSubtotal.textContent = `$${(item.price * item.quantity).toFixed(2)}`;

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Eliminar';
        removeButton.addEventListener('click', () => removeFromCart(item.name));

        cartItem.appendChild(itemName);
        cartItem.appendChild(itemSubtotal);
        cartItem.appendChild(removeButton);

        cartItems.appendChild(cartItem);

        // Sumar al subtotal
        subtotal += item.price * item.quantity;
    });

      // Calcular el descuento y el cargo adicional
    const discount = calculateDiscount(cart);
    const deliveryCharge = calculateExtraCharge(subtotal);
    const total = subtotal - discount + deliveryCharge;

    // Mostrar los valores calculados en el HTML
    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('discount').textContent = `$${discount.toFixed(2)}`;
    document.getElementById('extra-charge-amount').textContent = `$${deliveryCharge.toFixed(2)}`;
    document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;

    // Actualizar el valor del campo oculto cart-total
    document.getElementById('cart-total').value = total.toFixed(2);
    document.getElementById('cart-total-hiden').value = total.toFixed(2); // Actualizar también el campo oculto en el formulario

    const extraChargeAmount = document.getElementById('extra-charge-amount');
    if (deliveryCharge > 0) {
        extraChargeAmount.textContent = `$${deliveryCharge.toFixed(2)}`;
        document.getElementById('extra-charge-container').style.display = 'block';
    } else {
        extraChargeAmount.textContent = `$0.00`;
        document.getElementById('extra-charge-container').style.display = 'none';
    }

    // Mostrar el total con descuento y cargo adicional
    document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;

    // Guardar carrito y total en sessionStorage
    sessionStorage.setItem('cart', JSON.stringify(cart));
    sessionStorage.setItem('cartTotal', total.toFixed(2));
    sessionStorage.setItem('discount', discount.toFixed(2));
    sessionStorage.setItem('subtotal', subtotal.toFixed(2));
}

// Función para calcular el descuento
function calculateDiscount(cart) {
    const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
    let discount = 0;

    if (totalItems >= 2) {
        discount = totalItems >= 5 ? 0.1 * cart.reduce((acc, item) => acc + item.price * item.quantity, 0) : 4;
    }

    return discount;
}

// Función para confirmar la entrega
function confirmDelivery() {
    // Validar el formulario de entrega antes de proceder a la confirmación
    if (validateForm()) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        let phone = document.getElementById('phone').value.trim();
        const cartTotal = document.getElementById('cart-total').textContent.trim(); // Obtener el total del carrito

        // Agregar prefijo de Perú si no está presente
        if (!phone.startsWith('+51')) {
            phone = '+51 ' + phone;
        }

        // Guardar detalles de entrega en localStorage
        localStorage.setItem('deliveryDetails', JSON.stringify({
            name: name,
            email: email,
            phone: phone
        }));

        // Enviar formulario al PHP para procesamiento
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('cartTotal', cartTotal);

        // Realizar la solicitud AJAX o utilizar fetch para enviar el formulario
        fetch('Entrega_Domicilio.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Mostrar mensaje de éxito o error
            // Mostrar alerta bonita usando SweetAlert2
            Swal.fire({
                icon: 'success',
                title: '¡Entrega en camino!',
                text: 'Por favor, revise su correo electrónico para más detalles.',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir a la página de confirmación de entrega después de cerrar la alerta
                    window.location.href = 'index.php';
                }
            });
        })
        .catch(error => {
            console.error('Error al enviar el formulario:', error);
            // Mostrar alerta de error si es necesario
        });
    }
}

// Función para eliminar un producto del carrito
function removeFromCart(productName) {
    // Obtener el carrito del sessionStorage
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

    // Filtrar el producto del carrito
    cart = cart.filter(item => item.name !== productName);

    // Mostrar nuevamente el resumen del carrito con el subtotal actualizado
    displayCart(cart);
}

// Función para validar el formulario antes de enviar
function validateForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();

    if (name === '' || email === '' || phone === '') {
        alert('Por favor completa todos los campos de entrega.');
        return false;
    }

    return true;
}

// Función para calcular el cargo adicional basado en el subtotal y el porcentaje
function calculateExtraCharge(subtotal) {
    const deliveryChargeRate = 0.16; // Cargo adicional del 16%
    return subtotal * deliveryChargeRate;
}

// Función para actualizar la visualización del cargo adicional
function updateExtraChargeDisplay() {
    const deliveryOption = document.getElementById('delivery-option');
    const extraChargeContainer = document.getElementById('extra-charge-container');
    const extraChargeAmount = document.getElementById('extra-charge-amount');

    if (deliveryOption && deliveryOption.value === 'domicilio') {
        const subtotal = parseFloat(sessionStorage.getItem('subtotal')) || 0;
        const extraCharge = calculateExtraCharge(subtotal);
        extraChargeAmount.textContent = `$${extraCharge.toFixed(2)}`;
        extraChargeContainer.style.display = 'block';
    } else {
        extraChargeAmount.textContent = `$0.00`;
        extraChargeContainer.style.display = 'none';
    }
}

// Escuchar cambios en la opción de entrega para actualizar el total
document.addEventListener('DOMContentLoaded', function() {
    const deliveryOption = document.getElementById('delivery-option');
    if (deliveryOption) {
        deliveryOption.addEventListener('change', function() {
            // Recalcular y mostrar el carrito con la opción de entrega actualizada
            const storedCart = sessionStorage.getItem('cart');
            if (storedCart) {
                const cart = JSON.parse(storedCart);
                displayCart(cart);
            }
        });
    }

    // Mostrar el resumen del carrito al cargar la página
    loadCartFromSessionStorage();

    // Asociar el evento click al botón de confirmar entrega
    document.getElementById('confirm-delivery-button').addEventListener('click', confirmDelivery);
});

// Función para volver a la página anterior
function goBack() {
    window.location.href = 'entrega.php';
}