import React, { useState } from "react";
import Swal from "sweetalert2";
import { Toast, ToastContainer } from "react-bootstrap";
import { useNavigate } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import "../styles/styles.css";
import Navigation from './Navigation'; // Importa el componente Navigation
import "@fortawesome/fontawesome-free/css/all.min.css";
import axios from 'axios';

function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [showPassword, setShowPassword] = useState(false);
  const [emailValid, setEmailValid] = useState(null);
  const [passwordValid, setPasswordValid] = useState(null);
  const [showErrorToast, setShowErrorToast] = useState(false);
  const navigate = useNavigate();

  const handleTogglePassword = () => {
    setShowPassword(!showPassword);
  };
  const handleSubmit = async (event) => {
    event.preventDefault();
  
    // Validación del correo electrónico
    const isValidEmail = /\S+@\S+\.\S+/.test(email);
    setEmailValid(isValidEmail);
  
    // Validación de la contraseña
    const isValidPassword =
      password.length >= 8 &&
      /[A-Z]/.test(password) &&
      /[a-z]/.test(password) &&
      /\d/.test(password);
    setPasswordValid(isValidPassword);
  
    if (isValidEmail && isValidPassword) {
      try {
        // Intento de inicio de sesión con el servidor Express
        const response = await axios.post("http://localhost:3001/login", {
          email,
          password,
        });
  
        // Mostrar mensaje de inicio de sesión exitoso con SweetAlert2
        Swal.fire({
          icon: "success",
          title: "Inicio de sesión exitoso",
          text: "¡Bienvenido!",
          confirmButtonText: "Aceptar",
        }).then((result) => {
          if (result.isConfirmed) {
            navigate('/inicio'); // Redirigir a la ruta correcta dentro de la carpeta components
          }
        });
      } catch (error) {
        // Mostrar toast de error
        setShowErrorToast(true);
      }
    }
  };
  
  return (
    <div>
      <Navigation /> {/* Incluye el componente Navigation */}

      {/* Toast de error */}
      <ToastContainer position="top-end" className="p-3">
        <Toast onClose={() => setShowErrorToast(false)} show={showErrorToast} delay={3000} autohide>
          <Toast.Header>
            <strong className="me-auto">Error de inicio de sesión</strong>
          </Toast.Header>
          <Toast.Body>Correo electrónico o contraseña incorrectos</Toast.Body>
        </Toast>
      </ToastContainer>

      {/* Contenido del formulario de inicio de sesión */}
      <div className="container w-75 bg-primary mt-5 rounded shadow">
        <div className="row align-items-center align-items-stretch">
          <div className="col d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded bg"></div>
          <div className="col bg-white p-5 col-lg-7 col-xl-6 rounded-end">
            <h2 className="fw-bold text-center pt-5 mb-5">Iniciar sesión</h2>
            <form onSubmit={handleSubmit} noValidate>
              <div className="mb-4">
                <label htmlFor="email" className="form-label">Correo electrónico</label>
                <input
                  type="email"
                  className={`form-control ${emailValid === null ? '' : emailValid ? 'is-valid' : 'is-invalid'}`}
                  name="email"
                  id="email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  required
                />
                <div className="invalid-feedback">
                  Por favor, introduce un correo electrónico válido.
                </div>
                <div className="valid-feedback">
                  Correo electrónico válido.
                </div>
              </div>
              <div className="mb-4">
                <label htmlFor="password" className="form-label">Contraseña</label>
                <div className="input-group">
                  <input
                    type={showPassword ? "text" : "password"}
                    className={`form-control ${passwordValid === null ? '' : passwordValid ? 'is-valid' : 'is-invalid'}`}
                    name="password"
                    id="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                  />
                  <button
                    type="button"
                    className="btn btn-outline-secondary"
                    onClick={handleTogglePassword}
                  >
                    <i className={showPassword ? "fas fa-eye-slash" : "fas fa-eye"}></i>
                  </button>
                  <div className="invalid-feedback">
                    La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.
                  </div>
                  <div className="valid-feedback">
                    Contraseña válida.
                  </div>
                </div>
              </div>
              <div className="d-grid">
                <button type="submit" className="btn btn-primary">
                  Iniciar sesión
                </button>
              </div>
              <div className="my-3">
                <span>
                  No tienes una cuenta? <a href="register">Regístrate</a>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Login;