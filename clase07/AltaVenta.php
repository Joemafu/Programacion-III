<?php

    include_once "Pizza.php";


    $mail = $_POST['mail'];
    $sabor = $_POST['sabor'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];

    if(Pizza::PizzaExiste($sabor,$tipo))
    {
        
    }


?>