import React from 'react';
import Swal from 'sweetalert2';
import { useNavigate } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'sweetalert2/dist/sweetalert2.min.css';

function Inicio() {
    const navigate = useNavigate();

    const handleLogout = (event) => {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Sesión cerrada',
            text: 'Has cerrado sesión exitosamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Redirigir al login o a la página de inicio de sesión usando navigate
            navigate('/login'); // Ajusta la ruta según tu configuración
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
                            <a className="nav-link" href="/">Inicio</a> {/* Ajusta según tu ruta */}
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="/Usuarios">Usuarios</a> {/* Ajusta según tu ruta */}
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="#">Otra página más</a>
                        </li>
                        <li className="nav-item">
                            <a id="logoutButton" className="nav-link" href="#" onClick={handleLogout}>Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div className="container w-75 bg-primary mt-5 rounded shadow">
                <div className="row align-items-center align-items-stretch">
                    <div className="col d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded bg"></div>
                    <div className="col bg-white p-5 col-lg-7 col-xl-6 rounded-end">
                        <h2 className="fw-bold text-center pt-5 mb-5">Bienvenido a tu página principal</h2>
                        <p className="text-center">Aquí puedes mostrar contenido exclusivo para usuarios logueados.</p>
                    </div>
                </div>
            </div>
        </>
    );
}

export default Inicio;