<?php
session_start(); // Iniciamos la sesión

# Incluyendo librerias necesarias #
require "./code128.php";
$pdf = new PDF_Code128('P','mm','Letter');
$pdf->SetMargins(17,17,17);
$pdf->AddPage();

# Logo de la empresa formato png #
$pdf->Image('./img/utsc_logo-removebg-preview.png', 20, 12, 35, 26, 'PNG');
$pdf->Image('./img/utsc_dual_logo.png',162,12,35,26,'PNG');
// Define la posición y dimensiones del rectángulo del encabezado
$rectXHeader = 20;   // Ajusta estos valores según sea necesario
$rectYHeader = 40;   // Ajusta estos valores según sea necesario
$rectWHeader = 175;  // Ajusta estos valores según sea necesario
$rectHHeader = 18;   // Ajusta estos valores según sea necesario

# Encabezado y datos de la empresa #
$pdf->SetXY($rectXHeader, $rectYHeader);
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(181,8,utf8_decode(strtoupper("REPORTE SEMANAL DE APRENDIZAJE")),0,1,'C');
$pdf->Cell(181,8,utf8_decode(strtoupper("EDUCACIÓN DUAL")),0,1,'C');
 // Dibuja el rectángulo para el encabezado
 $pdf->Rect($rectXHeader, $rectYHeader, $rectWHeader, $rectHHeader);

 $pdf->Ln(2);
require 'cn.php';

