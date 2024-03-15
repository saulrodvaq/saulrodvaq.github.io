<?php
include("../../templates/conexion.php");
session_start(); // Inicia la sesión si no ha sido iniciada antes
if(isset($_GET["idInstructor"])) {
    // Obtener el valor del campo idInstructor de la URL
    $idInstructor = $_GET["idInstructor"];

    // Consulta para obtener los datos del instructor correspondiente
    $query = "SELECT * FROM instructores WHERE idInstructor = $idInstructor";
    $resultado = mysqli_query($conn, $query);
    $instructor = mysqli_fetch_assoc($resultado);
}
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header('Location: /dual/login.php');
    exit;
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
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
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
                    <li><a class="scrollto efectoboton" href="../../menu_formador.php">Regresar</a></li>
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
            <div class="tab-pane active show" id="tab-2">
            <h1 class="mb-4 text-center" style="font-size: 68px; font-weight:800;">Alumnos asignados al instructor</h1>
                    <section id="contact" class="card">
                        <div class="container-fluid">
                            <div class="table-responsive text-center table-hover">

                                <table class="table table-responsive-sm text-center table-hover" id="tabla_id">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Alumno</th>
                                            <th>Cantidad de reportes</th>
                                            <th>Tutor académico</th>
                                            <th>Instructor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
        $query_alumnos_asignados = "SELECT * FROM alumnos WHERE idInstructor = $idInstructor";
        $resultado_alumnos_asignados = mysqli_query($conn, $query_alumnos_asignados);

        while ($alumno_asignado = mysqli_fetch_assoc($resultado_alumnos_asignados)) {
            $idAlumno = $alumno_asignado['idAlumno'];
            $query_reportes = "SELECT COUNT(*) AS total FROM reportes WHERE idAlumno = $idAlumno";
            $resultado_reportes = mysqli_query($conn, $query_reportes);
            $row_reportes = mysqli_fetch_assoc($resultado_reportes);
            $cantidad_reportes = $row_reportes['total'];

            $idTutor = $alumno_asignado['idTutor'];
            $query_tutor = "SELECT apellidos, nombres FROM tutores WHERE idTutor = $idTutor";
            $resultado_tutor = mysqli_query($conn, $query_tutor);
            $row_tutor = mysqli_fetch_assoc($resultado_tutor);
            $nombre_tutor = $row_tutor['apellidos'] . ' ' . $row_tutor['nombres'];

            $idInstructor = $alumno_asignado['idInstructor'];
            $query_instructor = "SELECT apellidos, nombres FROM instructores WHERE idInstructor = $idInstructor";
            $resultado_instructor = mysqli_query($conn, $query_instructor);
            $row_instructor = mysqli_fetch_assoc($resultado_instructor);
            $nombre_instructor = $row_instructor['apellidos'] . ' ' . $row_instructor['nombres'];

            echo "<tr>";
            echo "<td>" . $alumno_asignado['idAlumno'] . "</td>";
            echo "<td>" . $alumno_asignado['apellidos'] . ' ' . $alumno_asignado['nombres'] . "</td>";
            echo "<td>" . $cantidad_reportes . "</td>";
            echo "<td>" . $nombre_tutor . "</td>";
            echo "<td>" . $nombre_instructor . "</td>";
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
            // Configuración de las tablas de alumnos asignados al instructor
            var tablaAlumnosAsignados = $('#tabla-alumnos-asignados').DataTable({
                "paging": true,
                "lengthChange": true,
                "lengthMenu": [5, 10, 15, 25, 50],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            })
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

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <!-- Tu archivo main.js -->
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

        .fijo-column {
            width: 130px !important;
        }
        </style>

</body>

</html>