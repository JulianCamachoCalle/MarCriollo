document.addEventListener('DOMContentLoaded', function() {
    // Cargar el carrito desde sessionStorage al cargar la página
    loadCartFromSessionStorage();

    // Configurar el evento para el botón "Pagar"
    const payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        // Verificar si hay productos en el carrito
        if (cart.length === 0) {
            alert('Agrega al menos un producto al carrito antes de proceder al pago.');
            return;
        }

        // Redirigir a la página de entrega.html al hacer clic en Pagar
        window.location.href = 'entrega.php';
    });

    // Configurar el evento para el botón "Seguir Comprando"
    const continueShoppingButton = document.getElementById('continue-shopping');
    continueShoppingButton.addEventListener('click', function() {
        // Redirigir al usuario a donde desees que continúe comprando
        // Aquí puedes colocar la URL de la página de catálogo o la página anterior
        window.location.href = 'carrito.php'; // Cambia 'catalogo.html' por la URL correcta
    });

    // Verificar si el carrito está vacío inicialmente para deshabilitar el botón de Pagar
    updatePayButtonState();
});

// Variable global para almacenar el carrito
let cart = [];

// Función para cargar el carrito desde sessionStorage
function loadCartFromSessionStorage() {
    const storedCart = sessionStorage.getItem('cart');
    if (storedCart) {
        cart = JSON.parse(storedCart);
        displayCart();
    }
}

// Función para añadir un producto al carrito
function addToCart(productName, price) {
    let found = cart.find(item => item.name === productName);
    
    if (found) {
        found.quantity++;
    } else {
        cart.push({ name: productName, price: price, quantity: 1 });
    }
    
    // Aplicar descuento según la cantidad de productos distintos
    applyDiscount();

    // Actualizar el resumen del carrito y sessionStorage
    displayCart();

    // Actualizar estado del botón de Pagar
    updatePayButtonState();
}

// Función para mostrar el resumen del carrito
function displayCart() {
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

    // Calcular subtotal del carrito
    const subtotal = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
    const subtotalElement = document.getElementById('cart-subtotal');
    subtotalElement.textContent = `$${subtotal.toFixed(2)}`;

    // Calcular descuento aplicado
    const discount = calculateDiscount(subtotal);
    const discountElement = document.getElementById('cart-discount');
    discountElement.textContent = `-$${discount.toFixed(2)}`;

    // Calcular total del carrito con descuento
    const total = subtotal - discount;
    const totalElement = document.getElementById('cart-total');
    totalElement.textContent = `$${total.toFixed(2)}`;

    // Guardar carrito y total en sessionStorage
    sessionStorage.setItem('cart', JSON.stringify(cart));
    sessionStorage.setItem('cartTotal', total.toFixed(2));
}

// Función para eliminar un producto del carrito
function removeFromCart(productName) {
    // Filtrar el producto del carrito
    cart = cart.filter(item => item.name !== productName);
    
    // Aplicar descuento según la cantidad de productos distintos
    applyDiscount();

    // Actualizar el resumen del carrito y sessionStorage
    displayCart();

    // Actualizar estado del botón de Pagar
    updatePayButtonState();
}

// Función para aplicar el descuento según la cantidad de productos distintos
function applyDiscount() {
    const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
    const distinctProductsCount = cart.length; // Cantidad de productos distintos en el carrito
    
    if (totalItems >= 5) {
        const total = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
        const discount = total * 0.1; // Descuento del 10%
        sessionStorage.setItem('discount', discount.toFixed(2));
    } else if (totalItems >= 2) {
        const discount = Math.min(totalItems * 2, 4); // Descuento máximo de $4
        sessionStorage.setItem('discount', discount.toFixed(2));
    } else {
        removeDiscount(); // No aplica descuento
    }
}

// Función para eliminar el descuento
function removeDiscount() {
    sessionStorage.removeItem('discount');
}

// Función para calcular el descuento actual
function calculateDiscount(subtotal) {
    const discount = parseFloat(sessionStorage.getItem('discount')) || 0;
    return discount;
}

// Función para actualizar el estado del botón de Pagar
function updatePayButtonState() {
    const payButton = document.getElementById('pay-button');
    payButton.disabled = cart.length === 0;
}

// Función para mostrar u ocultar la descripción del producto
function toggleDescription(button) {
    const description = button.parentElement.parentElement.querySelector('.description');
    description.classList.toggle('description-visible');
}