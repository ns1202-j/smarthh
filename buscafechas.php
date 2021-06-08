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
	
		mysqli_data_seek ($date_res, $num);
		$extraido =	mysqli_fetch_array($date_res);
		$ver = $extraido['ver'];
		//echo "Fecha: " .$fecha_actual. " ,con horario para ver: " .$ver;
		
	}
	else{
		
		$fecha_anual = date("Y-m-d",strtotime($fecha_actual."- 1 years"));
		while((mysqli_data_seek($date_res,0) == null) && ($fecha_restada != $fecha_anual)){
			$fecha_restada = date("Y-m-d",strtotime($fecha_restada."- 1 days")); 	
			 //echo $fecha_restada . "<br>";
			 $nueva_fecha = "SELECT * FROM " .$client. " WHERE area = '$area' and fecha = '$fecha_restada'";
			 $date_res = mysqli_query($conn, $nueva_fecha);
			if(mysqli_data_seek($date_res,0) != null){
	
				mysqli_data_seek ($date_res, $num);
				$extraido =	mysqli_fetch_array($date_res);
				$ver = $extraido['ver'];
				$flagFinder = 1;
				
				//echo "Fecha: " .$fecha_restada. " ,tiempo a mostrar: " .$ver. "<br>" ;
				
			}
			else{
			
				
			
			}
		}
		
	}
	

} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$fecha_restada = $fecha_actual;
$date_res = mysqli_query($conn, $conteo);

if($ver == "24"){

	
	if (mysqli_data_seek ($date_res,0) != null){
	
		$extraido =	mysqli_fetch_array($date_res);
		$efectivos = $extraido['total_efectivos'];
		$oportunidades = $extraido['total_oportunidades'];
		$pantalla = $extraido['pantalla'];
		$id = $extraido['id'];
		if ($oportunidades == 0){
			$porcentaje = 0;
		}
		else{
			$porcentaje = ($efectivos*100)/$oportunidades;
		}
	 
	
		$jsonarray = array("Porcentaje" => $porcentaje,"Oportunidades" => $oportunidades,"Efectivos" => $efectivos, "ver" => $ver, "id" => $id);
		$myArr[] = $jsonarray;
		$flag = 1;
	}
	else{
		
	}

}

