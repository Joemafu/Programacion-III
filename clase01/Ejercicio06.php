<?php

/*

    Parte 2 - Ejercicios con Arrays

    Aplicación No 6 (Carga aleatoria)
    Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
    función rand). Mediante una estructura condicional, determinar si el promedio de los números
    son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
    resultado.

*/

$arrayDeEnteros = [rand(1,10),rand(1,10),rand(1,10),rand(1,10),rand(1,10)];
$acumulador=0;
$promedio;

foreach($arrayDeEnteros as $entero)
{
    echo $entero, "<br>";
    $acumulador+=$entero;
} 

echo "La suma es {$acumulador}.<br>";

$promedio = $acumulador/ count($arrayDeEnteros);

if ($promedio>6)
{
    echo "El promedio es mayor que 6.";
}
else if ($promedio==6)
{
    echo "El promedio es igual a 6.";
}
else
{
    echo "El promedio es menor que 6.";
}

?>