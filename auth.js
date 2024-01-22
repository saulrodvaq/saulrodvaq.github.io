document.getElementById('loginForm').addEventListener('submit', function (event) {
  event.preventDefault(); 

  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;

  if (username === 'admin' && password === '123') {
    alert('Login exitoso');
    window.location.href = 'dashboard.html';
  } else {
    alert('Credenciales incorrectas. Inténtelo de nuevo.');
  }
});