<?php
session_start(); // Inicia la sesión si no ha sido iniciada antes

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header('Location: login.php');
    exit;
}

if (!esAlumno($_SESSION['usuario'])) {
    echo "No estás autorizado para acceder a esta página.";
    exit;
}

function esAlumno($usuario) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dual_bd";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $query = "SELECT * FROM alumnos WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conn, $query);
    $esAlumno = mysqli_num_rows($resultado) > 0;
    mysqli_close($conn);
    return $esAlumno;
}

include ("templates/conexion.php");

// Luego, obtenemos los datos del usuario actual utilizando su matrícula
$usuario = $_SESSION['usuario']; // Obtén la matrícula del usuario actual de la sesión
$sql = "SELECT *, idAlumno FROM alumnos WHERE usuario = '$usuario'";
$resultado = mysqli_query($conn, $sql);

// Verificamos si la consulta se realizó correctamente
if (!$resultado) {
    die("Error al obtener los datos del usuario: " . mysqli_error($conn));
}

// Obtenemos los datos del usuario y los guardamos en la variable $usuario
$usuario = mysqli_fetch_assoc($resultado);
$_SESSION['idAlumno'] = $usuario['idAlumno'];
// Cerramos la conexión a la base de datos


// Asignamos los valores de las variables para utilizar en el código HTML del primer código
$matricula = $usuario['matricula'];
$nombres = $usuario['nombres'];
$apellidos = $usuario['apellidos'];
$carrera = $usuario['carrera'];
// Obtener el idEmpresa del alumno
$empresa = $usuario['idEmpresa'];

// Consulta para obtener el nombreEmp de la tabla empresas
$query = "SELECT nombreEmp FROM empresas WHERE idEmpresa = $empresa";
$resultado = mysqli_query($conn, $query);

// Verificar si se obtuvo un resultado
if ($fila = mysqli_fetch_assoc($resultado)) {
    $nombreEmpresa = $fila['nombreEmp'];
} else {
    $nombreEmpresa = "Empresa no asignada";
}

// Consulta para obtener el idFormador de la tabla formadores
$query = "SELECT idFormador FROM formadores WHERE idEmpresa = $empresa";
$resultado = mysqli_query($conn, $query);

// Verificar si se obtuvo un resultado
if ($fila = mysqli_fetch_assoc($resultado)) {
    $idFormador = $fila['idFormador'];
} else {
    $idFormador = "Formador no asignado";
}

$idInstructor = $usuario['idInstructor'];

// Consulta para obtener el nombre y apellidos del instructor
$query = "SELECT nombres, apellidos FROM instructores WHERE idInstructor = $idInstructor";
$resultado = mysqli_query($conn, $query);

if ($fila = mysqli_fetch_assoc($resultado)) {
    $nombreInstructor = $fila['nombres'];
    $apellidosInstructor = $fila['apellidos'];
} else {
    $nombreInstructor = "Instructor no asignado";
    $apellidosInstructor = "";
}

$idTutor = $usuario['idTutor'];

// Consulta para obtener el nombre y apellidos del tutor
$query = "SELECT nombres, apellidos FROM tutores WHERE idTutor = $idTutor";
$resultado = mysqli_query($conn, $query);

if ($fila = mysqli_fetch_assoc($resultado)) {
    $nombreTutor = $fila['nombres'];
    $apellidosTutor = $fila['apellidos'];
} else {
    $nombreTutor = "Tutor no asignado";
    $apellidosTutor = "";
}

