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
$idEmpresa = $_GET['idEmpresa'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Matriz</title>
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
    <link href="../../assets/css/style_login.scss" rel="stylesheet">

</head>
<style>
.form-check-input:checked {
    background-color: #70cc06;
    border-color: #70cc06;
}

.form-check-input {
    border: 2px solid #70cc06;
    border-radius: 4px;
    transform: translateY(-10%);
    width: 20px;
    height: 20px;
    transition: background-color 0.3s ease-in-out;
}
</style>


<body>
    <header id="header" class="fixed-top2 header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/dual/index.php" class="logo"><img src="../../assets/img/log-bar2.png" alt="" class="img-fluid"></a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link efectoboton scrollto"
                            href="gestionar.php?idEmpresa=<?php echo $idEmpresa; ?>">Regresar</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header>
    <?php
include("../../templates/conexion.php");
$idEmpresa = $_GET["idEmpresa"];

// Obtener carreras
$query = "SELECT * FROM carreras";
$result = $conn->query($query);

$carreras = array();
if ($result !== false) {
    while ($row = $result->fetch_assoc()) {
        $carreras[] = $row;
    }
} else {
    die("Error en la consulta: " . $conn->error);
}

// Obtener cuatrimestres de la carrera seleccionada
$carreraSeleccionada = $_POST["carrera"] ?? null;


$cuatrimestres = array();
if ($carreraSeleccionada !== null) {
    $query = "SELECT * FROM cuatrimestres";
    $result = $conn->query($query);

    if ($result !== false) {
        while ($row = $result->fetch_assoc()) {
            $cuatrimestres[] = $row;
        }
    } else {
        die("Error en la consulta: " . $conn->error);
    }

    // Obtener asignaturas y competencias para un cuatrimestre específico
    $cuatrimestreSeleccionado = $_POST["cuatrimestre"] ?? null;

    $asignaturasCompetencias = array();
    if ($cuatrimestreSeleccionado !== null) {
        $query = "SELECT ac.idAsignatura, ac.nombre, a.competencia 
        FROM asignaturas ac
        INNER JOIN asignaturas a ON ac.idAsignatura = a.idAsignatura
        WHERE ac.idCuatrimestre = ? AND ac.idCarrera = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ii", $cuatrimestreSeleccionado, $carreraSeleccionada);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result !== false) {
                while ($row = $result->fetch_assoc()) {
                    $asignaturasCompetencias[] = $row;
                }
            } else {
                die("Error en la consulta: " . $stmt->error);
            }

            $stmt->close();
        } else {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
    }
}

// Obtener puestos de la empresa
$query = "SELECT * FROM puestos WHERE idEmpresa = '$idEmpresa' AND idCarrera = '$carreraSeleccionada'";
$result = $conn->query($query);

$puestos = array();
if ($result !== false) {
    while ($row = $result->fetch_assoc()) {
        $puestos[] = $row;
    }
} else {
    die("Error en la consulta: " . $conn->error);
}

// Obtener la cantidad de puestos
$cantidadPuestos = count($puestos);

// Agregar nuevo puesto
if (isset($_POST["nuevo_puesto"])) {
    $nombrePuesto = $_POST["nombre_puesto"];
    $idCarrera = $_POST["idCarrera"];

    // Insertar el nuevo puesto en la base de datos
    $query = "INSERT INTO puestos (nombre, idEmpresa, idCarrera) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("sii", $nombrePuesto, $idEmpresa, $idCarrera);
        $stmt->execute();
        $stmt->close();

        // Redireccionar para evitar la reenviación del formulario
        header("Location: matriz.php?idEmpresa=$idEmpresa");
        exit();
    } else {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
}
// Obtener puestos y su estado de cumplimiento de la base de datos
$query = "SELECT pa.idPuesto, pa.idAsignatura, pa.cumple FROM puestos_asignaturas pa
          INNER JOIN puestos p ON pa.idPuesto = p.idPuesto
          WHERE p.idEmpresa = '$idEmpresa' AND p.idCarrera = '$carreraSeleccionada'";
$result = $conn->query($query);

