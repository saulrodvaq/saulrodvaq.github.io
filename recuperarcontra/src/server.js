const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const bcrypt = require('bcryptjs');
const cors = require('cors');
const nodemailer = require('nodemailer');
const crypto = require('crypto');

const app = express();
const port = 3001;

app.use(bodyParser.json());
app.use(cors());

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'login_db'
});

db.connect(err => {
  if (err) {
    console.error('Error de conexión a la base de datos:', err);
    return;
  }
  console.log('Conectado a la base de datos MySQL.');
});

// Ruta de ejemplo para generar y mostrar el token
app.get('/generate-token', (req, res) => {
  const token = crypto.randomBytes(20).toString('hex');
  console.log(`Token generado: ${token}`); // Se mostrará en la consola del servidor
  res.send(`Token generado: ${token}`);
});

app.post('/register', (req, res) => {
  const { username, email, password } = req.body;
  const hashedPassword = bcrypt.hashSync(password, 10);

  const query = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?)';
  db.query(query, [username, email, hashedPassword], (err, result) => {
    if (err) {
      if (err.code === 'ER_DUP_ENTRY') {
        return res.status(400).json({ message: 'El usuario o correo electrónico ya existe' });
      }
      return res.status(500).json({ message: 'Error en el servidor al registrar usuario' });
    }
    res.status(201).json({ message: 'Usuario registrado exitosamente' });
  });
});

app.post('/login', (req, res) => {
  const { email, password } = req.body;

  const query = 'SELECT * FROM users WHERE email = ?';
  db.query(query, [email], (err, results) => {
    if (err) {
      console.error('Error al ejecutar la consulta:', err);
      return res.status(500).json({ message: 'Error en el servidor al iniciar sesión' });
    }
    if (results.length > 0) {
      const user = results[0];
      const passwordIsValid = bcrypt.compareSync(password, user.password);

      if (passwordIsValid) {
        res.json({ message: 'Login exitoso' });
      } else {
        res.status(401).json({ message: 'Contraseña incorrecta' });
      }
    } else {
      res.status(404).json({ message: 'Usuario no encontrado' });
    }
  });
});

const transporter = nodemailer.createTransport({
  service: 'gmail',
  auth: {
    user: 'pirataxd1004@gmail.com',
    pass: 'lhvoeeqexayatyqb'
  }
});

app.post('/recover', (req, res) => {
  const { email } = req.body;
  const token = crypto.randomBytes(20).toString('hex');

  const query = 'UPDATE users SET resetPasswordToken = ?, resetPasswordExpires = ? WHERE email = ?';
  db.query(query, [token, Date.now() + 3600000, email], (err, result) => {
    if (err) {
      console.error('Error al ejecutar la consulta:', err);
      return res.status(500).json({ message: 'Error en el servidor' });
    }

    if (result.affectedRows === 0) {
      return res.status(404).json({ message: 'Correo no encontrado' });
    }

    const mailOptions = {
      from: 'pirataxd1004@gmail.com',
      to: email,
      subject: 'Enlace para restablecer tu contraseña',
      text: `Recibiste este correo porque solicitaste restablecer la contraseña de tu cuenta.\n\n
             Por favor, haz clic en el siguiente enlace o pégalo en tu navegador para completar el proceso:\n\n
             http://localhost:3000/reset/${token}\n\n
             Si no solicitaste esta acción, por favor ignora este correo y tu contraseña permanecerá sin cambios.\n`
    };

    transporter.sendMail(mailOptions, (error, response) => {
      if (error) {
        console.error('Error al enviar el correo:', error);
        return res.status(500).json({ message: 'Error al enviar el correo' });
      }

      res.status(200).json({ message: 'Correo enviado' });
    });
  });
});

app.post('/reset/:token', (req, res) => {
  const { password } = req.body;
  const hashedPassword = bcrypt.hashSync(password, 10);
  const token = req.params.token;

  const query = 'SELECT * FROM users WHERE resetPasswordToken = ? AND resetPasswordExpires > ?';
  db.query(query, [token, Date.now()], (err, results) => {
    if (err) {
      console.error('Error al ejecutar la consulta:', err);
      return res.status(500).json({ message: 'Error en el servidor' });
    }

    if (results.length === 0) {
      return res.status(400).json({ message: 'Token inválido o expirado' });
    }

    const user = results[0];

    const updateQuery = 'UPDATE users SET password = ?, resetPasswordToken = NULL, resetPasswordExpires = NULL WHERE id = ?';
    db.query(updateQuery, [hashedPassword, user.id], (err, result) => {
      if (err) {
        console.error('Error al ejecutar la consulta:', err);
        return res.status(500).json({ message: 'Error en el servidor' });
      }

      res.status(200).json({ message: 'Contraseña cambiada exitosamente' });
    });
  });
});

app.listen(port, () => {
  console.log(`Servidor escuchando en http://localhost:${port}`);
});