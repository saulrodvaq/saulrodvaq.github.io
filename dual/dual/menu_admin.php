<?php
session_start();
include("templates/conexion.php");

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$nombres = $_SESSION['fullname'];
$id = $_SESSION['id'];
$role_id = $_SESSION['role_id'];

if ($role_id != 1) {
        header('Location: login.php');
    exit;
}

$sql = "SELECT * FROM usuario WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (!$resultado || mysqli_num_rows($resultado) != 1) {
    session_destroy();
    header('Location: login.php');
    exit;
}

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- Cerrar sesion-Botones o cuadros de texto dentro de la pagina-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Cerrar sesion-Botones o cuadros de texto dentro de la pagina-->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>



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
    <link href="assets/css/style.css" rel="stylesheet">



</head>

<body>
    <script>
    window.onload = function() {
        var textoBanner = document.getElementById('textoBanner');
        textoBanner.style.animation = `typewriter ${textoBanner.textContent.length / 5}s linear 1s 1 normal both,
    blink 1s steps(${textoBanner.textContent.length}) infinite`;
    }
    </script>
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/dual/index.php" class="logo"><img src="assets/img/log-bar2.png" alt="" class="img-fluid"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a id="cerrar" class="scrollto efectoboton" href="templates/cerrar_sesion.php">Cerrar Sesión</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <script>
            $(document).ready(function() {
                $('#cerrar').click(function(e) {
                    e.preventDefault();
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
                                logoutUrl;
                        }
                    })
                });
            });
            </script>
        </div>
    </header>
    <section id="cta" class="cta">
        <div class="container">
            <div class="text-center">
                <br>
                <h3 id="textoBanner" style="font-size: 68px"><?php echo 'Bienvenido, ' . $nombres;?></h3>
                <h2>Administrador</h2>
                <br>
            </div>
        </div>
    </section>
    <!--Opciones-->
    <section id="features" class="features">
        <div class="container" data-aos="fade-up" style="max-width: 90%;">
            <ul class="nav nav-tabs row d-flex">
                <li class="nav-item col-3">
                    <a class="nav-link navo active show" data-bs-toggle="tab" href="#tab-1">
                        <i class="bi bi-house-gear-fill"></i>
                        <h4 class="d-none d-lg-block">Gestión</h4>
                    </a>
                </li>
                <li class="nav-item col-3">
                    <a class="nav-link navo" data-bs-toggle="tab" href="#tab-2">
                        <i class="bi bi-card-list"></i>
                        <h4 class="d-none d-lg-block">Reportes</h4>
                    </a>
                </li>
                <li class="nav-item col-3">
                    <a class="nav-link navo" data-bs-toggle="tab" href="#tab-3">
                        <i class="bi bi-mailbox2"></i>
                        <h4 class="d-none d-lg-block">Postulaciones</h4>
                    </a>
                </li>
                <li class="nav-item col-3">
                    <a class="nav-link navo" data-bs-toggle="tab" href="#tab-4">
                        <i class="bi bi-archive-fill"></i>
                        <h4 class="d-none d-lg-block">Archivo</h4>
                    </a>
                </li>
            </ul>
            <div class="tab-content">


                <!--.class="tab-pane active show" id="tab-1">-->
                <div class="tab-pane active" id="tab-1">
                    <section id="contact" class="contact section">
                        <div class="container">
                            <style>
                            .texto {
                                font-size: 18px !important;
                                color: #3a3a3a !important;
                                
                            }

                            .card {
                                border: 4px solid #3a3a3a;
                                border-color: #FFF !important;
                                background-color: #FFF !important;
                                transition: all 0.3s;
                                height: 100%;
                                font-weight: 700 !important;
                                font-size: 18px;
                                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
                            }

                            .card hr {
                                border: 2px solid #70cc06 !important;
                                transition: all 0.3s;
                                opacity: 1 !important;
                            }

                            .card a {
                                font-weight: 600 !important;
                                font-size: 30px !important;
                                color: #212121 !important;
                                text-align: justify !important;
                            }

                            .card:hover {
                                border: 4px solid #70cc06;
                                transform: translateY(-5px);
                                border-color: #70cc06 !important;
                                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
                            }

                            .card:hover a {
                                color: #70cc06 !important;
                            }

                            .card-img-top {
                                transition: all 0.3s;
                            }

                            .card-img-top:hover {
                                transform: scale(1.1);
                            }

                            .card-zoom {
                                overflow: hidden;
                            }

                            .card-img-container {
                                transition: all 0.3s;
                            }

                            .card:hover .card-img-container {
                                transform: scale(1.1);
                            }

                            .whitebackground {
                                background-color: #fff !important;
                            }
                            </style>

                            <div class="container d-flex justify-content-center align-items-center">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                    <div class="col">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/alumnos/alumnos.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/alumnos.jpg" alt="Alumnos" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/alumnos/alumnos.php">Alumnos</a></h5>
                                                <hr>
                                                <p class="card-text text-center">Podrá gestionar a los alumnos con los
                                                    datos referentes a su postulación.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/tutores/tutores.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/tutores.jpg"
                                                        alt="Tutores Académicos" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/tutores/tutores.php">Tutores Académicos</a></h5>
                                                <hr>
                                                <p class="card-text text-center">Podrá gestionar los tutores y
                                                    asignarles
                                                    los alumnos que estarán a su cargo.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/instructores/instructores.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/instructores.jpg"
                                                        alt="Instructores" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/instructores/instructores.php">Instructores</a>
                                                </h5>
                                                <hr>
                                                <p class="card-text text-center">Podrá crear un instructor empresarial
                                                    que se le solicitará su empresa para poder darlo de alta.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/empresas/empresas.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/empresas.jpg" alt="empresas" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/empresas/empresas.php">Empresas</a></h5>
                                                <hr>
                                                <p class="card-text text-center">Acceso a todas las empresas que están
                                                    vinculadas
                                                    a la modalidad dual.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/carga_dual/carga_dual.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/carga_dual.jpg"
                                                        alt="Carga Dual" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/carga_dual/carga_dual.php">Carga Dual</a>
                                                </h5>
                                                <hr>
                                                <p class="card-text text-center">Podrá visualizar los alumnos que hay en
                                                    cada empresa y vincularlos con sus instructores.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/docentes/docentes.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/docentes.jpg" alt="Docentes" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/docentes/docentes.php">Docentes</a>
                                                </h5>
                                                <hr>
                                                <p class="card-text text-center">Podrá gestionar los docentes y
                                                    asignarles
                                                    los alumnos que estarán a su cargo.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/formadores_dual/formadores_dual.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/formadores_dual.jpg"
                                                        alt="Directores" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/formadores_dual/formadores_dual.php">Formadores
                                                        Dual</a></h5>
                                                <hr>
                                                <p class="card-text text-center">Podrá gestionar a los
                                                    formadores dual.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/subdirectores/subdirectores.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/subdirectivos.jpg"
                                                        alt="Subdirectores" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/subdirectores/subdirectores.php">Subdirectivos</a></h5>
                                                <hr>
                                                <p class="card-text text-center">Podrá gestionar a los
                                                    subdirectivos.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/directores/directores.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/directivos.jpg"
                                                        alt="Directores" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/directores/directores.php">Directivos</a></h5>
                                                <hr>
                                                <p class="card-text text-center">Podrá gestionar a los
                                                    directivos.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-center">
                                        <div class="card bg-light animate__animated">
                                            <a href="secciones/administradores/administradores.php" class="card-zoom">
                                                <div class="card-img-container">
                                                    <img class="card-img-top"
                                                        src="assets/img/imagenes_admin/administradores.jpg"
                                                        alt="Administradores" />
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><a class="stretched-link"
                                                        href="secciones/administradores/administradores.php">Administradores</a>
                                                </h5>
                                                <hr>
                                                <p class="card-text text-center">Podrá gestionar a los
                                                    administradores.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                </div>
                <div class="tab-pane" id="tab-2">
                    <section id="contact" class="contact section">
                        <div class="section-title">
                            <h3>EDUCACIÓN DUAL</h3>
                            <h1 style="font-size: 55px !important; font-weight:800 !important;">REGISTRO DE REPORTES</h1>
                            <hr>
                        </div>
                        <style>
                        .features .nav-link.active#tabb2 {
                            background: #FFBB33 !important;
                            color: #fff;
                            border-color: #EEAA11;
                            border-radius: 6px;
                            border-width: 5px;
                        }

                        .features .nav-link:hover#tabb2 {
                            background: #FFBB33 !important;
                        }

                        .features .nav-link.active#tabb3 {
                            background: #FF4444 !important;
                            color: #fff;
                            border-color: #F12929;
                            border-radius: 6px;
                            border-width: 5px;
                        }

                        .features .nav-link:hover#tabb3 {
                            background: #FF4444 !important;
                        }

                        .edit3 {
                            border-radius: 0rem 0.5rem 0rem 0.5rem !important;
                        }

                        .edit4 {
                            border-radius: 0rem 0.5rem 0rem 0.5rem !important;
                        }

                        .edit1 {
                            cursor: pointer;
                            position: relative;
                            font-size: 16px;
                            font-weight: 600;
                            border-radius: 0rem 0.5rem 0rem 0.5rem !important;
                            transition: all 0.5s;
                            background-color: #FFBB33;
                            border-radius: 0rem 0.5rem 0rem 0.5rem !important;
                            color: #fff;
                            border: none;
                        }

                        .edit2 {
                            cursor: pointer;
                            position: relative;
                            font-size: 16px;
                            font-weight: 600;
                            border-radius: 0rem 0.5rem 0rem 0.5rem !important;
                            transition: all 0.5s;
                            background-color: #FF4444;
                            color: #fff;
                            border-radius: 0rem 0.5rem 0rem 0.5rem !important;
                            border: none;
                        }

                        .edit2:hover {
                            color: #fff;
                            background-color: #FF4444;
                        }

                        .edit2::before {
                            bottom: -3px;
                            right: -3px;
                            border-bottom: 5px solid #F12929;
                            border-right: 5px solid #F12929;
                            opacity: 0;
                        }

                        .edit2:after {
                            top: -3px;
                            left: -3px;
                            border-top: 5px solid #F12929;
                            border-left: 5px solid #F12929;
                            opacity: 0;
                        }


                        .edit1:hover {
                            color: #fff;
                            background-color: #FFBB33;
                        }

                        .edit1::before {
                            bottom: -3px;
                            right: -3px;
                            border-bottom: 5px solid #EEAA11;
                            border-right: 5px solid #EEAA11;
                            opacity: 0;
                        }

                        .edit1::after {
                            top: -3px;
                            left: -3px;
                            border-top: 5px solid #EEAA11;
                            border-left: 5px solid #EEAA11;
                            opacity: 0;
                        }

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

                        .card2 {
                            position: relative;
                            display: flex;
                            flex-direction: column;
                            min-width: 0;
                            word-wrap: break-word;
                            background-color: #fff;
                            background-clip: border-box;
                            border: 1px solid rgba(0, 0, 0, 0.125);
                            border-radius: 0.25rem;
                        }
                        </style>
                        <div class="container" data-aos="fade-up" style="max-width: 100%;">
                            <ul class="nav nav-tabs row d-flex">
                                <li class="nav-item col-4">
                                    <a id="tabb2" class="nav-link navo active" data-bs-toggle="tab" href="#tabb-2">
                                        <i class="bi bi-envelope-exclamation"></i>
                                        <h4 class="d-none d-lg-block">Sin revisar</h4>
                                    </a>
                                </li>
                                <li class="nav-item col-4">
                                    <a id="tabb3" class="nav-link navo" data-bs-toggle="tab" href="#tabb-3">
                                        <i class="bi bi-dash-circle"></i>
                                        <h4 class="d-none d-lg-block">No Aprobados</h4>
                                    </a>
                                </li>
                                <li class="nav-item col-4">
                                    <a id="tabb4" class="nav-link navo" data-bs-toggle="tab" href="#tabb-4">
                                        <i class="bi bi-file-earmark-check"></i>
                                        <h4 class="d-none d-lg-block">Aprobados</h4>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabb-2">
                                    <section id="contact" class="card2">
                                        <div class="container-fluid">
                                            <div class="table-responsive text-center table-hover">
                                                <table class="table table-responsive-sm text-center table-hover"
                                                    id="tabla_id">
                                                    <thead>
                                                        <tr>
                                                            <th>No. Reporte</th>
                                                            <th>Carrera</th>
                                                            <th>Cuatrimestre</th>
                                                            <th>Matrícula</th>
                                                            <th>Alumno</th>
                                                            <th>Empresa</th>
                                                            <th>Tutor Académico</th>
                                                            <th>Instructor</th>
                                                            <th class="fijo-column2">Semana</th>
                                                            <th>Reporte de Actividades</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                include("templates/conexion.php");
                $query = "SELECT r.*, t.nombres as nombrestutor, t.apellidos as apellidostutor, i.nombres as nombresinstructor, i.apellidos as apellidosinstructor
                FROM reportes r
                INNER JOIN tutores t ON r.idTutor = t.idTutor
                INNER JOIN instructores i ON r.idInstructor = i.idInstructor
                WHERE estatus_tutor = 'sin_revisar' AND estatus_instructor = 'sin_revisar' ORDER BY idReporte DESC";
                $respuesta = mysqli_query($conn, $query);

                while ($registro = mysqli_fetch_array($respuesta)) {
                    echo "<tr>";
                    echo "<td>{$registro['idReporte']}</td>";
                    echo "<td>{$registro['carrera']}</td>";
                    echo "<td>{$registro['cuatrimestre']}</td>";
                    echo "<td>{$registro['matricula']}</td>";
                    echo "<td>".$registro['apellidos']." ".$registro['nombres']."</td>";
                    echo "<td>{$registro['empresa']}</td>";
                    echo "<td>{$registro['apellidostutor']} {$registro['nombrestutor']}</td>";
                    echo "<td>{$registro['apellidosinstructor']} {$registro['nombresinstructor']}</td>";
                    echo "<td>"." Del ".$registro['f_Inicio']." al ".$registro['f_Fin']."</td>";
                    echo "<td style='padding: 30px !important;'><a href='gestion/generador_pdf/invoice.php?id=" . $registro['idReporte'] . "' class='efectoboton edit1' target='_blank'><i class='bi bi-file-earmark-text-fill'></i></a></td>";
                    echo "</tr>";
                }
                ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="tab-pane" id="tabb-3">
                                    <section id="contact" class="card2">
                                        <div class="container-fluid">
                                            <div class="table-responsive text-center table-hover">
                                                <table class="table table-responsive-sm text-center table-hover"
                                                    id="tabla_id2">
                                                    <thead>
                                                        <tr>
                                                            <th>No. Reporte</th>
                                                            <th>Carrera</th>
                                                            <th>Cuatrimestre</th>
                                                            <th>Matrícula</th>
                                                            <th>Alumno</th>
                                                            <th>Empresa</th>
                                                            <th>Tutor Académico</th>
                                                            <th>Instructor</th>
                                                            <th class="fijo-column2">Semana</th>
                                                            <th>Reporte de Actividades</th>
                                                            <th>VoBo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                include("templates/conexion.php");
                $query = "SELECT r.*, t.nombres as nombrestutor, t.apellidos as apellidostutor, i.nombres as nombresinstructor, i.apellidos as apellidosinstructor
                FROM reportes r
                INNER JOIN tutores t ON r.idTutor = t.idTutor
                INNER JOIN instructores i ON r.idInstructor = i.idInstructor
                WHERE estatus_tutor = 'no_aprobado' OR estatus_instructor = 'no_aprobado' OR (estatus_instructor = 'aprobado' AND estatus_tutor = 'sin_revisar') OR (estatus_instructor = 'sin_revisar' AND estatus_tutor = 'aprobado') ORDER BY idReporte DESC";
                $respuesta = mysqli_query($conn, $query);

                while ($registro = mysqli_fetch_array($respuesta)) {
                    echo "<tr>";
                    echo "<td>{$registro['idReporte']}</td>";
                    echo "<td>{$registro['carrera']}</td>";
                    echo "<td>{$registro['cuatrimestre']}</td>";
                    echo "<td>{$registro['matricula']}</td>";
                    echo "<td>".$registro['apellidos']." ".$registro['nombres']."</td>";
                    echo "<td>{$registro['empresa']}</td>";
                    echo "<td>{$registro['apellidostutor']} {$registro['nombrestutor']}</td>";
                    echo "<td>{$registro['apellidosinstructor']} {$registro['nombresinstructor']}</td>";
                    echo "<td>"." Del ".$registro['f_Inicio']." al ".$registro['f_Fin']."</td>";
                    echo "<td style='padding: 30px !important;'><a href='gestion/generador_pdf/invoice.php?id=" . $registro['idReporte'] . "' class='efectoboton edit2' target='_blank'><i class='bi bi-file-earmark-text-fill'></i></a></td>";
                    echo "<td>";
                    echo "<button type='button' class='retro-button efectoboton edit2' data-id='{$registro['idReporte']}' data-retro-tutor='{$registro['retro_tutor']}' data-retro-instructor='{$registro['retro_instructor']}' onclick='showFeedback(this)'>Retroalimentación</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="tab-pane" id="tabb-4">
                                    <section id="contact" class="card2">
                                        <div class="container-fluid">
                                            <div class="table-responsive text-center table-hover">
                                                <table class="table table-responsive-sm text-center table-hover"
                                                    id="tabla_id3">
                                                    <thead>
                                                        <tr>
                                                            <th>No. Reporte</th>
                                                            <th>Carrera</th>
                                                            <th>Cuatrimestre</th>
                                                            <th>Matrícula</th>
                                                            <th>Alumno</th>
                                                            <th>Empresa</th>
                                                            <th>Tutor Académico</th>
                                                            <th>Instructor</th>
                                                            <th class="fijo-column2">Semana</th>
                                                            <th>Reporte de Actividades</th>
                                                            <th>VoBo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                               include("templates/conexion.php");
                               $query = "SELECT r.*, t.nombres as nombrestutor, t.apellidos as apellidostutor, i.nombres as nombresinstructor, i.apellidos as apellidosinstructor
                               FROM reportes r
                               INNER JOIN tutores t ON r.idTutor = t.idTutor
                               INNER JOIN instructores i ON r.idInstructor = i.idInstructor
                               WHERE estatus_tutor = 'aprobado' AND estatus_instructor = 'aprobado' ORDER BY idReporte DESC";
                               $respuesta = mysqli_query($conn, $query);
               

                while ($registro = mysqli_fetch_array($respuesta)) {
                    echo "<tr>";
                    echo "<td>{$registro['idReporte']}</td>";
                    echo "<td>{$registro['carrera']}</td>";
                    echo "<td>{$registro['cuatrimestre']}</td>";
                    echo "<td>{$registro['matricula']}</td>";
                    echo "<td>".$registro['apellidos']." ".$registro['nombres']."</td>";
                    echo "<td>{$registro['empresa']}</td>";
                    echo "<td>{$registro['apellidostutor']} {$registro['nombrestutor']}</td>";
                    echo "<td>{$registro['apellidosinstructor']} {$registro['nombresinstructor']}</td>";
                    echo "<td>"." Del ".$registro['f_Inicio']." al ".$registro['f_Fin']."</td>";
                    echo "<td style='padding: 30px !important;'><a href='gestion/generador_pdf/invoice.php?id=" . $registro['idReporte'] . "' class='efectoboton edit3' target='_blank'><i class='bi bi-file-earmark-text-fill'></i></a></td>";
                    echo "<td>";
                    echo "<button type='button' class='retro-button efectoboton edit4' data-id='{$registro['idReporte']}' data-retro-tutor='{$registro['retro_tutor']}' data-retro-instructor='{$registro['retro_instructor']}' onclick='showFeedback(this)'>Retroalimentación</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                                                        <script>
                                                        function showFeedback(element) {
                                                            var retroTutor = element.getAttribute('data-retro-tutor');
                                                            var retroInstructor = element.getAttribute(
                                                                'data-retro-instructor');

                                                            var content = `
        <h2>Tutor Académico</h2>
        <p>${retroTutor ? retroTutor : 'Sin retroalimentación.'}</p>
        <br/>
        <h2>Instructor</h2>
        <p>${retroInstructor ? retroInstructor : 'Sin retroalimentación.'}</p>
    `;

                                                            Swal.fire({
                                                                html: content,
                                                                icon: 'info',
                                                                confirmButtonText: 'OK',
                                                                allowOutsideClick: false,
                                                                allowEscapeKey: false,
                                                                allowEnterKey: false
                                                            });
                                                        }
                                                        </script>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane" id="tab-3">
                    <section id="contact" class="contact section">
                        <article class="postcard light green animate__animated">
                            <a class="postcard__img_link" href="secciones/postulados/alumnos_postulados.php">
                                <img class="postcard__img" src="assets/img/imagenes_admin/alumnos_postulados.jpg"
                                    alt="Image Title" />
                            </a>
                            <div class="postcard__text t-dark whitebackground">
                                <h1 class="postcard__title green"><a class="stretched-link"
                                        href="secciones/postulados/alumnos_postulados.php">Alumnos
                                        Postulados</a>
                                </h1>
                                <div class="postcard__subtitle small">
                                </div>
                                <div class="postcard__bar"></div>
                                <div class="postcard__preview-txt texto"> Podrá tener acceso a todos los alumnos que
                                    se
                                    han postulado en la modalidad dual.</div>
                            </div>
                        </article>

                        <article class="postcard light green animate__animated">
                            <a class="postcard__img_link" href="secciones/postulados/empresas_postuladas.php">
                                <img class="postcard__img" src="assets/img/imagenes_admin/empresas_postuladas.jpg"
                                    alt="Image Title" />
                            </a>
                            <div class="postcard__text t-dark whitebackground">
                                <h1 class="postcard__title green"><a class="stretched-link"
                                        href="secciones/postulados/empresas_postuladas.php">Empresas
                                        Postuladas</a>
                                </h1>
                                <div class="postcard__subtitle small">
                                </div>
                                <div class="postcard__bar">
                                </div>
                                <div class="postcard__preview-txt texto">Acceso a todas las empresas que se han
                                    postulado
                                    dentro de la modalidad dual.
                                </div>
                            </div>
                        </article>
                    </section>
                </div>


                <div class="tab-pane" id="tab-4">
                    <section id="contact" class="contact section">
                        <div class="container-fluid">
                            <article class="postcard light green animate__animated">
                                <a class="postcard__img_link"
                                    href="secciones/periodos_concluidos/periodos_concluidos.php">
                                    <img class="postcard__img" src="assets/img/imagenes_admin/periodos_concluidos.jpg"
                                        alt="Periodos Concluidos" />
                                </a>
                                <div class="postcard__text t-dark whitebackground">
                                    <h1 class="postcard__title green"><a class="stretched-link"
                                            href="secciones/periodos_concluidos/periodos_concluidos.php">Periodos
                                            Concluidos</a>
                                    </h1>
                                    <div class="postcard__subtitle small">
                                    </div>
                                    <div class="postcard__bar"></div>
                                    <div class="postcard__preview-txt texto">Podrá acceder a todos los alumnos que
                                        concluyeron su periodo en la modalidad dual y su
                                        historial de instructores y tutores académicos.
                                    </div>
                                </div>
                            </article>
                            <article class="postcard light green animate__animated">
                                <a class="postcard__img_link" href="secciones/generaciones/generaciones.php">
                                    <img class="postcard__img" src="assets/img/imagenes_admin/generaciones.jpg"
                                        alt="Image Title" />
                                </a>
                                <div class="postcard__text t-dark whitebackground">
                                    <h1 class="postcard__title green"><a class="stretched-link"
                                            href="secciones/generaciones/generaciones.php">Generaciones</a>
                                    </h1>
                                    <div class="postcard__subtitle small">
                                    </div>
                                    <div class="postcard__bar"></div>
                                    <div class="postcard__preview-txt texto">Podrá acceder a las
                                        generaciones de alumnos dual.
                                    </div>
                                </div>
                            </article>
                            <article class="postcard light green animate__animated">
                                <a class="postcard__img_link" href="secciones/empresas/empresas.php">
                                    <img class="postcard__img" src="assets/img/imagenes_admin/empresas2.jpg"
                                        alt="Image Title" />
                                </a>
                                <div class="postcard__text t-dark whitebackground">
                                    <h1 class="postcard__title green"><a class="stretched-link"
                                            href="secciones/empresas/empresas_desvinculadas.php">Empresas
                                            inactivas</a>
                                    </h1>
                                    <div class="postcard__subtitle small">
                                    </div>
                                    <div class="postcard__bar"></div>
                                    <div class="postcard__preview-txt texto">Acceso a todas las empresas que formaron
                                        parte de
                                        UTSC Dual pero actualmente se encuentran inactivas.
                                    </div>
                                </div>
                            </article>
                            <article class="postcard light green animate__animated">
                                <a class="postcard__img_link" href="secciones/catalogo/catalogo.php">
                                    <img class="postcard__img" src="assets/img/imagenes_admin/ut.png"
                                        alt="Image Title" />
                                </a>
                                <div class="postcard__text t-dark whitebackground">
                                    <h1 class="postcard__title green"><a class="stretched-link"
                                            href="secciones/catalogo/catalogo.php">Catálogo de carreras</a>
                                    </h1>
                                    <div class="postcard__subtitle small">
                                    </div>
                                    <div class="postcard__bar"></div>
                                    <div class="postcard__preview-txt texto">Podrá añadir nuevas carreras y materias a éstas carreras.
                                    </div>
                                </div>
                            </article>


                        </div>
                    </section>
                </div>



            </div>
        </div>
    </section>


    <style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover {
        background: none !important;
        border: none !important;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .dataTables_wrapper .dataTables_filter input[type="search"] {
        flex: 1;
    }

    .dataTables_wrapper .dataTables_length select {

        padding-right: 30px;

    }

    .table td {
        padding: 20px !important;
        /* Ajusta el espacio en blanco según tus necesidades */
        background: #fff;
    }

    .table th {
        text-align: center !Important;
    }

    .pagination {
        --bs-pagination-padding-x: 0.75rem;
        --bs-pagination-padding-y: 0.375rem;
        --bs-pagination-font-size: 1rem;
        --bs-pagination-color: #fff;
        --bs-pagination-bg: #70cc06;
        --bs-pagination-border-width: 4px;
        --bs-pagination-border-color: #2e9b0f;
        --bs-pagination-border-radius: 0.375rem;
        --bs-pagination-hover-color: #fff;
        --bs-pagination-hover-bg: #70cc06;
        --bs-pagination-hover-border-color: #2e9b0f;
        --bs-pagination-focus-color: #fff;
        --bs-pagination-focus-bg: #70cc06;
        --bs-pagination-focus-box-shadow: #70cc06;
        --bs-pagination-active-color: #fff;
        --bs-pagination-active-bg: #2e9b0f;
        --bs-pagination-active-border-color: #70cc06;
        --bs-pagination-disabled-color: #6c757d;
        --bs-pagination-disabled-bg: #fff;
        --bs-pagination-disabled-border-color: #fff;
        display: flex;
        padding-left: 0;
        list-style: none;
    }
    </style>

    <?php 
    include ("templates/footer.php");
    ?>
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Tu archivo main.js -->
    <script src="assets/js/main.js"></script>
    <script>
    $(document).ready(function() {
        $("#tabla_id").DataTable({
            "pageLength": 5,
            lengthMenu: [
                [5, 10, 15, 25, 50],
                [5, 10, 15, 25, 50]
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            }
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#tabla_id2").DataTable({
            "pageLength": 5,
            lengthMenu: [
                [5, 10, 15, 25, 50],
                [5, 10, 15, 25, 50]
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            }
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#tabla_id3").DataTable({
            "pageLength": 5,
            lengthMenu: [
                [5, 10, 15, 25, 50],
                [5, 10, 15, 25, 50]
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            }
        });
    });
    </script>

</body>

</html>