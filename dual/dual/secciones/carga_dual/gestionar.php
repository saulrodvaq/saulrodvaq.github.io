<?php
include("../../templates/conexion.php");


// Obtener el ID de la empresa actual
$idEmpresa = $_GET['idEmpresa'];

// Obtener el nombre de la empresa actual
$queryEmpresa = "SELECT nombreEmp FROM empresas WHERE idEmpresa = $idEmpresa";
$resultEmpresa = mysqli_query($conn, $queryEmpresa);
$rowEmpresa = mysqli_fetch_assoc($resultEmpresa);
$nombreEmpresa = $rowEmpresa['nombreEmp'];

$query = "SELECT instructores.*, COUNT(alumnos.idAlumno) AS cantidad_alumnos 
          FROM instructores LEFT JOIN alumnos ON instructores.idInstructor = alumnos.idInstructor
          WHERE instructores.idEmpresa = $idEmpresa
          GROUP BY instructores.idInstructor";
$resultInstructores = mysqli_query($conn, $query);

// Obtener los alumnos de la empresa actual
$query = "SELECT * FROM alumnos WHERE idEmpresa = $idEmpresa";
$resultAlumnos = mysqli_query($conn, $query);

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

    <title>Gestión</title>
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
    <link href="../../assets/vendor/datatables/datatables.min.css" rel="stylesheet">

    <link href="../../assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
                    <li><a class="scrollto efectoboton" href="matriz.php?idEmpresa=<?php echo $idEmpresa; ?>">Matriz</a>
                    </li>
                    <li><a class="scrollto efectoboton" href="carga_dual.php">Regresar</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <main>
        <div class="text-center">
            <br>
            <br>
            <h1 style="font-size: 68px; font-weight: 800;"><?php echo $nombreEmpresa; ?></h1>
        </div>

        <section class="contact">
            <main class="container" style="max-width: 100% !important">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title text-center">Instructores</h1>
                                <table id="instructores-table" class="table table-hover w-100 text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Instructor</th>
                                            <th>Cantidad de alumnos asignados</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($resultInstructores)) { ?>
                                        <tr>
                                            <td><?php echo $row['idInstructor']; ?></td>
                                            <td><?php echo $row['apellidos'] . ' ' . $row['nombres']; ?></td>
                                            <td><?php echo $row['cantidad_alumnos']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title text-center">Alumnos</h1>
                                <table id="alumnos-table" class="table table-hover w-100 text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Alumno</th>
                                            <th>Instructor</th>
                                            <th>Cambiar instructor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($resultAlumnos)) { ?>
                                        <tr>
                                            <td><?php echo $row['idAlumno']; ?></td>
                                            <td><?php echo $row['apellidos'] . ' ' . $row['nombres']; ?></td>
                                            <td>
                                                <?php
                                                    $instructorFound = false;
                                                    mysqli_data_seek($resultInstructores, 0); // Reiniciar el puntero del resultado de los instructores
                                                    while ($instructor = mysqli_fetch_assoc($resultInstructores)) {
                                                        if ($instructor['idInstructor'] == $row['idInstructor']) {
                                                            echo $instructor['apellidos'] . ' ' . $instructor['nombres'];
                                                            $instructorFound = true;
                                                            break;
                                                        }
                                                    }

                                                    if (!$instructorFound) {
                                                        echo "Aún no tiene un instructor asignado.";
                                                    }
                                                    ?>
                                            </td>
                                            <td>
                                                <form method="POST" action="cambiar_instructor.php">
                                                    <input type="hidden" name="alumnoId"
                                                        value="<?php echo $row['idAlumno']; ?>">
                                                    <select name="nuevoInstructor">
                                                        <option value="0">...</option>
                                                        <!-- Opción vacía o "..." por defecto -->
                                                        <?php
    mysqli_data_seek($resultInstructores, 0); // Reiniciar el puntero del resultado de los instructores
    while ($instructor = mysqli_fetch_assoc($resultInstructores)) {
        $selected = ($instructor['idInstructor'] == $row['idInstructor']) ? 'selected' : '';
        echo '<option value="' . $instructor['idInstructor'] . '" ' . $selected . '>' . $instructor['apellidos'] . ' ' . $instructor['nombres'] . '</option>';
    }
    ?>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </section>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <?php include("../../templates/footer.php"); ?>

        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="../../assets/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="../../assets/vendor/php-email-form/validate.js"></script>
        <script src="../../assets/vendor/datatables/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Template Main JS File -->
        <script src="../../assets/js/main.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#instructores-table').DataTable({
                lengthMenu: [
                    [5, 10, 15, 25, 50],
                    [5, 10, 15, 25, 50]
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                }
            });
            $('#alumnos-table').DataTable({
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