$f_Entrega = date('d-m-Y');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dual</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/utsc_dual_logo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- SweetAlert2-->
    <!-- Cerrar sesion-Botones o cuadros de texto dentro de la pagina-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

    <!-- jQuery -->
    <!-- Cerrar sesion-Botones o cuadros de texto dentro de la pagina-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/dual/index.php" class="logo"><img src="assets/img/log-bar2.png" alt="" class="img-fluid"></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a id="cerrar" class="scrollto efectoboton" href="templates/cerrar_sesion.php">Cerrar Sesión</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
            <script>
            $(document).ready(function() {
                $('#cerrar').click(function(e) {
                    e.preventDefault(); // Evita el comportamiento predeterminado del enlace
                    var logoutUrl = $(this).attr('href');

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¿Realmente deseas cerrar la sesión?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, cerrar sesión',
                        cancelButtonText: 'No, cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                logoutUrl; // Si el usuario confirma, redirige a la URL de cierre de sesión
                        }
                    })
                });
            });
            </script>
        </div>
    </header>
    <script>
    window.onload = function() {
        var textoBanner = document.getElementById('textoBanner');
        textoBanner.style.animation = `typewriter ${textoBanner.textContent.length / 5}s linear 1s 1 normal both,
    blink 1s steps(${textoBanner.textContent.length}) infinite`;
    }
    </script>
    <section id="cta" class="cta">
        <div class="container"></div>
        <div class="text-center">
            <br>
            <h3 id="textoBanner" style="font-size: 68px"><?php echo 'Bienvenido, ' . $usuario['nombres'];?></h3>
            <h2>Alumno Dual</h2>
            <br>
        </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="container" data-aos="fade-up" style="max-width: 100%">
            <ul class="nav nav-tabs row d-flex">
                <li class="nav-item col-4">
                    <a class="nav-link navo active show" data-bs-toggle="tab" href="#tab-2">
                        <i class="bi bi-clipboard-plus"></i>
                        <h4 class="d-none d-lg-block">Reporte Semanal</h4>
                    </a>
                </li>
                <li class="nav-item col-4">
                    <a class="nav-link navo" data-bs-toggle="tab" href="#tab-3">
                        <i class="bi bi-envelope-check"></i>
                        <h4 class="d-none d-lg-block">Seguimiento</h4>
                    </a>
                </li>
                <li class="nav-item col-4">
                    <a class="nav-link navo" data-bs-toggle="tab" href="#tab-4">
                        <i class="bi bi-person-circle"></i>
                        <h4 class="d-none d-lg-block">Alumno</h4>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="tab-2">
                    <section id="contact" class="contact text-center animate__animated p-3 shadow-lg">
                        <div class="container-fluid">
                            <div class="section-title">
                                <h3>EDUCACIÓN DUAL</h3>
                                <h1 style="font-size: 55px !important; font-weight:800 !important;">REPORTE SEMANAL DE
                                    APRENDIZAJE</h1>
                                <hr>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <form id="enviar_reporte" target="_blank" action="" method="post"
                                                enctype="multipart/form-data">
                                                <input type="hidden" name="tipo_formulario" id="tipo_formulario"
                                                    value="">
                                                <input type="hidden" name="matricula" id="matricula"
                                                    value="<?php echo $usuario['matricula']; ?>">
                                                <input type="hidden" name="nombres" id="nombres"
                                                    value="<?php echo $usuario['nombres']; ?>">
                                                <input type="hidden" name="apellidos" id="apellidos"
                                                    value="<?php echo $usuario['apellidos']; ?>">
                                                <input type="hidden" name="idTutor" id="idTutor"
                                                    value="<?php echo $idTutor; ?>">
                                                <input type="hidden" name="idInstructor" id="idInstructor"
                                                    value="<?php echo $idInstructor; ?>">
                                                <input type="hidden" name="idFormador" id="idFormador"
                                                    value="<?php echo $idFormador; ?>">
                                                <input type="hidden" name="empresa" id="empresa"
                                                    value="<?php echo $nombreEmpresa; ?>">
                                                <input type="hidden" name="cuatrimestre" id="cuatrimestre"
                                                    value="<?php echo $usuario['cuatrimestre']; ?>">
                                                <input type="hidden" name="carrera" id="carrera"
                                                    value="<?php echo $usuario['carrera']; ?>">
                                                <input type="hidden" name="f_Entrega" id="f_Entrega"
                                                    value="<?php echo $f_Entrega; ?>">
                                                <?php
// Obtener la cantidad de reportes del ID del alumno en la tabla de reportes
$idAlumno = $usuario['idAlumno'];
$sql = "SELECT COUNT(*) as cantidad FROM reportes WHERE idAlumno = $idAlumno";
$resultado = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado);
$cantidadReportes = $row['cantidad'];

// Calcular la semana en base a la cantidad de reportes
$semana = $cantidadReportes + 1; // Si cada semana tiene 7 días

