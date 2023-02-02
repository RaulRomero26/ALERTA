<?php

//print_r($_POST);

$Usuario = trim($_POST['User_Name']);
$Password = trim($_POST['Password']);

$conn = mysqli_connect('localhost', 'inteligencia', 'inteligencia');
mysqli_select_db($conn, "alertas");

$respuestasPositivas = Array();
$i=0;


$query = $conn -> query ("SELECT Usuario FROM usuarios
                WHERE Usuario='".$Usuario."' AND Password = MD5('".$Password."')");

    while ($login = mysqli_fetch_array($query)) {
        $respuestasPositivas['Login'] = $login;
    }
    print_r($respuestasPositivas['Login']['Usuario']);

    mysqli_close($conn);

    if(!empty($respuestasPositivas)){
        session_start();
        $_SESSION['Usuario']= $respuestasPositivas['Login']['Usuario'];
        header("Location: ../busqueda.php");
        exit();
    } else{
        header("Location: ../index.php");
        exit();
    }

?>