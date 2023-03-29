<?php

/*

    Aplicación No 7 (Mostrar impares)
    Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
    Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
    salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
    utilizando las estructuras while y foreach.

*/

$listaImpares = array();
$i = 0;

while (count ($listaImpares)<10)
{
    if ($i%2!=0)
    {
        $listaImpares[] = $i;

        //array_push($listaImpares, $i); //Lo mismo que la linea anterior.
    }
    $i++;
}

echo "Imprimo con for: <br>";

for ($i=0;$i<count($listaImpares);$i++)
{
    echo $listaImpares[$i], "<br>";
}

echo "<br>Imprimo con while: <br>";

$i=0;
while ($i<count($listaImpares))
{
    echo $listaImpares[$i], "<br>";
    $i++;
}

echo "<br>Imprimo con foreach: <br>";

foreach ($listaImpares as $item)
{
    echo $item, "<br>";
}

?>