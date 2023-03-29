<?php

/*
    Aplicación No 2 (Mostrar fecha y estación)
    Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
    distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
    año es. Utilizar una estructura selectiva múltiple.

*/

date_default_timezone_set('America/Argentina/Buenos_Aires');

echo date("l"), "<br>";

echo "Este año mi cumpleaños cae " . date("l",mktime(0,0,0,6,23,2023)), "<br>";

echo date(DATE_RFC2822), "<br>";

echo date('l \t\h\e jS'), "<br>";

echo "hoy es ", date("l"), " ", date("d"), " de ",date("M"), " de ", date("Y"), "<br>";

echo "hoy es ", date("l \ d\ \d\\e\ M \ \d\\e\ Y"), "<br>"; //lo mismo que en la linea 13 pero otro formato.

$mes = date ("m");
$dia = date ("d");

if ($mes == 3 && $dia > 20 || $mes==4 || $mes == 5 || $mes == 6 && $dia<21)
{
    echo "es otoño";
}
else if ($mes == 6 && $dia > 20 || $mes==7 || $mes == 8 || $mes == 9 && $dia<21)
{
    echo "es invierno";
}
else if ($mes == 9 && $dia > 20 || $mes==10 || $mes == 11 || $mes == 12 && $dia<21)
{
    echo "es primavera";
}
else
{
    echo "es verano";
}



$fecha = date('Y-m-d H:i:s');
echo "<br><br><br><br>Fecha actual: $fecha <br>";
echo "Fecha formateada 1: " . date('d/m/Y H:i:s') . "<br>";
echo "Fecha formateada 2: " . date('F j, Y, g:i a') . "<br>";
echo "Fecha formateada 3: " . date('l, F jS Y') . "<br>";

?>