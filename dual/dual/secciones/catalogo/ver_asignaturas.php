<?php
session_start(); // Inicia la sesión si no ha sido iniciada antes

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header('Location: login.php');
    exit;
}

if (!esAdmin($_SESSION['usuario'])) {
    echo "No estás autorizado para acceder a esta página.";
    exit;
}

function esAdmin($usuario) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dual_bd";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $query = "SELECT * FROM administradores WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conn, $query);
    $esAdmin = mysqli_num_rows($resultado) > 0;
    mysqli_close($conn);
    return $esAdmin;
}

include("../../templates/conexion.php");
  // Obtener el ID de la carrera desde la URL
if (isset($_GET['idCarrera'])) {
    $idCarrera = $_GET['idCarrera'];
  } else {
    // Si no se proporciona un ID de carrera válido, redirigir a la página anterior
    header('Location: catalogo.php');
    exit;
  }
    // Consulta SQL para obtener las carreras
  // Consulta SQL para obtener la carrera seleccionada por ID
$sql_carrera = "SELECT nombre AS nombreCarrera FROM carreras WHERE idCarrera = $idCarrera";
$resultado_carrera = mysqli_query($conn, $sql_carrera);

// Verifica si la consulta retornó resultados
if ($resultado_carrera && mysqli_num_rows($resultado_carrera) > 0) {
    // Obtener el primer registro del conjunto de resultados
    $fila_carrera = mysqli_fetch_assoc($resultado_carrera);
    // Guardar el valor del campo 'nombreCarrera'
    $nombreCarrera = $fila_carrera['nombreCarrera'];
} else {
    // Si no hay resultados, imprime un mensaje de error o realiza alguna otra acción adecuada.
    error_log("No se encontró la carrera con ID $idCarrera");
    $nombreCarrera = "Carrera no encontrada";
}
error_log("Valor de \$idCarrera: " . $idCarrera);

// Realiza la consulta SQL y verifica si hay resultados
$sql_asignaturas = "SELECT asignaturas.idAsignatura, asignaturas.nombre AS nombreAsignatura, asignaturas.competencia, cuatrimestres.nombre AS nombreCuatrimestre, carreras.nombre AS nombreCarrera
                   FROM asignaturas
                   INNER JOIN cuatrimestres ON asignaturas.idCuatrimestre = cuatrimestres.idCuatrimestre
                   INNER JOIN carreras ON asignaturas.idCarrera = carreras.idCarrera
                   WHERE asignaturas.idCarrera = $idCarrera";
$resultado = mysqli_query($conn, $sql_asignaturas);

// Verifica si la consulta retornó resultados
if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Obtener el primer registro del conjunto de resultados
    $fila_primera_asignatura = mysqli_fetch_assoc($resultado);
    // Guardar el valor del campo 'nombreCarrera'
    $nombreCarrera = $fila_primera_asignatura['nombreCarrera'];
} else {
    // Si no hay resultados, imprime un mensaje de error o realiza alguna otra acción adecuada.
    error_log("No se encontraron asignaturas para la carrera con id $idCarrera");
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Asignaturas</title>
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
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <link href="../../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <link href="../../assets/css/style_login.scss" rel="stylesheet">

</head>

<body>
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/dual/index.php" class="logo"><img src="../../assets/img/log-bar2.png" alt=""
                    class="img-fluid"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link efectoboton scrollto" href="agregar_asignatura.php?idCarrera=<?php echo $idCarrera; ?>">Agregar asignatura</a>
                    </li>
                    <li><a class="nav-link efectoboton scrollto" href="catalogo.php">Regresar</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header>


    <main class="container mt-4" style="max-width: 1600px;">
        <div class="container">
            </br>
            </br>
            <h1 class="mb-4 text-center" style="font-size: 68px; font-weight:800;">Asignaturas</h1>
            <p class="text-center" style="font-size: 24px;"><?php echo $nombreCarrera;?></p>
            </br>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-center table-hover">
                    <table class="table table-responsive-sm text-center table-hover"
                        style="text-align: center !important;" id="tabla_id">
                        <thead>
                            <tr>
                                <th>Asignatura</th>
                                <th>Cuatrimestre</th>
                                <th>Competencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($fila_asignaturas = mysqli_fetch_assoc($resultado)) { ?>
                            <tr>
                                <td><?php echo $fila_asignaturas['nombreAsignatura']; ?></td>
                                <td><?php echo $fila_asignaturas['nombreCuatrimestre']; ?></td>
                                <td><?php echo $fila_asignaturas['competencia']; ?></td>
                                <td>
                                    <div class='btn-group'>
                                    <a class='btn btn-secondary btn-sm mr-1' href="editar_asignatura.php?idAsignatura=<?php echo $fila_asignaturas['idAsignatura']; ?>&idCarrera=<?php echo $idCarrera; ?>">Editar</a>
                                        |
                                        <a class='btn btn-danger btn-sm mr-1'
                                            href="borrar_asignatura.php?idAsignatura=<?php echo $fila_asignaturas['idAsignatura']; ?>"
                                            onclick='confirmarEliminacion(event)'>Eliminar</a>
                                    </div>
                                    <script>
                                    function confirmarEliminacion(event) {
                                        event.preventDefault();

                                        Swal.fire({
                                            title: '¿Estás seguro?',
                                            text: 'Esta acción no se puede deshacer',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Sí, eliminar',
                                            cancelButtonText: 'Cancelar'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = event.target.href;
                                            }
                                        });
                                    }
                                    </script>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    </br></br></br></br></br></br>
    <?php 
include("../../templates/footer.php");
?>
    <!-- Vendor JS Files -->
    <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Tu archivo main.js -->
    <script src="../../assets/js/main.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script src="../../gestion/js/bootstrap.bundle.js"></script>
    <script>
    $(document).ready(function() {
        $("#tabla_id").DataTable({
            "pageLength": 15,
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