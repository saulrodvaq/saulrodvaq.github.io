document.getElementById('loginForm').addEventListener('submit', function (event) {
  event.preventDefault(); 

  var username = document.getElementById('email').value;
  var password = document.getElementById('password').value;

  if (username === 'admin@gmail.com' && password === '123') {
    alert('Login exitoso');
    window.location.href = 'index.html';
  } else {
    alert('Credenciales incorrectas. Inténtelo de nuevo.');
  }
});