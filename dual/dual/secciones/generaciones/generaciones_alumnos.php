<?php
include("../../templates/conexion.php");

// Obtener el ID de la generación actual
$generacionId = $_GET['idGeneracion'];

// Obtener la información de la generación actual
$queryGeneracion = "SELECT * FROM generaciones WHERE idGeneracion = $generacionId";
$resultGeneracion = mysqli_query($conn, $queryGeneracion);
$rowGeneracion = mysqli_fetch_assoc($resultGeneracion);

$anioGeneracion = $rowGeneracion['anio'];
$cuatrimestreGeneracion = $rowGeneracion['cuatrimestre'];

// Obtener los alumnos de la generación actual
$queryAlumnos = "SELECT * FROM alumnos WHERE ingreso BETWEEN ? AND ?";
$stmt = mysqli_prepare($conn, $queryAlumnos);

$fechaInicio = obtenerFechaInicio($anioGeneracion, $cuatrimestreGeneracion);
$fechaFin = obtenerFechaFin($anioGeneracion, $cuatrimestreGeneracion);

mysqli_stmt_bind_param($stmt, "ss", $fechaInicio, $fechaFin);
mysqli_stmt_execute($stmt);
$resultAlumnos = mysqli_stmt_get_result($stmt);

// Función para obtener la fecha de inicio de la generación
function obtenerFechaInicio($anioGeneracion, $cuatrimestreGeneracion)
{
    if ($cuatrimestreGeneracion == 1) {
        return $anioGeneracion . "-01-01";
    } elseif ($cuatrimestreGeneracion == 2) {
        return $anioGeneracion . "-05-01";
    } elseif ($cuatrimestreGeneracion == 3) {
        return $anioGeneracion . "-09-01";
    }
}

// Función para obtener la fecha de fin de la generación
function obtenerFechaFin($anioGeneracion, $cuatrimestreGeneracion)
{
    if ($cuatrimestreGeneracion == 1) {
        return $anioGeneracion . "-04-30";
    } elseif ($cuatrimestreGeneracion == 2) {
        return $anioGeneracion . "-08-31";
    } elseif ($cuatrimestreGeneracion == 3) {
        return $anioGeneracion . "-12-31";
    }
}

session_start(); // Inicia la sesión si no ha sido iniciada antes

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header('Location: /dual/login.php');
    exit;
}

// Luego, obtenemos los datos del usuario actual utilizando su usuario
$usuario = $_SESSION['usuario']; // Obtén el usuario del usuario actual de la sesión
$query = "SELECT *, idAdministrador FROM administradores WHERE usuario = '$usuario'";
$result = $conn->query($query);

// Verificamos si la consulta se realizó correctamente
if (!$result) {
    die("Error al obtener los datos del usuario: " . $conn->error);
}

// Verificamos si se encontró algún resultado en la consulta
if ($result->num_rows > 0) {
    // Obtenemos los datos del usuario y los guardamos en la variable $usuario
    $usuario = $result->fetch_assoc();
    $_SESSION['idAdministrador'] = $usuario['idAdministrador'];
    // Cerramos la conexión a la base de datos

    // Verificamos si la variable $usuario tiene datos antes de acceder a sus índices
    if ($usuario) {
        $nombres = $usuario['nombres'];
    } else {
        // Manejar el caso en el que $usuario es nulo
        die("Usuario no encontrado");
    }
} else {
    // Manejar el caso en el que no se encontraron resultados
    die("Usuario no encontrado");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Ver Generación</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../assets/img/utsc_dual_logo.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="../../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/dual/index.php" class="logo"><img src="../../assets/img/log-bar2.png" alt=""
                    class="img-fluid"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="scrollto efectoboton" href="generaciones.php">Regresar</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>

    <main>
    <div class="text-center">
        <br>
        <br>
        <h1 style="font-size: 68px; font-weight:800;">Alumnos de la Generación</h1>
        <h2><?php echo "Generación $cuatrimestreGeneracion-$anioGeneracion"; ?></h2>
        <p><?php echo obtenerMesesCuatrimestre($cuatrimestreGeneracion); ?></p>
    </div>

    <?php
function obtenerMesesCuatrimestre($cuatrimestre) {
    $meses = '';
    
    switch ($cuatrimestre) {
        case 1:
            $meses = 'Enero - Febrero - Marzo - Abril';
            break;
        case 2:
            $meses = 'Mayo - Junio - Julio - Agosto';
            break;
        case 3:
            $meses = 'Septiembre - Octubre - Noviembre - Diciembre';
            break;
        default:
            $meses = '';
            break;
    }

    return $meses;
}
?>
        <section class="contact">
            <main class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="alumnos-table" class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Alumno</th>
                                            <th>Estatus</th>
                                            <th>Fecha de Ingreso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($resultAlumnos)) { ?>
                                        <tr>
                                            <td><?php echo $row['idAlumno']; ?></td>
                                            <td><?php echo $row['apellidos'] . ' ' .  $row['nombres']; ?></td>
                                            <td style="color: #fff; background-color: <?php echo obtenerColorEstatus($row['estatus_alumno']); ?>;">
                <?php echo $row['estatus_alumno']; ?>
                                            <td><?php echo $row['ingreso']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php
function obtenerColorEstatus($estatus) {
    $color = '';

    if ($estatus == 'Activo') {
        $color = '#70cc06';
    } elseif ($estatus == 'Baja' || $estatus == 'Suspendido') {
        $color = '#FF4444';
    } elseif ($estatus == 'Incapacitado' || $estatus == 'En proceso') {
        $color = '#FFDD33';
    } elseif ($estatus == 'Finalizado') {
        $color = '#444';
    }

    return $color;
}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </section>
    </main>

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

    .dataTables_wrapper .dataTables_length select {
        padding-right: 30px;
    }

    .table td {
        padding: 20px !important;
        /* Ajusta el espacio en blanco según tus necesidades */
        background: #fff;
    }

    .table th {
        text-align: center !important;
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

    .fijo-column {
        width: 130px !important;
    }
    </style>
    <!-- Vendor JS Files -->
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../assets/vendor/waypoints/noframework.waypoints.js"></script>

    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#alumnos-table').DataTable({
            "pageLength": 5,
            "lengthMenu": [
                [5, 10, 15, 25, 50],
                [5, 10, 15, 25, 50]
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
            }
        });
    });
    </script>

    <script src="../../assets/vendor/php-email-form/validate.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>

</html>