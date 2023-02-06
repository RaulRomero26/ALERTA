<?php
session_start();
$Nombre = strtoupper(trim($_POST['Nombre']));
$ApPaterno = strtoupper(trim($_POST['ApPaterno']));
$ApMaterno = strtoupper(trim($_POST['ApMaterno']));
//$Alias = strtoupper(trim($_POST['Alias']));
$Banda = strtoupper(trim($_POST['Banda']));

$conn = mysqli_connect('localhost', 'inteligencia', 'inteligencia');
mysqli_select_db($conn, "alertas");

$respuestasPositivas = Array();
$i=0;

if(($Nombre!="")&& ($ApPaterno!="")&&($ApMaterno!="")){
    //echo 'entro caso1';
  $query = $conn -> query ("SELECT * FROM buscados WHERE (ApellidoPaterno = '".$ApPaterno."' AND ApellidoMaterno = '".$ApMaterno."' AND (Nombre LIKE '%".$Nombre."%'))");

  //$que = "SELECT * FROM buscados WHERE (ApellidoPaterno = '".$ApPaterno."' AND ApellidoMaterno = '".$ApMaterno."' AND (Nombre LIKE '".$Nombre."'))";
  //echo $que;

}else if(($Nombre=="")&& ($ApPaterno=="")&&($ApMaterno=="")&&($Banda!="")){
  $query = $conn -> query ("SELECT * FROM buscados WHERE Banda = '".$Banda."'");
  while ($valoresBanda = mysqli_fetch_array($query)) 
  {
    $respuestasPositivas[$i]['Banda'][] = $valoresBanda;
  }

}



function trim_value(&$value) //Funcion quita espacios
{   
    if($value ==''){
        $value = 'S/D';
    }
    $value = trim($value);     
}

//$valores = mysqli_fetch_array($query);

//print_r($valores);

while ($valores = mysqli_fetch_array($query)) 
{
  //echo $i;
  //print_r($valores);
  array_walk($valores, 'trim_value');//Aqui quita espacios de la consulta


    if((strcmp(strtolower($valores['ApellidoPaterno']),strtolower($ApPaterno))==0)&&(strcmp(strtolower($valores['ApellidoMaterno']),strtolower($ApMaterno))==0)){
      //echo 'if de insert \n';
      $sql = "INSERT INTO coincidencias (Nombre,ApellidoPaterno,ApellidoMaterno,Alias,Banda,Delitos_Asociados,Folio,Captura,Observaciones,Foto,Id_referencia) 
              VALUES ("."'".$valores['Nombre']."'".","."'".$valores['ApellidoPaterno']."'".",".
              "'".$valores['ApellidoMaterno']."'".","."'".$valores['Alias']."'".","."'".$valores['Banda']."','".$valores['Delitos_Asociados']."','".$valores['Folio']."','".$valores['Captura']."','".$valores['Observaciones']."','".$valores['Foto']."','".$valores['Id']."');";
      //echo 'genere cadena insert \n';
      $respuestasPositivas[$i]['Personas'] = $valores;
      if (mysqli_query($conn, $sql)) {
        //echo 'if evaluacion de query \n';
         //echo "Ubo una coincidencia se inserto nuevo registro \n";
         if(strcmp($valores['Banda'],'S/D')!=0){
          //echo 'if evaluacion de banda sd \n';
          $query2 = $conn -> query ("SELECT * FROM buscadosvh WHERE Banda = '".$valores['Banda']."'");
          
          while ($valoresvh = mysqli_fetch_array($query2)){
            //echo 'while de banda si hubo';
            $respuestasPositivas[$i]['Vehiculos_Encontrados'][] = $valoresvh;
          }
         }
      } else {
         echo "Error: " . $sql . "" . mysqli_error($conn);
      }
     
    
  }
  $i++;
}


$Historial = Array();
$Historial['Usuario']=$_SESSION['Usuario'];
$Historial['Movimiento']="Busqueda de persona";
$Historial['Datos']=$Nombre.";".$ApPaterno.";".$ApMaterno.";".$Banda;

$sqlHis = "INSERT INTO historial (Usuario,Movimiento,Datos_Entrada) VALUES ("."'".$Historial['Usuario']."','".$Historial['Movimiento']."','".$Historial['Datos']."');";

if (mysqli_query($conn, $sqlHis)) {
  #echo "Historial capturado con exito\n";
} else {
  echo "Error: " . $sql . "" . mysqli_error($conn);
}


mysqli_close($conn);

print_r(json_encode($respuestasPositivas));
?>