<?php
    /*
        Aplicación No 3 (Auto)
    */
    
    require_once("Auto.php");

    //● Crear dos objetos “Auto” de la misma marca y distinto color.
    $auto1 = new Auto("Audi","Verde");
    $auto2 = new Auto("Audi", "Rojo");

    //● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
    $auto3 = new Auto("Toyota", "Negro", 100000);
    $auto4 = new Auto("Toyota", "Negro", 120000);

    //● Crear un objeto “Auto” utilizando la sobrecarga restante.
    $auto5 = new Auto("Volkswagen", "Gris", 75000);

    //● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al atributo precio.
    $auto3->AgregarImpuestos(1500);
    $auto4->AgregarImpuestos(1500);
    $auto5->AgregarImpuestos(1500);

    //● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el resultado obtenido.
    echo "Suma de los importes de auto 1 y 2: $", Auto::Add($auto1,$auto2), "<br>";
    echo "<br>";

    //● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
    echo "el primer y segundo auto son iguales?: ", $auto1->Equals($auto2), "<br>";
    echo "el primer y quinto auto son iguales?: ", $auto1->Equals($auto5), "<br>";
    echo "<br>";

    //● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)
    Auto::MostrarAuto($auto1);
    echo "<br>";
    Auto::MostrarAuto($auto3);
    echo "<br>";
    Auto::MostrarAuto($auto5);    
?>