$puestosCumplimiento = array();
if ($result !== false) {
    while ($row = $result->fetch_assoc()) {
        $puestoId = $row['idPuesto'];
        $asignaturaId = $row['idAsignatura'];
        $cumple = $row['cumple'];
        
        if (!isset($puestosCumplimiento[$asignaturaId])) {
            $puestosCumplimiento[$asignaturaId] = array();
        }
        
        $puestosCumplimiento[$asignaturaId][$puestoId] = $cumple;
    }
} else {
    die("Error en la consulta: " . $conn->error);
}

// Cerrar conexión
$conn->close();
?>


    <div class="container">
        </br>
        </br>
        <h1 class="mb-4 text-center" style="font-size: 68px; font-weight:800;">Matriz de Correspondencia</h1>
        <p class="text-center" style="font-size: 24px;">Bienvenido(a) a la matriz de correspondencia, podrá gestionar
            que puestos de su empresa cumplen con las competencias de cada asignatura, seleccionará la carrera y el
            cuatrimestre por el que desee empezar y agregará los puestos de su empresa que estén dentro de la modalidad
            dual.</p>
        </br>

        <form method="post" action="matriz.php?idEmpresa=<?php echo $idEmpresa; ?>">
            <div class="my-4">
                <label for="carrera" class="form-label fw-bold fs-4">Seleccionar Carrera:</label>
                <div class="input-group">
                    <span class="input-group-text text-white btn efectoboton"
                        style="border-radius: 5px 0px 0px 5px !Important;"><i class="bi bi-book-half"></i></span>
                    <select name="carrera" id="carrera" class="form-select fw-bold fs-5" onchange="this.form.submit()"
                        style="color:#444444; border-radius: 0px 20px 20px 0px; z-index: 0;">
                        <option value="">Seleccionar Carrera</option>
                        <?php foreach ($carreras as $carrera) { ?>
                        <option value="<?php echo $carrera['idCarrera']; ?>"
                            <?php if ($carreraSeleccionada == $carrera['idCarrera']) echo 'selected'; ?>>
                            <?php echo $carrera['nombre']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <?php if ($carreraSeleccionada !== null && count($cuatrimestres) > 0) { ?>
            <div class="my-4">
                <label for="cuatrimestre" class="form-label fw-bold fs-4">Seleccionar Cuatrimestre:</label>
                <div class="input-group">
                    <span class="input-group-text text-white btn efectoboton"
                        style="border-radius: 5px 0px 0px 5px !Important;"><i class="bi bi-calendar4"></i></span>
                    <select name="cuatrimestre" id="cuatrimestre" class="form-select fw-bold fs-5"
                        onchange="this.form.submit()"
                        style="color:#444444; border-radius: 0px 20px 20px 0px; z-index: 0;">
                        <option value="">Seleccionar Cuatrimestre</option>
                        <?php foreach ($cuatrimestres as $cuatrimestre) { ?>
                        <option value="<?php echo $cuatrimestre['idCuatrimestre']; ?>"
                            <?php if ($cuatrimestreSeleccionado == $cuatrimestre['idCuatrimestre']) echo 'selected'; ?>>
                            <?php echo $cuatrimestre['nombre']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php } ?>
            </br>
            <table class="table table-bordered fadeIn" id="tablaPuestos">
                <thead>
                    <tr>
                        <th class="text-center"
                            style="width: 50%; font-size: 30px; background-color: #70cc06; color: #fff; border-color: #2e9b0f; border-width: 7px;">
                            Competencias por asignatura</th>
                        <th class="text-center"
                            style="width: 50%; font-size: 30px; background-color: #70cc06; color: #fff; border-color: #2e9b0f; border-width: 7px;">
                            Puestos que cumplen la competencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($asignaturasCompetencias)) { ?>
                    <?php

// Generar las filas de la tabla
foreach ($asignaturasCompetencias as $ac) {
    echo '<tr>';
    echo '<td style="padding: 0px;">';
    echo '<div class="accordion" id="accordionFlushExample' . $ac['idAsignatura'] . '">';

    // Código para generar el contenido de la primera columna de la fila
    echo '<h2 class="accordion-header" id="flush-headingOne' . $ac['idAsignatura'] . '">';
    echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne' . $ac['idAsignatura'] . '" aria-expanded="false" aria-controls="flush-collapseOne' . $ac['idAsignatura'] . '" data-bs-parent="#accordionFlushExample' . $ac['idAsignatura'] . '" style="font-weight: 800;font-size:24px; color: #555">';
    echo $ac['nombre'];
    echo '</button>';
    echo '</h2>';
    echo '<div id="flush-collapseOne' . $ac['idAsignatura'] . '" class="accordion-collapse collapse" aria-labelledby="flush-headingOne' . $ac['idAsignatura'] . '">';
    echo '<div class="accordion-body">';
    echo $ac['competencia'];
    echo '</div>';
    echo '</div>';

    echo '</div>';
    echo '</td>';
    echo '<td>';
    
    // Código para generar los checkboxes de la segunda columna de la fila
    foreach ($puestos as $puesto) {
        $isChecked = isset($puestosCumplimiento[$ac['idAsignatura']][$puesto['idPuesto']]) && $puestosCumplimiento[$ac['idAsignatura']][$puesto['idPuesto']] == 1;
        echo '<div class="form-check">';
        echo '<input class="form-check-input puesto-checkbox" type="checkbox" name="puesto[' . $ac['idAsignatura'] . ']" value="' . $puesto['idPuesto'] . '" data-asignatura="' . $ac['idAsignatura'] . '"';
        if ($isChecked) {
            echo ' checked';
        }
        echo '>';
        echo '<label class="form-check-label">' . $puesto['nombre'] . '</label>';
        echo '</div>';
    }
    
    echo '</td>';
    echo '</tr>';
}
                    ?>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center"
                            style=" width: 50%; font-size: 30px; background-color: #70cc06; color: #fff; border-color: #2e9b0f; border-width: 7px;">
                            Porcentaje de cumplimiento
                        </th>
                        <td id="porcentaje-cumplimiento" class="text-center" style="font-size: 26px">
                            100%
                        </td>
                    </tr>
                </tfoot>
            </table>
            <script>
            // Obtener todos los checkboxes de clase "puesto-checkbox"
            const checkboxes = document.querySelectorAll('.puesto-checkbox');

            // Agregar un evento de cambio a cada checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const puestoId = this.value;
                    const asignaturaIndex = this.dataset.asignatura;
                    const isChecked = this.checked ? 1 : 0;

                    // Enviar una solicitud al servidor para actualizar la tabla "puestos_asignaturas"
                    fetch(`actualizar_puesto_asignatura.php?puestoId=${puestoId}&asignaturaIndex=${asignaturaIndex}&cumple=${isChecked}`, {
                            method: 'POST'
                        })
                        .then(response => {
                            if (response.ok) {
                                console.log('El puesto se actualizó correctamente.');
                                // Calcular el nuevo porcentaje de cumplimiento
                                calcularPorcentajeCumplimiento();
                            } else {
                                console.error('Error al actualizar el puesto.');
                            }
                        })
                        .catch(error => {
                            console.error('Error al enviar la solicitud de actualización.');
                        });
                });
            });

            // Llamar a la función calcularPorcentajeCumplimiento al cargar la página
            calcularPorcentajeCumplimiento();

            // Función para calcular el porcentaje de cumplimiento basado en el cumplimiento de las asignaturas
            function calcularPorcentajeCumplimiento() {
                const asignaturasTotales = document.querySelectorAll('.puesto-checkbox[data-asignatura]')
                    .length; // Obtener la cantidad total de asignaturas

                const asignaturasCumplidas = new Set(); // Utilizamos un Set para almacenar las asignaturas cumplidas

                // Obtener todas las asignaturas que tienen al menos un checkbox marcado
                const checkboxesMarcados = document.querySelectorAll('.puesto-checkbox:checked');
                checkboxesMarcados.forEach(checkbox => {
                    const asignaturaIndex = checkbox.dataset.asignatura;
                    asignaturasCumplidas.add(asignaturaIndex);
                });

                const porcentajeCumplimiento = (asignaturasCumplidas.size / asignaturasTotales) * 100 *
                    <?php echo $cantidadPuestos; ?>; // Calcular el porcentaje de cumplimiento

                // Actualizar el texto del porcentaje de cumplimiento
                const porcentajeElement = document.querySelector('#porcentaje-cumplimiento');

                if (isNaN(porcentajeCumplimiento)) {
                    porcentajeElement.textContent = 'Sin porcentaje.';
                } else {
                    porcentajeElement.textContent = `${porcentajeCumplimiento.toFixed(0)}%`;
                }
            }
            </script>
            <script>
            // Obtener todos los checkboxes de clase "puesto-checkbox"
            const checkboxes = document.querySelectorAll('.puesto-checkbox');

            // Agregar un evento de cambio a cada checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const puestoId = this.value;
                    const asignaturaIndex = this.dataset.asignatura;
                    const isChecked = this.checked ? 1 : 0;

                    // Enviar una solicitud al servidor para actualizar la tabla "puestos_asignaturas"
                    fetch(`actualizar_puesto_asignatura.php?puestoId=${puestoId}&asignaturaIndex=${asignaturaIndex}&cumple=${isChecked}`, {
                            method: 'POST'
                        })
                        .then(response => {
                            if (response.ok) {
                                console.log('El puesto se actualizó correctamente.');
                            } else {
                                console.error('Error al actualizar el puesto.');
                            }
                        })
                        .catch(error => {
                            console.error('Error al enviar la solicitud de actualización.');
                        });
                });
            });
            </script>
            <div class="text-center mt-4">
                <button type="button" class="btn btn-secondary" id="agregarPuestoBtn">Agregar Puesto</button>
                <button type="button" class="btn btn-danger" id="eliminarPuestoBtn">Eliminar Puestos</button>
            </div>
        </form>
        <script>
        // Agregar nuevo puesto
        document.getElementById('agregarPuestoBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Agregar Puesto',
                html: `
        <form method="post" action="matriz.php?idEmpresa=<?php echo $idEmpresa; ?>">
            <div class="mb-3">
                <label for="nombre_puesto" class="form-label">Nombre del Puesto:</label>
                <input type="text" name="nombre_puesto" id="nombre_puesto" class="form-control" required>
                <input type="hidden" name="idCarrera" value="<?php echo $carreraSeleccionada; ?>">
            </div>
            <button type="submit" name="nuevo_puesto" class="btn btn-primary">Agregar Puesto</button>
        </form>
    `,
                showCloseButton: true,
                showConfirmButton: false
            });
        });
        </script>
        <script>
        document.getElementById('eliminarPuestoBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Eliminar Puestos',
                html: `
                <form id="eliminarPuestoForm" method="post">
                    <div class="mb-3">
                        <label for="puesto" class="form-label">Seleccionar Puesto:</label>
                        <select name="puesto" id="puesto" class="form-select" required>
                            <option value="">Seleccionar Puesto</option>
                            <?php foreach ($puestos as $puesto) { ?>
                                <option value="<?php echo $puesto['idPuesto']; ?>">
                                    <?php echo $puesto['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="eliminar_puesto" class="btn btn-danger">Eliminar</button>
                </form>
            `,
                showCloseButton: true,
                showConfirmButton: false
            });

            document.getElementById('eliminarPuestoForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

                var form = event.target;
                var data = new FormData(form);

                fetch('eliminar_puestos.php?idEmpresa=<?php echo $idEmpresa; ?>', {
                        method: 'POST',
                        body: data
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        // Procesar la respuesta JSON
                        if (data.status === 'success') {
                            Swal.fire('Éxito', data.message, 'success');
                            // Realizar cualquier acción adicional después de eliminar el puesto
                            // Por ejemplo, recargar la página
                            location.reload();
                        } else if (data.status === 'error') {
                            Swal.fire('Error', data.message, 'error');
                        }
                    })
                    .catch(function(error) {
                        Swal.fire('Error', 'Ocurrió un error al enviar la solicitud', 'error');
                    });
            });
        });
        </script>

        <style>
        .swal2-html-container {
            padding: 4px;
        }
        </style>
        <br>

    </div>

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
    <!-- Template Main JS File -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>