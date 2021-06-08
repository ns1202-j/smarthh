<?php
include 'digitalocean.php';

$sql = "SELECT * FROM incorporacion_simpla WHERE IDincorporacion = '100'";

if ($res = mysqli_query($conn, $sql)){
	mysqli_data_seek ($res, 0);
	$extraido =	mysqli_fetch_array($res);
     $efectivos = $extraido['total_efectivos'];
	 $oportunidades = $extraido['total_oportunidades'];
	 $pantalla = $extraido['pantalla'];
	 $area = $extraido['area'];
	 //echo $pantalla. "<br>";
	 
	 $oportunidades = $oportunidades + 1;
	 	 
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//$sql = "INSERT INTO incorporacion_simpla (IDincorporacion, total_efectivos, total_oportunidades, pantalla) VALUES ('100', $efectivos, $oportunidades, $pantalla)";
//$sql = "REPLACE INTO incorporacion_simpla (IDincorporacion, total_efectivos, total_oportunidades, pantalla) VALUES ('100', $efectivos, $oportunidades, $pantalla)";
$sql = "UPDATE incorporacion_simpla SET total_oportunidades = $oportunidades WHERE IDincorporacion = '100'";


if ($res = mysqli_query($conn, $sql)){

	 include 'porc_simpla.php';
	 
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



?>