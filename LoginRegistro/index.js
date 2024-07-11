document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.getElementById('logoutButton');

    logoutButton.addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Sesión cerrada',
            text: 'Has cerrado sesión exitosamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Redirigir al login.html o cualquier otra página de inicio de sesión
            window.location.href = 'login.html';
        });
    });
});