else if($ver == "48"){
	$fecha_aevaluar = date("Y-m-d",strtotime($fecha_actual."- 2 days"));
	//echo $fecha_aevaluar;
	while($fecha_restada != $fecha_aevaluar) {
		
			
		echo $fecha_restada . "<br>";
		$nueva_fecha = "SELECT * FROM " .$client. " WHERE area = '$area' and fecha = '$fecha_restada'";
		$date_res = mysqli_query($conn, $nueva_fecha);
		
		if(mysqli_data_seek($date_res,0) != null){
			mysqli_data_seek ($date_res,0);
			$extraido =	mysqli_fetch_array($date_res);
			$efectivos = $extraido['total_efectivos'];
			$oportunidades = $extraido['total_oportunidades'];
			$pantalla = $extraido['pantalla'];
			$fechajson = $extraido['fecha'];
			$id = $extraido['id'];
				 
			if ($oportunidades == 0){
				 $porcentaje = 0;
			}
			else{
				$porcentaje = ($efectivos*100)/$oportunidades;
			}
			 
			
			$jsonarray = array("Porcentaje" => $porcentaje,"Oportunidades" => $oportunidades,"Efectivos" => $efectivos, "ver" => $ver, "id" => $id, "fecha" => $fechajson);
			$myArr[] = $jsonarray;
			$flag = 1;
		}
		else{
			
		}
		
		$num = $num + 1;
		
		$fecha_restada = date("Y-m-d",strtotime($fecha_restada."- 1 days")); 
	}
	
}
else if($ver == "semana"){
	
	$fecha_aevaluar = date("Y-m-d",strtotime($fecha_actual."- 7 days"));
	//echo $fecha_aevaluar;
	while($fecha_restada != $fecha_aevaluar) {
		
			
		//echo $fecha_restada . "<br>";
		$nueva_fecha = "SELECT * FROM " .$client. " WHERE area = '$area' and fecha = '$fecha_restada'";
		$date_res = mysqli_query($conn, $nueva_fecha);
		
		if(mysqli_data_seek($date_res,0) != null){
			mysqli_data_seek ($date_res,0);
			$extraido =	mysqli_fetch_array($date_res);
			$efectivos = $extraido['total_efectivos'];
			$oportunidades = $extraido['total_oportunidades'];
			$pantalla = $extraido['pantalla'];
			$fechajson = $extraido['fecha'];
			$id = $extraido['id'];
				 
			if ($oportunidades == 0){
				 $porcentaje = 0;
			}
			else{
				$porcentaje = ($efectivos*100)/$oportunidades;
			}
			 
			
			$jsonarray = array("Porcentaje" => $porcentaje,"Oportunidades" => $oportunidades,"Efectivos" => $efectivos, "ver" => $ver, "id" => $id, "fecha" => $fechajson);
			$myArr[] = $jsonarray;
			$flag = 1;
		}
		else{
			
		}
		
		$num = $num + 1;
		
		$fecha_restada = date("Y-m-d",strtotime($fecha_restada."- 1 days")); 
	}
	
}
else if($ver == "mes"){
	
	$fecha_aevaluar = date("Y-m-d",strtotime($fecha_actual."- 30 days"));
	//echo "fecha para evaluar: ".$fecha_aevaluar . "<br>";
	while($fecha_restada != $fecha_aevaluar) {
		
			
		//echo $fecha_restada . "<br>";
		$nueva_fecha = "SELECT * FROM " .$client. " WHERE area = '$area' and fecha = '$fecha_restada'";
		$date_res = mysqli_query($conn, $nueva_fecha);
		
		if(mysqli_data_seek($date_res,0) != null){
			mysqli_data_seek ($date_res,0);
			$extraido =	mysqli_fetch_array($date_res);
			$efectivos = $extraido['total_efectivos'];
			$oportunidades = $extraido['total_oportunidades'];
			$pantalla = $extraido['pantalla'];
			$fechajson = $extraido['fecha'];
			$id = $extraido['id'];
				 
			if ($oportunidades == 0){
				 $porcentaje = 0;
			}
			else{
				$porcentaje = ($efectivos*100)/$oportunidades;
			}
			 
			
			$jsonarray = array("Porcentaje" => $porcentaje,"Oportunidades" => $oportunidades,"Efectivos" => $efectivos, "ver" => $ver, "id" => $id, "fecha" => $fechajson);
			$myArr[] = $jsonarray;
			$flag = 1;
		}
		else{
			
		}
		
		$num = $num + 1;
		
		$fecha_restada = date("Y-m-d",strtotime($fecha_restada."- 1 days")); 
	}
	
}
else if($ver == "todo"){
	
	$fecha_aevaluar = date("Y-m-d",strtotime($fecha_actual."- 1 years"));
	//echo $fecha_aevaluar;
	while($fecha_restada != $fecha_aevaluar) {
		
			
		//echo $fecha_restada . "<br>";
		$nueva_fecha = "SELECT * FROM " .$client. " WHERE area = '$area' and fecha = '$fecha_restada'";
		$date_res = mysqli_query($conn, $nueva_fecha);
		
		if(mysqli_data_seek($date_res,0) != null){
			mysqli_data_seek ($date_res,0);
			$extraido =	mysqli_fetch_array($date_res);
			$efectivos = $extraido['total_efectivos'];
			$oportunidades = $extraido['total_oportunidades'];
			$pantalla = $extraido['pantalla'];
			$fechajson = $extraido['fecha'];
			$id = $extraido['id'];
				 
			if ($oportunidades == 0){
				 $porcentaje = 0;
			}
			else{
				$porcentaje = ($efectivos*100)/$oportunidades;
			}
			 
			
			$jsonarray = array("Porcentaje" => $porcentaje,"Oportunidades" => $oportunidades,"Efectivos" => $efectivos, "ver" => $ver, "id" => $id, "fecha" => $fechajson);
			$myArr[] = $jsonarray;
			$flag = 1;
		}
		else{
			
		}
		
		$num = $num + 1;
		
		$fecha_restada = date("Y-m-d",strtotime($fecha_restada."- 1 days")); 
	}
	
}
else if($ver == "null"){
	
	echo "null";
	
}


if($flag == 1){
	echo json_encode($myArr);
}
else{
	$jsonnull = "null";
	echo $jsonnull;
}



mysqli_close($conn);


?>
