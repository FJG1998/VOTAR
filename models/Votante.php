<?php
include_once('ivotar.php');

/*
..######..##.....##.########..########.########......######..##..........###.....######...######.
.##....##.##.....##.##.....##.##.......##.....##....##....##.##.........##.##...##....##.##....##
.##.......##.....##.##.....##.##.......##.....##....##.......##........##...##..##.......##......
..######..##.....##.########..######...########.....##.......##.......##.....##..######...######.
.......##.##.....##.##........##.......##...##......##.......##.......#########.......##.......##
.##....##.##.....##.##........##.......##....##.....##....##.##.......##.....##.##....##.##....##
..######...#######..##........########.##.....##.....######..########.##.....##..######...######.
*/

// SUPER CLASE DE PERSONA

class Votante implements Votar{

    private $dni;//guarda el dni de cada objeto (persona que va a votar)
    private $fechaNacimiento;//guarda la fecha de nacimiento
    private $caducidad;//guarda la fecha de caducidad del dni
    private $nombre;//guarda el nombre de cada persona
    private $calle;//guarda la calle donde vive cada persona
    private $localidad;//guarda la localidad donde reside cada persona
    private $pais;//guarda el pais de nacimiento de cada persona
    private $mesa;//guarda la mesa donde debe votar cada persona


    public function __construct($dni,$fechaNacimiento, $caducidad, $nombre, $calle, $pais, $mesa,$localidad){

        $this->dni = $dni;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->caducidad = $caducidad;
        $this->nombre = $nombre;
        $this->calle = $calle;
        $this->pais = $pais;
        $this->mesa = $mesa;
        $this->localidad = $localidad;
    }

    // Metodos

        // METODO MAESTRO (recoje todas las fucniones privadas y las une en una publica para poder llamarla en info.php)

    public function maestro(){

        $noValido = 0;//esta variable sirve para comprovar si hay algun fallo en la validacion del dni

        $this->noValido = $noValido;//define el $this de no valido para que entienda la variable

        $this->dnicompare = $_SESSION['dni'];//mete la informacion del dni introducido en el input dentro de una propiedad

        $this->printINfo();//funcion que imprime la informacion de cada persona en pantalla

        $this->menorEdad();//comprueva si el usuario es menor de edad

        $this->caducidad($this->getCaducidad());//comprueva la caducidad del dni

        $this->mesa();//comprueva si nuestra mesa es la mesa que le toca venir al usuario

        $this->dniComparar();//busca en el registro si el usuario ha votado anteriormente


        if($this->noValido < 1){//cuando no sale ningun error y $this->noValido se queda en 0: es apto para votar


            echo '<h1 class="apto">APTO PARA VOTAR<h1><br><br>';


         $registro = fopen('registro.txt','a+');//abre el archivo de registro (si no existe lo crea)

                    $hora = date('h:i:s');//mete la hora actual en una variable para introducirla en el registro con el dni

                    $dniUsuario = $this->dni;//mete el dni del usuario en una variable para poder introducirla en el registro

            fwrite($registro, $dniUsuario.'-'.$hora.PHP_EOL);//escribe el dni del usuario que ha votado con la hora de votacion

            echo '<a class="votar" href="index.php">VOTAR</a>';//boton para votar

            fclose($registro);//cierra el archivo

        }else{

            echo ' <a class="botonno" href="index.php">VOLVER</a> ';//voton para volver a la pagina principal en caso de que no sea apto para votar

        }

    }

        // Metodo que imprime la informacion de cada votante

    private function printInfo(){


        echo('<article>');

            echo('DNI:'.'  '.$this->dni.'.<br><br>');
            echo('Nombre:'.'  '. $this->nombre.'.<br><br>');
            echo('Direccion:'.'  '.$this->calle.'.<br><br>');

        echo('</article>');
    }

    // Funcion que calcula la edad de cada persona 
    
