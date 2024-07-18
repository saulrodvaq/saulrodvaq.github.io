import React, { useState } from "react";
import Swal from "sweetalert2";
import { Toast, ToastContainer } from "react-bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "../styles/styles.css";
import Navigation from './Navigation';
import axios from 'axios';

function ReCon() {
  const [email, setEmail] = useState("");
  const [emailValid, setEmailValid] = useState(null);
  const [showErrorToast, setShowErrorToast] = useState(false);

  const handleSubmit = async (event) => {
    event.preventDefault();

    const isValidEmail = /\S+@\S+\.\S+/.test(email);
    setEmailValid(isValidEmail);

    if (isValidEmail) {
      try {
        await axios.post("http://localhost:3001/recover", { email });

        Swal.fire({
          icon: "success",
          title: "Correo enviado",
          text: "Revisa tu correo para cambiar tu contraseña",
          confirmButtonText: "Aceptar",
        });
      } catch (error) {
        setShowErrorToast(true);
      }
    }
  };

  return (
    <div>
      <Navigation />
      <ToastContainer position="top-end" className="p-3">
        <Toast onClose={() => setShowErrorToast(false)} show={showErrorToast} delay={3000} autohide>
          <Toast.Header>
            <strong className="me-auto">Error al enviar el correo</strong>
          </Toast.Header>
          <Toast.Body>No se pudo enviar el correo</Toast.Body>
        </Toast>
      </ToastContainer>
      <div className="container w-75 bg-primary mt-5 rounded shadow">
        <div className="row align-items-center align-items-stretch">
          <div className="col d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded bg"></div>
          <div className="col bg-white p-5 col-lg-7 col-xl-6 rounded-end">
            <h2 className="fw-bold text-center pt-5 mb-5">Recuperar contraseña</h2>
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
              <div className="d-grid">
                <button type="submit" className="btn btn-primary">
                  Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}

export default ReCon;