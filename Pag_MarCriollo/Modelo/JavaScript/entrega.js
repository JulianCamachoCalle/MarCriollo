document.addEventListener('DOMContentLoaded', function() {
    // Cargar detalles de entrega guardados en localStorage si existen
    const deliveryDetails = JSON.parse(localStorage.getItem('delivery-Details'));
    if (deliveryDetails) {
        document.getElementById('name').value = deliveryDetails.name || '';
        document.getElementById('address').value = deliveryDetails.address || '';
        document.getElementById('date').value = deliveryDetails.date || '';
        document.getElementById('time').value = deliveryDetails.time || '';
        document.getElementById('district').value = deliveryDetails.district || '';
    }

    // Configurar el evento para el botón "Pagar"
    const payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        confirmDelivery();
    });

    // Configurar el evento para el botón "Seguir Comprando"
    const continueButton = document.getElementById('continue-button');
    continueButton.addEventListener('click', function() {
        continueShopping();
    });

    // Cargar carrito desde sessionStorage al cargar la página
    loadCartFromSessionStorage();

    // Mostrar el descuento y el total con el descuento aplicado
    displayDiscountAndTotal();
});

// Función para cargar el carrito desde sessionStorage
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

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Eliminar';
        removeButton.addEventListener('click', () => removeFromCart(item.name));

        cartItem.appendChild(itemName);
        cartItem.appendChild(itemSubtotal);
        cartItem.appendChild(removeButton);

        cartItems.appendChild(cartItem);
    });

    // Calcular y mostrar el total del carrito
    const total = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
    const discount = calculateDiscount(cart); // Calcular el descuento
    const discountedTotal = total - discount;

    // Mostrar el descuento y el total con el descuento aplicado
    document.getElementById('cart-total').textContent = `$${discountedTotal.toFixed(2)}`;
    document.getElementById('discount').textContent = `$${discount.toFixed(2)}`;

    // Guardar carrito y total en sessionStorage
    sessionStorage.setItem('cart', JSON.stringify(cart));
    sessionStorage.setItem('cartTotal', discountedTotal.toFixed(2));
    sessionStorage.setItem('discount', discount.toFixed(2));
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

// Función para mostrar el descuento y el total con el descuento aplicado
function displayDiscountAndTotal() {
    const storedCart = sessionStorage.getItem('cart');
    if (storedCart) {
        const cart = JSON.parse(storedCart);
        const total = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
        const discount = parseFloat(sessionStorage.getItem('discount')) || 0;
        const discountedTotal = total - discount;

        document.getElementById('cart-total').textContent = `$${discountedTotal.toFixed(2)}`;
        document.getElementById('discount').textContent = `$${discount.toFixed(2)}`;
    }
}

// Función para mostrar el resumen del carrito
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
        itemSubtotal.textContent = `$${item.price * item.quantity}`;

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

    // Calcular y mostrar el total del carrito
    const total = subtotal + calculateExtraCharge(); // Incluir el cargo adicional si corresponde
    const discount = calculateDiscount(cart); // Calcular el descuento
    const discountedTotal = total - discount;

    // Mostrar el descuento y el total con el descuento aplicado
    document.getElementById('cart-total').textContent = `$${discountedTotal.toFixed(2)}`;
    document.getElementById('discount').textContent = `$${discount.toFixed(2)}`;
    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;

    // Mostrar el cargo adicional solo si la opción de entrega es 'domicilio'
    const deliveryOption = document.getElementById('delivery-option').value;
    const extraChargeContainer = document.getElementById('extra-charge-container');
    const extraChargeAmount = document.getElementById('extra-charge-amount');

    if (deliveryOption === 'domicilio') {
        const extraCharge = calculateExtraCharge();
        extraChargeContainer.style.display = 'block';
        extraChargeAmount.textContent = `$${extraCharge.toFixed(2)}`;
    } else {
        extraChargeContainer.style.display = 'none';
    }

    // Guardar carrito y total en sessionStorage
    sessionStorage.setItem('cart', JSON.stringify(cart));
    sessionStorage.setItem('cartTotal', discountedTotal.toFixed(2));
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

// Función para mostrar el descuento y el total con el descuento aplicado
function displayDiscountAndTotal() {
    const storedCart = sessionStorage.getItem('cart');
    if (storedCart) {
        const cart = JSON.parse(storedCart);
        const total = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
        const discount = parseFloat(sessionStorage.getItem('discount')) || 0;
        const discountedTotal = total - discount;

        document.getElementById('cart-total').textContent = `$${discountedTotal.toFixed(2)}`;
        document.getElementById('discount').textContent = `$${discount.toFixed(2)}`;
    }
}

// Función para confirmar la entrega
function confirmDelivery() {
    // Validar el formulario de entrega antes de proceder a la confirmación
    if (validateForm()) {
        const name = document.getElementById('name').value.trim();
        const address = document.getElementById('address').value.trim();
        const date = document.getElementById('date').value.trim();
        const time = document.getElementById('time').value.trim();
        const district = document.getElementById('district').value.trim();

        // Guardar detalles de entrega en localStorage si es necesario
        localStorage.setItem('deliveryDetails', JSON.stringify({
            name: name,
            address: address,
            date: date,
            time: time,
            district: district
        }));

        // Redirigir a la página de confirmación de entrega
        window.location.href = 'pago.php'; 
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
    const address = document.getElementById('address').value.trim();
    const date = document.getElementById('date').value.trim();
    const time = document.getElementById('time').value.trim();
    const district = document.getElementById('district').value.trim();

    if (name === '' || address === '' || date === '' || time === '' || district === '') {
        alert('Por favor completa todos los campos de entrega.');
        return false;
    }

    return true;
}

// Función para calcular el cargo adicional basado en la opción de entrega seleccionada
function calculateExtraCharge() {
    const deliveryOption = document.getElementById('delivery-option').value;
    const deliveryChargeRate = 0.16; // Cargo adicional del 14%
    const subtotal = parseFloat(sessionStorage.getItem('subtotal')) || 0;

    if (deliveryOption === 'domicilio') {
        return subtotal * deliveryChargeRate;
    } else {
        return 0;
    }
}

// Escuchar cambios en la opción de entrega para actualizar el total
document.getElementById('delivery-option').addEventListener('change', function() {
    // Recalcular y mostrar el carrito con la opción de entrega actualizada
    const storedCart = sessionStorage.getItem('cart');
    if (storedCart) {
        const cart = JSON.parse(storedCart);
        displayCart(cart);
    }
});