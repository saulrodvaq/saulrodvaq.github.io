document.addEventListener('DOMContentLoaded', () => {
    const cartItems = document.getElementById('cart-items');
    const totalPrice = document.getElementById('total-price');
    const checkoutButton = document.getElementById('checkout');
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function updateCart() {
        cartItems.innerHTML = '';
        let total = 0;

        cart.forEach(item => {
            const productDiv = document.createElement('div');
            productDiv.classList.add('card', 'mb-3');
            productDiv.innerHTML = `
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="${item.image}" class="custom-image rounded-start" alt="${item.name}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">${item.name}</h5>
                            <p class="card-text">Precio: $${item.price}</p>
                            <p class="card-text">Cantidad: ${item.quantity}</p>
                            <button class="btn btn-danger remove-from-cart" data-id="${item.id}">Eliminar</button>
                            <button class="btn btn-primary modify-quantity" data-id="${item.id}">Modificar cantidad</button>
                        </div>
                    </div>
                </div>
            `;
            cartItems.appendChild(productDiv);

            total += item.price * item.quantity;
        });

        totalPrice.textContent = total.toFixed(2);

        const removeFromCartButtons = document.querySelectorAll('.remove-from-cart');
        removeFromCartButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                Swal.fire({
                    title: '¿Estás seguro de eliminar el producto?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cart = cart.filter(item => item.id !== productId);
                        localStorage.setItem('cart', JSON.stringify(cart));
                        Swal.fire({
                            icon: 'success',
                            title: 'Producto eliminado del carrito de compras exitosamente.',
                            confirmButtonText: 'Aceptar'
                        });
                        updateCart();
                    }
                });
            });
        });

        const modifyQuantityButtons = document.querySelectorAll('.modify-quantity');
        modifyQuantityButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                const product = cart.find(item => item.id === productId);
                Swal.fire({
                    title: 'Modificar cantidad',
                    input: 'number',
                    inputLabel: 'Ingrese la nueva cantidad:',
                    inputValue: product.quantity,
                    showCancelButton: true,
                    confirmButtonText: 'Modificar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const newQuantity = parseInt(result.value, 10);
                        if (newQuantity > 0) {
                            product.quantity = newQuantity;
                            localStorage.setItem('cart', JSON.stringify(cart));
                            Swal.fire({
                                icon: 'success',
                                title: 'Cantidad modificada exitosamente.',
                                confirmButtonText: 'Aceptar'
                            });
                            updateCart();
                        }
                    }
                });
            });
        });
    }

    checkoutButton.addEventListener('click', () => {
        if (cart.length > 0) {
            Swal.fire({
                icon: 'success',
                title: 'Compra realizada',
                text: 'Su compra ha sido realizada con éxito.',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                cart = [];
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCart();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Carrito vacío',
                text: 'No hay productos en el carrito.',
                confirmButtonText: 'Aceptar'
            });
        }
    });

    updateCart();
}); 