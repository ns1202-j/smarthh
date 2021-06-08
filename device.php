<?php
include 'digitalocean.php';

$sql = "SELECT * FROM incorporacion_simpla WHERE IDincorporacion = '75'";

if ($res = mysqli_query($conn, $sql)){
	mysqli_data_seek ($res, 0);
	$extraido =	mysqli_fetch_array($res);
     $efectivos = $extraido['total_efectivos'];
	 $oportunidades = $extraido['total_oportunidades'];
	 $pantalla = $extraido['pantalla'];
	 
	 $porcentaje = ($efectivos*100)/$oportunidades;
	 $jsonarray = array($porcentaje, $oportunidades, $efectivos);
	 echo json_encode($jsonarray);
	 
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "REPLACE INTO incorporacion_simpla (IDincorporacion, porcentaje, total_efectivos, total_oportunidades, pantalla) VALUES ('75', $porcentaje, $efectivos, $oportunidades, $pantalla)";


mysqli_close($conn);


?>