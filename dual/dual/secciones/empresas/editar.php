<?php
include("../../templates/conexion.php");
if(isset($_GET["idEmpresa"])) {
    // Obtener el valor del campo idEmpresa de la URL
    $idEmpresa = $_GET["idEmpresa"];

    // Consulta para obtener los datos de la empresa correspondiente
    $query = "SELECT * FROM empresas WHERE idEmpresa = $idEmpresa";
    $resultado = mysqli_query($conn, $query);
    $empresa = mysqli_fetch_assoc($resultado);
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

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Editar Empresas</title>
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
                    <li><a class="scrollto efectoboton" href="empresas.php">Regresar</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <!-- Formulario para editar los datos de la empresa -->
    <div class="container">
        <br />
        <br />
        <h1 class="mb-4 text-center" style="font-size: 68px; font-weight:800;">Actualizar datos</h1>
        <hr>
        <form action="actualizar.php" method="POST">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <input type="hidden" class="form-control mb-3" name="idEmpresa"
                        value="<?php echo $empresa['idEmpresa']; ?>">
                    <label for="nombreEmp">Empresa</label>
                    <input type="text" class="form-control mb-3" name="nombreEmp"
                        value="<?php echo $empresa['nombreEmp']; ?>">
                    <label for="calle">Calle:</label>
                    <input type="text" class="form-control mb-3" name="calle" value="<?php echo $empresa['calle']; ?>">
                    <label for="colonia">Colonia:</label>
                    <input type="text" class="form-control mb-3" name="colonia"
                        value="<?php echo $empresa['colonia']; ?>">
                    <label for="municipio">Municipio:</label>
                    <select class="form-select" name="municipio" id="country"
                        value="<?php echo $empresa['municipio']; ?>">
                        <option>...</option>
                        <option <?php if ($empresa['municipio'] == 'Santa Catarina') echo 'selected'; ?>>Santa Catarina
                        </option>
                        <option <?php if ($empresa['municipio'] == 'Monterrey') echo 'selected'; ?>>Monterrey</option>
                        <option <?php if ($empresa['municipio'] == 'García') echo 'selected'; ?>>García</option>
                        <option <?php if ($empresa['municipio'] == 'San Pedro') echo 'selected'; ?>>San Pedro</option>
                        <option <?php if ($empresa['municipio'] == 'Otro') echo 'selected'; ?>>Otro</option>
                    </select>
                    <br />
                    <label for="numero">Número:</label>
                    <input type="text" class="form-control mb-3" name="numero"
                        value="<?php echo $empresa['numero']; ?>">
                    <label for="cp">CP:</label>
                    <input type="text" class="form-control mb-3" name="cp" value="<?php echo $empresa['cp']; ?>">
                    <label for="name">Giro</label>
                    <select class="form-select" name="giro" id="country" value="<?php echo $empresa['giro']; ?>">
                        <option>...</option>
                        <option
                            <?php if ($empresa['giro'] == 'Agricultura y actividades del campo') echo 'selected'; ?>>
                            Agricultura y actividades del campo</option>
                        <option <?php if ($empresa['giro'] == 'Minería') echo 'selected'; ?>>Minería</option>
                        <option <?php if ($empresa['giro'] == 'Energía eléctrica y suministro de agua y de
                            gas') echo 'selected'; ?>>Energía eléctrica y suministro de agua y de
                            gas</option>
                        <option <?php if ($empresa['giro'] == 'Construcción') echo 'selected'; ?>>Construcción</option>
                        <option <?php if ($empresa['giro'] == 'Industrias manufactureras') echo 'selected'; ?>>
                            Industrias manufactureras</option>
                        <option <?php if ($empresa['giro'] == 'Comercio') echo 'selected'; ?>>Comercio</option>
                        <option
                            <?php if ($empresa['giro'] == 'Transportes, correos y almacenamiento') echo 'selected'; ?>>
                            Transportes, correos y almacenamiento</option>
                        <option <?php if ($empresa['giro'] == 'Información en medios masivos') echo 'selected'; ?>>
                            Información en medios masivos</option>
                        <option <?php if ($empresa['giro'] == 'Servicios financieros y de seguros') echo 'selected'; ?>>
                            Servicios financieros y de seguros</option>
                        <option <?php if ($empresa['giro'] == 'Servicios inmobiliarios y de alquiler de
                            bienes muebles e intangibles') echo 'selected'; ?>>Servicios inmobiliarios y de alquiler de
                            bienes muebles e intangibles</option>
                        <option <?php if ($empresa['giro'] == 'Servicios de apoyo a los negocios y manejo
                            de residuos y desechos') echo 'selected'; ?>>Servicios de apoyo a los negocios y manejo
                            de residuos y desechos</option>
                        <option <?php if ($empresa['giro'] == 'Corporativos') echo 'selected'; ?>>Corporativos</option>
                        <option <?php if ($empresa['giro'] == 'Servicios profesionales, científicos y
                            técnicos') echo 'selected'; ?>>Servicios profesionales, científicos y
                            técnicos</option>
                        <option <?php if ($empresa['giro'] == 'Servicios educativos') echo 'selected'; ?>>Servicios
                            educativos</option>
                        <option
                            <?php if ($empresa['giro'] == 'Servicios de salud y de asistencia social') echo 'selected'; ?>>
                            Servicios de salud y de asistencia social</option>
                        <option <?php if ($empresa['giro'] == 'Servicios de esparcimiento culturales y
                            deportivos') echo 'selected'; ?>>Servicios de esparcimiento culturales y
                            deportivos</option>
                        <option <?php if ($empresa['giro'] == 'Servicios de alojamiento temporal y de
                            preparación de alimentos y bebidas') echo 'selected'; ?>>Servicios de alojamiento temporal
                            y de
                            preparación de alimentos y bebidas</option>
                        <option <?php if ($empresa['giro'] == 'Dependencias gubernamentales') echo 'selected'; ?>>
                            Dependencias gubernamentales</option>
                        <option <?php if ($empresa['giro'] == 'Otros servicios') echo 'selected'; ?>>Otros servicios
                        </option>
                    </select>
                    <br />
                    <label for="parqueIndustrial">Parque Industrial:</label>
                    <select class="form-select mb-3" name="parqueIndustrial" id="country"
                        value="<?php echo $empresa['parqueIndustrial']; ?>">
                        <option>...</option>
                        <option <?php if ($empresa['parqueIndustrial'] == 'si') echo 'selected'; ?>>Si</option>
                        <option <?php if ($empresa['parqueIndustrial'] == 'no') echo 'selected'; ?>>No</option>
                    </select>

                    <label for="permite_imagenes">¿Permite imágenes?</label>
                    <select class="form-select" name="permite_imagenes" id="permite_imagenes"
                        value="<?php echo $empresa['permite_imagenes']; ?>">>
                        <option>...</option>
                        <option <?php if ($empresa['permite_imagenes'] == 'Si') echo 'selected'; ?>>Si</option>
                        <option <?php if ($empresa['permite_imagenes'] == 'No') echo 'selected'; ?>>No</option>
                    </select>

                    
                    <br />
                    <div id="container" class="d-flex justify-content-center">
                        <h3>Datos de Contacto</h3>
                    </div>
                    <label for="nombreC">Nombre(s):</label>
                    <input type="text" class="form-control mb-3" name="nombreC"
                        value="<?php echo $empresa['nombreC']; ?>">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control mb-3" name="telefono"
                        value="<?php echo $empresa['telefono']; ?>">
                    <label for="correo">Correo:</label>
                    <input type="text" class="form-control mb-3" name="correo"
                        value="<?php echo $empresa['correo']; ?>">
                    <label for="puesto">Puesto:</label>
                    <input type="text" class="form-control mb-3" name="puesto"
                        value="<?php echo $empresa['puesto']; ?>">
                    <div class="d-flex justify-content-center">
                        <a href="empresas.php" class="btn btn-danger mx-1" boton class="boton boton1">Cancelar</a>
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