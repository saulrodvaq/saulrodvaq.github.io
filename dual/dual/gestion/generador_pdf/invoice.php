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
$rectXHeader = 17;   // Ajusta estos valores según sea necesario
$rectYHeader = 42;   // Ajusta estos valores según sea necesario
$rectWHeader = 175;  // Ajusta estos valores según sea necesario
$rectHHeader = 42;   // Ajusta estos valores según sea necesario

# Encabezado y datos de la empresa #
$pdf->SetXY($rectXHeader, $rectYHeader);
$pdf->SetFont('Arial','B',18,'',true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(181,8,strtoupper("REPORTE SEMANAL DE APRENDIZAJE"),0,1,'C');
$pdf->Cell(181,8,strtoupper(mb_convert_encoding("EDUCACIÓN DUAL",'ISO-8859-1', 'UTF-8')),0,1,'C');
 // Dibuja el rectángulo para el encabezado
 $pdf->SetLineWidth(0.8);
 $pdf->Rect($rectXHeader, $rectYHeader, $rectWHeader, $rectHHeader);

 $pdf->Ln(2);
require 'cn.php';

// Obtenemos el id del reporte de la URL
if (isset($_GET['id'])) {
  $idReporte = $_GET['id'];

  // Modificamos la consulta para obtener el reporte con el ID correspondiente
  $consulta = "SELECT * FROM reportes WHERE idReporte = $idReporte";
  $resultado = $mysqli->query($consulta);
if ($resultado && $resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
	
	$pdf->SetFont('Arial','B',12);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(49.5, 9, "Educando Aprendiz: ", 0, 0, 'L');
		$pdf->SetTextColor(0, 0, 0);
		$nombreCompleto = $row['nombres'] . ' ' . $row['apellidos'];
		$nombres = $row['nombres'];
		$apellidos = $row['apellidos'];
		$pdf->Cell(40, 9, mb_convert_encoding($nombreCompleto,'ISO-8859-1','UTF-8'), 0, 0, 'L');
		
	
	}
	$pdf->Ln(4);

	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(50,9,mb_convert_encoding("Empresa:",'ISO-8859-1','UTF-8'),0,0,'L');
	$pdf->Cell(40,9,mb_convert_encoding($row['empresa'],'ISO-8859-1','UTF-8'),0,0,'L');
	


	$pdf->Ln(4);

	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(50,9,mb_convert_encoding("Carrera:",'ISO-8859-1','UTF-8'),0,0,'L');

	$pdf->Cell(40,9,mb_convert_encoding($row['carrera'],'ISO-8859-1','UTF-8'),0,0,'L');

	$pdf->SetTextColor(0,0,0);

	
	 ##
	$pdf->SetTextColor(0,0,0);
	
	$pdf->Ln(4);
	
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(50,9,mb_convert_encoding("Semana de Aprendizaje:",'ISO-8859-1', 'UTF-8'),0,0,'L');
	$pdf->Cell(40,9,mb_convert_encoding($row['semana'],'ISO-8859-1','UTF-8'),0,0,'L');

	$pdf->Ln(4);

	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(26,9,strtoupper(mb_convert_encoding("No. Reporte: ",'ISO-8859-1', 'UTF-8')),0,0,'L');
	$pdf->Cell(10,9,mb_convert_encoding($row['idReporte'],'ISO-8859-1','UTF-8'),0,0,'L');

	$pdf->Ln(2);
    


	
	$pdf->SetTextColor(0,0,0);

	$pdf->Ln(2);

	
	

	$pdf->Ln(10);

	 // Añadir la descripción de las actividades
	 $pdf->SetFont('Arial','',12);
	$textoDescripcion = "DESCRIPCIÓN DE ACTIVIDADES REALIZADAS pudiéndose integrar evidencias en fotografía y video con autorización previa de la empresa formadora, se deberá elaborar el reporte tan extenso como sea  necesario para documentar la evidencia de tu aprendizaje y debe estar revisada por tu instructor y formador empresarial, así como tu tutor académico, este formato y sus evidencias no pueden ser utilizados para otro fin que la evidencia del aprendizaje, en caso de que la empresa NO autorice la utilización de evidencia fotográfica o video favor de incluir otras evidencias demostrativas de aprendizaje).";
	$pdf->SetFillColor(255, 255, 255); // Color de fondo blanco
	$pdf->SetTextColor(255, 255, 255); // Color de texto blanco
	$pdf->SetTextColor(0, 0, 0); // Color de texto negro
	$pdf->MultiCell(183, 4.5, mb_convert_encoding($textoDescripcion,'ISO-8859-1', 'UTF-8'), 0, 'J', true);
	$pdf->Ln(1);


	function truncate($string, $length, $append = ".") {
        $string = trim($string);

        if(strlen($string) > $length) {
            $string = substr($string, 0, $length) . $append;
        }

        return $string;
    }
	// Altura máxima para el contenido de un día
	$alturaMaxima = 145;

	// Margen inferior de la página
	$margin = 10;  // Ajusta este valor según sea necesario

	# Tabla de dia lunes #
	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->SetTextColor(0,0,0);
	 // Chequea si el contenido del día excederá el límite de la página
	 // Chequea si el contenido del día excederá el límite de la página
	if ($pdf->GetY() + $alturaMaxima > ($pdf->GetPageHeight() - $margin)) {
	$pdf->AddPage();
  	}
	$pdf->Cell(40,9,$row['fecha_L'],1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);

	$pdf->Ln(3);
    $pdf->SetTextColor(0,0,0);
	
    // Truncar el contenido del primer párrafo
	$resumenL = truncate(strip_tags(mb_convert_encoding($row['resumen_L'],'ISO-8859-1', 'UTF-8')), 15000); // Truncate to characters
	$resumenL = str_replace('&nbsp;', ' ', $resumenL);
	$resumenL = str_replace('&ntilde;', mb_convert_encoding('ñ','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&Ntilde;', mb_convert_encoding('Ñ','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&quot;', mb_convert_encoding('"','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&acute;', mb_convert_encoding("´",'ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&amp;', mb_convert_encoding('&','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&#39;', mb_convert_encoding("'",'ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&iquest;', mb_convert_encoding('¿','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&iexcl;', mb_convert_encoding('¡','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&deg;', mb_convert_encoding('°','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&uml;', mb_convert_encoding('¨','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&aacute;', mb_convert_encoding('á','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&eacute;', mb_convert_encoding('é','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&iacute;', mb_convert_encoding('í','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&oacute;', mb_convert_encoding('ó','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&uacute;', mb_convert_encoding('ú','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&Aacute;', mb_convert_encoding('Á','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&Eacute;', mb_convert_encoding('É','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&Iacute;', mb_convert_encoding('Í','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&Oacute;', mb_convert_encoding('Ó','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&Uacute;', mb_convert_encoding('Ú','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&lt;', mb_convert_encoding('<','ISO-8859-1', 'UTF-8'), $resumenL);
	$resumenL = str_replace('&gt;', mb_convert_encoding('>','ISO-8859-1', 'UTF-8'), $resumenL);
	

	

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
	$pdf->Cell(40,9,$row['fecha_M'],1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Ln(3);
	$pdf->SetTextColor(0, 0, 0);

	// Truncar el contenido del primer párrafo
	$resumenM = truncate(strip_tags(mb_convert_encoding($row['resumen_M'],'ISO-8859-1', 'UTF-8')), 15000); // Truncate to characters
	$resumenM = str_replace('&nbsp;', ' ', $resumenM);
	$resumenM = str_replace('&ntilde;', mb_convert_encoding('ñ','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&Ntilde;', mb_convert_encoding('Ñ','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&quot;', mb_convert_encoding('"','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&acute;', mb_convert_encoding("´",'ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&amp;', mb_convert_encoding('&','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&#39;', mb_convert_encoding("'",'ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&iquest;', mb_convert_encoding('¿','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&iexcl;', mb_convert_encoding('¡','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&deg;', mb_convert_encoding('°','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&uml;', mb_convert_encoding('¨','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&aacute;', mb_convert_encoding('á','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&eacute;', mb_convert_encoding('é','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&iacute;', mb_convert_encoding('í','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&oacute;', mb_convert_encoding('ó','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&uacute;', mb_convert_encoding('ú','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&Aacute;', mb_convert_encoding('Á','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&Eacute;', mb_convert_encoding('É','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&Iacute;', mb_convert_encoding('Í','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&Oacute;', mb_convert_encoding('Ó','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&Uacute;', mb_convert_encoding('Ú','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&lt;', mb_convert_encoding('<','ISO-8859-1', 'UTF-8'), $resumenM);
	$resumenM = str_replace('&gt;', mb_convert_encoding('>','ISO-8859-1', 'UTF-8'), $resumenM);

	// Mostrar el primer párrafo
	$pdf->MultiCell(183, 4.5, $resumenM, 1, 'J', true);
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
	$pdf->Cell(40,9,$row['fecha_Mi'],1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Ln(3);

	$pdf->SetFont('Arial', '', 12);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	
     // Truncar el contenido del primer párrafo
	 $resumenMi = truncate(strip_tags(mb_convert_encoding($row['resumen_Mi'],'ISO-8859-1', 'UTF-8')), 15000); // Truncate to characters
	$resumenMi = str_replace('&nbsp;', ' ', $resumenMi);
	$resumenMi = str_replace('&ntilde;', mb_convert_encoding('ñ','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&Ntilde;', mb_convert_encoding('Ñ','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&quot;', mb_convert_encoding('"','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&acute;', mb_convert_encoding("´",'ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&amp;', mb_convert_encoding('&','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&#39;', mb_convert_encoding("'",'ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&iquest;', mb_convert_encoding('¿','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&iexcl;', mb_convert_encoding('¡','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&deg;', mb_convert_encoding('°','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&uml;', mb_convert_encoding('¨','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&aacute;', mb_convert_encoding('á','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&eacute;', mb_convert_encoding('é','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&iacute;', mb_convert_encoding('í','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&oacute;', mb_convert_encoding('ó','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&uacute;', mb_convert_encoding('ú','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&Aacute;', mb_convert_encoding('Á','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&Eacute;', mb_convert_encoding('É','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&Iacute;', mb_convert_encoding('Í','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&Oacute;', mb_convert_encoding('Ó','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&Uacute;', mb_convert_encoding('Ú','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&lt;', mb_convert_encoding('<','ISO-8859-1', 'UTF-8'), $resumenMi);
	$resumenMi = str_replace('&gt;', mb_convert_encoding('>','ISO-8859-1', 'UTF-8'), $resumenMi);

	// Mostrar el primer párrafo
	$pdf->MultiCell(183, 4.5, $resumenMi, 1, 'J', true);
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
	$pdf->Cell(40,9,$row['fecha_J'],1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Ln(3);

	$pdf->SetFont('Arial','',12);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->SetTextColor(0,0,0);

	 // Truncar el contenido del primer párrafo
	 $resumenJ = truncate(strip_tags(mb_convert_encoding($row['resumen_J'],'ISO-8859-1', 'UTF-8')), 15000); // Truncate to characters
	$resumenJ = str_replace('&nbsp;', ' ', $resumenJ);
	$resumenJ = str_replace('&ntilde;', mb_convert_encoding('ñ','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&Ntilde;', mb_convert_encoding('Ñ','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&quot;', mb_convert_encoding('"','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&acute;', mb_convert_encoding("´",'ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&amp;', mb_convert_encoding('&','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&#39;', mb_convert_encoding("'",'ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&iquest;', mb_convert_encoding('¿','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&iexcl;', mb_convert_encoding('¡','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&deg;', mb_convert_encoding('°','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&uml;', mb_convert_encoding('¨','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&aacute;', mb_convert_encoding('á','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&eacute;', mb_convert_encoding('é','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&iacute;', mb_convert_encoding('í','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&oacute;', mb_convert_encoding('ó','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&uacute;', mb_convert_encoding('ú','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&Aacute;', mb_convert_encoding('Á','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&Eacute;', mb_convert_encoding('É','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&Iacute;', mb_convert_encoding('Í','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&Oacute;', mb_convert_encoding('Ó','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&Uacute;', mb_convert_encoding('Ú','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&lt;', mb_convert_encoding('<','ISO-8859-1', 'UTF-8'), $resumenJ);
	$resumenJ = str_replace('&gt;', mb_convert_encoding('>','ISO-8859-1', 'UTF-8'), $resumenJ);

	// Mostrar el primer párrafo
	$pdf->MultiCell(183, 4.5, $resumenJ, 1, 'J', true);
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
	$pdf->Cell(40,9,$row['fecha_V'],1,0,'L',true);
	$pdf->Ln(4);
	$pdf->SetTextColor(0,0,0);
	/*----------  Detalles de la tabla  ----------*/
	$pdf->Ln(3);

	$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);



// Truncar el contenido del primer párrafo
$resumenV = truncate(strip_tags(mb_convert_encoding($row['resumen_V'],'ISO-8859-1', 'UTF-8')), 15000); // Truncate to characters
$resumenV = str_replace('&nbsp;', ' ', $resumenV);
	$resumenV = str_replace('&ntilde;', mb_convert_encoding('ñ','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&Ntilde;', mb_convert_encoding('Ñ','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&quot;', mb_convert_encoding('"','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&acute;', mb_convert_encoding("´",'ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&amp;', mb_convert_encoding('&','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&#39;', mb_convert_encoding("'",'ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&iquest;', mb_convert_encoding('¿','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&iexcl;', mb_convert_encoding('¡','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&deg;', mb_convert_encoding('°','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&uml;', mb_convert_encoding('¨','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&aacute;', mb_convert_encoding('á','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&eacute;', mb_convert_encoding('é','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&iacute;', mb_convert_encoding('í','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&oacute;', mb_convert_encoding('ó','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&uacute;', mb_convert_encoding('ú','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&Aacute;', mb_convert_encoding('Á','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&Eacute;', mb_convert_encoding('É','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&Iacute;', mb_convert_encoding('Í','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&Oacute;', mb_convert_encoding('Ó','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&Uacute;', mb_convert_encoding('Ú','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&lt;', mb_convert_encoding('<','ISO-8859-1', 'UTF-8'), $resumenV);
	$resumenV = str_replace('&gt;', mb_convert_encoding('>','ISO-8859-1', 'UTF-8'), $resumenV);



// Mostrar el primer párrafo
$pdf->MultiCell(183, 4.5, $resumenV, 1, 'J', true);
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
$pdf->Cell(40, 9, mb_convert_encoding("Retroalimentación y Observaciones", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L', true);

$pdf->Ln(10);

# Retroalimentación del Instructor #
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(40, 9, "Instructor:", 0, 0, 'L', true);
$pdf->Ln(60);

# Retroalimentación del FORMADOR #
$pdf->Cell(40, 9, "Formador:", 0, 0, 'L', true);
$pdf->Ln(60);

# Retroalimentacion del tutor academico #
$pdf->Cell(40, 9, mb_convert_encoding("Tutor Académico:",'ISO-8859-1', 'UTF-8'), 0, 0, 'L', true);

$pdf->Ln(45);

#Coloca la tabla de firmas en celdas y los nombres que corresponden abajo de ellas, (texto largo)

# Tabla de Firmas #
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);
#$pdf->Cell(181, 10, "Firmas", 0, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);

$cellWidth = 45;
$cellHeight = 40;

$initX = $pdf->GetX();
$initY = $pdf->GetY();

include("../../templates/conexion.php");
$idInstructor=$row['idInstructor'];
$query = "SELECT nombres, apellidos FROM instructores WHERE idInstructor = $idInstructor";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $rowInstructor = mysqli_fetch_assoc($result);
    $nombreInstructor = $rowInstructor['nombres'];
	$apellidosInstructor = $rowInstructor['apellidos'];
} else {
    // Manejo de error si no se encuentra el instructor
    $nombreInstructor = 'Sin firma del instructor';
}

$idFormador=$row['idFormador'];
$query = "SELECT nombres, apellidos FROM formadores WHERE idFormador = $idFormador";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $rowFormador = mysqli_fetch_assoc($result);
    $nombreFormador = $rowFormador['nombres'];
	$apellidosFormador = $rowFormador['apellidos'];
} else {
    // Manejo de error si no se encuentra el formador
    $nombreFormador = 'Sin firma del formador';
}

$idTutor=$row['idTutor'];
$query = "SELECT nombres, apellidos FROM tutores WHERE idTutor = $idTutor";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $rowTutor = mysqli_fetch_assoc($result);
    $nombreTutor = $rowTutor['nombres'];
	$apellidosTutor = $rowTutor['apellidos'];
} else {
    // Manejo de error si no se encuentra el tutor
    $nombreTutor = 'Sin firma del tutor';
}
$pdf->SetFont('Arial','B',10);
# Primera celda #
$pdf->MultiCell($cellWidth, $cellHeight-10, '', 1, 'C', true);
$pdf->SetXY($initX, $initY+$cellHeight-10);
$pdf->MultiCell($cellWidth, 5, mb_convert_encoding('Firma de Instructor Empresa ','ISO-8859-1', 'UTF-8'), 0, 'C', false);
if ($row['estatus_instructor'] == 'aprobado') {
	$pdf->SetXY($initX+13, $initY+$cellHeight-48);
$pdf->Cell(100, 10, $row['f_aprobado_instructor'], 0, 0, 'L');
$pdf->SetXY($initX+3, $initY+$cellHeight-32);
$pdf->Cell(100, 10, $nombreInstructor, 0, 0, 'L');
$pdf->SetXY($initX+3, $initY+$cellHeight-28);
$pdf->Cell(100, 10, $apellidosInstructor, 0, 0, 'L');
}
$initX += $cellWidth;

# Segunda celda #
$pdf->SetXY($initX, $initY);
$pdf->MultiCell($cellWidth, $cellHeight-10, '', 1, 'C', true);
$pdf->SetXY($initX, $initY+$cellHeight-10);
$pdf->MultiCell($cellWidth, 5, mb_convert_encoding('Firma de Formador Empresa','ISO-8859-1', 'UTF-8'), 0, 'C', false);
if ($row['estatus_instructor'] == 'aprobado' && $row['estatus_tutor'] == 'aprobado') {
	$pdf->SetXY($initX+13, $initY+$cellHeight-48);
$pdf->Cell(100, 10, $row['f_aprobado_formador'], 0, 0, 'L');
$pdf->SetXY($initX+3, $initY+$cellHeight-32);
$pdf->Cell(100, 10, $nombreFormador, 0, 0, 'L');
$pdf->SetXY($initX+3, $initY+$cellHeight-28);
$pdf->Cell(100, 10, $apellidosFormador, 0, 0, 'L');
}
$initX += $cellWidth;

# Tercera celda #
$pdf->SetXY($initX, $initY);
$pdf->MultiCell($cellWidth, $cellHeight-10, '', 1, 'C', true);
$pdf->SetXY($initX, $initY+$cellHeight-10);
$pdf->MultiCell($cellWidth, 5,mb_convert_encoding('Firma del Tutor Académico','ISO-8859-1', 'UTF-8'), 0, 'C', false);
if ($row['estatus_tutor'] == 'aprobado') {
	$pdf->SetXY($initX+13, $initY+$cellHeight-48);
$pdf->Cell(100, 10, $row['f_aprobado_tutor'], 0, 0, 'L');
$pdf->SetXY($initX+3, $initY+$cellHeight-32);
$pdf->Cell(100, 10, $nombreTutor, 0, 0, 'L');
$pdf->SetXY($initX+3, $initY+$cellHeight-28);
$pdf->Cell(100, 10, $apellidosTutor, 0, 0, 'L');
}
$initX += $cellWidth;

# Cuarta celda #
$pdf->SetXY($initX, $initY);
$pdf->MultiCell($cellWidth+1, $cellHeight-10, '', 1, 'C', true);
$pdf->SetXY($initX, $initY+$cellHeight-10);
$pdf->MultiCell($cellWidth+1, 5, mb_convert_encoding('Firma del Educando Aprendiz','ISO-8859-1', 'UTF-8'), 0, 'C', false);
$pdf->SetXY($initX+13, $initY+$cellHeight-48);
$pdf->Cell(100, 10, $row['f_entrega'], 0, 0, 'L');
$pdf->SetXY($initX+3, $initY+$cellHeight-32);
$pdf->Cell(100, 10, $nombres, 0, 0, 'L');
$pdf->SetXY($initX+3, $initY+$cellHeight-28);
$pdf->Cell(100, 10, $apellidos, 0, 0, 'L');
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