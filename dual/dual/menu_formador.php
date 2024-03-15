<?php
session_start(); // Inicia la sesión si no ha sido iniciada antes

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header('Location: login.php');
    exit;
}

if (!esFormador($_SESSION['usuario'])) {
    echo "No estás autorizado para acceder a esta página.";
    exit;
}

function esFormador($usuario) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dual_bd";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $query = "SELECT * FROM formadores WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conn, $query);
    $esFormador = mysqli_num_rows($resultado) > 0;
    mysqli_close($conn);
    return $esFormador;
}

include("templates/conexion.php");

// Luego, obtenemos los datos del usuario actual utilizando su matrícula
$usuario = $_SESSION['usuario']; // Obtén la matrícula del usuario actual de la sesión
$sql = "SELECT *, idFormador, idEmpresa FROM formadores WHERE usuario = '$usuario'";
$resultado = mysqli_query($conn, $sql);

// Verificamos si la consulta se realizó correctamente
if (!$resultado) {
    die("Error al obtener los datos del usuario: " . mysqli_error($conn));
}

// Obtenemos los datos del usuario y los guardamos en la variable $usuario
$usuario = mysqli_fetch_assoc($resultado);
$_SESSION['nombres'] = $usuario['nombres'];

// Aquí agregamos el idFormador a la sesión
$_SESSION['idFormador'] = $usuario['idFormador'];

// Obtenemos el idEmpresa del formador
$idEmpresa = $usuario['idEmpresa'];

// Consulta para obtener los datos de la empresa correspondiente al idEmpresa del formador
$queryEmpresa = "SELECT * FROM empresas WHERE idEmpresa = '$idEmpresa'";
$resultadoEmpresa = mysqli_query($conn, $queryEmpresa);

// Verificamos si la consulta se realizó correctamente
if (!$resultadoEmpresa) {
    die("Error al obtener los datos de la empresa: " . mysqli_error($conn));
}

// Obtenemos los datos de la empresa y los guardamos en la variable $empresa
$empresa = mysqli_fetch_assoc($resultadoEmpresa);

// Cerramos la conexión a la base de datos
mysqli_close($conn);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <style>
    .dataTables_wrapper .dataTables_length {
        float: left;
    }
    </style>
</head>

