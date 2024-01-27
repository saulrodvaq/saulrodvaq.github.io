document.getElementById('loginForm').addEventListener('submit', function (event) {
  event.preventDefault(); 

  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;

  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  var passwordRegex = /^(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\/\-])(?=.*[A-Z])(?=.*\d.*\d).{8,}$/;

  var isValidEmail = emailRegex.test(email);
  var isValidPassword = passwordRegex.test(password);

  if (isValidEmail && isValidPassword) {
    alert('Login exitoso');
    console.log("Email: " + email, "Password: " + password);
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