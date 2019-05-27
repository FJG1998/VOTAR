<?php

// SEGURIDAD

class Seguridad{

    private $dni;

    public function letraDNI ($dni) {

        // Obtiene letra del DNI 

          $calcular = (int) ($dni / 23);
          $calcular *= 23;
          $calcular = $dni - $calcular;
          $letras = 'TRWAGMYFPDXBNJZSQVHLCKEO';
          $letraDNI = substr ($letras, $calcular, 1);

        return $letraDNI;


    }


}

$validarLetra = new Seguridad;