<?php
session_start();
$Niv = trim($_POST['Niv']);
$Placa = trim($_POST['Placa']);
$Banda = trim($_POST['Banda']);

$conn = mysqli_connect('localhost', 'root', '');
mysqli_select_db($conn, "alertas");

$respuestasPositivas2 = Array();
$i=0;
if(($Niv!="")&& ($Placa=="")){
    //echo 'entro caso1';
    $query = $conn -> query ("SELECT * FROM buscadosvh WHERE (Niv LIKE '%".$Niv."%')");
  }else if(($Niv=="")&& ($Placa!="")){
    $query = $conn -> query ("SELECT * FROM buscadosvh WHERE (Placa LIKE '%".$Placa."%')");
  }else if(($Niv!="")&& ($Placa!="")){
    $query = $conn -> query ("SELECT * FROM buscadosvh WHERE (Niv LIKE '%".$Niv."%' OR Placa LIKE '%".$Placa."%')");
  }else if(($Niv=="")&& ($Placa=="")&&($Banda!="")){
  $query = $conn -> query ("SELECT * FROM buscadosvh WHERE Banda = '".$Banda."'");
  while ($valoresBanda = mysqli_fetch_array($query)) 
  {
    $respuestasPositivas2[$i]['Banda'][] = $valoresBanda;
  }

}

function trim_value(&$value) 
{     
    if($value ==''){
        $value = 'S/D';
    }
    $value = trim($value); 
}
while ($valores = mysqli_fetch_array($query)) 
{
  ///print_r($valores);
  array_walk($valores, 'trim_value');//Aqui quita espacios de la consulta
 // echo $valores['Id'].$valores['Placa'].$valores['Niv'].$valores['Vehiculo'].$valores['Banda'].$valores['Delito'].$valores['Captura']."\n";

  if((strcmp(strtolower($valores['Placa']),strtolower($Placa))==0)||(strcmp(strtolower($valores['Niv']),strtolower($Niv))==0)){
   // echo 'paso compraracion';
    $sql = "INSERT INTO coincidenciasvh (Placa,Niv,Vehiculo,Banda,Delito,Captura,Observaciones) 
          VALUES("."'".$valores['Placa']."','".$valores['Niv']."','".$valores['Vehiculo']."','".$valores['Banda']."','".$valores['Delito']."','".$valores['Captura']."','".$valores['Observaciones']."');";
    
    
    $respuestasPositivas2[$i]['Vehiculo'] = $valores;
    //echo $sql;
    if (mysqli_query($conn, $sql)) {
      // echo "Ubo una coincidencia en el vehiculo se inserto nuevo registro \n";
      if(strcmp($valores['Banda'],'S/D')!=0){
        $query2 = $conn -> query ("SELECT * FROM buscados WHERE Banda = '".$valores['Banda']."'");
        while ($valoresper = mysqli_fetch_array($query2)){
          $respuestasPositivas2[$i]['Personas_Encontradas'][] = $valoresper;
        }
       }

    } else {
       echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    $i++;
  }
}
$Historial = Array();
$Historial['Usuario']=$_SESSION['Usuario'];
$Historial['Movimiento']="Busqueda de Vehiculo";
$Historial['Datos']=$Niv.";".$Placa.";".$Banda;

$sqlHis = "INSERT INTO historial (Usuario,Movimiento,Datos_Entrada) VALUES ("."'".$Historial['Usuario']."','".$Historial['Movimiento']."','".$Historial['Datos']."');";

if (mysqli_query($conn, $sqlHis)) {
  //echo "Historial capturado con exito\n";
} else {
  echo "Error: " . $sql . "" . mysqli_error($conn);
}
mysqli_close($conn);
print_r(json_encode($respuestasPositivas2));
?>