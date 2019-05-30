<?php

// INICIO DE SESION PARA PODER COGER LA INFORMACION DEL DNI INTRODUCIDO EN EL INPUT
session_start();

include_once('models/Votante.php');

// ARRAY PARA EL FOREACH QUE COMPRUEVA LA INFORMACION DE CADA DNI

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

        $dniUsuario = $_SESSION['dni'];//variable de sesion que tiene la informacion del dni introducido en el input


    foreach($votantes as $valor){

        if($valor->getDNI() == $dniUsuario){

        $valor->maestro();
        
        }
    }
?>

</body>
</html>