// Mostrar el valor de la semana en el input hidden
echo '<input type="hidden" name="semana" id="semana" value="' . $semana . '">';
?>
                                        </div>
                                        <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var currentDate = new Date();
                                            var currentDayOfWeek = currentDate.getDay();

                                            // Establecer f_Inicio al lunes de la semana actual
                                            var fInicio = new Date(currentDate);
                                            var diff = currentDayOfWeek - 1;
                                            fInicio.setDate(fInicio.getDate() - diff);
                                            document.getElementById('f_Inicio').value = fInicio.toISOString()
                                                .split('T')[0];

                                            // Establecer f_Fin al viernes de la semana actual
                                            var fFin = new Date(currentDate);
                                            diff = currentDayOfWeek === 0 ? 4 : 4 - (currentDayOfWeek - 1);
                                            fFin.setDate(fFin.getDate() + diff);
                                            document.getElementById('f_Fin').value = fFin.toISOString().split(
                                                'T')[0];


                                        });
                                        </script>
                                        <style>
                                        .btn-outline-light {
                                            --bs-btn-color: #888 !important;
                                            --bs-btn-border-color: #fff !important;
                                            --bs-btn-hover-color: #333 !important;
                                            --bs-btn-hover-bg: #fff !important;
                                            --bs-btn-hover-border-color: #fff !important;
                                            --bs-btn-focus-shadow-rgb: 248, 249, 250;
                                            --bs-btn-active-color: #000;
                                            --bs-btn-active-bg: #fff !important;
                                            --bs-btn-active-border-color: #ffff !important;
                                            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
                                            --bs-btn-disabled-color: #fff !important;
                                            --bs-btn-disabled-bg: transparent;
                                            --bs-btn-disabled-border-color: #fff !important;
                                            --bs-gradient: none;
                                        }

                                        .card.shadow {
                                            border-width: 4px;
                                            border-color: #70cc06;
                                            border-style: solid;
                                        }
                                        </style>
                                        <div class="row mt-3">
                                            <div class="card shadow">
                                                <div class="card-header text-white"
                                                    style="background-color: #70cc06; border-radius: 0px 0px 20px 20px">
                                                    <h3>Resumen de semana:</h3>
                                                    <label>Describe todas las actividades que realizaste
                                                        diariamente en la empresa en su día respectivo.</label>
                                                </div>
                                                <br>
                                                <div class="d-flex justify-content-between">
                                                    <div class="mb-2 col-md-3 text-center me-3">
                                                        <label for="f_Inicio" class="form-label">Fecha de inicio de la
                                                            semana</label>
                                                        <input type="date" name="f_Inicio" id="f_Inicio" readonly
                                                            class="form-control text-center"
                                                            style="border: none; color:#70cc06; font-weight: 800;"
                                                            required>
                                                    </div>

                                                    <div class="mb-2 col-md-3 text-center">
                                                        <label for="f_Fin" class="form-label">Fecha de fin de la
                                                            semana</label>
                                                        <input type="date" name="f_Fin" id="f_Fin"
                                                            class="form-control text-center"
                                                            style="border: none; color:#70cc06; font-weight: 800;"
                                                            readonly required>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-4 animate__animated animate__fadeIn">
                                                        <h5 style="color: #70cc06;">Lunes</h5>
                                                        <textarea id="ckeditor" class="ckeditor form-control"
                                                            name="resumen_L" rows="5"
                                                            placeholder="Ingresa tu resumen del día lunes."
                                                            required></textarea>
                                                        <div class="mt-2">
                                                            <label for="img_L" class="form-label btn btn-primary">Cargar
                                                                imagen</label>
                                                            <input type="file" name="img_L" id="img_L" accept="image/*"
                                                                style="display:none;">
                                                            <i class="bi bi-card-image"></i>
                                                            <span id="imagen" style="cursor: pointer;">
                                                                Imagen no seleccionada
                                                            </span>

                                                        </div>
                                                        </br>
                                                        <div class="mb-4 animate__animated animate__fadeIn">
                                                            <h5 style="color: #70cc06;">Martes</h5>
                                                            <textarea id="ckeditor" class="ckeditor form-control"
                                                                name="resumen_M" id="resumen_M" rows="5"
                                                                placeholder="Ingresa tu resumen del día martes."
                                                                required></textarea>
                                                            <div class="mt-2">
                                                                <label for="img_M"
                                                                    class="form-label btn btn-primary">Cargar
                                                                    imagen</label>
                                                                <input type="file" name="img_M" id="img_M"
                                                                    accept="image/*" style="display:none;">
                                                                <i class="bi bi-card-image"></i>
                                                                <span id="imagen2" style="cursor: pointer;">
                                                                    Imagen no seleccionada
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="mb-4 animate__animated animate__fadeIn">
                                                            <h5 style="color: #70cc06;">Miércoles</h5>
                                                            <textarea id="ckeditor" class="ckeditor form-control"
                                                                name="resumen_Mi" id="resumen_Mi" rows="5"
                                                                placeholder="Ingresa tu resumen del día miércoles."
                                                                required></textarea>
                                                            <div class="mt-2">
                                                                <label for="img_Mi"
                                                                    class="form-label btn btn-primary">Cargar
                                                                    imagen</label>
                                                                <input type="file" name="img_Mi" id="img_Mi"
                                                                    accept="image/*" style="display:none;">
                                                                <i class="bi bi-card-image"></i>
                                                                <span id="imagen3" style="cursor: pointer;">
                                                                    Imagen no seleccionada
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="mb-4 animate__animated animate__fadeIn">
                                                            <h5 style="color: #70cc06;">Jueves</h5>
                                                            <textarea id="ckeditor" class="ckeditor form-control"
                                                                name="resumen_J" id="resumen_J" rows="5"
                                                                placeholder="Ingresa tu resumen del día jueves."
                                                                required></textarea>
                                                            <div class="mt-2">
                                                                <label for="img_J"
                                                                    class="form-label btn btn-primary">Cargar
                                                                    imagen</label>
                                                                <input type="file" name="img_J" id="img_J"
                                                                    accept="image/*" style="display:none;">
                                                                <i class="bi bi-card-image"></i>
                                                                <span id="imagen4" style="cursor: pointer;">
                                                                    Imagen no seleccionada
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="mb-4 animate__animated animate__fadeIn">
                                                            <h5 style="color: #70cc06;">Viernes</h5>
                                                            <textarea id="ckeditor" id="resumen_V"
                                                                class="ckeditor form-control" name="resumen_V" rows="5"
                                                                placeholder="Ingresa tu resumen del día viernes."
                                                                required></textarea>
                                                            <div class="mt-2">
                                                                <label for="img_V"
                                                                    class="form-label btn btn-primary">Cargar
                                                                    imagen</label>
                                                                <input type="file" name="img_V" id="img_V"
                                                                    accept="image/*" style="display:none;">
                                                                <i class="bi bi-card-image"></i>
                                                                <span id="imagen5" style="cursor: pointer;">
                                                                    Imagen no seleccionada
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button id="btn_enviar_reporte" class="efectoboton"
                                                                style="font-size:20px !important" type="button"
                                                                onclick="cambiarTipoFormulario('reporte')">Enviar
                                                                Reporte</button>
                                                            <button id="btn_guardar_borrador" class="efectoboton"
                                                                style="font-size:20px !important" type="button"
                                                                onclick="cambiarTipoFormulario('borrador')">Guardar
                                                                Borrador</button>
                                                        </div>
                                                        <script>
                                                        function reloadPage() {
                                                            $(document).ready(function() {
                                                                Swal.fire({
                                                                    title: 'Listo!',
                                                                    text: 'Tu reporte ha sido enviado.',
                                                                    icon: 'success',
                                                                    timer: 2000,
                                                                }).then(function() {
                                                                    window.location.href =
                                                                        'menu_alumnos.php';
                                                                });
                                                            });
                                                        }
                                                        </script>
                                                    </div>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </section>
                </div>
                <script>
                function cambiarTipoFormulario(tipo) {
                    var form = document.getElementById('enviar_reporte');
                    var tipoFormularioInput = document.getElementById('tipo_formulario');

                    tipoFormularioInput.value = tipo;

                    if (tipo == 'reporte') {
                        form.action = "gestion/generador_pdf/send.php";
                    } else if (tipo == 'borrador') {
                        form.action = "gestion/generador_pdf/save.php";
                    }

                    form.submit();
                }
                </script>

                <style>
                .btn-outline-light {
                    --bs-btn-color: #f8f9fa;
                    --bs-btn-border-color: #f8f9fa;
                    --bs-btn-hover-color: #000;
                    --bs-btn-hover-bg: #f8f9fa;
                    --bs-btn-hover-border-color: #f8f9fa;
                    --bs-btn-focus-shadow-rgb: 248, 249, 250;
                    --bs-btn-active-color: #000;
                    --bs-btn-active-bg: #f8f9fa;
                    --bs-btn-active-border-color: #f8f9fa;
                    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
                    --bs-btn-disabled-color: #f8f9fa;
                    --bs-btn-disabled-bg: transparent;
                    --bs-btn-disabled-border-color: #f8f9fa;
                    --bs-gradient: none;
                }

                .report-card {
                    transition: transform 0.3s ease-in-out;
                }

                .report-card:hover {
                    transform: scale(1.1);
                }

                @keyframes fadeIn {
                    0% {
                        opacity: 0;
                    }

                    100% {
                        opacity: 1;
                    }
                }

                .fade {
                    animation-name: fadeIn;
                    animation-duration: 1s;
                    animation-fill-mode: forwards;
                    /* Añadimos esta línea */
                }

                .fade {
                    animation-name: fadeIn;
                    animation-duration: 1s;
                }

                .bg-green {
                    background-color: #70cc06 !important;
                }

                .bg-green h2 {
                    font-size: 31px !important;
                }

                .bg-red {
                    background-color: #FF4444 !important;
                }

                .bg-red h2 {
                    font-size: 31px !important;
                }

                .bg-yellow {
                    background-color: #FFBB33 !important;
                }

                .bg-yellow h2 {
                    font-size: 31px !important;
                }

                .bg-white {
                    background-color: #fff !important;
                }

                .bg-white h2 {
                    color: #000 !important;
                    font-size: 31px !important;
                }

                .bg-white p {
                    color: #000 !important;
                }

                .white {
                    color: #fff;
                }

                .carousel-control-next-icon,
                .carousel-control-prev-icon {
                    background-color: gray !important;
                }

                .container-fluid {
                    padding: 2rem;
                }

                .navigation-btn i {
                    font-size: 1.5rem;
                }

                .report-card {
                    height: 100%;
                    padding: 2rem;
                    border-radius: 1rem;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                }

                .report-card h2 {
                    margin-bottom: 1rem;
                }

                .report-card p {
                    margin-bottom: 2rem;
                }

                .report-card button {
                    align-self: flex-start;
                }

                .navigation-btn {
                    height: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .total-reports {
                    font-size: 1.5rem;
                    color: #4F5D75;
                    margin-top: 2rem;
                    text-align: center;
                }

                .lead {
                    text-align: justify !important;
                    font-weight: 600;
                }
                </style>

                <div class="tab-pane" id="tab-3">
                    <section id="contact" class="contact animate__animated p-3 shadow-lg">
                        <div class="container-fluid">
                            <div class="section-title">
                                <h3>EDUCACIÓN DUAL</h3>
                                <h1 style="font-size: 55px !important; font-weight:800 !important;">SEGUIMIENTO</h1>
                                <hr>
                            </div>
                            <p class="lead">
                                Bienvenido a la sección de seguimiento de reportes, aquí encontrarás la
                                retroalimentación de
                                tus tutores académicos y instructores dual, detallando el estatus de cada uno de tus
                                reportes
                                semanales.
                                Esta sección te permitirá hacer un seguimiento de tus progresos y mejorar continuamente
                                en
                                tu aprendizaje.
                            </p>
                            <div class="container-fluid" style="padding: 0px">
                                <div class="row align-items-md-stretch">
                                    <div class="col-1">
                                        <button class="btn btn-outline-light navigation-btn" id="prev-btn">
                                            <i class="bi bi-chevron-left"></i>
                                        </button>
                                    </div>
                                    <div class="col-10" style="max-width: 90%">
                                        <div class="row align-items-md-stretch" id="report-container">
                                        </div>
                                    </div>
                                    <div class="col-1" style="max-width: 5%">
                                        <button class="btn btn-outline-light navigation-btn" id="next-btn">
                                            <i class="bi bi-chevron-right"></i>
                                        </button>
                                    </div>

                                </div>
                                <div class="total-reports">
                                    Total de reportes entregados:
                                    <?php
                                include("templates/conexion.php");
                                $idAlumno = $_SESSION['idAlumno']; // Asegúrate de que esta sesión exista
                                $query = "SELECT COUNT(*) AS total FROM reportes WHERE idAlumno = $idAlumno";
            $result = $conn->query($query);

            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['total'];
            } else {
                die('Error realizando la consulta: ' . $conn->error);
            }

            $conn->close();
            ?>
                                </div>

                                <div class="text-center mt-4">
                                    <style>
                                    .p-5 {
                                        padding: 2rem !important;
                                    }

                                    .efectoboton {
                                        cursor: pointer;
                                        position: relative;
                                        padding: 13px 24px;
                                        font-size: 22px;
                                        font-weight: 600;
                                        border-radius: 0.375rem 0.9rem 0.375rem 0.9rem !important;
                                        transition: all 0.5s;
                                        background-color: #70cc06;
                                        color: #fff;

                                        &:after,
                                        &:before {
                                            content: " ";
                                            width: 10px;
                                            height: 10px;
                                            position: absolute;
                                            border: 0px solid #fff;
                                            transition: all 0.5s;
                                        }

                                        &:after {
                                            top: -2px;
                                            left: -2px;
                                            border-top: 5px solid #2e9b0f;
                                            border-left: 5px solid #2e9b0f;
                                        }

                                        &:before {
                                            bottom: -3px;
                                            right: -2px;
                                            border-bottom: 5px solid #2e9b0f;
                                            border-right: 5px solid #2e9b0f;

                                        }

                                        &:hover {
                                            color: #fff;
                                            background-color: #70cc06;

                                            &:before,
                                            &:after {
                                                width: 102%;
                                                height: 105%;
                                                border-top-right-radius: 20px;
                                                border-bottom-left-radius: 20px;
                                            }
                                        }
                                    }
                                    </style>
                                    <button class="efectoboton" onclick="fetchReports()">
                                        Actualizar
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
                <style>
                .bg-white .info-btn {
                    color: white !important;
                    transition: .3s;
                }

                .bg-white .info-btn:hover {
                    color: white !important;
                    transition: .3s;
                }

                .bg-white .btn-light {
                    background-color: #70cc06 !important;
                    transition: .3s;
                    color: white !important;
                }

                .info-btn:hover {
                    color: #c6c7c8 !important;
                    transition: .3s;
                }

                .info-card {
                    transition: all .2s ease-in-out;
                }

                .info-card:hover {
                    transform: scale(1.05);
                }

                .info-tooltip {
                    /* Aquí va el resto de tus estilos para .info-tooltip */

                    font-family: 'Open Sans', sans-serif;
                    /* Cambia 'Roboto' por la fuente que desees */
                }
                </style>
                <script>
                const reportContainer = document.getElementById("report-container");
                const prevBtn = document.getElementById("prev-btn");
                const nextBtn = document.getElementById("next-btn");
                let currentPage = 0;
                const reportsPerPage = 4;
                let reports = [];

                function fetchReports() {
                    fetch('gestion/get_reports.php')
                        .then(response => response.json())
                        .then(data => {
                            reports = data;
                            generateReportBoxes();
                            updateReportCount(); // Llama a la función para actualizar el contador de reportes
                        });
                }

                // Define una nueva función para actualizar el contador de reportes
                function updateReportCount() {
                    fetch('gestion/count_reports.php')
                        .then(response => response.text())
                        .then(count => {
                            const totalReportsDiv = document.querySelector('.total-reports');
                            totalReportsDiv.textContent = 'Total de reportes entregados: ' + count;
                        });
                }

                function generateReportBoxes() {
                    reportContainer.innerHTML = "";

                    const startIndex = currentPage * reportsPerPage;
                    const endIndex = startIndex + reportsPerPage;

                    for (let i = startIndex; i < endIndex && i < reports.length; i++) {
                        const report = reports[i];
                        const reportBox = document.createElement("div");
                        reportBox.className = "col-md-3 fade report-card"; // Añadimos la clase fade aquí
                        reportBox.innerHTML = `
<div class="h-100 p-5 bg-light border rounded-3 ${getStatusColor(report.estatus_tutor, report.estatus_instructor)}" style="position: relative; box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);">
  <h2 class="white">Reporte Semanal No. ${i + 1}</h2>
  <p class="white">${getStatusText(report.estatus_tutor, report.estatus_instructor)}</p>
  <i class="fas fa-info-circle info-btn" id="info-btn-${report.idReporte}" style="position: absolute; top: 10px; right: 10px; color: #fff; font-size: 24px;"></i>
  <button class="btn btn-light" type="button" onclick="viewReport('${report.idReporte}')">Ver reporte</button>
</div>
`;

                        let infoDiv = null; // Guarda la referencia al tooltip creado
                        reportBox.querySelector(`#info-btn-${report.idReporte}`).addEventListener("click", function() {
                            fetch(`gestion/get_report_info.php?id=${report.idReporte}`)
                                .then(response => response.json())
                                .then(info => {
                                    let content;

                                    if (info.retro_tutor === null && info.retro_instructor === null) {
                                        content = "Sin retroalimentaciones.";
                                    } else {
                                        content = `
            <h2>Tutor Académico</h2>
            <p>${info.retro_tutor ? info.retro_tutor : 'Sin retroalimentación.'}</p>
            <br/><h2>Instructor</h2>
            <p>${info.retro_instructor ? info.retro_instructor : 'Sin retroalimentación.'}</p>
            `;
                                    }

                                    Swal.fire({
                                        title: 'Retroalimentación',
                                        html: content,
                                        confirmButtonText: 'OK',
                                        showCloseButton: true,
                                        animation: true
                                    })
                                });
                        });

                        reportContainer.appendChild(reportBox);
                    }

                    prevBtn.style.display = currentPage > 0 ? "block" : "none";
                    nextBtn.style.display = endIndex < reports.length ? "block" : "none";
                }

                function getStatusColor(estatus_tutor, estatus_instructor) {
                    if (estatus_tutor === "aprobado" && estatus_instructor === "aprobado") {
                        return "bg-green";
                    } else if (estatus_tutor === "no_aprobado" || estatus_instructor === "no_aprobado") {
                        return "bg-red";
                    } else if (estatus_tutor === "pendiente" || estatus_instructor === "pendiente") {
                        return "bg-yellow";
                    } else {
                        return "bg-white";
                    }
                }

                function getStatusText(estatus_tutor, estatus_instructor) {
                    if (estatus_tutor === "aprobado" && estatus_instructor === "aprobado") {
                        return "Aprobado";
                    } else if (estatus_tutor === "no_aprobado" || estatus_instructor === "no_aprobado") {
                        return "No Aprobado";
                    } else if (estatus_tutor === "pendiente" || estatus_instructor === "pendiente") {
                        return "Pendiente";
                    } else {
                        return "Sin revisar";
                    }
                }

                function viewReport(idReporte) {
                    window.open(`gestion/generador_pdf/invoice.php?id=${idReporte}`, '_blank');
                }

                function nextPage() {
                    currentPage++;
                    generateReportBoxes();
                }

                function prevPage() {
                    currentPage--;
                    generateReportBoxes();
                }

                prevBtn.addEventListener("click", prevPage);
                nextBtn.addEventListener("click", nextPage);

                fetchReports();
                </script>

                <div class="tab-pane" id="tab-4">
                    <section id="contact" class="contact text-center animate__animated p-3 shadow-lg">


                        <div class="container">
                            <div class="section-title">
                                <br />
                                <h3>EDUCACIÓN DUAL</h3>
                                <h1 style="font-size: 55px !important; font-weight:800 !important;">ALUMNO</h1>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="info-card rounded p-3 shadow">
                                            <h5 class="mb-0"><i class="fas fa-id-card info-icon text-success"></i>
                                                Matrícula:</h5>
                                            <p class="font-weight-bold text-success"><?php echo $matricula; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-card rounded p-3 shadow">
                                            <h5 class="mb-0"><i class="fas fa-user info-icon text-success"></i>
                                                Nombre:</h5>
                                            <p class="font-weight-bold text-success">
                                                <?php echo $apellidos . ' ' . $nombres; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-card rounded p-3 shadow">
                                            <h5 class="mb-0"><i
                                                    class="fas fa-graduation-cap info-icon text-success"></i>
                                                Carrera:</h5>
                                            <p class="font-weight-bold text-success"><?php echo $carrera; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-3">
                                    <div class="col-md-4">
                                        <div class="info-card rounded p-3 shadow">
                                            <h5 class="mb-0"><i class="fas fa-building info-icon text-success"></i>
                                                Empresa:</h5>
                                            <p class="font-weight-bold text-success"><?php echo $nombreEmpresa; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-card rounded p-3 shadow">
                                            <h5 class="mb-0"><i
                                                    class="fas fa-chalkboard-teacher info-icon text-success"></i>
                                                Tutor
                                                Académico:</h5>
                                            <p class="font-weight-bold text-success">
                                                <?php echo $apellidosTutor . ' ' . $nombreTutor?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-card rounded p-3 shadow">
                                            <h5 class="mb-0"><i
                                                    class="fas bi bi-person-fill-up info-icon text-success"></i>
                                                Instructor:</h5>
                                            <p class="font-weight-bold text-success">
                                                <?php echo $apellidosInstructor . ' ' . $nombreInstructor; ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                        <!-- Inicio de la sección de Borradores y Pendientes -->
                        <div class="container">
                            <ul class="nav nav-tabs row d-flex mt-5">
                                <li class="nav-item col-6">
                                    <a class="nav-link active sub-tab-link navo" data-bs-toggle="tab" href="#subtab-1"
                                        id="borradores-tab">
                                        <i class="bi bi-file-earmark-post big-icon"></i>
                                        <h4 class="d-none d-lg-block">Borradores</h4>
                                    </a>
                                </li>
                                <li class="nav-item col-6">
                                    <a class="nav-link sub-tab-link navo" data-bs-toggle="tab" href="#subtab-2"
                                        id="pendientes-tab">
                                        <i class="bi bi-clock-history big-icon"></i>
                                        <h4 class="d-none d-lg-block">Pendientes</h4>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="subtab-1" class="tab-pane fade show active">
                                    <!-- Contenido de Borradores -->
                                    <h1 class="mb-4 text-center" style="font-size: 68px; font-weight:800;">Borradores
                                    </h1>
                                    <p class="lead text-center">
                                        Aquí encontrará sus borradores creados con anterioridad, podrá editarlos día a
                                        día hasta la fecha que lo suba, los borradores se eliminarán automáticamente
                                        cuando la semana en la que fue creado el borrador ya pasó.
                                    </p>
                                    <div class="container">
                                        <div class="border p-3">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"
                                                            style="width: 50%; font-size: 30px; background-color: #70cc06; color: #fff; border-color: #2e9b0f; border-width: 7px; font-size:24px !important"
                                                            scope="col">Borradores</th>
                                                        <th class="text-center"
                                                            style="width: 50%; font-size: 30px; background-color: #70cc06; color: #fff; border-color: #2e9b0f; border-width: 7px; font-size:24px !important"
                                                            scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="borradores-body">
                                                    <!-- Aquí es donde se insertarán los datos de los borradores. -->
                                                </tbody>
                                            </table>
                                            <!-- Div para los botones de paginación -->
                                            <div id="pagination-buttons" class="text-center my-3"></div>
                                        </div>
                                    </div>
                                </div>

                                <div id="subtab-2" class="tab-pane fade">
                                    <!-- Contenido de Pendientes -->
                                    <h1 class="mb-4 text-center" style="font-size: 68px; font-weight:800;">Pendientes
                                    </h1>
                                    <p class="lead text-center">
                                        Aquí encontrará sus reportes no aprobados que aún puede corregir para que el
                                        instructor o tutor académico vuelva a revisar para posteriormente ser aprobado.
                                        la fecha límite para corregir un reporte semanal es hasta el domingo de la
                                        semana a la que pertenece el reporte, si pasa de esa fecha el reporte
                                        automáticamente quedará como no aprobado.
                                    </p>
                                    <div class="container">
                                        <div class="border p-3">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"
                                                            style="width: 50%; font-size: 30px; background-color: #70cc06; color: #fff; border-color: #2e9b0f; border-width: 7px; font-size:24px !important"
                                                            scope="col">No Aprobados</th>
                                                        <th class="text-center"
                                                            style="width: 50%; font-size: 30px; background-color: #70cc06; color: #fff; border-color: #2e9b0f; border-width: 7px; font-size:24px !important"
                                                            scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="pendientes-body">
                                                    <!-- Aquí es donde se insertarán los datos de los pendientes. -->
                                                    <?php
                                include("templates/conexion.php");
                                $idAlumno = $_SESSION['idAlumno'];
                                
                                // Obtener la fecha actual y la fecha de inicio y fin de la semana actual
                                $fechaActual = date("Y-m-d");
                                $inicioSemana = date('Y-m-d', strtotime('monday this week', strtotime($fechaActual)));
                                $finSemana = date('Y-m-d', strtotime('sunday this week', strtotime($fechaActual)));
                                
                                $query = "SELECT * FROM reportes WHERE (estatus_tutor = 'no_aprobado' OR estatus_instructor = 'no_aprobado') AND idAlumno = '$idAlumno' AND f_Fin BETWEEN '$inicioSemana' AND '$finSemana'";
                                
                                $respuesta = mysqli_query($conn, $query);
                                while ($registro = mysqli_fetch_array($respuesta))  {
                                    echo '<tr>';
                                    echo '<td class="p-4">No Aprobado ' . $registro['idReporte'] . '</td>';
                                    echo '<td class="p-4">';
                                    echo '<a href="gestion/generador_pdf/edit_reporte.php?id=' . $registro['idReporte'] . '" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Editar</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                
                                $conn->close();
                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <script>
            $(document).ready(function() {
                function loadBorradores(page = 1) {
                    $.ajax({
                        url: "gestion/generador_pdf/fetch.php",
                        type: "GET",
                        data: {
                            page: page
                        },
                        success: function(data) {
                            var rows = JSON.parse(data);
                            var html = "";
                            for (var i = 0; i < rows.length; i++) {
                                var row = rows[i];
                                html += "<tr>";
                                html += '<td class="p-5">Borrador ' + row["idBorrador"] + '</td>';
                                html += "<td class='p-4'>";
                                html += "<div class='btn-group'>";
                                html +=
                                    '<a href="/dual/gestion/generador_pdf/edit_borrador.php?id=' +
                                    row["idBorrador"] +
                                    '" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Editar</a>';
                                html +=
                                    '<a href="#" class="btn btn-danger delete-btn" data-id="' +
                                    row["idBorrador"] +
                                    '"><i class="bi bi-trash"></i> Borrar</a>';
                                html += "</div>";
                                html += "</td>";
                                html += "</tr>";
                            }
                            $("#borradores-body").html(html);
                            generatePaginationButtons(page);
                        },
                    });
                }

                function generatePaginationButtons(currentPage) {
                    $.ajax({
                        url: "/dual/gestion/generador_pdf/total_borradores.php",
                        type: "GET",
                        success: function(totalBorradores) {
                            var totalPages = Math.ceil(totalBorradores / 5);
                            var buttonsHtml = "";
                            for (var i = 1; i <= totalPages; i++) {
                                buttonsHtml +=
                                    `<button class="btn page-btn ${currentPage === i ? 'btn-secondary-active' : 'btn-outline-secondary'} mx-1" data-page="${i}">${i}</button>`;
                            }
                            $("#pagination-buttons").html(buttonsHtml);
                        },
                    });
                }

                $(document).on('click', '.page-btn', function(e) {
                    e.preventDefault();
                    var page = $(this).data('page');
                    loadBorradores(page);
                });

                $('#borradores-tab').on('shown.bs.tab', function() {
                    loadBorradores();
                });

                $(document).on('click', '.delete-btn', function(e) {
                    e.preventDefault();
                    var idBorrador = $(this).data('id');
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción eliminará el borrador permanentemente.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Si, eliminar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "/dual/gestion/generador_pdf/delete_borrador.php",
                                type: "POST",
                                data: {
                                    idBorrador: idBorrador
                                },
                                success: function(response) {
                                    if (response.trim() === "success") {
                                        Swal.fire('Eliminado',
                                            'El borrador ha sido eliminado.',
                                            'success').then(function() {
                                            loadBorradores();
                                        });
                                    } else {
                                        Swal.fire('Error',
                                            'Ha ocurrido un error al eliminar el borrador.',
                                            'error');
                                    }
                                },
                                error: function() {
                                    Swal.fire('Error',
                                        'Ha ocurrido un error en la comunicación con el servidor.',
                                        'error');
                                }
                            });
                        }
                    });
                });

                // Load the first page of drafts when the page loads
                loadBorradores();
            });
            </script>
            <style>
            .nav-item:hover a.navo#tabb2 {
                background-color: #FFBB33;
                /* Aquí puedes poner el color que quieras */
                color: #fff;
            }

            .nav-item:hover a.navo#tabb3 {
                background-color: #FF4444;
                /* Aquí puedes poner el color que quieras */
                color: #fff;

            }

            .fijo-column2 {
                width: 110px !important;
            }

            .features .nav-tabs .nav-item:hover i {
                color: #fff;
            }

            .features .tab-pane ul i h4 .active {
                color: #fff !important;
            }

            .features .tab-pane ul i.active {
                color: #fff;
            }

            .features .tab-pane ul i {
                font-size: 40px;
                padding-right: 4px;
                color: #000;
            }

            .features .nav-tabs .nav-item .nav-link.active i {
                color: #fff;
            }


            .features .nav-tabs .nav-item .nav-link:hover i {
                color: #fff;
            }
            </style>

    </section>






    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="//cdn.ckeditor.com/4.20.2/basic/ckeditor.js"></script>

    <?php
    include ("templates/footer.php");
    ?>

    <script src="assets/js/main.js"></script>

    <script>
    document.getElementById('img_L').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen = file.name;
        document.getElementById('imagen').textContent = imagen;
        document.getElementById('imagen').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
    <style>
    .custom-image-style {
        max-width: 25vw;
        max-height: 200vh;
    }
    </style>
    <script>
    document.getElementById('img_M').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen2 = file.name;
        document.getElementById('imagen2').textContent = imagen2;
        document.getElementById('imagen2').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
    <script>
    document.getElementById('img_Mi').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen3 = file.name;
        document.getElementById('imagen3').textContent = imagen3;
        document.getElementById('imagen3').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
    <script>
    document.getElementById('img_J').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen4 = file.name;
        document.getElementById('imagen4').textContent = imagen4;
        document.getElementById('imagen4').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
    <script>
    document.getElementById('img_V').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen5 = file.name;
        document.getElementById('imagen5').textContent = imagen5;
        document.getElementById('imagen5').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
</body>

</html>