<?php
    include("../../templates/conexion.php");
    if(isset($_GET["idAlumno"])) {
        // Obtener el valor del campo idUsuario de la URL
        $idAlumno = $_GET["idAlumno"];

        // Consulta para obtener los datos del usuario correspondiente
        $query = "SELECT * FROM alumnos WHERE idAlumno = $idAlumno";
        $resultado = mysqli_query($conn, $query);
        $usuario = mysqli_fetch_assoc($resultado);
    }
    session_start(); // Inicia la sesión si no ha sido iniciada antes

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

    <title>Editar Alumnos</title>
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
                    <li><a class="scrollto efectoboton" href="alumnos.php">Regresar</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <!-- Formulario para editar los datos del usuario -->
    <div class="container">
        <br />
        <br />
        <h1 class="mb-4 text-center" style="font-size: 68px; font-weight:800;">Actualizar datos</h1>
        <hr>
        <form action="actualizar.php" method="POST">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <input type="hidden" class="form-control mb-3" name="idAlumno"
                        value="<?php echo $usuario['idAlumno']; ?>">

                    <label for="nombres">Nombre(s):</label>
                    <input type="text" class="form-control mb-3" name="nombres"
                        value="<?php echo $usuario['nombres']; ?>">

                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control mb-3" name="apellidos"
                        value="<?php echo $usuario['apellidos']; ?>">

                    <label for="matricula">Matrícula:</label>
                    <input type="text" class="form-control mb-3" name="matricula"
                        value="<?php echo $usuario['matricula']; ?>">

                    <label for="carrera">Carrera:</label>
                    <select class="form-select mb-3" name="carrera" id="country">
                        <option>...</option>
                        <option
                            <?php if ($usuario['carrera'] == 'Ingeniería en Desarrollo y Gestión de Software') echo 'selected'; ?>>
                            Ingeniería en Desarrollo y Gestión de Software</option>
                        <option <?php if ($usuario['carrera'] == 'Ingeniería en Mecatrónica') echo 'selected'; ?>>
                            Ingeniería en Mecatrónica</option>
                        <option
                            <?php if ($usuario['carrera'] == 'Ingeniería en Sistemas Productivos') echo 'selected'; ?>>
                            Ingeniería en Sistemas
                            Productivos</option>
                        <option
                            <?php if ($usuario['carrera'] == 'Ingeniería en Mantenimiento Industrial') echo 'selected'; ?>>
                            Ingeniería en Mantenimiento Industrial</option>
                        <option
                            <?php if ($usuario['carrera'] == 'Licenciatura en Innovación de Negocios y Mercadotecnia') echo 'selected'; ?>>
                            Licenciatura en Innovación de Negocios y Mercadotecnia</option>
                        <option
                            <?php if ($usuario['carrera'] == 'Licenciatura en Gestión Institucional Educativa y Curricular') echo 'selected'; ?>>
                            Licenciatura en Gestión Institucional Educativa y Curricular</option>
                        <option <?php if ($usuario['carrera'] == 'TSU en Lengua Inglesa') echo 'selected'; ?>>
                            TSU en Lengua Inglesa</option>
                        <option
                            <?php if ($usuario['carrera'] == 'TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma') echo 'selected'; ?>>
                            TSU en Tecnologías de la Información área Desarrollo de Software Multiplataforma</option>
                        <option
                            <?php if ($usuario['carrera'] == 'TSU en Desarrollo de Negocios área Mercadotecnia') echo 'selected'; ?>>
                            TSU en Desarrollo de Negocios área Mercadotecnia</option>
                        <option
                            <?php if ($usuario['carrera'] == 'TSU en Mantenimiento área Industrial') echo 'selected'; ?>>
                            TSU en Mantenimiento área Industrial</option>
                        <option
                            <?php if ($usuario['carrera'] == 'TSU en Procesos Industriales área Industrial') echo 'selected'; ?>>
                            TSU en Procesos Industriales área Manufactura</option>
                        <option
                            <?php if ($usuario['carrera'] == 'TSU en Mecatrónica área Automatización') echo 'selected'; ?>>
                            TSU en Mecatrónica área Automatización</option>
                    </select>

                    <label for="cuatrimestre">Cuatrimestre:</label>
                    <select class="form-select mb-3" name="cuatrimestre">
                        <option>...</option>
                        <?php
                        for ($i = 1; $i <= 11; $i++) {
                            $selected = ($usuario['cuatrimestre'] == $i) ? 'selected' : '';
                            echo "<option $selected>$i</option>";
                        }
                        ?>
                    </select>

                    <label>Empresa:</label>
                    <select class="form-select mb-3" name="empresa">
                        <?php
  // Realizar una consulta para obtener todas las empresas
  $queryEmpresas = "SELECT * FROM empresas";
  $respuestaEmpresas = mysqli_query($conn, $queryEmpresas);

  // Obtener el ID de la empresa del alumno actual
  $queryAlumnoEmpresa = "SELECT idEmpresa FROM alumnos WHERE idAlumno = $idAlumno";
  $respuestaAlumnoEmpresa = mysqli_query($conn, $queryAlumnoEmpresa);
  $filaAlumnoEmpresa = mysqli_fetch_assoc($respuestaAlumnoEmpresa);
  $idEmpresaAlumno = $filaAlumnoEmpresa['idEmpresa'];

  // Iterar sobre los resultados de la consulta y generar las opciones del select
  while ($empresa = mysqli_fetch_array($respuestaEmpresas)) {
    $idEmpresa = $empresa['idEmpresa'];
    $nombreEmpresa = $empresa['nombreEmp'];
    $selected = ($idEmpresa == $idEmpresaAlumno) ? 'selected' : '';
    echo "<option value=\"$idEmpresa\" $selected>$nombreEmpresa</option>";
  }
  ?>
                    </select>
                    </select>

                    <label>Ingreso:</label>
                    <input type="date" class="form-control mb-3" name="ingreso"
                        value="<?php echo $usuario['ingreso']; ?>">

                    <label for="fecha_fin">Fecha Fin:</label>
                    <input type="date" class="form-control mb-3" name="fecha_fin"
                        value="<?php echo $usuario['fecha_fin']; ?>">

                    <label for="usuario">Usuario:</label>
                    <input type="text" class="form-control mb-3" name="usuario"
                        value="<?php echo $usuario['usuario']; ?>">

                    <label for="password">Contraseña:</label>
                    <input type="text" class="form-control mb-3" name="password"
                        value="<?php echo $usuario['password']; ?>">
                    <div class="d-flex justify-content-center">
                        <a href="alumnos.php" class="btn btn-danger boton boton1 mx-1">Cancelar</a>
                        <input type="submit" class="btn btn-primary mx-1" value="Actualizar">
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