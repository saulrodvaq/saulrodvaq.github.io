import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2';
import { useNavigate } from 'react-router-dom'; // Importa useNavigate
import 'bootstrap/dist/css/bootstrap.min.css';
import 'sweetalert2/dist/sweetalert2.min.css';

function Usuarios() {
    const [users, setUsers] = useState([]);
    const navigate = useNavigate(); // Define navigate

    useEffect(() => {
        loadUsers();
    }, []);

    const loadUsers = () => {
        let usersData = JSON.parse(localStorage.getItem('users')) || [];
        setUsers(usersData);
    };

    const deleteUser = (email) => {
        let updatedUsers = users.filter(user => user.email !== email);
        localStorage.setItem('users', JSON.stringify(updatedUsers));
        setUsers(updatedUsers);
        Swal.fire({
            icon: 'success',
            title: 'Usuario eliminado',
            text: 'El usuario ha sido eliminado correctamente.',
            confirmButtonText: 'Aceptar'
        });
    };

    const handleLogout = (event) => {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Sesión cerrada',
            text: 'Has cerrado sesión exitosamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            navigate('/login'); // Redirige al login después de cerrar sesión
        });
    };

    return (
        <>
            <nav className="navbar navbar-expand-lg navbar-light bg-light" style={{ backgroundColor: '#ffa751' }}>
                <a className="navbar-brand" href="#">EL LECTOR</a>
                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarNav">
                    <ul className="navbar-nav ml-auto">
                        <li className="nav-item">
                            <a className="nav-link" href="/Inicio">Inicio</a> {/* Ajusta según tu ruta */}
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="/usuarios">Usuarios</a> {/* Ajusta según tu ruta */}
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="#">Otra página más</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="#" onClick={handleLogout} id="logoutButton">Cerrar sesión</a> {/* Añade el evento onClick */}
                        </li>
                    </ul>
                </div>
            </nav>

            <div className="container w-75 bg-primary mt-5 rounded shadow">
                <div className="row align-items-center align-items-stretch">
                    <div className="col d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded bg"></div>
                    <div className="col bg-white p-5 col-lg-7 col-xl-6 rounded-end">
                        <h2 className="fw-bold text-center pt-5 mb-5">Usuarios Registrados</h2>
                        <div id="usersList">
                            {users.length === 0 ? (
                                <p>No hay usuarios registrados.</p>
                            ) : (
                                <table className="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Correo electrónico</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {users.map((user, index) => (
                                            <tr key={index}>
                                                <td>{user.name}</td>
                                                <td>{user.email}</td>
                                                <td>
                                                    <button className="btn btn-danger btn-sm delete-button" onClick={() => deleteUser(user.email)}>
                                                        Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

export default Usuarios;