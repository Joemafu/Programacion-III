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

$garage->Add($auto1); // Se agrega
$garage->Add($auto2); // No se agrega
$garage->Add($auto3); // Se agrega
$garage->Add($auto4); // No se agrega
$garage->Add($auto5); // Se agrega

$garage->MostrarGarage(); //Muestro coches 1, 3 y 5

if ($garage->Equals($auto1)) 
{
    echo "El auto 1 está en el garage.<br><br>"; // Opción correcta
} 
else 
{
    echo "El auto 1 no está en el garage.<br><br>";
}

$garage->Add($auto1); // Error! este auto ya está en el garage

$resultado = $garage->Remove($auto2); // Quitar auto del garage (debe quitar auto 1 debido a la lógica de negocio)

$garage->MostrarGarage(); // Muestro coches 3 y 5

// Comparar auto en garage
if ($garage->Equals($auto2)) 
{
    echo "El auto 2 está en el garage.<br><br>";
} 
else 
{
    echo "El auto 2 no está en el garage.<br><br>"; // Opción correcta
}

?>