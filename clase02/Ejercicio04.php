<?php

/*
    Aplicación No 4 (Auto - Garage)
    En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
    los métodos.
*/

require_once 'Auto.php';
require_once 'Garage.php';

$auto1 = new Auto("Audi","Verde");
$auto2 = new Auto("Audi", "Rojo");
$auto3 = new Auto("Toyota", "Negro", 100000);
$auto4 = new Auto("Toyota", "Negro", 120000);
$auto5 = new Auto("Volkswagen", "Gris", 75000);

$garage = new Garage('Mi Garage', 10);

$garage->Add($auto1);
$garage->Add($auto2);
$garage->Add($auto3);
$garage->Add($auto4);
$garage->Add($auto5);

echo "<br><br><br><br>";

echo var_dump($garage->_autos);

echo "<br><br><br><br>";

//$garage->MostrarGarage();

if ($garage->Equals($auto1)) {
    echo "El auto 1 está en el garage.\n"; //opcion correcta
} else {
    echo "El auto 1 no está en el garage.\n";
}

echo "<br>";

// Este auto ya está en el garage
$garage->Add($auto1);

// Quitar auto del garage
$garage->Remove($auto2);

// Mostrar garage
//$garage->MostrarGarage();

// Comparar auto en garage
if ($garage->Equals($auto2)) {
    echo "El auto 2 está en el garage.\n";
} else {
    echo "El auto 2 no está en el garage.\n";
}

?>