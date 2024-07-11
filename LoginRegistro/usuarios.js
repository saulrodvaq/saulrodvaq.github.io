document.addEventListener('DOMContentLoaded', function() {
    const usersList = document.getElementById('usersList');

    // Cargar usuarios desde el almacenamiento local al cargar la página
    loadUsers();

    function loadUsers() {
        let users = JSON.parse(localStorage.getItem('users')) || [];
        renderUsers(users);
    }

    function renderUsers(users) {
        if (users.length === 0) {
            usersList.innerHTML = '<p>No hay usuarios registrados.</p>';
            return;
        }

        let tableHtml = `
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
        `;

        users.forEach(user => {
            tableHtml += `
                <tr>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <button class="btn btn-danger btn-sm delete-button" data-email="${user.email}">Eliminar</button>
                    </td>
                </tr>
            `;
        });

        tableHtml += `
                </tbody>
            </table>
        `;

        usersList.innerHTML = tableHtml;

        // Agregar eventos a los botones de eliminar
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userEmail = this.getAttribute('data-email');
                deleteUser(userEmail);
            });
        });
    }

    function deleteUser(email) {
        let users = JSON.parse(localStorage.getItem('users')) || [];
        users = users.filter(user => user.email !== email);
        localStorage.setItem('users', JSON.stringify(users));
        Swal.fire({
            icon: 'success',
            title: 'Usuario eliminado',
            text: 'El usuario ha sido eliminado correctamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Recargar la lista de usuarios después de eliminar uno
            loadUsers();
        });
    }
});