    private function edad($fecha){


        list($y, $m, $d) = explode('/', $fecha);
        
        $mesDiaActual = date('md');

        $añoActual = date('Y');
        
        if($mesDiaActual < $m.$d){

            return( $añoActual - $y -1);

        }else {

            return($añoActual - $y );

        }
    }

    // Función que imprime en pantalla si es menor de edad (implementa edad())

    private function menorEdad(){

        $fecha = $this->getFechaNacimiento();


            $edad = $this->edad($fecha);

            if($edad < 18){

                echo '<h1 class="menor">MENOR DE EDAD</h1><br<br><br><br>';

                $this->noValido += 1;

            }
    }

    // Funcion que comprueva la caducidad del dni

    private function caducidad($caducidad){

    
        list($y, $m, $d) = explode('/', $caducidad);
        
        $mesDiaActual = date('md');

        $anyoActual = date('Y');

        if($anyoActual < $y || ( $anyoActual == $y && $mesDiaActual < $m.$d)){

        }else{
            
            echo '<h1 class="menor">DNI CADUCADO</h1><br><br>';


           $this->noValido += 1;

        }
        
    }

    // Funcion que comprueva que es la mesa que le toca 
    //      y si no le toca nos dice la mesa que le toca.

    private function mesa(){

        $mesa = $this->mesa;

        if($mesa != 'Colegio 01, mesa: 7-u'){

            echo '<h1 class="menor">MESA EQUIVOCADA, su mesa es:'.' '. $this->mesa.'<h1><br><br>';
            
            $this->noValido += 1;
        }
    }

    private function dniComparar(){

        $array = file('registro.txt',FILE_IGNORE_NEW_LINES);

        $dniIntro = $this->dnicompare;

        foreach($array as $valor){

            list($dni, $hora) = explode('-', $valor);//separa el dni de la hora

            if($dniIntro == $dni){//compara el dni y si ya estaba en el registro muestra el mensaje con la hora del voto

                echo '<h1 class="menor">YA HA VOTADO A LAS:'.'  '.$hora.'<h1><br><br>';

                $this->noValido += 1;
            }
        }
    }

    // GETTER

        // Coje la fecha de caducidad del dni

    public function getCaducidad(){

        return $this->caducidad;
    }

        // Coje el dni

    public function getDNI(){

        return $this->dni;
    }

        // Coje la fecha de nacimiento

    public function getFechaNacimiento(){

        return $this->fechaNacimiento;
    }

}
    // OBJETOS (personas que van a votar)

$fran = new Votante('21041746N','1998/11/17', '2019/05/25','Francisco Jimenez Gomez','Calle de la esperanza nº7, 1e','España','Colegio 01, mesa: 7-u','LLucmajor');//DNI CADUCADO

$pedro = new Votante('48571445X','1970/05/22', '2019/12/25','Ana Maria La Justicia','Calle delcuerno nº22, 5p','España','Colegio 01, mesa: 7-u','Palma');//DNI INCORRECTO(LETRA)

$martina= new Votante('02289412S','1978/02/25', '2020/06/10','Martina de la rosa','Calle de la esperanza nº7, 1e','España','Colegio 05, mesa: 7-u','Euskadi');//MESA EQUIVOCADA

$fernando = new Votante('71929822J','1998/11/17', '2019/12/15','Fernando Pedrini Romero','Calle de la costa nº7, 1e','Francia','Colegio 01, mesa: 7-u','Paris');//APTO

$juaquin = new Votante('52412142H','1998/11/17', '2030/05/25','Juaquin De los dolores Gomez','Calle de la rosa nº7, 1e','España','Colegio 01, mesa: 7-u','LLucmajor');//APTO

$julia = new Votante('43553273J','2003/11/17', '2019/12/03','Julia Fernandes','Calle de la esperanza nº7, 1e','España','Colegio 01, mesa: 7-u','Llucmajor');//MENOR DE EDAD

$petro = new Votante('53673366Z','2005/11/17', '2019/02/18','Petro Miralles Perez','Calle de la esperanza nº7, 1e','España','Colegio 07, mesa: 7-z','Llucmajor');//APTO