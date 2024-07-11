document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const messageContainer = document.getElementById('message');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        event.stopPropagation();

        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const password = document.getElementById('password');

        let isValid = true;

        // Validación del nombre
        if (name.value.trim().split(' ').length < 1) {
            name.classList.add('is-invalid');
            isValid = false;
        } else {
            name.classList.remove('is-invalid');
            name.classList.add('is-valid');
        }

        // Validación del correo electrónico
        if (!validateEmail(email.value.trim())) {
            email.classList.add('is-invalid');
            isValid = false;
        } else {
            email.classList.remove('is-invalid');
            email.classList.add('is-valid');
        }

        // Validación de la contraseña
        if (password.value.length < 8 || !/[A-Z]/.test(password.value) || !/[a-z]/.test(password.value) || !/\d/.test(password.value)) {
            password.classList.add('is-invalid');
            isValid = false;
        } else {
            password.classList.remove('is-invalid');
            password.classList.add('is-valid');
        }

        if (isValid) {
            // Simulación de almacenamiento en un array en el DOM
            const userData = {
                name: name.value.trim(),
                email: email.value.trim(),
                password: password.value
            };
            saveUserData(userData);

            // Mostrar mensaje de registro exitoso con SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'Registro exitoso',
                text: '¡Tu registro ha sido exitoso!',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.html'; // Redirigir al login
                }
            });
        }
    });

    function validateEmail(email) {
        const re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function saveUserData(userData) {
        // Aquí puedes simular el almacenamiento en un array en el DOM
        let users = JSON.parse(localStorage.getItem('users')) || [];
        users.push(userData);
        localStorage.setItem('users', JSON.stringify(users));
    }
});