<?php
session_start(); // Inicia la sesión si no ha sido iniciada antes
include("../../templates/conexion.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header('Location: ../../login.php');
    exit;
}

if (!esAlumno($_SESSION['usuario'])) {
    echo "No estás autorizado para acceder a esta página.";
    exit;
}

function esAlumno($usuario) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dual_bd";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $query = "SELECT * FROM alumnos WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conn, $query);
    $esAlumno = mysqli_num_rows($resultado) > 0;
    mysqli_close($conn);
    return $esAlumno;
}

include ("../../templates/conexion.php");

// Luego, obtenemos los datos del usuario actual utilizando su matrícula
$usuario = $_SESSION['usuario']; // Obtén la matrícula del usuario actual de la sesión
$sql = "SELECT *, idAlumno FROM alumnos WHERE usuario = '$usuario'";
$resultado = mysqli_query($conn, $sql);

// Verificamos si la consulta se realizó correctamente
if (!$resultado) {
    die("Error al obtener los datos del usuario: " . mysqli_error($conn));
}

// Obtenemos los datos del usuario y los guardamos en la variable $usuario
$usuario = mysqli_fetch_assoc($resultado);
$_SESSION['idAlumno'] = $usuario['idAlumno'];
// Cerramos la conexión a la base de datos

// Recupera el ID del borrador de la URL
$idBorrador = $_GET['id'];
// Recupera el ID del borrador de la URL
if(isset($_GET['id'])){
    $_SESSION['idBorrador'] = $_GET['id'];
}else{
    $_SESSION['idBorrador'] = 0;
}
// Selecciona los datos del borrador de la base de datos
$sql = "SELECT * FROM borradores WHERE idBorrador = '$idBorrador'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Asigna los datos del borrador a variables
  while($row = $result->fetch_assoc()) {
    $idAlumno = $row["idAlumno"];
    $matricula = $row["matricula"];
    $nombres = $row["nombres"];
    $apellidos = $row["apellidos"];
    $carrera = $row["carrera"];
    $empresa = $row["empresa"];
    $idInstructor = $row["idInstructor"];
    $idTutor = $row["idTutor"];
    $semana = $row["semana"];
    $f_Inicio = $row["f_Inicio"];
    $f_Fin = $row["f_Fin"];
$fecha_L = $row["fecha_L"];
$fecha_M = $row["fecha_M"];
$fecha_Mi = $row["fecha_Mi"];
$fecha_J = $row["fecha_J"];
$fecha_V = $row["fecha_V"];

    $cuatrimestre = $row["cuatrimestre"];
    $resumen_L = $row["resumen_L"];
    $imagenL = $row["img_L"];
    $resumen_M = $row["resumen_M"];
    $imagenM = $row["img_M"];
    $resumen_Mi = $row["resumen_Mi"];
    $imagenMi = $row["img_Mi"];
    $resumen_J = $row["resumen_J"];
    $imagenJ = $row["img_J"];
    $resumen_V = $row["resumen_V"];
    $imagenV = $row["img_V"];
   
  }
} else {
  echo "No se encontró el borrador.";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Se recibió una solicitud POST para guardar o enviar el reporte

  // Obtener los valores de los campos del formulario
  $resumen_L = $_POST['resumen_L'];
  $resumen_M = $_POST['resumen_M'];
  $resumen_Mi = $_POST['resumen_Mi'];
  $resumen_J = $_POST['resumen_J'];
  $resumen_V = $_POST['resumen_V'];
  $semana = $_POST['semana'];

  if ($_FILES['img_L']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenL = 'imagenes/borradores/' . $_FILES['img_L']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_L']['tmp_name'], $imagenL)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }

  if ($_FILES['img_M']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenM = 'imagenes/borradores/' . $_FILES['img_M']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_M']['tmp_name'], $imagenM)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }

  if ($_FILES['img_Mi']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenMi = 'imagenes/borradores/' . $_FILES['img_Mi']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_Mi']['tmp_name'], $imagenMi)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }

  if ($_FILES['img_J']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenJ = 'imagenes/borradores/' . $_FILES['img_J']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_J']['tmp_name'], $imagenJ)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }

  if ($_FILES['img_V']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenV = 'imagenes/borradores/' . $_FILES['img_V']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_V']['tmp_name'], $imagenV)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }
  if ($result){
    // Obtener el ID del reporte recién insertado
    $idReporte = mysqli_insert_id($conn);

 
  // Actualizar los valores en la base de datos
  $sql = "UPDATE borradores SET resumen_L = '$resumen_L', img_L = '$imagenL', resumen_M = '$resumen_M', img_M = '$imagenM', resumen_Mi = '$resumen_Mi', img_Mi = '$imagenMi', resumen_J = '$resumen_J', img_J = '$imagenJ', resumen_V = '$resumen_V', img_V = '$imagenV' WHERE idBorrador = '$idBorrador'";
  $result = $conn->query($sql);
}
  
    
  
  if ($_POST['submit'] === 'enviar_reporte') {
    // Se recibió una solicitud POST para enviar el reporte

    if ($result) {
      // Guardar el borrador como reporte en la tabla de reportes
      $sql = "INSERT INTO reportes (idAlumno, matricula, nombres, apellidos, carrera, empresa, idInstructor, idTutor, semana, f_Inicio, f_Fin, cuatrimestre, resumen_L, img_L, resumen_M, img_M, resumen_Mi, img_Mi, resumen_J, img_J, resumen_V, img_V, fecha_L, fecha_M, fecha_Mi, fecha_J, fecha_V) VALUES ('$idAlumno', '$matricula', '$nombres', '$apellidos', '$carrera', '$empresa', '$idInstructor', '$idTutor', '$semana', '$f_Inicio', '$f_Fin', '$cuatrimestre', '$resumen_L', '$imagenL',  '$resumen_M', '$imagenM',  '$resumen_Mi', '$imagenMi', '$resumen_J', '$imagenJ', '$resumen_V', '$imagenV', '$fecha_L', '$fecha_M', '$fecha_Mi', '$fecha_J', '$fecha_V')";
      $result = $conn->query($sql);

      if ($result) {
        $_SESSION['success_message'] = "Borrador guardado y enviado correctamente.";

        // Obtener el ID del reporte recién insertado
        $idReporte = mysqli_insert_id($conn);

        // Abrir el PDF del nuevo reporte generado
        header("Location: invoice.php?id=$idReporte");
        exit;
      } else {
        $_SESSION['error_message'] = "Error al guardar y enviar el borrador como reporte: " . $conn->error;
      }
    } else {
      $_SESSION['error_message'] = "Error al guardar el borrador: " . $conn->error;
    }
  } else {
    // La solicitud POST es para guardar el borrador, no se realizará ninguna acción adicional aquí
    $_SESSION['success_message'] = "Borrador guardado correctamente.";
  }

  // Redirigir a la página de edición del borrador
  header("Location: edit_borrador.php?id=$idBorrador");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Editar Borrador</title>
    <title>Dual</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../assets/img/utsc_dual_logo.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- SweetAlert2-->
    <!-- Cerrar sesion-Botones o cuadros de texto dentro de la pagina-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <!-- Cerrar sesion-Botones o cuadros de texto dentro de la pagina-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        // Actualiza el valor del campo oculto cada vez que cambia el valor del campo de texto
        $('textarea[name="resumen_L"]').on('change', function() {
            $('input[name="resumen_L"]').val($(this).val());
        });
        $('textarea[name="resumen_M"]').on('change', function() {
            $('input[name="resumen_M"]').val($(this).val());
        });
        // Haz lo mismo para los demás campos de texto
    });
    </script>
    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="../../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo"><img src="../../assets/img/log-bar2.png" alt="" class="img-fluid"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a id="cerrar" class="nav-link efectoboton" href="../../menu_alumnos.php">Regresar</a></li>
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
                        text: "¿Realmente deseas salir?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, salir',
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
    </header>
    <div class="tab-content">
        <div class="tab-pane active show" id="tab-2">
            <section id="contact" class="contact text-center animate__animated p-3 shadow-lg">
                <div class="container-fluid">
                    <div class="section-title">
                        <h3>EDUCACIÓN DUAL</h3>
                        <h1 style="font-size: 55px !important; font-weight:800 !important;">BORRADOR DE REPORTE SEMANAL DE APRENDIZAJE</h1>
                        <hr>
                    </div>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var currentDate = new Date();
                        var currentDayOfWeek = currentDate.getDay();

                        // Establecer f_Inicio al lunes de la semana actual
                        var fInicio = new Date(currentDate);
                        var diff = currentDayOfWeek - 1;
                        fInicio.setDate(fInicio.getDate() - diff);
                        document.getElementById('f_Inicio').value = fInicio.toISOString()
                            .split('T')[0];

                        // Establecer f_Fin al viernes de la semana actual
                        var fFin = new Date(currentDate);
                        diff = currentDayOfWeek === 0 ? 4 : 4 - (currentDayOfWeek - 1);
                        fFin.setDate(fFin.getDate() + diff);
                        document.getElementById('f_Fin').value = fFin.toISOString().split(
                            'T')[0];
                    });
                    </script>
                    <style>
                    .card.shadow {
                        border-width: 4px;
                        border-color: #70cc06;
                        border-style: solid;
                    }
                    </style>
                    <div class="row mt-3">
                        <div class="card shadow animate__animated animate__fadeIn">
                            <div class="card-header text-white"
                                style="background-color: #70cc06; border-radius: 0px 0px 20px 20px">
                                <h3>Resumen de semana:</h3>
                                <label for="name">Describe todas las actividades que realizaste
                                    diariamente en la empresa en su día respectivo.</label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="mb-2 col-md-3 text-center me-3">
                                    <label for="f_Inicio" class="form-label mt-3">Fecha de inicio de la
                                        semana</label>
                                    <input type="date" name="f_Inicio" id="f_Inicio" readonly
                                        class="form-control text-center"
                                        style="border: none; color:#70cc06; font-weight: 800;" required>
                                </div>

                                <div class="mb-2 col-md-3 text-center">
                                    <label for="f_Fin" class="form-label mt-3">Fecha de fin de la
                                        semana</label>
                                    <input type="date" name="f_Fin" id="f_Fin" class="form-control text-center"
                                        style="border: none; color:#70cc06; font-weight: 800;" readonly required>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Columna de Editar Borrador -->
                                <form action="edit_borrador.php?id=<?php echo $idBorrador; ?>" method="post" enctype="multipart/form-data">
                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Lunes</h5>
                                        <textarea id="resumen_L" class="ckeditor form-control" name="resumen_L" rows="5"
                                            required><?php echo $resumen_L; ?></textarea>
                                        <div class="mt-2">
                                            <label for="img_L" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_L" id="img_L" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen" data-image-url="<?php echo $imagenL; ?>" style="cursor: pointer;">
                                            <?php echo $imagenL ? basename($imagenL) : 'Imagen no seleccionada'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Martes</h5>
                                        <textarea id="resumen_M" class="ckeditor form-control" name="resumen_M" rows="5"
                                            required><?php echo $resumen_M; ?></textarea>
                                        <div class="mt-2">
                                            <label for="img_M" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_M" id="img_M" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen2" data-image-url="<?php echo $imagenM; ?>" style="cursor: pointer;">
                                            <?php echo $imagenM ? basename($imagenM) : 'Imagen no seleccionada'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Miércoles</h5>
                                        <textarea id="resumen_Mi" class="ckeditor form-control" name="resumen_Mi"
                                            rows="5" required><?php echo $resumen_Mi; ?></textarea>
                                        <div class="mt-2">
                                            <label for="img_Mi" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_Mi" id="img_Mi" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen3" data-image-url="<?php echo $imagenMi; ?>" style="cursor: pointer;">
                                            <?php echo $imagenMi ? basename($imagenMi) : 'Imagen no seleccionada'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Jueves</h5>
                                        <textarea id="resumen_J" class="ckeditor form-control" name="resumen_J" rows="5"
                                            required><?php echo $resumen_J; ?></textarea>
                                        <div class="mt-2">
                                            <label for="img_J" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_J" id="img_J" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen4" data-image-url="<?php echo $imagenJ; ?>" style="cursor: pointer;">
                                            <?php echo $imagenJ ? basename($imagenJ) : 'Imagen no seleccionada'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Viernes</h5>
                                        <textarea id="resumen_V" class="ckeditor form-control" name="resumen_V" rows="5"
                                            required><?php echo $resumen_V; ?></textarea>
                                        <div class="mt-2">
                                            <label for="img_V" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_V" id="img_V" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen5" data-image-url="<?php echo $imagenV; ?>" style="cursor: pointer;">
                                            <?php echo $imagenV ? basename($imagenV) : 'Imagen no seleccionada'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php
                                    $idAlumno = $usuario['idAlumno'];
                                    $sql = "SELECT COUNT(*) as cantidad FROM reportes WHERE idAlumno = $idAlumno";
                                    $resultado = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($resultado);
                                    $cantidadReportes = $row['cantidad'];
                                    
                                    // Calcular la semana en base a la cantidad de reportes
                                    $semana = $cantidadReportes + 1; // Si cada semana tiene 7 días
                                    ?>
                                    <input type="hidden" name="semana" value="<?php echo $semana; ?>">
                                    <div class="text-center">
                                        <button id="btn_guardar_borrador" class="efectoboton"
                                            style="font-size:20px !important" type="submit" name="submit"
                                            value="guardar_borrador">Guardar Borrador</button>
                                        <button id="btn_enviar_reporte" class="efectoboton"
                                            style="font-size:20px !important" type="submit" name="submit"
                                            value="enviar_reporte">Enviar Reporte</button>

                                    </div>
                                </form>
                                <form action="send.php" method="post">
                                    <!-- Aquí puedes incluir los campos ocultos necesarios para enviar el reporte -->
                                    <input type="hidden" name="nombres" value="<?php echo $nombres; ?>">
                                    <input type="hidden" name="apellidos" value="<?php echo $apellidos; ?>">
                                    <input type="hidden" name="carrera" value="<?php echo $carrera; ?>">
                                    <input type="hidden" name="empresa" value="<?php echo $empresa; ?>">
                                    <input type="hidden" name="idInstructor" value="<?php echo $idInstructor; ?>">
                                    <input type="hidden" name="idTutor" value="<?php echo $idTutor; ?>">
                                    <input type="hidden" name="f_Inicio" value="<?php echo $f_Inicio; ?>">
                                    <input type="hidden" name="f_Fin" value="<?php echo $f_Fin; ?>">
                                    <input type="hidden" name="semana" value="<?php echo $semana; ?>">
                                    <input type="hidden" name="resumen_L" value="<?php echo $resumen_L; ?>">
                                    <input type="hidden" name="resumen_M" value="<?php echo $resumen_M; ?>">
                                    <input type="hidden" name="resumen_Mi" value="<?php echo $resumen_Mi; ?>">
                                    <input type="hidden" name="resumen_J" value="<?php echo $resumen_J; ?>">
                                    <input type="hidden" name="resumen_V" value="<?php echo $resumen_V; ?>">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>
    <script src="//cdn.ckeditor.com/4.20.2/basic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.sub-tab-button').click(function() {
            var target = $(this).data('target');
            $('.sub-tab-button').removeClass('active');
            $(this).addClass('active');
            $('.sub-tab-pane').hide();
            $(target).show();
        });
    });
    </script>

    <style>
    .btn-outline-light {
        --bs-btn-color: #f8f9fa;
        --bs-btn-border-color: #f8f9fa;
        --bs-btn-hover-color: #000;
        --bs-btn-hover-bg: #f8f9fa;
        --bs-btn-hover-border-color: #f8f9fa;
        --bs-btn-focus-shadow-rgb: 248, 249, 250;
        --bs-btn-active-color: #000;
        --bs-btn-active-bg: #f8f9fa;
        --bs-btn-active-border-color: #f8f9fa;
        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        --bs-btn-disabled-color: #f8f9fa;
        --bs-btn-disabled-bg: transparent;
        --bs-btn-disabled-border-color: #f8f9fa;
        --bs-gradient: none;
    }

    .report-card {
        transition: transform 0.3s ease-in-out;
    }

    .report-card:hover {
        transform: scale(1.1);
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .fade {
        animation-name: fadeIn;
        animation-duration: 1s;
        animation-fill-mode: forwards;
        /* Añadimos esta línea */
    }

    .fade {
        animation-name: fadeIn;
        animation-duration: 1s;
    }

    .bg-green {
        background-color: #70cc06 !important;
    }

    .bg-green h2 {
        font-size: 31px !important;
    }

    .bg-red {
        background-color: #FF4444 !important;
    }

    .bg-red h2 {
        font-size: 31px !important;
    }

    .bg-yellow {
        background-color: #FFBB33 !important;
    }

    .bg-yellow h2 {
        color: #000 !important;
        font-size: 31px !important;
    }

    .bg-white {
        background-color: #E2DEDE !important;
    }

    .bg-white h2 {
        color: #000 !important;
        font-size: 31px !important;
    }

    .bg-white p {
        color: #000 !important;
    }

    .white {
        color: #fff;
    }

    .carousel-control-next-icon,
    .carousel-control-prev-icon {
        background-color: gray !important;
    }

    .container-fluid {
        padding: 2rem;
    }

    .section-title h3 {
        font-size: 2rem;
        color: #4F5D75;
        text-transform: uppercase;
    }

    .section-title h1 {
        font-size: 3rem;
        color: #EF8354;
        text-transform: uppercase;
        margin-bottom: 2rem;
    }

    .navigation-btn i {
        font-size: 1.5rem;
    }

    .report-card {
        height: 100%;
        padding: 2rem;
        border-radius: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .report-card h2 {
        margin-bottom: 1rem;
    }

    .report-card p {
        margin-bottom: 2rem;
    }

    .report-card button {
        align-self: flex-start;
    }

    .navigation-btn {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .total-reports {
        font-size: 1.5rem;
        color: #4F5D75;
        margin-top: 2rem;
        text-align: center;
    }

    .lead {
        text-align: justify !important;
        font-weight: 600;
    }
    </style>
    <?php
            include ("../../templates/footer.php");
            ?>



    <!-- Template Main JS File -->
    <script src="//cdn.ckeditor.com/4.20.2/basic/ckeditor.js"></script>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Bloque de anuncios adaptable -->
    <ins class="adsbygoogle" style="display:block height:50px" data-ad-client="ca-pub-6676636635558550"
        data-ad-slot="8523024962" data-ad-format="auto" data-full-width-responsive="true">
    </ins>





    <script>
    $(document).ready(function() {
        $('#btn_enviar_reporte').click(function() {
            Swal.fire(
                'Listo!',
                'Tu reporte ha sido enviado.',
                'success'
            );
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#btn_guardar_borrador').click(function() {
            Swal.fire(
                'Listo!',
                'Tu reporte ha sido guardado.',
                'success'
            );
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.sub-tab-button').click(function() {
            var target = $(this).data('target');
            $('.sub-tab-button').removeClass('active');
            $(this).addClass('active');
            $('.sub-tab-pane').hide();
            $(target).show();
        });
    });
    </script>


<script src="../../assets/js/main.js"></script>

<script src="../../assets/js/main.js"></script>

<script>
    var imageFile_L;
    var imagenElement_L = document.getElementById('imagen');
    var imageUrl_L = imagenElement_L.getAttribute('data-image-url');

    document.getElementById('img_L').addEventListener('change', function(e) {
        imageFile_L = e.target.files[0];
        var imageName = imageFile_L.name;
        imagenElement_L.textContent = imageName;
        imageUrl_L = URL.createObjectURL(imageFile_L);
    });

    imagenElement_L.addEventListener('click', function() {
        Swal.fire({
            imageUrl: imageUrl_L,
            imageAlt: 'Imagen',
            customClass: {
                image: 'custom-image-style'
            }
        });
    });
</script>

<script>
    var imageFile_M;
    var imagenElement_M = document.getElementById('imagen2');
    var imageUrl_M = imagenElement_M.getAttribute('data-image-url');

    document.getElementById('img_M').addEventListener('change', function(e) {
        imageFile_M = e.target.files[0];
        var imageName = imageFile_M.name;
        imagenElement_M.textContent = imageName;
        imageUrl_M = URL.createObjectURL(imageFile_M);
    });

    imagenElement_M.addEventListener('click', function() {
        Swal.fire({
            imageUrl: imageUrl_M,
            imageAlt: 'Imagen',
            customClass: {
                image: 'custom-image-style'
            }
        });
    });
</script>

<script>
    var imageFile_Mi;
    var imagenElement_Mi = document.getElementById('imagen3');
    var imageUrl_Mi = imagenElement_Mi.getAttribute('data-image-url');

    document.getElementById('img_Mi').addEventListener('change', function(e) {
        imageFile_Mi = e.target.files[0];
        var imageName = imageFile_Mi.name;
        imagenElement_Mi.textContent = imageName;
        imageUrl_Mi = URL.createObjectURL(imageFile_Mi);
    });

    imagenElement_Mi.addEventListener('click', function() {
        Swal.fire({
            imageUrl: imageUrl_Mi,
            imageAlt: 'Imagen',
            customClass: {
                image: 'custom-image-style'
            }
        });
    });
</script>

<script>
    var imageFile_J;
    var imagenElement_J = document.getElementById('imagen4');
    var imageUrl_J = imagenElement_J.getAttribute('data-image-url');

    document.getElementById('img_J').addEventListener('change', function(e) {
        imageFile_J = e.target.files[0];
        var imageName = imageFile_J.name;
        imagenElement_J.textContent = imageName;
        imageUrl_J = URL.createObjectURL(imageFile_J);
    });

    imagenElement_J.addEventListener('click', function() {
        Swal.fire({
            imageUrl: imageUrl_J,
            imageAlt: 'Imagen',
            customClass: {
                image: 'custom-image-style'
            }
        });
    });
</script>

<script>
    var imageFile_V;
    var imagenElement_V = document.getElementById('imagen5');
    var imageUrl_V = imagenElement_V.getAttribute('data-image-url');

    document.getElementById('img_V').addEventListener('change', function(e) {
        imageFile_V = e.target.files[0];
        var imageName = imageFile_V.name;
        imagenElement_V.textContent = imageName;
        imageUrl_V = URL.createObjectURL(imageFile_V);
    });

    imagenElement_V.addEventListener('click', function() {
        Swal.fire({
            imageUrl: imageUrl_V,
            imageAlt: 'Imagen',
            customClass: {
                image: 'custom-image-style'
            }
        });
    });
</script>

<style>
    .custom-image-style {
        max-width: 25vw;
        max-height: 200vh;
    }
</style>


<style>
    .custom-image-style {
        max-width: 25vw;
        max-height: 200vh;
    }
</style>

</body>

</html>
<?php
$conn->close();
?>