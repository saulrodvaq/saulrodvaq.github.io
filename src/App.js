import React from 'react';
import { BrowserRouter as Router, Route, Routes, useLocation } from 'react-router-dom';
import Navigation from './components/Navigation';
import Login from './components/Login';
import Inicio from './components/Inicio';
import Usuarios from './components/Usuarios';
import Register from './components/Register';
import ReCon from './components/ReCon';
import ResetPassword from './components/ResetPassword'; // Nuevo componente importado
import './styles/styles.css';

function App() {
  return (
    <Router>
      <div className="App">
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
          <Route path="/inicio" element={<Inicio />} />
          <Route path="/usuarios" element={<Usuarios />} />
          <Route path="/recon" element={<ReCon />} />
          <Route path="/reset/:token" element={<ResetPassword />} /> {/* Nueva ruta añadida */}
        </Routes>
      </div>
    </Router>
  );
}

export default App;