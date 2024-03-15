<?php
include("../../templates/conexion.php");

// Obtener los registros de la tabla de empresas
$query = "SELECT * FROM empresas";
$result = mysqli_query($conn, $query);

// Obtener el número total de empresas
$totalEmpresas = mysqli_num_rows($result);

// Número de resultados por página
$resultadosPorPagina = 6;

// Calcular el número total de páginas
$totalPaginas = ceil($totalEmpresas / $resultadosPorPagina);

// Obtener la página actual
if (isset($_GET['page'])) {
    $paginaActual = $_GET['page'];
} else {
    $paginaActual = 1;
}

// Calcular el índice inicial y final de los resultados
$indiceInicio = ($paginaActual - 1) * $resultadosPorPagina;
$indiceFinal = $indiceInicio + $resultadosPorPagina;

// Búsqueda por nombre
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $nombreBusqueda = $_GET['search'];
    $query .= " WHERE nombreEmp LIKE '%$nombreBusqueda%'";
    $result = mysqli_query($conn, $query);
    $totalEmpresas = mysqli_num_rows($result);
    $totalPaginas = ceil($totalEmpresas / $resultadosPorPagina);
}

// Consulta para obtener las empresas paginadas
$queryPaginado = "$query LIMIT $indiceInicio, $resultadosPorPagina";
$resultPaginado = mysqli_query($conn, $queryPaginado);

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

    <title>Carga Dual</title>
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

    <link href="../../assets/css/style.css" rel="stylesheet">

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
                    <li><a class="scrollto efectoboton" href="../../menu_admin.php">Regresar</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main>
        <div class="text-center">
            <br>
            <br>
            <h1 style="font-size: 68px; font-weight:800;">Carga Dual</h1>
        </div>

        <style>
        .cantidad {
            font-size: 90px
        }

        .cuadro {
            transition: transform 0.3s ease;
        }

        .cuadro:hover {
            transform: scale(1.05);
        }

        .pagination {
            --bs-pagination-padding-x: 0.80rem;
            --bs-pagination-padding-y: 0.375rem;
            --bs-pagination-font-size: 1.5rem;
            --bs-pagination-color: #e4771d;
            --bs-pagination-bg: #ff9a48;
            --bs-pagination-border-width: 3.5px;
            --bs-pagination-border-color: #fff;
            --bs-pagination-border-radius: 0.4rem;
            --bs-pagination-hover-color: #e4771d;
            --bs-pagination-hover-bg: #ff9a48;
            --bs-pagination-hover-border-color: #e4771d;
            --bs-pagination-focus-color: #e4771d;
            --bs-pagination-focus-bg: #ff9a48;
            --bs-pagination-focus-box-shadow: #e4771d;
            --bs-pagination-active-color: #fff;
            --bs-pagination-active-bg: #ff9a48;
            --bs-pagination-active-border-color: #e4771d;
            --bs-pagination-disabled-color: #ff9a48;
            --bs-pagination-disabled-bg: #fff;
            --bs-pagination-disabled-border-color: #e4771d;
            display: flex;
            padding-left: 0;
            list-style: none;
        }
        </style>
        <script>
        var cuadros = document.querySelectorAll('.cuadro');

        // Iterar sobre cada cuadro y agregar el evento de mouseover
        cuadros.forEach(function(cuadro) {
            cuadro.addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.05)';
            });

            // Agregar el evento de mouseout para volver al tamaño original
            cuadro.addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
            });
        });
        </script>

        <section class="contact">
            <!-- Agregar el buscador -->
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Buscar por nombre">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Agregar la paginación -->
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php
                                // Mostrar los enlaces de paginación
                                for ($i = 1; $i <= $totalPaginas; $i++) {
                                    $activeClass = ($i == $paginaActual) ? "active" : "";
                                ?>
                            <li class="page-item <?php echo $activeClass; ?>"><a class="page-link"
                                    href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                                }
                                ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <main class="container">

                <div class="row mb-2">
                    <?php
                    // Recorrer los registros de la tabla de empresas paginados
                    while ($row = mysqli_fetch_assoc($resultPaginado)) {
                        // Obtener el número de alumnos para la empresa actual
                        $idEmpresa = $row['idEmpresa'];
                        $queryAlumnos = "SELECT COUNT(*) AS cantidadAlumnos FROM alumnos WHERE idEmpresa = $idEmpresa";
                        $resultAlumnos = mysqli_query($conn, $queryAlumnos);
                        $rowAlumnos = mysqli_fetch_assoc($resultAlumnos);
                        $cantidadAlumnos = $rowAlumnos['cantidadAlumnos'];

                        // Obtener el número de instructores para la empresa actual
                        $queryInstructores = "SELECT COUNT(*) AS cantidadInstructores FROM instructores WHERE idEmpresa = $idEmpresa";
                        $resultInstructores = mysqli_query($conn, $queryInstructores);
                        $rowInstructores = mysqli_fetch_assoc($resultInstructores);
                        $cantidadInstructores = $rowInstructores['cantidadInstructores'];
                        
                        $queryFormadores = "SELECT apellidos, nombres FROM formadores WHERE idEmpresa = $idEmpresa";
                        $resultFormadores = mysqli_query($conn, $queryFormadores);
                        // Agregar el enlace de redirección con el ID de la empresa como parámetro
                        $empresaId = $row['idEmpresa'];
                        $gestionarUrl = "gestionar.php?idEmpresa=" . $empresaId;
                    ?>
                    <div class="col-md-6">
                        <div
                            class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative cuadro">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-success"><?php echo $cantidadInstructores; ?>
                                    Instructores</strong>
                                <h3 class="mb-0"><?php echo $row['nombreEmp']; ?></h3>
                                <div class="mb-1 text-muted">Ingreso: <?php echo $row['ingreso']; ?></div>
                                <?php
// Mostrar los apellidos y nombres de los formadores
if (mysqli_num_rows($resultFormadores) > 0) {
    while ($rowFormadores = mysqli_fetch_assoc($resultFormadores)) {
        $apellidos = $rowFormadores['apellidos'];
        $nombres = $rowFormadores['nombres'];
        echo '<div class="mb-1 text-muted">Formador Dual: ' . $apellidos . ' ' . $nombres . '</div>';
    }
} else {
    echo '<div class="mb-1 text-muted">Formador Dual no asignado</div>';
}
?>
                                <p class="mb-auto"><?php echo $row['razon_social']; ?></p>
                                <!-- Actualizar el enlace con la URL de redirección -->
                                <a href="<?php echo $gestionarUrl; ?>" class="stretched-link">Click para gestionar</a>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <svg class="bd-placeholder-img" width="200" height="250"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#70cc06" />
                                    <text class="cantidad" x="50%" y="50%" fill="#fff"
                                        dy=".10em"><?php echo $cantidadAlumnos; ?></text>
                                    <text x="50%" y="80%" fill="#fff" dy=".3em">Alumnos</text>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>


            </main>
        </section>

        <?php
        include("../../templates/footer.php");
        ?>

        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="../../assets/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="../../assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="../../assets/js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>