import React, { useState } from "react";
import Swal from "sweetalert2";
import { Toast, ToastContainer } from "react-bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "../styles/styles.css";
import axios from 'axios';
import Navigation from './Navigation';
import { useParams } from "react-router-dom";

function ResetPassword() {
  const [password, setPassword] = useState("");
  const [passwordValid, setPasswordValid] = useState(null);
  const [showErrorToast, setShowErrorToast] = useState(false);
  const { token } = useParams();

  const handleSubmit = async (event) => {
    event.preventDefault();

    const isValidPassword = password.length >= 8;
    setPasswordValid(isValidPassword);

    if (isValidPassword) {
      try {
        await axios.post(`http://localhost:3001/reset/${token}`, { password });

        Swal.fire({
          icon: "success",
          title: "Contraseña cambiada",
          text: "Tu contraseña ha sido cambiada exitosamente",
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
            <strong className="me-auto">Error al cambiar la contraseña</strong>
          </Toast.Header>
          <Toast.Body>No se pudo cambiar la contraseña</Toast.Body>
        </Toast>
      </ToastContainer>
      <div className="container w-75 bg-primary mt-5 rounded shadow">
        <div className="row align-items-center align-items-stretch">
          <div className="col d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded bg"></div>
          <div className="col bg-white p-5 col-lg-7 col-xl-6 rounded-end">
            <h2 className="fw-bold text-center pt-5 mb-5">Cambiar contraseña</h2>
            <form onSubmit={handleSubmit} noValidate>
              <div className="mb-4">
                <label htmlFor="password" className="form-label">Nueva contraseña</label>
                <input
                  type="password"
                  className={`form-control ${passwordValid === null ? '' : passwordValid ? 'is-valid' : 'is-invalid'}`}
                  name="password"
                  id="password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required
                />
                <div className="invalid-feedback">
                  La contraseña debe tener al menos 8 caracteres.
                </div>
                <div className="valid-feedback">
                  Contraseña válida.
                </div>
              </div>
              <div className="d-grid">
                <button type="submit" className="btn btn-primary">
                  Cambiar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}

export default ResetPassword;