<body>
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/dual/index.php" class="logo"><img src="assets/img/log-bar2.png" alt="" class="img-fluid"></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="scrollto efectoboton" href="matriz.php?idEmpresa=<?php echo $idEmpresa; ?>">Matriz</a>
                    </li>
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
            <h2>Formador Dual</h2>
            <br>
        </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="container" data-aos="fade-up" style="max-width: 100%">
            <ul class="nav nav-tabs row d-flex">
                <li class="nav-item col-4">
                    <a class="nav-link navo active show" data-bs-toggle="tab" href="#tab-2">
                        <i class="bi bi-people-fill"></i>
                        <h4 class="d-none d-lg-block">Alumnos en la empresa</h4>
                    </a>
                </li>
                <li class="nav-item col-4">
                    <a class="nav-link navo" data-bs-toggle="tab" href="#tab-3">
                        <i class="bi bi-person-fill-up"></i>
                        <h4 class="d-none d-lg-block">Instructores en la empresa</h4>
                    </a>
                </li>
                <li class="nav-item col-4">
                    <a class="nav-link navo" data-bs-toggle="tab" href="#tab-4">
                        <i class="bi bi-card-list"></i>
                        <h4 class="d-none d-lg-block">Reportes</h4>
                    </a>
                </li>
            </ul>
            <style>
            .fijo-column {
                width: 40px !important;
            }
            </style>
            <div class="tab-content">
                <div class="tab-pane active show" id="tab-2">
                    <section id="contact" class="card2">
                        <div class="container-fluid">
                            <div class="section-title">
                                <h3>EDUCACIÓN DUAL</h3>
                                <h1 style="font-size: 55px !important; font-weight:800 !important;">ALUMNOS EN LA EMPRESA</h1>
                                <hr>
                            </div>
                            <table id="alumnosTable" class="table table-responsive-sm text-center table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="fijo-column">Carrera</th>
                                        <th>Matrícula</th>
                                        <th>Alumno</th>
                                        <th>Instructor</th>
                                        <th>Ingreso</th>
                                        <th>Fecha Fin</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                        include("templates/conexion.php");

                        $queryAlumnos = "SELECT * FROM alumnos WHERE idEmpresa = '$idEmpresa'";
                        $resultadoAlumnos = mysqli_query($conn, $queryAlumnos);
                        while ($row = mysqli_fetch_assoc($resultadoAlumnos)) {
                            echo "<tr>";
                            echo "<td>" . $row['idAlumno'] . "</td>";
                            echo "<td>" . $row['carrera'] . "</td>";
                            echo "<td>" . $row['matricula'] . "</td>";
                            echo "<td>" . $row['apellidos'] . ' ' . $row['nombres'] . "</td>";
                        
                            // Obtener el nombre del instructor
                            $idInstructor = $row['idInstructor'];
                            $queryInstructor = "SELECT * FROM instructores WHERE idInstructor = '$idInstructor'";
                            $resultadoInstructor = mysqli_query($conn, $queryInstructor);
                            
                            // Verificar si hay un resultado válido
                            $rowInstructor = ($resultadoInstructor) ? mysqli_fetch_assoc($resultadoInstructor) : null;
                            
                            // Obtener el nombre del instructor o mostrar un mensaje alternativo
                            if ($rowInstructor) {
                                $nombreInstructor = $rowInstructor['apellidos'] . ' ' . $rowInstructor['nombres'];
                            } else {
                                $nombreInstructor = "Sin instructor asignado";
                            }
                        
                            echo "<td>" . $nombreInstructor . "</td>";
                            echo "<td>" . $row['ingreso'] . "</td>";
                            $fechaFin = $row['fecha_fin'];
                                        $hoy = date('Y-m-d');
                                        $diasRestantes = intval((strtotime($fechaFin) - strtotime($hoy)) / (60 * 60 * 24));
                                    
                                        $recuadroColor = '';
                                        $textoColor = '';
                                        if ($diasRestantes < 0) {
                                            $recuadroColor = '#FF4444'; // Fecha pasada
                                            $textoColor = '#FFF';
                                        } elseif ($diasRestantes <= 10) {
                                            $recuadroColor = '#FFBB33'; // Faltan 10 días o menos
                                            $textoColor = '#FFF';
                                        }
                                    
                                        echo ("<td style='background-color: $recuadroColor; color: $textoColor;'>$row[fecha_fin]</td>");
                            $estatus = $row['estatus_alumno'];
                            $color = '';
                        
                            if ($estatus == 'Activo') {
                                $color = '#70cc06';
                            } elseif ($estatus == 'Baja' or $estatus == 'Suspendido') {
                                $color = '#FF4444';
                            } elseif ($estatus == 'Incapacitado' or $estatus == 'En proceso') {
                                $color = '#FFDD33';
                            } elseif ($estatus == 'Finalizado') {
                                $color = '#444';
                            }
                            echo ("<td style='background-color: $color; color: #fff'>$estatus</td>");
                            echo "</tr>";
                        }
                        mysqli_close($conn);
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                <div class="tab-pane" id="tab-3">
                    <section id="contact" class="card2">
                        <div class="container-fluid">
                            <div class="section-title">
                                <div class="section-title">
                                    <h3>EDUCACIÓN DUAL</h3>
                                    <h1 style="font-size: 55px !important; font-weight:800 !important;">INSTRUCTORES EN LA EMPRESA</h1>
                                    <hr>
                                </div>
                                <table id="instructoresTable" class="table table-responsive-sm text-center table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Instructor</th>
                                            <th>Cantidad de alumnos asignados</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                    include("templates/conexion.php");
                    
                    $queryInstructores = "SELECT idInstructor, apellidos, nombres FROM instructores WHERE idEmpresa = '$idEmpresa'";
                    $resultadoInstructores = mysqli_query($conn, $queryInstructores);
                    while ($row = mysqli_fetch_assoc($resultadoInstructores)) {
                        echo "<tr>";
                        echo "<td>" . $row['idInstructor'] . "</td>";
                        echo "<td>" . $row['apellidos'] . ' ' . $row['nombres'] . "</td>";
                        
                        // Consulta para obtener la cantidad de alumnos con el mismo idInstructor
                        $idInstructor = $row['idInstructor'];
                        $queryCantidadAlumnos = "SELECT COUNT(*) AS cantidad FROM alumnos WHERE idInstructor = '$idInstructor'";
                        $resultadoCantidadAlumnos = mysqli_query($conn, $queryCantidadAlumnos);
                        $rowCantidadAlumnos = mysqli_fetch_assoc($resultadoCantidadAlumnos);
                        $cantidadAlumnos = $rowCantidadAlumnos['cantidad'];
                        
                        echo "<td>" . $cantidadAlumnos . "</td>";
                        echo "<td>    <a class='btn btn-primary btn-sm mr-1' href='secciones/instructores/alumnos_asignados.php?idInstructor=$row[idInstructor]'>Ver alumnos asignados</a></td>";
                        echo "</tr>";
                    }
                    mysqli_close($conn);
                    ?>
                                    </tbody>
                                </table>
                            </div>
                    </section>
                </div>
                <div class="tab-pane" id="tab-4">
                    <section class="card2">
                        <div class="container-fluid">
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
                                px;
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
                                width: 120px !important;
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
                INNER JOIN empresas e ON r.empresa = e.nombreEmp
                WHERE r.empresa = e.nombreEmp AND e.idEmpresa = '$idEmpresa' AND r.estatus_tutor = 'sin_revisar' AND r.estatus_instructor = 'sin_revisar' ORDER BY r.idReporte DESC";
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
                INNER JOIN empresas e ON r.empresa = e.nombreEmp
                WHERE r.empresa = e.nombreEmp AND e.idEmpresa = '$idEmpresa' AND r.estatus_tutor = 'no_aprobado' OR r.estatus_instructor = 'no_aprobado' OR (r.estatus_instructor = 'aprobado' AND r.estatus_tutor = 'sin_revisar') OR (r.estatus_instructor = 'sin_revisar' AND r.estatus_tutor = 'aprobado') ORDER BY idReporte DESC";
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
                INNER JOIN empresas e ON r.empresa = e.nombreEmp
                WHERE r.empresa = e.nombreEmp AND e.idEmpresa = '$idEmpresa' AND r.estatus_tutor = 'aprobado' AND r.estatus_instructor = 'aprobado' ORDER BY r.idReporte DESC";
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
                                                                var retroTutor = element.getAttribute(
                                                                    'data-retro-tutor');
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
    <!-- Bootstrap JS -->

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
    <script>
    $(document).ready(function() {
        $("#instructoresTable").DataTable({
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
        $("#alumnosTable").DataTable({
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