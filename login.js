document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    var passwordRegex =
      /^(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\/\-])(?=.*[A-Z])(?=.*\d.*\d).{8,}$/;

    var isValidEmail = emailRegex.test(email);
    var isValidPassword = passwordRegex.test(password);

    if (isValidEmail && isValidPassword) {
      alert("Login exitoso");
      location.reload();

      return;
    } else {
      var errorMessage = "";
      console.log("Email: " + email, "Password: " + password);
      if (!isValidEmail) {
        errorMessage += "El formato del correo electrónico no es válido. ";
      }

      if (!isValidPassword) {
        errorMessage += "La contraseña no cumple con los requisitos mínimos.";
      }

      alert("Credenciales incorrectas. Inténtelo de nuevo.\n" + errorMessage);
    }
  });
