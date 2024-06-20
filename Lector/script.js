document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const updateCart = (product) => {
        const existingProductIndex = cart.findIndex(item => item.id === product.id);
        if (existingProductIndex !== -1) {
            cart[existingProductIndex].quantity += 1;
        } else {
            cart.push(product);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        Swal.fire({
            icon: 'success',
            title: 'Producto agregado',
            text: 'Su producto se ha agregado exitosamente al carrito de compras.',
            confirmButtonText: 'Aceptar'
        });
    };

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productElement = button.closest('.card');
            const product = {
                id: productElement.getAttribute('data-id'),
                name: productElement.getAttribute('data-title'),
                price: parseFloat(productElement.getAttribute('data-price')),
                image: productElement.getAttribute('data-image'), // Aquí se almacena la URL de la imagen
                quantity: 1
            };

            updateCart(product);
        });
    });

    // Modal functionality
    const modal = new bootstrap.Modal(document.getElementById('modal'));
    const modalImage = document.getElementById("modal-image");
    const modalTitle = document.getElementById("modal-title");
    const modalDescription = document.getElementById("modal-description");
    const modalPrice = document.getElementById("modal-price");
    const modalAddToCartButton = document.getElementById("modal-add-to-cart");

    document.querySelectorAll(".details-button").forEach(button => {
        button.addEventListener("click", function() {
            const productItem = this.closest('.card');
            const title = productItem.querySelector('.card-title').textContent;
            const image = productItem.querySelector('.card-img-top').getAttribute('src');
            const price = productItem.querySelector('.card-text').textContent.replace('Precio: $', '');
            const productId = productItem.getAttribute("data-id");

            modalImage.src = image;
            modalTitle.textContent = title;
            modalDescription.textContent = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
            modalPrice.textContent = `Precio: $${price}`;
            modalAddToCartButton.dataset.id = productId;
            modalAddToCartButton.dataset.name = title;
            modalAddToCartButton.dataset.price = price;
            modalAddToCartButton.dataset.image = image; // Aquí se almacena la URL de la imagen

            modal.show();
        });
    });

    modalAddToCartButton.addEventListener("click", () => {
        const product = {
            id: modalAddToCartButton.dataset.id,
            name: modalAddToCartButton.dataset.name,
            price: parseFloat(modalAddToCartButton.dataset.price),
            image: modalAddToCartButton.dataset.image, // Aquí se almacena la URL de la imagen
            quantity: 1
        };

        updateCart(product);
        modal.hide();
    });

    // Carousel functionality
    const carouselImages = document.querySelectorAll(".carousel img");
    let currentImageIndex = 0;

    document.getElementById("carousel-left").addEventListener("click", () => {
        carouselImages[currentImageIndex].style.display = "none";
        currentImageIndex = (currentImageIndex === 0) ? carouselImages.length - 1 : currentImageIndex - 1;
        carouselImages[currentImageIndex].style.display = "block";
    });

    document.getElementById("carousel-right").addEventListener("click", () => {
        carouselImages[currentImageIndex].style.display = "none";
        currentImageIndex = (currentImageIndex === carouselImages.length - 1) ? 0 : currentImageIndex + 1;
        carouselImages[currentImageIndex].style.display = "block";
    });

    // Scroll-following cat.gif functionality
    const navbarHeight = document.querySelector('.navbar').offsetHeight;

    const catLeftContainer = document.getElementById("cat-left-container");
    const catRightContainer = document.getElementById("cat-right-container");
    let mouseX = 0;
    let mouseY = 0;

    window.addEventListener("mousemove", (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    window.addEventListener("scroll", () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const maxScrollTop = document.documentElement.scrollHeight - window.innerHeight;
        const newTop = Math.min(scrollTop + 100, maxScrollTop);

        const lastDiv = document.querySelector('.container');
        const lastDivRect = lastDiv.getBoundingClientRect();
        const lastDivInView = lastDivRect.bottom <= window.innerHeight;

        if (!lastDivInView) {
            catLeftContainer.style.display = 'block';
            catRightContainer.style.display = 'block';
            catLeftContainer.style.top = `${newTop}px`;
            catRightContainer.style.top = `${newTop}px`;

            const catHeight = catLeftContainer.offsetHeight;
            const windowHeight = window.innerHeight;
            const maxTop = windowHeight - catHeight;

            if (newTop > maxTop) {
                catLeftContainer.style.top = `${maxTop}px`;
                catRightContainer.style.top = `${maxTop}px`;
            }
        } else {
            catLeftContainer.style.display = 'none';
            catRightContainer.style.display = 'none';
        }
    });

    function updateCatPosition() {
        requestAnimationFrame(updateCatPosition);
        const catLeftImage = document.getElementById("cat-left-image");
        const catRightImage = document.getElementById("cat-right-image");

        catLeftImage.style.left = `${mouseX - 50}px`;
        catLeftImage.style.top = `${mouseY - 50}px`;

        catRightImage.style.left = `${mouseX - 50}px`;
        catRightImage.style.top = `${mouseY - 50}px`;
    }

    updateCatPosition();
});

