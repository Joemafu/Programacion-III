<?php

include_once("Auto.php");

$auto1 = new Auto("Ford", "Rojo");
$auto2 = new Auto("Ford", "Azul");
$auto3 = new Auto("Ford", "Gris", 250000);
$auto4 = new Auto("Toyota", "Negro", 300000);
$auto5 = new Auto("Toyota", "Negro", 280000);
$auto6 = new Auto("Toyota", "Blanco", 320000);
$auto7 = new Auto("Chevrolet", "Azul", 200000);
$auto8 = new Auto("Fiat", "Verde", 180000);

$arrayAutos = array($auto1, $auto2, $auto3, $auto4, $auto5, $auto6, $auto7, $auto8);

Auto::GuardarAutosCSV($arrayAutos);


$arrayLeido = Auto::LeerAutosCSV("autos.csv");

foreach ($arrayLeido as $autoLeido)
{
    Auto::MostrarAuto($autoLeido);
}

?>