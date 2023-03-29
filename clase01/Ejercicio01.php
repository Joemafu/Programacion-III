<?php

    /*
        Aplicación No 1 (Sumar números)
        Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
        supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
        se sumaron.
    */
    
    $numeroASumar=1;
    $acumulador=0;
    for ($acumulador = 0; $numeroASumar + $acumulador < 1000; $numeroASumar++)
    {
        echo $acumulador, " + ", $numeroASumar, " = ", $acumulador+=$numeroASumar, "\n";
        echo "<br>";
    }

    echo "\n\nse sumaron ", $numeroASumar-1, " numeros";
?>