// Gradient scroll effect
document.addEventListener('scroll', function() {
    const scrollTop = window.scrollY;
    const windowHeight = window.innerHeight;
    const documentHeight = document.body.clientHeight;
    
    const scrollFraction = scrollTop / (documentHeight - windowHeight);
    
    if (scrollFraction < 0.33) {
        document.body.className = 'gradient-1';
    } else if (scrollFraction < 0.66) {
        document.body.className = 'gradient-2';
    } else {
        document.body.className = 'gradient-3';
    }
});

// Load more books functionality
document.addEventListener('DOMContentLoaded', () => {
    const productContainer = document.querySelector('.product-list .row');
    const itBook = document.querySelector('[data-title="IT"]');
    let booksLoaded = 3;
    let loadingMoreBooks = false;

    const loadMoreBooksWithDelay = async () => {
        if (loadingMoreBooks) {
            return;
        }

        loadingMoreBooks = true;

        const loader = document.getElementById('loader');
        loader.style.display = 'block';

        await new Promise(resolve => setTimeout(resolve, 3000));

        if (booksLoaded < 10) {
            const newProduct = document.createElement('div');
            newProduct.classList.add('col-md-4', 'mb-3');
            newProduct.innerHTML = `
                <div class="card h-100 text-center" data-id="4" data-title="Bleach volumen 74" data-price="125" data-image="Ichigo.png">
                    <img src="Ichigo.png" class="card-img-top" alt="Ichigo">
                    <div class="card-body">
                        <h3 class="card-title">Bleach volumen 74</h3>
                        <p class="card-text">Precio: $125</p>
                        <button class="btn btn-success add-to-cart">Agregar al carrito</button>
                        <button class="btn btn-info details-button">Ver más a detalle</button>
                    </div>
                </div>
            `;
            productContainer.appendChild(newProduct);
            booksLoaded++;
        }

        loader.style.display = 'none';
        loadingMoreBooks = false;

        window.removeEventListener('scroll', scrollHandler);
    };

    const scrollHandler = () => {
        const itBookPosition = itBook.getBoundingClientRect().top;

        if (itBookPosition < window.innerHeight) {
            loadMoreBooksWithDelay();
        }
    };

    window.addEventListener('scroll', scrollHandler);
});

document.addEventListener('DOMContentLoaded', function() {
    const carousel = new bootstrap.Carousel(document.getElementById('carouselExampleControls'));
    const carouselItems = document.querySelectorAll('.carousel-item');

    function selectImage(index) {
        carousel.to(index);
    }

    function handleKeyPress(event) {
        switch (event.key) {
            case 'a':
                carousel.prev();
                break;
            case 'd':
                carousel.next();
                break;
            default:
                return;
        }
    }

    document.addEventListener('keypress', handleKeyPress);

    carouselItems.forEach(item => item.classList.remove('active'));
    carouselItems[0].classList.add('active');
});

document.addEventListener('keydown', function(event) {
    const modal = document.getElementById('modal');
    const modalAddToCartButton = document.getElementById('modal-add-to-cart');
    const modalCancelButton = document.getElementById('modal-cancel');

    if (event.key === 'Enter') {
        if (modal.classList.contains('show')) {
            modalAddToCartButton.click();
        }
    }

    if (event.key === 'c') {
        if (modal.classList.contains('show')) {
            modalCancelButton.click();
        }
    }

    if (event.key === 'x') {
        if (modal.classList.contains('show')) {
            const closeButton = modal.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click();
            }
        }
    }
});

document.addEventListener('keydown', function(event) {
    if (event.key === ' ' && document.activeElement.tagName !== 'INPUT') {
        event.preventDefault();
        const focusableElements = document.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        let currentFocusIndex = Array.from(focusableElements).findIndex(element => element === document.activeElement);

        if (currentFocusIndex !== -1) {
            const nextFocusIndex = (currentFocusIndex + 1) % focusableElements.length;
            focusableElements[nextFocusIndex].focus();
        }
    }

    if (event.key === 'Enter' && document.activeElement.classList.contains('details-button')) {
        event.preventDefault();
        document.activeElement.click();
    }
});