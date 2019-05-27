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

class Persona{

    private $dni;
    private $fechaNacimiento;
    private $caducidad;
    private $nombre;
    private $calle;
    private $localidad;
    private $pais;
    private $mesa;

    public function __construct($dni,$fechaNacimiento, $caducidad, $nombre, $calle, $pais, $mesa){

        $this->dni = $dni;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->caducidad = $caducidad;
        $this->nombre = $nombre;
        $this->calle = $calle;
        $this->pais = $pais;
        $this->mesa = $mesa;
    }

}

$fran = new Persona('21041746N',1998/11/17,2019/05/25,'Francisco Jimenez Gomez','España','7-u');

    

