document.getElementById('loginForm').addEventListener('submit', function (event) {
  event.preventDefault(); 

  var username = document.getElementById('email').value;
  var password = document.getElementById('password').value;

  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  var passwordRegex = /^(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\/\-])(?=.*[A-Z])(?=.*\d.*\d).{8,}$/;

  var isValidEmail = emailRegex.test(username);
  var isValidPassword = passwordRegex.test(password);

  if (isValidEmail && isValidPassword) {
    alert('Login exitoso');
    console.log("Username: " + username, "Password: " + password);
    window.location.href = 'index.html';
  } else {
    var errorMessage = '';

    if (!isValidEmail) {
      errorMessage += 'El formato del correo electrónico no es válido. ';
    }

    if (!isValidPassword) {
      errorMessage += 'La contraseña no cumple con los requisitos mínimos.';
    }

    alert('Credenciales incorrectas. Inténtelo de nuevo.\n' + errorMessage);
  }
});