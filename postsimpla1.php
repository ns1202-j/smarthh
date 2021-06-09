<?php
include 'digitalocean.php';

$num = 0;
$flag = 0;
//$area = $_POST['foo1'];
$client = 'incorporacion_simpla';

//$sql = "SELECT * FROM " .$client. " WHERE area = '$area'"; 
//$conteo = "SELECT * FROM " .$client. " WHERE area = '$area' and fecha = '1'"; 
$sql = "SELECT * FROM incorporacion_simpla WHERE IDincorporacion = '100'";

if ($res = mysqli_query($conn, $sql)){
	
	 
	 
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

 while((mysqli_data_seek($res,$num) != null)) {
	
	mysqli_data_seek ($res, $num);
	$extraido =	mysqli_fetch_array($res);
     $efectivos = $extraido['total_efectivos'];
	 $oportunidades = $extraido['total_oportunidades'];
	 
	 if ($oportunidades == 0){
		 $porcentaje = 0;
	 }
	 else{
	 $porcentaje = ($efectivos*100)/$oportunidades;
	 }
	 $jsonarray = array("Porcentaje" => $porcentaje,"Oportunidades" => $oportunidades,"Efectivos" => $efectivos);
	 $myArr[] = $jsonarray;
	
	
	$num = $num + 1;
	$flag = 1;
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
