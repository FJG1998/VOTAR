<?php

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

class Votante{

    private $dni;
    private $fechaNacimiento;
    private $caducidad;
    private $nombre;
    private $calle;
    private $localidad;
    private $pais;
    private $mesa;

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

        // Metodo que imprime la informacion de cada votante

    public function printInfo(){


        echo('<article>');

            echo('DNI:'.'  '.$this->dni.'.<br><br>');
            echo('Nombre:'.'  '. $this->nombre.'.<br><br>');
            echo('Direccion:'.'  '.$this->calle.'.<br><br>');

        echo('</article>');
    }

    // Funcion que calcula la edad de cada persona 
    
    public function edad($fecha){


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

    public function menorEdad(){

        $fecha = $this->getFechaNacimiento();

            $edad = $this->edad($fecha);

            if($edad < 18){

                echo '<h1 class="menor">MENOR DE EDAD</h1>';

            }
    }

    

    // GETTER

    public function getDNI(){

        return $this->dni;
    }

    public function getFechaNacimiento(){

        return $this->fechaNacimiento;
    }

}

    // OBJETOS (personas que van a votar)

$fran = new Votante('21041746N','1998/11/17', '2019/05/25','Francisco Jimenez Gomez','Calle de la esperanza nº7, 1e','España','7-u','LLucmajor');//DNI CADUCADO

$pedro = new Votante('48571445E','1970/05/22', '2019/12/25','Ana Maria La Justicia','Calle delcuerno nº22, 5p','España','7-u','Palma');//DNI INCORRECTO(LETRA)

$martina= new Votante('02289412S','1978/02/25', '2020/06/10','Martina de la rosa','Calle de la esperanza nº7, 1e','España','7-u','Euskadi');//MESA EQUIVOCADA

$fernando = new Votante('71929822J','1998/11/17', '2019/12/15','Fernando Pedrini Romero','Calle de la costa nº7, 1e','Francia','7-u','Paris');//MESA EQUIVOCADA

$juaquin = new Votante('52412142H','1998/11/17', '2030/05/25','Juaquin De los dolores Gomez','Calle de la rosa nº7, 1e','España','7-u','LLucmajor');//APTO

$julia = new Votante('43553273J','2003/11/17', '2023/02/03','Julia Fernandes','Calle de la esperanza nº7, 1e','España','7-u','Llucmajor');//MENOR DE EDAD

$petro = new Votante('53673366Z','1998/11/17', '2019/06/18','Petro Miralles Perez','Calle de la esperanza nº7, 1e','España','7-u','Llucmajor');//APTO