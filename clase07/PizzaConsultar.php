<?php

    include_once "Pizza.php";

    $sabor = $_POST['sabor'];
    $tipo = $_POST['tipo'];

    if(Pizza::PizzaExiste($sabor,$tipo))
    {
        echo "Si Hay.";
    }
    else
    {
        echo "La combinación de tipo y sabor de pizza ingresados no existe.";
    }   
?>