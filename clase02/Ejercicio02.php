<?php

    /*
        Aplicación No 2 (Invertir palabra)
        Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
        función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
        deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
        “Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán: 1 si la palabra
        pertenece a algún elemento del listado.
        0 en caso contrario.
    */

    function miFuncion($palabra, $max)
    {
        $ret = 0;

        if ((strlen($palabra)<=$max) && (strcmp($palabra,'Recuperatorio')==0 || strcmp($palabra,'Parcial')==0 || strcmp($palabra,'Programacion')==0))
        {
            $ret = 1;
        }
        return $ret;
    }

    echo "Parcial - ", "7 - ", miFuncion("Parcial",7),"<br>";
    echo "Parcial - ", "3 - ", miFuncion("Parcial",3),"<br>";
    echo "Perro - ", "12 - ", miFuncion("Perro",11),"<br>";
    echo "Programacion - ", "12 - ", miFuncion("Programacion",100),"<br>";

?>