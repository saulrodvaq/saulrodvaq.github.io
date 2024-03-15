<?php
include("../../templates/conexion.php");

if (isset($_GET["idDocente"])) {
    $idDocente = $_GET["idDocente"];
    $query = "SELECT * FROM docentes WHERE idDocente = $idDocente";
    $resultado = mysqli_query($conn, $query);
    $docente = mysqli_fetch_assoc($resultado);
}

$query_alumnos_asignados = "SELECT a.* FROM alumnos a INNER JOIN alumnos_docentes ad ON a.idAlumno = ad.idAlumno WHERE ad.idDocente = $idDocente";
$resultado_alumnos_asignados = mysqli_query($conn, $query_alumnos_asignados);

$query_alumnos_sin_docente = "SELECT a.* FROM alumnos a LEFT JOIN alumnos_docentes ad ON a.idAlumno = ad.idAlumno WHERE ad.idDocente IS NULL";
$resultado_alumnos_sin_docente = mysqli_query($conn, $query_alumnos_sin_docente);

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

    <title>Vinculación</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/dual/index.php" class="logo"><img src="../../assets/img/log-bar2.png" alt=""
                    class="img-fluid"></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="scrollto efectoboton" href="docentes.php">Regresar</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <main>
        <div class="text-center">
        </div>

        <section class="contact">
            <main class="container" style="max-width: 100% !important">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title text-center">Alumnos asignados al docente</h1>
                                <table id="tabla-alumnos-asignados" class="display">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Alumno</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($alumno_asignado = mysqli_fetch_assoc($resultado_alumnos_asignados)) {
                                            echo "<tr>";
                                            echo "<td>" . $alumno_asignado['idAlumno'] . "</td>";
                                            echo "<td>" . $alumno_asignado['apellidos'] . ' ' . $alumno_asignado['nombres'] . "</td>";
                                            echo "<td><button class='btn btn-secondary btn-desasignar' data-id='" . $alumno_asignado['idAlumno'] . "' data-url='" . $_SERVER['PHP_SELF'] . "?idDocente=" . $idDocente . "'>Desasignar</button></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title text-center">Alumnos no asignados al docente</h1>
                                <table id="tabla-alumnos-sin-docente" class="display">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Alumno</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($alumno_sin_docente = mysqli_fetch_assoc($resultado_alumnos_sin_docente)) {
                                            echo "<tr>";
                                            echo "<td>" . $alumno_sin_docente['idAlumno'] . "</td>";
                                            echo "<td>" . $alumno_sin_docente['apellidos'] . ' ' . $alumno_sin_docente['nombres'] . "</td>";
                                            echo "<td><button class='btn btn-primary btn-asignar' data-id='" . $alumno_sin_docente['idAlumno'] . "' data-url='" . $_SERVER['PHP_SELF'] . "?idDocente=" . $idDocente . "'>Asignar</button></td>";
                                            echo "</tr>";
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
        <?php
                    include("../../templates/footer.php");
                    ?>
        <script>
        $(document).ready(function() {
            // Configuración de las tablas de alumnos asignados al docente
            var tablaAlumnosAsignados = $('#tabla-alumnos-asignados').DataTable({
                "paging": true,
                "lengthChange": true,
                "lengthMenu": [5, 10, 15, 25, 50],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });

            // Configuración de las tablas de alumnos no asignados al docente
            var tablaAlumnosSinDocente = $('#tabla-alumnos-sin-docente').DataTable({
                "paging": true,
                "lengthChange": true,
                "lengthMenu": [5, 10, 15, 25, 50],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });

            // Evento de clic en botón Desasignar
            $('#tabla-alumnos-asignados').on('click', '.btn-desasignar', function() {
                var idAlumno = $(this).data('id');
                desasignarAlumno(idAlumno);
            });

            // Evento de clic en botón Asignar
            $('#tabla-alumnos-sin-docente').on('click', '.btn-asignar', function() {
                var idAlumno = $(this).data('id');
                asignarAlumno(idAlumno);
            });

            // Función para desasignar un alumno
            function desasignarAlumno(idAlumno) {
                $.ajax({
                    url: 'desasignar_alumno.php',
                    method: 'POST',
                    data: {
                        idAlumno: idAlumno
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                text: response.message,
                                allowOutsideClick: false
                            }).then(function(result) {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.message,
                                allowOutsideClick: false
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Función para asignar un alumno
            function asignarAlumno(idAlumno) {
                $.ajax({
                    url: 'asignar_alumno.php',
                    method: 'POST',
                    data: {
                        idAlumno: idAlumno,
                        idDocente: <?php echo $idDocente; ?>
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                text: response.message,
                                allowOutsideClick: false
                            }).then(function(result) {
                                if (response.reload) {
                                    location.reload();
                                } else {
                                    tablaAlumnosSinDocente.clear().draw();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.message,
                                allowOutsideClick: false
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
        </script>

        <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="../../assets/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="../../assets/vendor/php-email-form/validate.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/js/main.js"></script>
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
</body>

</html>