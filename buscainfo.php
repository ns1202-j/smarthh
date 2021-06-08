<?php
include 'digitalocean.php';

$num = 0;
$flag = 0;
$flagFinder = null;
//$area = $_POST['foo1'];
$ver = $_POST['ver'];
//$ver = "48hrs";
$area = "rayos x";
$client = 'incorporacion_simpla';

$fecha_actual = date("Y-m-d");
//$fecha_restada = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 
$fecha_restada = $fecha_actual; 
//echo ($fecha_restada); 

$sql = "SELECT * FROM " .$client. " WHERE area = '$area'"; 
$conteo = "SELECT * FROM " .$client. " WHERE area = '$area' and fecha = '$fecha_actual'"; 


$fecha_restada = $fecha_actual;


if ($date_res = mysqli_query($conn, $conteo)){
	
	



	if($ver == "24" || $ver == "24hrs" ){

		
		mysqli_data_seek ($date_res,0);
		
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

	else if($ver == "48" || $ver == "48hrs"){
		$fecha_aevaluar = date("Y-m-d",strtotime($fecha_actual."- 2 days"));
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
	else if($ver == "semana" || $ver == "Semana"){
		
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
	else if($ver == "mes" || $ver == "Mes"){
		
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
	else if($ver == "todo" || $ver == "Todo"){
		
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

} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

/*
	$sql = "UPDATE incorporacion_simpla SET ver = $ver WHERE IDincorporacion = '100'";


	if ($res = mysqli_query($conn, $sql)){

		 include 'porcentaje.php';
		 
	} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

*/

mysqli_close($conn);


?>
