<?php
include 'digitalocean.php';

$num = 0;
$flag = 0;
$user = "Jose Reyes";
$pass = "jnovas1";
$client = 'usuarios_simpla';
$date = "2021-04-26";
$i = 0;
$myArrComparador[0]['Area'] = "1";
$sql = "SELECT * FROM " .$client. " WHERE usuario = '$user' and password = '$pass'"; 



if ($res = mysqli_query($conn, $sql)){
	
	if(mysqli_data_seek($res,$num) != null){
		
		mysqli_data_seek ($res, $num);
		$extraido =	mysqli_fetch_array($res);
		$permisos = $extraido['permisos'];
		$tabla = $extraido['tabla'];
		
		$flag = 1;
		
		$sql_area = "SELECT * FROM " .$tabla;
		$resA = mysqli_query($conn, $sql_area);
		
			while((mysqli_data_seek($resA,$num) != null)) {
			
				mysqli_data_seek ($resA, $num);
				$extraido =	mysqli_fetch_array($resA);
				 $areas = $extraido['area'];
				 $fecha = $extraido['fecha'];
				 $efectivos = $extraido['total_efectivos'];
				 $oportunidades = $extraido['total_oportunidades'];
				 
				 if ($oportunidades == 0){
					 $porcentaje = 0;
				 }
				 else{
				 $porcentaje = ($efectivos*100)/$oportunidades;
				 }
				 

				 $jsonAreas = array("Area" => $areas,"fecha" => $fecha,"Oportunidades" => $oportunidades,"Efectivos" => $efectivos,"Porcentajes" => $porcentaje,"Permisos" => $permisos);
				 
				 $myArr1[] = $jsonAreas;
				
				
				$num = $num + 1;
			
			}
		
			while($i <= $num){
				
				
				$areas = $myArr1[$i]['Area'];
				echo $areas;
				$j = 0;
				 Do {
					
					
					 $comparadorAreas = $myArrComparador[$j]['Area'];
					 if($areas != $comparadorAreas){
						 $flagWhile = 0;
					 }
					 else{
						 $flagWhile = 1;
					 }

					
					 
					$j++;
				} while (($myArrComparador[$j]['Area']) != null);
				
				if($flagWhile == 0){
					$myArrComparador[$j]['Area'] = $areas;
				}
			
				 $areas = $myArr1[$i]['Area'];
				 $fecha = $myArr1[$i]['fecha'];
				 $efectivos = $myArr1[$i]['Efectivos'];
				 $oportunidades = $myArr1[$i]['Oportunidades'];
				 
				 if ($oportunidades == 0){
					 $porcentaje = 0;
				 }
				 else{
				 $porcentaje = ($efectivos*100)/$oportunidades;
				 }
				 
				 $jsonRes = array("Area" => $areas,"fecha" => $fecha,"Oportunidades" => $oportunidades,"Efectivos" => $efectivos,"Porcentajes" => $porcentaje,"Permisos" => $permisos);
				 
				 

				 $jsonRes = array("Area" => $areas,"fecha" => $fecha,"Oportunidades" => $oportunidades,"Efectivos" => $efectivos,"Porcentajes" => $porcentaje,"Permisos" => $permisos);
				 
				 $myArr_Res[] = $jsonRes;
				
				
				$i = $i + 1;
			
			}
			
		
	
	
	
	
		
	}
	
	else{
	
	}
	
	
	 
	 
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


if($flag == 1){
	//echo json_encode($myArr_Res);
}
else{
	$jsonnull = "null";
	echo $jsonnull;
}

echo "Areas totales: " . json_encode($myArrComparador);

mysqli_close($conn);


?>
