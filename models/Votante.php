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

    public $haVotado = false;
    private $dni;
    private $fechaNacimiento;
    private $caducidad;
    private $nombre;
    private $calle;
    private $localidad;
    private $pais;
    private $mesa;


    public function __construct($dni,$fechaNacimiento, $caducidad, $nombre, $calle, $pais, $mesa,$localidad,$haVotado){

        $this->dni = $dni;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->caducidad = $caducidad;
        $this->nombre = $nombre;
        $this->calle = $calle;
        $this->pais = $pais;
        $this->mesa = $mesa;
        $this->localidad = $localidad;
        $this->haVotado = $haVotado;
    }

    // Metodos

        // METODO MAESTRO

    public function maestro(){

        $noValido = 0;

        $this->noValido = $noValido;

        $this->dnicompare = $_SESSION['dni'];

        $this->printINfo();

        $this->menorEdad();

        $this->caducidad($this->getCaducidad());

        $this->mesa();

        $this->dniComparar();


        if($this->noValido < 1){


            echo '<h1 class="apto">APTO PARA VOTAR<h1><br><br>';

            $registro = fopen('registro.txt','a+');

                    $hora = date('h:i:s');

                    $dniUsuario = $this->dni;

            fwrite($registro, $dniUsuario . PHP_EOL);

            echo '<a class="votar" href="index.php">VOTAR</a>';

            fclose($registro);

            $this->haVotado = true;

        }else{

            echo ' <a class="botonno" href="index.php">VOLVER</a> ';

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

    // Función que imprime en pantalla si es menor de edad

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

            if($dniIntro == $valor){

                echo '<h1 class="menor">YA HA VOTADO<h1><br><br>';
                
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

$fran = new Votante('21041746N','1998/11/17', '2019/05/25','Francisco Jimenez Gomez','Calle de la esperanza nº7, 1e','España','Colegio 01, mesa: 7-u','LLucmajor',null);//DNI CADUCADO

$pedro = new Votante('48571445X','1970/05/22', '2019/12/25','Ana Maria La Justicia','Calle delcuerno nº22, 5p','España','Colegio 01, mesa: 7-u','Palma',null);//DNI INCORRECTO(LETRA)

$martina= new Votante('02289412S','1978/02/25', '2020/06/10','Martina de la rosa','Calle de la esperanza nº7, 1e','España','Colegio 05, mesa: 7-u','Euskadi',null);//MESA EQUIVOCADA

$fernando = new Votante('71929822J','1998/11/17', '2019/12/15','Fernando Pedrini Romero','Calle de la costa nº7, 1e','Francia','Colegio 01, mesa: 7-u','Paris',null);//APTO

$juaquin = new Votante('52412142H','1998/11/17', '2030/05/25','Juaquin De los dolores Gomez','Calle de la rosa nº7, 1e','España','Colegio 01, mesa: 7-u','LLucmajor',null);//APTO

$julia = new Votante('43553273J','2003/11/17', '2019/12/03','Julia Fernandes','Calle de la esperanza nº7, 1e','España','Colegio 01, mesa: 7-u','Llucmajor',null);//MENOR DE EDAD

$petro = new Votante('53673366Z','2005/11/17', '2019/02/18','Petro Miralles Perez','Calle de la esperanza nº7, 1e','España','Colegio 07, mesa: 7-z','Llucmajor',null);//APTO