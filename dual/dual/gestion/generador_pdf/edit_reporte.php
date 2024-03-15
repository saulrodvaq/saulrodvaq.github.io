<?php
session_start();
include("../../templates/conexion.php");

$idReporte = $_GET['id'];

$sql = "SELECT * FROM reportes WHERE idReporte = '$idReporte'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
  $reporte = $resultado->fetch_assoc();
} else {
  echo "No se encontró el reporte.";
  exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los valores de los campos del formulario
  $resumen_L = $_POST['resumen_L'];
  $resumen_M = $_POST['resumen_M'];
  $resumen_Mi = $_POST['resumen_Mi'];
  $resumen_J = $_POST['resumen_J'];
  $resumen_V = $_POST['resumen_V'];


  $imagenL = $reporte['img_L']; // Ruta de la imagen actual
  $imagenM = $reporte['img_M']; // Ruta de la imagen actual
  $imagenMi = $reporte['img_Mi']; // Ruta de la imagen actual
  $imagenJ = $reporte['img_J']; // Ruta de la imagen actual
  $imagenV = $reporte['img_V']; // Ruta de la imagen actual


  if ($_FILES['img_L']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenL = 'imagenes/reportes/' . $_FILES['img_L']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_L']['tmp_name'], $imagenL)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }

  if ($_FILES['img_M']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenM = 'imagenes/reportes/' . $_FILES['img_M']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_M']['tmp_name'], $imagenM)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }

  if ($_FILES['img_Mi']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenMi = 'imagenes/reportes/' . $_FILES['img_Mi']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_Mi']['tmp_name'], $imagenMi)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }

  if ($_FILES['img_J']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenJ = 'imagenes/reportes/' . $_FILES['img_J']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_J']['tmp_name'], $imagenJ)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }

  if ($_FILES['img_V']['error'] === UPLOAD_ERR_OK) {
    // Se recibió una imagen para el día lunes
    $imagenV = 'imagenes/reportes/' . $_FILES['img_V']['name']; // Ruta donde se almacenará la imagen
    
    // Mover la imagen al directorio
    if (!move_uploaded_file($_FILES['img_V']['tmp_name'], $imagenV)) {
      echo "Error al mover el archivo de imagen.";
      exit;
    }
  }

  // Actualizar los valores en la tabla "edit_reportes"
  $sql = "UPDATE edit_reportes SET resumen_L = '$resumen_L', img_L = '$imagenL',  resumen_M = '$resumen_M', img_M = '$imagenM', resumen_Mi = '$resumen_Mi', img_Mi = '$imagenMi', resumen_J = '$resumen_J', img_J = '$imagenJ', resumen_V = '$resumen_V', img_V = '$imagenV' WHERE idReporteOriginal = '$idReporte'";
  $resultado = $conn->query($sql);

  if ($resultado) {
    $_SESSION['success_message'] .= " El reporte también ha sido actualizado correctamente en la tabla 'edit_reportes'.";
  } else {
    $_SESSION['error_message'] .= " Error al actualizar el reporte en la tabla 'edit_reportes': " . $conn->error;
  }

  // Redirigir a la página de edición del reporte
  header("Location: edit_reporte.php?id=$idReporte");
  exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Actualizar Reporte</title>
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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    <script src="../../gestion/js/dropzone.js"></script>
    <script src="../../gestion/js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="../../assets/css/style.css" rel="stylesheet">
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
</head>

<body>
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo"><img src="../../assets/img/log-bar2.png" alt="" class="img-fluid"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a id="cerrar" class="nav-link efectoboton" href="../../menu_alumnos.php">Regresar</a></li>
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
                        <h1 style="font-size: 55px !important; font-weight:800 !important;">REPORTE PENDIENTE SEMANAL DE APRENDIZAJE</h1>
                        <hr>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var currentDate = new Date();
                            var currentDayOfWeek = currentDate.getDay();
                            var fInicio = new Date(currentDate);
                            var diff = currentDayOfWeek - 1;
                            fInicio.setDate(fInicio.getDate() - diff);
                            document.getElementById('f_Inicio').value = fInicio.toISOString()
                                .split('T')[0];
                            var fFin = new Date(currentDate);
                            diff = currentDayOfWeek === 0 ? 4 : 4 - (currentDayOfWeek - 1);
                            fFin.setDate(fFin.getDate() + diff);
                            document.getElementById('f_Fin').value = fFin.toISOString().split(
                                'T')[0];
                        });
                    </script>

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
                                        style="border: none; color:#70cc06; font-weight: 800;"
                                        required>
                                </div>

                                <div class="mb-2 col-md-3 text-center">
                                    <label for="f_Fin" class="form-label mt-3">Fecha de fin de la
                                        semana</label>
                                    <input type="date" name="f_Fin" id="f_Fin"
                                        class="form-control text-center"
                                        style="border: none; color:#70cc06; font-weight: 800;"
                                        readonly required>
                                </div>
                            </div>

                            <div class="card-body">
                                <form action="send_edit_reporte.php?id=<?php echo $idReporte; ?>" method="post" enctype="multipart/form-data">
                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Lunes</h5>
                                        <textarea id="resumen_L" class="ckeditor form-control" name="resumen_L"
                                            rows="5" required><?php echo $reporte['resumen_L']; ?></textarea>
                                            <div class="mt-2">
                                            <label for="img_L" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_L" id="img_L" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen" style="cursor: pointer;">
                                                Imagen no seleccionada
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Martes</h5>
                                        <textarea id="resumen_M" class="ckeditor form-control" name="resumen_M"
                                            rows="5" required><?php echo $reporte['resumen_M']; ?></textarea>
                                            <div class="mt-2">
                                            <label for="img_M" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_M" id="img_M" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen2" style="cursor: pointer;">
                                                Imagen no seleccionada
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Miércoles</h5>
                                        <textarea id="resumen_Mi" class="ckeditor form-control" name="resumen_Mi"
                                            rows="5" required><?php echo $reporte['resumen_Mi']; ?></textarea>
                                            <div class="mt-2">
                                            <label for="img_Mi" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_Mi" id="img_Mi" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen3" style="cursor: pointer;">
                                                Imagen no seleccionada
                                            </span>
                                        </div> 
                                    </div>
                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Jueves</h5>
                                        <textarea id="resumen_J" class="ckeditor form-control" name="resumen_J"
                                            rows="5" required><?php echo $reporte['resumen_J']; ?></textarea>
                                            <div class="mt-2">
                                            <label for="img_J" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_J" id="img_J" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen4" style="cursor: pointer;">
                                                Imagen no seleccionada
                                            </span>
                                        </div> 
                                    </div>
                                    <div class="mb-4 animate__animated animate__fadeIn">
                                        <h5 style="color: #70cc06;">Viernes</h5>
                                        <textarea id="resumen_V" class="ckeditor form-control" name="resumen_V"
                                            rows="5" required><?php echo $reporte['resumen_V']; ?></textarea>
                                            <div class="mt-2">
                                            <label for="img_V" class="form-label btn btn-primary">Cargar
                                                imagen</label>
                                            <input type="file" name="img_V" id="img_V" accept="image/*"
                                                style="display:none;">
                                            <i class="bi bi-card-image"></i>
                                            <span id="imagen5" style="cursor: pointer;">
                                                Imagen no seleccionada
                                            </span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="idAlumno" value="<?php echo $reporte['idAlumno']; ?>">
                                    <input type="hidden" name="matricula" value="<?php echo $reporte['matricula']; ?>">
                                    <input type="hidden" name="nombres" value="<?php echo $reporte['nombres']; ?>">
                                    <input type="hidden" name="apellidos" value="<?php echo $reporte['apellidos']; ?>">
                                    <input type="hidden" name="carrera" value="<?php echo $reporte['carrera']; ?>">
                                    <input type="hidden" name="empresa" value="<?php echo $reporte['empresa']; ?>">
                                    <input type="hidden" name="idInstructor" value="<?php echo $reporte['idInstructor']; ?>">
                                    <input type="hidden" name="idTutor" value="<?php echo $reporte['idTutor']; ?>">

                                    <div class="animate__animated animate__fadeIn text-center">
                                        <button type="submit" style="font-size:20px !important" class="btn efectoboton">Guardar cambios</button>
                                    </div>
                                </form>
                            </div>
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
    <script src="../../assets/js/main.js"></script>
    <script src="//cdn.ckeditor.com/4.20.2/basic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#btn_actualizar_reporte').click(function() {
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
            $('.sub-tab-button').click(function() {
                var target = $(this).data('target');
                $('.sub-tab-button').removeClass('active');
                $(this).addClass('active');
                $('.sub-tab-pane').hide();
                $(target).show();
            });
        });
    </script>
    <?php
            include ("../../templates/footer.php");
            ?>
             <script src="assets/js/main.js"></script>

    <script>
    document.getElementById('img_L').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen = file.name;
        document.getElementById('imagen').textContent = imagen;
        document.getElementById('imagen').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
    <style>
    .custom-image-style {
        max-width: 25vw;
        max-height: 200vh;
    }
    </style>
    <script>
    document.getElementById('img_M').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen2 = file.name;
        document.getElementById('imagen2').textContent = imagen2;
        document.getElementById('imagen2').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
     <script>
    document.getElementById('img_Mi').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen3 = file.name;
        document.getElementById('imagen3').textContent = imagen3;
        document.getElementById('imagen3').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
     <script>
    document.getElementById('img_J').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen4 = file.name;
        document.getElementById('imagen4').textContent = imagen4;
        document.getElementById('imagen4').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
     <script>
    document.getElementById('img_V').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var imagen5 = file.name;
        document.getElementById('imagen5').textContent = imagen5;
        document.getElementById('imagen5').addEventListener('click', function() {
            Swal.fire({
                imageUrl: URL.createObjectURL(file),
                imageAlt: 'Imagen',
                customClass: {
                    image: 'custom-image-style'
                }
            });
        });
    });
    </script>
</body>

</html>
