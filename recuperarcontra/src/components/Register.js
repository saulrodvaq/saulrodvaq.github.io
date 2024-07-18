import React, { useState } from "react";
import Swal from "sweetalert2";
import { useNavigate } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import "sweetalert2/dist/sweetalert2.min.css";
import Navigation from "./Navigation"; // Importa el componente Navigation
import axios from "axios";

function Register() {
  const navigate = useNavigate();
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [nameValid, setNameValid] = useState(null);
  const [emailValid, setEmailValid] = useState(null);
  const [passwordValid, setPasswordValid] = useState(null);

  const handleSubmit = async (event) => {
    event.preventDefault();

    let isNameValid = true;
    let isEmailValid = true;
    let isPasswordValid = true;

    // Validación del nombre
    if (name.trim().length < 5 || name.trim().length > 10) {
      isNameValid = false;
    }

    // Validación del correo electrónico
    if (!validateEmail(email.trim())) {
      isEmailValid = false;
    }

    // Validación de la contraseña
    if (
      password.length < 8 ||
      !/[A-Z]/.test(password) ||
      !/[a-z]/.test(password) ||
      !/\d/.test(password)
    ) {
      isPasswordValid = false;
    }

    setNameValid(isNameValid);
    setEmailValid(isEmailValid);
    setPasswordValid(isPasswordValid);

    if (isNameValid && isEmailValid && isPasswordValid) {
      try {
        const response = await axios.post("http://localhost:3001/register", {
          username: name.trim(),
          email: email.trim(),
          password: password,
        });

        Swal.fire({
          icon: "success",
          title: "Registro exitoso",
          text: "¡Tu registro ha sido exitoso!",
          confirmButtonText: "Aceptar",
        }).then((result) => {
          if (result.isConfirmed) {
            navigate("/login");
          }
        });
      } catch (error) {
        Swal.fire({
          icon: "error",
          title: "Error de registro",
          text: error.response.data.message,
          confirmButtonText: "Aceptar",
        });
      }
    }
  };

  function validateEmail(email) {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
  }

  return (
    <div>
      <Navigation /> {/* Incluye el componente Navigation */}
      <div className="container w-75 bg-primary mt-5 rounded shadow">
        <div className="row align-items-center align-items-stretch">
          <div className="col d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded bg"></div>
          <div className="col bg-white p-5 col-lg-7 col-xl-6 rounded-end">
            <h2 className="fw-bold text-center pt-5 mb-5">Registrarse</h2>
            <form id="registerForm" onSubmit={handleSubmit} noValidate>
              <div className="mb-4">
                <label htmlFor="name" className="form-label">
                  Nombre del usuario
                </label>
                <input
                  type="text"
                  className={`form-control ${
                    nameValid === false
                      ? "is-invalid"
                      : nameValid === true
                      ? "is-valid"
                      : ""
                  }`}
                  id="name"
                  name="name"
                  required
                  minLength="5"
                  maxLength="10"
                  value={name}
                  onChange={(e) => setName(e.target.value)}
                />
                {nameValid === false && (
                  <div className="invalid-feedback">
                    Utiliza un nombre de usuario de 5 a 10 caracteres.
                  </div>
                )}
              </div>
              <div className="mb-4">
                <label htmlFor="email" className="form-label">
                  Correo electrónico
                </label>
                <input
                  type="email"
                  className={`form-control ${
                    emailValid === false
                      ? "is-invalid"
                      : emailValid === true
                      ? "is-valid"
                      : ""
                  }`}
                  id="email"
                  name="email"
                  required
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                />
                {emailValid === false && (
                  <div className="invalid-feedback">
                    Por favor, ingresa un correo electrónico válido.
                  </div>
                )}
              </div>
              <div className="mb-4">
                <label htmlFor="password" className="form-label">
                  Contraseña
                </label>
                <input
                  type="password"
                  className={`form-control ${
                    passwordValid === false
                      ? "is-invalid"
                      : passwordValid === true
                      ? "is-valid"
                      : ""
                  }`}
                  id="password"
                  name="password"
                  required
                  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                />
                {passwordValid === false && (
                  <div className="invalid-feedback">
                    Por favor, ingresa una contraseña válida con un mínimo de 8
                    caracteres, mayúscula, minúscula y algún dígito numérico.
                  </div>
                )}
              </div>
              <div className="d-grid">
                <button type="submit" className="btn btn-primary">
                  Registrarse
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Register;
