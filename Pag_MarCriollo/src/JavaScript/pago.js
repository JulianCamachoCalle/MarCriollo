document.addEventListener('DOMContentLoaded', function() {
    // Cargar carrito desde sessionStorage al cargar la página
    loadCartFromSessionStorage();

    // Configurar el evento para el botón "Confirmar Pago"
    const confirmPaymentButton = document.getElementById('confirm-payment-button');
    confirmPaymentButton.addEventListener('click', function() {
        confirmPayment();
    });
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

        cartItem.appendChild(itemName);
        cartItem.appendChild(itemSubtotal);

        cartItems.appendChild(cartItem);
    });

    // Calcular y mostrar el total del carrito
    const total = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
    const discount = calculateDiscount(cart); // Calcular el descuento

    // Mostrar el total con el descuento aplicado
    document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;
    document.getElementById('discount').textContent = `$${discount.toFixed(2)}`;

    // Guardar total y descuento en sessionStorage
    sessionStorage.setItem('cartTotal', total.toFixed(2));
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

// Función para confirmar el pago y generar la factura en PDF
function confirmPayment() {
    // Obtener los detalles de entrega desde localStorage
    const deliveryDetails = JSON.parse(localStorage.getItem('deliveryDetails'));

    if (!deliveryDetails) {
        alert('Primero completa los detalles de entrega.');
        return;
    }

    // Generar factura en PDF
    generateReceiptPDF('factura');
}

// Función para generar boleta o factura en PDF
function generateReceiptPDF(receiptType) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Obtener los datos del carrito y el total desde sessionStorage
    const storedCart = sessionStorage.getItem('cart');
    const cartTotal = sessionStorage.getItem('cartTotal');
    const discount = sessionStorage.getItem('discount');
    const cart = JSON.parse(storedCart);

    // Obtener los detalles de entrega desde localStorage
    const deliveryDetails = JSON.parse(localStorage.getItem('deliveryDetails'));
    const { name, address, phone, date, time } = deliveryDetails;

    // Configurar el título del documento y otros detalles
    const title = receiptType === 'boleta' ? 'Boleta de Venta' : 'Factura';
    const today = new Date();
    const formattedDate = today.toLocaleDateString('es-ES', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    // Configurar el contenido del PDF
    let yOffset = 20;
    doc.setFontSize(18);
    doc.text(title, 105, 10, null, null, 'center');

    // Información del cliente
    doc.setFontSize(12);
    doc.text(`Fecha: ${formattedDate}`, 10, yOffset);
    doc.text(`Nombre del Titular: ${name}`, 10, yOffset + 10);
    // Aquí puedes agregar más detalles según sea necesario

    // Información de entrega
    doc.text(`Dirección de Entrega: ${address}`, 10, yOffset + 30);
    doc.text(`Teléfono de Contacto: ${phone}`, 10, yOffset + 40);
    doc.text(`Fecha de Entrega: ${date}`, 10, yOffset + 50);
    doc.text(`Hora de Entrega: ${time}`, 10, yOffset + 60);

    // Detalles de la compra
    yOffset += 80; // Ajuste para separar los detalles del encabezado
    doc.setFontSize(14);
    cart.forEach(item => {
        doc.text(`${item.name} x ${item.quantity}`, 10, yOffset);
        doc.text(`Precio unitario: $${item.price.toFixed(2)}`, 80, yOffset);
        doc.text(`Subtotal: $${(item.price * item.quantity).toFixed(2)}`, 150, yOffset);
        yOffset += 10;
    });

    // Descuento y total
    doc.setFontSize(12);
    doc.text(`Descuento: $${discount}`, 150, yOffset);
    yOffset += 10;
    doc.text(`Total: $${cartTotal}`, 150, yOffset);

    // Descargar el PDF
    doc.save(`${title}.pdf`);
}
