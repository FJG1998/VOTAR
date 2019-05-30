<?php

// SEGURIDAD

class Seguridad{

  // Metodo que comprueva si la letra del dni coincide con los numeros

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