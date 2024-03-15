<?php
include("../../templates/conexion.php");
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
if (isset($_GET['idCarrera'])) {
    $idCarrera = $_GET['idCarrera'];
  } else {
    // Si no se proporciona un ID de carrera válido, redirigir a la página anterior
    header('Location: catalogo.php');
    exit;
  }
  // Paso 1: Obtener los cuatrimestres de la base de datos
$query_cuatrimestres = "SELECT idCuatrimestre, nombre FROM cuatrimestres";
$result_cuatrimestres = $conn->query($query_cuatrimestres);

// Verificamos si la consulta se realizó correctamente
if (!$result_cuatrimestres) {
    die("Error al obtener los cuatrimestres: " . $conn->error);
}

// Paso 2: Almacenar los cuatrimestres en un array para generar las opciones del select
$cuatrimestres = array();
while ($row = $result_cuatrimestres->fetch_assoc()) {
    $cuatrimestres[$row['idCuatrimestre']] = $row['nombre'];
}
// Obtener los datos de la asignatura actual (reemplaza "idAsignaturaActual" con el nombre correcto de la columna que contiene el ID de la asignatura actual en tu tabla de asignaturas)
$idAsignaturaActual = $_GET['idAsignatura']; // Suponiendo que el ID de la asignatura actual se obtiene de la URL
$query_asignatura_actual = "SELECT * FROM asignaturas WHERE idAsignatura = '$idAsignaturaActual'";
$result_asignatura_actual = $conn->query($query_asignatura_actual);

// Verificar si la consulta se realizó correctamente
if (!$result_asignatura_actual) {
    die("Error al obtener los datos de la asignatura actual: " . $conn->error);
}

// Verificamos si se encontró algún resultado en la consulta
if ($result_asignatura_actual->num_rows > 0) {
    // Obtenemos los datos de la asignatura actual y los guardamos en la variable $asignatura_actual
    $asignatura_actual = $result_asignatura_actual->fetch_assoc();
    $nombre_asignatura_actual = $asignatura_actual['nombre'];
    $idCuatrimestre_asignatura_actual = $asignatura_actual['idCuatrimestre'];
    $competencia_asignatura_actual = $asignatura_actual['competencia'];
} else {
    // Manejar el caso en el que la asignatura actual no se encontró en la base de datos
    die("Asignatura no encontrada");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Editar Asignatura</title>
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
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/dual/index.php" class="logo"><img src="/dual/assets/img/log-bar2.png" alt=""
                    class="img-fluid"></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="scrollto efectoboton" href="ver_asignaturas.php?idCarrera=<?php echo $idCarrera; ?>">Regresar</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <!-- Formulario para editar los datos del usuario -->
    <div class="container">
        <br />
        <br />
        <h1 class="mb-4 text-center" style="font-size: 68px; font-weight:800;">Actualizar asignatura</h1>
        <hr>
        <form method="post" action="mensaje_asignaturas.php">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <input type="text" class="form-control mb-3" name="nombre" value="<?php echo $nombre_asignatura_actual; ?>">

<select class="form-control form-select mb-3" name="idCuatrimestre">
    <?php
    foreach ($cuatrimestres as $id => $nombre) {
        $selected = ($idCuatrimestre_asignatura_actual == $id) ? "selected" : "";
        echo "<option value=\"$id\" $selected>$nombre</option>";
    }
    ?>
</select>

<textarea class="form-control mb-3" name="competencia" rows="4"><?php echo $competencia_asignatura_actual; ?></textarea>

                    <input type="hidden" name="idCarrera" value="<?php echo $idCarrera; ?>">

                    <div class="d-flex justify-content-center">
                        <a href="ver_asignaturas.php?idCarrera=<?php echo $idCarrera; ?>" class="btn btn-danger mx-1"
                            boton class="boton boton1">Cancelar</a>
                        <input type="submit" class="btn btn-primary mx-1" value="Agregar">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br />
    <br />
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


    <script src="../../gestion/js/bootstrap.bundle.js"></script>
    <script src="../../gestion/js/bootstrap.bundle.js"></script>
</body>

</html>