document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const toastEl = document.getElementById('loginToast');
    const toast = new bootstrap.Toast(toastEl, { delay: 3000 });

    // Función para alternar la visibilidad de la contraseña
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Cambiar el ícono del ojo según el tipo de campo de contraseña
        togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
        togglePassword.querySelector('i').classList.toggle('fa-eye');
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        event.stopPropagation();

        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();

        let isValid = true;

        // Validación del correo electrónico
        if (!validateEmail(email)) {
            emailInput.classList.remove('is-valid');
            emailInput.classList.add('is-invalid');
            isValid = false;
        } else {
            emailInput.classList.remove('is-invalid');
            emailInput.classList.add('is-valid');
        }

        // Validación de la contraseña
        if (password.length < 8 || !/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/\d/.test(password)) {
            passwordInput.classList.remove('is-valid');
            passwordInput.classList.add('is-invalid');
            isValid = false;
        } else {
            passwordInput.classList.remove('is-invalid');
            passwordInput.classList.add('is-valid');
        }

        if (isValid) {
            const users = JSON.parse(localStorage.getItem('users')) || [];
            const user = users.find(u => u.email === email && u.password === password);

            if (user) {
                // Mostrar mensaje de inicio de sesión exitoso con SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Inicio de sesión exitoso',
                    text: '¡Bienvenido!',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.html'; // Redirigir al index.html después del inicio de sesión
                    }
                });
            } else {
                // Mostrar mensaje de error con Toast de Bootstrap
                toast.show();

                // Ocultar mensajes de error pero mantener valores introducidos
                emailInput.classList.remove('is-invalid');
                emailInput.classList.remove('is-valid');
                passwordInput.classList.remove('is-invalid');
                passwordInput.classList.remove('is-valid');
            }
        }
    });
});

function validateEmail(email) {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
}