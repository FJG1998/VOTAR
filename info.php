<?php
session_start();

include_once('models/Votante.php');

$votantes=[

    $fran,
    $pedro,
    $martina,
    $fernando,
    $juaquin,
    $julia,
    $petro
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Datos</title>
</head>
<body>

<?php

        $dniUsuario = $_SESSION['dni'];


    foreach($votantes as $valor){

        if($valor->getDNI() == $dniUsuario){

        $valor->maestro();
        
        }
    }
?>

</body>
</html>