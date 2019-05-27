<?php

require_once('models/Seguridad.php');

if(isset($_POST['dni'])){

    $dniIntroducido = $_POST['dni']; //Coje el dni introducido de la index

    $logitudDni = strlen($dniIntroducido);//nos da 9 que son todos los caracteres del DNI

    $numeros = substr($dniIntroducido,0,$logitudDni-1); //Separa y coje los numeros

    $letra = substr($dniIntroducido,$logitudDni-1,1); //Separa y coje la letra

    // Condicional que comprueba la si la letra es correcta y nos envia a la pagina de informacion

    if($validarLetra->letraDNI($numeros) != $letra){

    echo'DNI INVALIDO';

    }else{

        header('location:info.php');
    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DNI</title>
</head>
<body>

    <form action="" method="POST">

                
        <input type="text" name="dni" id="" placeholder="DNI" required><br><br>

        <input type="submit" value="COMPROBAR"><br><br>

    </form>
 
</body>
</html>