// Obtenemos el id del reporte de la URL
if (isset($_GET['id'])) {
  $idReporte = $_GET['id'];

  // Modificamos la consulta para obtener el reporte con el ID correspondiente
  $consulta = "SELECT * FROM borradores WHERE idReporte = $idReporte";
  $resultado = $mysqli->query($consulta);
if ($resultado && $resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
	// Define la posición y dimensiones del rectángulo de los datos de la empresa
	$rectXData = 17.5;   // Ajusta estos valores según sea necesario
	$rectYData = 60;   // Ajusta estos valores según sea necesario
	$rectWData = 180;  // Ajusta estos valores según sea necesario
	$rectHData = 23;   // Ajusta estos valores según sea necesario

	$pdf->SetXY($rectXData, $rectYData);
	$pdf->SetFont('Arial','B',12);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(49.5, 9, utf8_decode("Educando Aprendiz: "), 0, 0, 'L');
		$pdf->SetTextColor(0, 0, 0);
		$nombreCompleto = $row['nombres'] . ' ' . $row['apellidos'];
		$pdf->Cell(40, 9, utf8_decode($nombreCompleto), 0, 0, 'L');
	
	}
	$pdf->Ln(4);

	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(50,9,utf8_decode("Empresa:"),0,0,'L');
	$pdf->Cell(40,9,utf8_decode($row['empresa']),0,0,'L');
	


	$pdf->Ln(4);

	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(50,9,utf8_decode("Carrera:"),0,0,'L');

	$pdf->Cell(40,9,utf8_decode($row['carrera']),0,0,'L');

	$pdf->SetTextColor(0,0,0);

	
	 ##
	$pdf->SetTextColor(0,0,0);
	
	$pdf->Ln(4);
	
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(50,9, utf8_decode("Semana de Aprendizaje:"),0,0,'L');
	$pdf->Cell(40,9,utf8_decode($row['semana']),0,0,'L');

	$pdf->Ln(4);

	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(26,9,utf8_decode(strtoupper("No. Borrador: ")),0,0,'L');
	$pdf->Cell(10,9,$row['idReporte'],0,0,'L');

	$pdf->Ln(2);
    // Dibuja el rectángulo para los datos de la empresa
    $pdf->Rect($rectXData, $rectYData, $rectWData, $rectHData);


	
	$pdf->SetTextColor(0,0,0);

	$pdf->Ln(2);

	
	//Dibuja el rectángulo
	$rectX = 16;   // Ajusta estos valores según sea necesario
	$rectY = 38;   // Ajusta estos valores según sea necesario
	$rectW = 183;  // Ajusta estos valores según sea necesario
	$rectH = 46;  // Ajusta estos valores según sea necesario
	$pdf->Rect($rectX, $rectY, $rectW, $rectH);
	$boldWidth = 0.4;
	for ($i = 0; $i <= $boldWidth; $i += 0.1) {
		$pdf->Rect($rectX - $i, $rectY - $i, $rectW + 2*$i, $rectH + 2*$i);
	}

	$pdf->Ln(10);

	 // Añadir la descripción de las actividades
	 $pdf->SetFont('Arial','',12);
	$textoDescripcion = "DESCRIPCIÓN DE ACTIVIDADES REALIZADAS pudiéndose integrar evidencias en fotografía y video con autorización previa de la empresa formadora, se deberá elaborar el reporte tan extenso como sea  necesario para documentar la evidencia de tu aprendizaje y debe estar revisada por tu instructor y formador empresarial, así como tu tutor académico, este formato y sus evidencias no pueden ser utilizados para otro fin que la evidencia del aprendizaje, en caso de que la empresa NO autorice la utilización de evidencia fotográfica o video favor de incluir otras evidencias demostrativas de aprendizaje).";
	$pdf->SetFillColor(255, 255, 255); // Color de fondo blanco
	$pdf->SetTextColor(255, 255, 255); // Color de texto blanco
	$pdf->SetTextColor(0, 0, 0); // Color de texto negro
	$pdf->MultiCell(183, 4, utf8_decode($textoDescripcion), 0, 'J', true);

	$pdf->Ln(1);


	function truncate($string, $length, $append = ".") {
        $string = trim($string);

        if(strlen($string) > $length) {
            $string = substr($string, 0, $length) . $append;
        }

        return $string;
    }
	// Altura máxima para el contenido de un día
	$alturaMaxima = 150;

	// Margen inferior de la página
	$margin = 10;  // Ajusta este valor según sea necesario

	# Tabla de dia lunes #
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->SetTextColor(0,0,0);

	 // Chequea si el contenido del día excederá el límite de la página
	if ($pdf->GetY() + $alturaMaxima > ($pdf->GetPageHeight() - $margin)) {
	$pdf->AddPage();
  	}
	$pdf->Cell(40,9,utf8_decode($row['fecha_L']),1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);

	$pdf->Ln(3);
    $pdf->SetTextColor(0,0,0);
	
    // Truncar el contenido del primer párrafo
	$resumenL = truncate(strip_tags($row['resumen_L']), 15000); // Truncate to characters
	$resumenL = str_replace('&nbsp;', ' ', $resumenL);

	// Mostrar el primer párrafo
	$pdf->MultiCell(183, 4.5, $resumenL, 1, 'J', true);
	$pdf->Ln(2);
	
	// Mostrar la imagen subida para el día lunes si existe
$imagenL = $row['img_L'];
if ($imagenL) {
    // Obtener las dimensiones de la imagen
    list($width, $height) = getimagesize($imagenL);

    // Obtener el ancho de la página
    $pageWidth = $pdf->GetPageWidth();

    // Calcular el nuevo tamaño de la imagen manteniendo la proporción
    $maxWidth = $pageWidth - $pdf->GetX() * 2;
    $maxHeight = $maxWidth * $height / $width;

		// Comprobar si hay suficiente espacio en la página actual para la imagen
		if ($pdf->GetY() + $maxHeight > ($pdf->GetPageHeight() - $margin)) {
			// Si no hay suficiente espacio, agrega una nueva página
			$pdf->AddPage();
		}

    // Generar la imagen a partir de la cadena de texto con el nuevo tamaño
    $pdf->Image($imagenL, $pdf->GetX(), $pdf->GetY(), $maxWidth, $maxHeight);
    $pdf->Ln(65); // ajustar el salto de línea según el tamaño de la imagen

	// Obtener la posición Y después de agregar la imagen
    $newY = $pdf->GetY() + $maxHeight;

    // Establecer la nueva posición Y para asegurar que el contenido siguiente no se superponga
    $pdf->SetY($newY);
}
	
	$pdf->Ln(10);

	# Tabla de dia martes #
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(255, 255, 255 );
	$pdf->SetDrawColor(255, 255, 255 );
	$pdf->SetTextColor(0,0,0);

	 // Altura máxima para el contenido de un día
	 $alturaMaxima = 150;

	 // Margen inferior de la página
	 $margin = 10;  // Ajusta este valor según sea necesario

	// Chequea si el contenido del día excederá el límite de la página
	if ($pdf->GetY() + $alturaMaxima > ($pdf->GetPageHeight() - $margin)) {
		$pdf->AddPage();
		  }
	$pdf->Cell(40,9,utf8_decode($row['fecha_M']),1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Ln(3);
	$pdf->SetTextColor(0, 0, 0);
	$resumenM = strip_tags($row['resumen_M']); // Eliminar etiquetas HTML

	// Truncar el contenido del primer párrafo
	$resumenM_truncated = truncate($resumenM, 15000); // Truncate to 50 characters

	// Mostrar el primer párrafo
	$pdf->MultiCell(183, 4.5, $resumenM_truncated, 1, 'J', true);
	$pdf->Ln(2);
	
	// Insertar imagen para el dia martes si existe
	$imagenM = $row['img_M'];
	if ($imagenM) {
    // Obtener las dimensiones de la imagen
    list($width, $height) = getimagesize($imagenM);
    // Obtener el ancho de la página
    $pageWidth = $pdf->GetPageWidth();

    // Calcular el nuevo tamaño de la imagen manteniendo la proporción
    $maxWidth = $pageWidth - $pdf->GetX() * 2;
    $maxHeight = $maxWidth * $height / $width;
	
	 // Comprobar si hay suficiente espacio en la página actual para la imagen
	 if ($pdf->GetY() + $maxHeight > ($pdf->GetPageHeight() - $margin)) {
        // Si no hay suficiente espacio, agrega una nueva página
        $pdf->AddPage();
    }

    // Generar la imagen a partir de la cadena de texto con el nuevo tamaño
    $pdf->Image($imagenM, $pdf->GetX(), $pdf->GetY(), $maxWidth, $maxHeight);
	$pdf->Ln(65); // ajustar el salto de línea según el tamaño de la imagen

	// Obtener la posición Y después de agregar la imagen
    $newY = $pdf->GetY() + $maxHeight;

    // Establecer la nueva posición Y para asegurar que el contenido siguiente no se superponga
    $pdf->SetY($newY);
}

	// Dividir el texto en párrafos
	$parrafos = explode("\n", $texto);

	// Imprimir cada párrafo en una celda separada
	foreach ($parrafos as $parrafo) {
  $pdf->MultiCell(181, 10, $parrafo, 1, 'L', true);
	}
	$pdf->Ln(10);
	// Altura máxima para el contenido de un día
	$alturaMaxima = 150;

	// Margen inferior de la página
	$margin = 10;  // Ajusta este valor según sea necesario

	# Tabla de dia miercoles #
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(255, 255, 255 );
	$pdf->SetDrawColor(255, 255, 255 );
	$pdf->SetTextColor(0,0,0);

	 // Altura máxima para el contenido de un día
	 $alturaMaxima = 150;

	 // Margen inferior de la página
	 $margin = 10;  // Ajusta este valor según sea necesario

	// Chequea si el contenido del día excederá el límite de la página
	if ($pdf->GetY() + $alturaMaxima > ($pdf->GetPageHeight() - $margin)) {
		$pdf->AddPage();
		  }
	$pdf->Cell(40,9,utf8_decode($row['fecha_Mi']),1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Ln(3);

	$pdf->SetFont('Arial', '', 12);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$resumenMi = strip_tags($row['resumen_Mi']); // Eliminar etiquetas HTML
     // Truncar el contenido del primer párrafo
	$resumenMi_truncated = truncate($resumenMi, 15000); // Truncate to 50 characters

	// Mostrar el primer párrafo
	$pdf->MultiCell(183, 4.5, $resumenMi_truncated, 1, 'J', true);
	$pdf->Ln(2);
	

	// Insertar imagen para el dia martes si existe
	$imagenMi = $row['img_Mi'];
	if ($imagenMi) {
    // Obtener las dimensiones de la imagen
    list($width, $height) = getimagesize($imagenMi);

    // Obtener el ancho de la página
    $pageWidth = $pdf->GetPageWidth();

    // Calcular el nuevo tamaño de la imagen manteniendo la proporción
    $maxWidth = $pageWidth - $pdf->GetX() * 2;
    $maxHeight = $maxWidth * $height / $width;

	  // Comprobar si hay suficiente espacio en la página actual para la imagen
	  if ($pdf->GetY() + $maxHeight > ($pdf->GetPageHeight() - $margin)) {
        // Si no hay suficiente espacio, agrega una nueva página
        $pdf->AddPage();
    }


    // Generar la imagen a partir de la cadena de texto con el nuevo tamaño
    $pdf->Image($imagenMi, $pdf->GetX(), $pdf->GetY(), $maxWidth, $maxHeight);

	$pdf->Ln(65); // Ajustar el salto de línea según el tamaño de la imagen

    // Obtener la posición Y después de agregar la imagen
    $newY = $pdf->GetY() + $maxHeight;

    // Establecer la nueva posición Y para asegurar que el contenido siguiente no se superponga
    $pdf->SetY($newY);

}
$pdf->Ln(10);

	# Tabla de dia jueves #
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetDrawColor(255, 255, 255 );
	$pdf->SetTextColor(0,0,0);

	 // Altura máxima para el contenido de un día
	 $alturaMaxima = 150;

	 // Margen inferior de la página
	 $margin = 10;  // Ajusta este valor según sea necesario

	// Chequea si el contenido del día excederá el límite de la página
	if ($pdf->GetY() + $alturaMaxima > ($pdf->GetPageHeight() - $margin)) {
		$pdf->AddPage();
		  }
	$pdf->Cell(40,9,utf8_decode($row['fecha_J']),1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Ln(3);

	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->SetTextColor(0,0,0);
	$resumenJ = strip_tags($row['resumen_J']); // Eliminar etiquetas HTML
	 // Truncar el contenido del primer párrafo
	$resumenJ_truncated = truncate($resumenJ, 15000); // Truncate to 50 characters

	// Mostrar el primer párrafo
	$pdf->MultiCell(183, 4.5, $resumenJ_truncated, 1, 'J', true);
	$pdf->Ln(2);

	// Insertar imagen para el dia martes si existe
	$imagenJ = $row['img_J'];
	if ($imagenJ) {
    // Obtener las dimensiones de la imagen
    list($width, $height) = getimagesize($imagenJ);

    // Obtener el ancho de la página
    $pageWidth = $pdf->GetPageWidth();

    // Calcular el nuevo tamaño de la imagen manteniendo la proporción
    $maxWidth = $pageWidth - $pdf->GetX() * 2;
    $maxHeight = $maxWidth * $height / $width;
	 
	// Comprobar si hay suficiente espacio en la página actual para la imagen
    if ($pdf->GetY() + $maxHeight > ($pdf->GetPageHeight() - $margin)) {
        // Si no hay suficiente espacio, agrega una nueva página
        $pdf->AddPage();
    }

    // Generar la imagen a partir de la cadena de texto con el nuevo tamaño
    $pdf->Image($imagenJ, $pdf->GetX(), $pdf->GetY(), $maxWidth, $maxHeight);
	$pdf->Ln(65); // Ajustar el salto de línea según el tamaño de la imagen

    // Obtener la posición Y después de agregar la imagen
    $newY = $pdf->GetY() + $maxHeight;

    // Establecer la nueva posición Y para asegurar que el contenido siguiente no se superponga
    $pdf->SetY($newY);
}
$pdf->Ln(10);

	# Tabla de dia viernes #
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->SetTextColor(0,0,0);

	 // Altura máxima para el contenido de un día
	 $alturaMaxima = 150;

	 // Margen inferior de la página
	 $margin = 10;  // Ajusta este valor según sea necesario

	// Chequea si el contenido del día excederá el límite de la página
	if ($pdf->GetY() + $alturaMaxima > ($pdf->GetPageHeight() - $margin)) {
		$pdf->AddPage();
		  }
	$pdf->Cell(40,9,utf8_decode($row['fecha_V']),1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Ln(3);

	$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

$resumenV = strip_tags($row['resumen_V']); // Eliminar

// Truncar el contenido del primer párrafo
$resumenV_truncated = truncate($resumenV, 15000); // Truncate to 50 characters

// Mostrar el primer párrafo
$pdf->MultiCell(183, 4.5, $resumenV_truncated, 1, 'J', true);
$pdf->Ln(2);

// Insertar imagen para el dia martes si existe
$imagenV = $row['img_V'];
if ($imagenV) {
// Obtener las dimensiones de la imagen
list($width, $height) = getimagesize($imagenV);

// Obtener el ancho de la página
$pageWidth = $pdf->GetPageWidth();

// Calcular el nuevo tamaño de la imagen manteniendo la proporción
$maxWidth = $pageWidth - $pdf->GetX() * 2;
$maxHeight = $maxWidth * $height / $width;

// Comprobar si hay suficiente espacio en la página actual para la imagen
if ($pdf->GetY() + $maxHeight > ($pdf->GetPageHeight() - $margin)) {
	// Si no hay suficiente espacio, agrega una nueva página
	$pdf->AddPage();
}


// Generar la imagen a partir de la cadena de texto con el nuevo tamaño
$pdf->Image($imagenV, $pdf->GetX(), $pdf->GetY(), $maxWidth, $maxHeight);
$pdf->Ln(65); // Ajustar el salto de línea según el tamaño de la imagen

    // Obtener la posición Y después de agregar la imagen
    $newY = $pdf->GetY() + $maxHeight;

    // Establecer la nueva posición Y para asegurar que el contenido siguiente no se superponga
    $pdf->SetY($newY);

}

$pdf->AddPage(); // Agregar una nueva página

# Sección de Retroalimentación y Observaciones #
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(40, 9, utf8_decode("Retroalimentación y Observaciones"), 0, 0, 'L', true);

$pdf->Ln(10);

# Retroalimentación del Instructor #
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(40, 9, utf8_decode("Instructor:"), 0, 0, 'L', true);
$pdf->Ln(60);

# Retroalimentación del FORMADOR #
$pdf->Cell(40, 9, utf8_decode("Formador:"), 0, 0, 'L', true);
$pdf->Ln(60);

# Retroalimentacion del tutor academico #
$pdf->Cell(40, 9, utf8_decode("Tutor Académico:"), 0, 0, 'L', true);

$pdf->Ln(45);

#Coloca la tabla de firmas en celdas y los nombres que corresponden abajo de ellas, (texto largo)

# Tabla de Firmas #
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);
#$pdf->Cell(181, 10, utf8_decode("Firmas"), 0, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);

$cellWidth = 45;
$cellHeight = 40;

$initX = $pdf->GetX();
$initY = $pdf->GetY();

# Primera celda #
$pdf->MultiCell($cellWidth, $cellHeight-10, '', 1, 'C', true);
$pdf->SetXY($initX, $initY+$cellHeight-10);
$pdf->MultiCell($cellWidth, 5, 'Firma de Instructor Empresa ', 0, 'C', false);
$initX += $cellWidth;

# Segunda celda #
$pdf->SetXY($initX, $initY);
$pdf->MultiCell($cellWidth, $cellHeight-10, '', 1, 'C', true);
$pdf->SetXY($initX, $initY+$cellHeight-10);
$pdf->MultiCell($cellWidth, 5, 'Firma de Formador Empresa', 0, 'C', false);
$initX += $cellWidth;

# Tercera celda #
$pdf->SetXY($initX, $initY);
$pdf->MultiCell($cellWidth, $cellHeight-10, '', 1, 'C', true);
$pdf->SetXY($initX, $initY+$cellHeight-10);
$pdf->MultiCell($cellWidth, 5, 'Firma del Tutor Academico', 0, 'C', false);
$initX += $cellWidth;

# Cuarta celda #
$pdf->SetXY($initX, $initY);
$pdf->MultiCell($cellWidth+1, $cellHeight-10, '', 1, 'C', true);
$pdf->SetXY($initX, $initY+$cellHeight-10);
$pdf->MultiCell($cellWidth+1, 5, 'Firma del Educando Aprendiz', 0, 'C', false);

$pdf->Ln($cellHeight);

// Generar el PDF en una ubicación específica
$pdfPath = 'Reporte_Semanal.pdf';
$pdf->Output($pdfPath, 'F');

// Redireccionar al archivo PDF
header("Location: $pdfPath");
exit;
# Nombre del archivo PDF #
#$pdf->Output();
}