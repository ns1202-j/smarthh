<?php

$conn = MYSQLI_INIT();
$conn->REAL_CONNECT("DB-MYSQL-SF03-32873-DO-USER-924719-0.B.DB.ONDIGITALOCEAN.COM","DOADMIN", "WYEHRX4PKYHJABM6", "DEFAULTDB",25060,null);


$sql = "SELECT * FROM incorporacion_simpla WHERE IDincorporacion = '100'";

if ($res = mysqli_query($conn, $sql)){
	mysqli_data_seek ($res, 0);
	$extraido =	mysqli_fetch_array($res);
     $efectivos = $extraido['total_efectivos'];
	 $oportunidades = $extraido['total_oportunidades'];
	 $pantalla = $extraido['pantalla'];
	 $area = $extraido['area'];
	 
	 if ($oportunidades == 0){
		 $porcentaje = 0;
	 }
	 else{
	 $porcentaje = ($efectivos*100)/$oportunidades;
	 }
	 
	 $jsonarray = array($porcentaje, $oportunidades, $efectivos);
	 echo json_encode($jsonarray);
	 
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//$sql = "REPLACE INTO incorporacion_simpla (IDincorporacion, area, porcentaje, total_efectivos, total_oportunidades, pantalla) VALUES ('100', $area, $porcentaje, $efectivos, $oportunidades, $pantalla)";
$sql = "UPDATE incorporacion_simpla SET porcentaje = $porcentaje WHERE IDincorporacion = '100'";
if ($res = mysqli_query($conn, $sql)){

	 //echo $res;
	 
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>