<?php

include 'digitalocean.php';


$num = 0;
$flag = 0;
$flagFinder = null;
//$area = $_POST['foo1'];
//$area = $_POST['ver'];
$area = "rayos x";
$client = 'incorporacion_simpla';

$fecha_actual = date("Y-m-d");
//$fecha_restada = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 
$fecha_restada = $fecha_actual; 
//echo ($fecha_restada); 

$sql = "SELECT * FROM " .$client. " WHERE area = '$area'"; 
$conteo = "SELECT * FROM " .$client. " WHERE area = '$area' and fecha = '$fecha_actual'"; 


if ($date_res = mysqli_query($conn, $conteo)){
	
	if(mysqli_data_seek($date_res,0) != null){
	
	
	}
	else{
		
		$sql = "INSERT INTO incorporacion_simpla (area, ver) VALUES ($area,'24')";
		if (mysqli_query($conn, $sql)) {}
		else{
		echo "error"
		}
		
		
	}
	

} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);
?>