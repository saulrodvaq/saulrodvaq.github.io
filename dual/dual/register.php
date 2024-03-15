<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dual | Iniciar Sesión</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/utsc_dual_logo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style_login.scss" rel="stylesheet">

</head>

<body>
    <style>
  .fa,.fab,.fal,.far,.fas {
    line-height: 1 !important;
}
    body {
        background-color: #F7F7F7;
        margin: 0;
        padding: 0;
        overflow-x: hidden !important;
        /* Cortar las formas que se salgan de su contenedor */
    }

    .shape {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #a2ee39;
        /* Color de fondo de las formas */
        z-index: -1;
        animation: bounce 1s infinite;
        /* Aplica la animación de rebote */
    }

    .shape1 {
        width: 700px;
        /* Ancho de la forma 1 */
        height: 700px;
        /* Alto de la forma 1 */
        top: -10%;
        /* Posición superior de la forma 1 */
        left: -10%;
        /* Posición izquierda de la forma 1 */
        border-radius: 50%;
        /* Forma circular */
    }

    .shape3 {
        width: 800px;
        /* Ancho de la forma 3 */
        height: 800px;
        /* Alto de la forma 3 */
        top: 90%;
        /* Posición superior de la forma 3 */
        left: 70%;
        /* Posición izquierda de la forma 3 */
        border-radius: 50%;
        /* Forma circular */
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes bounce2 {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(10px);
        }
    }

    .shape1 {
        animation: bounce 1s infinite;
    }

    .shape3 {
        animation: bounce2 1s infinite;
    }
    </style>
    <div class="geometric-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape3"></div>
    </div>
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="/dual/index.php" class="logo"><img src="assets/img/log-bar2.png" alt="" class="img-fluid"></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link efectoboton scrollto" href="index.php">Inicio</a></li>
                    <li><a class="nav-link efectoboton" href="index.php#features">Postularse</a></li>
                    <li><a class="nav-link efectoboton" href="login.php">Iniciar sesión</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header>
    <BR>
    <style>
    .form-control {
        border-radius: .375rem .90rem .375rem .90rem;
    }
    </style>
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">

            <style>
            .nav-tabs {
                width: 100%;
                display: flex;
                justify-content: flex-start;
            }

            .nav-tabs .nav-item {
                flex: 1;
                text-align: center;
            }

            .nav-tabs .nav-link {
                width: 100%;
            }

            .espaciadotabs {
                margin-right: 10px;
            }
            </style>

            <div class="tab-content">
                <div class="tab-pane active show" id="tab-1">
                    <div class="container h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-lg-12 col-xl-11">
                                <div class="card text-black"
                                    style="border-radius: 25px; box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);">
                                    <div class="card-body p-md-5">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                                <h2 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrarse</h2>
                                                <form id="register-form" class="mx-1 mx-md-4">
                                                <div class="d-flex flex-row align-items-center mb-4 green-bg">
                                                        <div class="form-outline flex-fill mb-0">
                                                        <label class="form-label" for="form3Example1c"> <i
                                                                    class="fas fa-signature fa-lg me-1 fa-fw"></i>Nombre</label>
                                                            <input type="fullname" name="fullname" id="fullname"
                                                                class="form-control shadow" />
                                                                </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center mb-4 green-bg">
                                                        <div class="form-outline flex-fill mb-0">
                                                            <label class="form-label" for="form3Example1c"> <i
                                                                    class="fas fa-user fa-lg me-1 fa-fw"></i>Email</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control shadow" />
                                                              
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="d-flex flex-row align-items-center mb-4 green-bg">

                                                        <div class="form-outline flex-fill mb-0 position-relative">
                                                            <label class="form-label" for="form3Example3c"><i
                                                                    class="fas fa-lock fa-lg me-1 fa-fw"></i>Contraseña</label>
                                                            <input type="password" name="password" id="password"
                                                                class="form-control shadow" />
                                                            <i class="fas fa-eye position-absolute eye-icon"
                                                                style="right: 10px; bottom: 10px; cursor: pointer;"></i>
                                                        </div>
                                                    </div>
                                                    <script>
                                                    $(document).ready(function() {
                                                        $(".eye-icon").on("click", function() {
                                                            var $passwordInput = $(this).siblings(
                                                                "input");
                                                            var inputType = $passwordInput.attr("type");
                                                            if (inputType === "password") {
                                                                $passwordInput.attr("type", "text");
                                                                $(this).removeClass("fa-eye").addClass(
                                                                    "fa-eye-slash");
                                                            } else {
                                                                $passwordInput.attr("type", "password");
                                                                $(this).removeClass("fa-eye-slash")
                                                                    .addClass("fa-eye");
                                                            }
                                                        });
                                                    });
                                                    </script>

                                                    <br><br>
                                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                        <button type="submit" class="btn efectoboton shadow">Registrarse</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
    <br><br><br><br>
    <?php 
include("templates/footer.php");
?>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
$(document).ready(function() {
    $("#register-form").submit(function(e) {
        e.preventDefault();

        var email = $("#email").val();
        var password = $("#password").val();
        var fullname = $("#fullname").val();

        if (!validateEmail(email) || !validatePassword(password)) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El email o la contraseña son incorrectos. Por favor, inténtelo de nuevo.',
                confirmButtonText: 'OK'
            });
            return;
        }

        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "validar_register.php",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
            Swal.fire({
                icon: 'success',
                title: 'Registro exitoso',
                text: 'Ok, registro exitoso.',
                confirmButtonText: 'OK'
            });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al procesar la solicitud. Por favor, inténtelo de nuevo.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    console.log(email);
    return re.test(email);
}

function validatePassword(password) {
    var re = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>ยง~]).{8,}$/;
    console.log(re.test(password));
    return re.test(password);
}
</script>
</body>

</html>