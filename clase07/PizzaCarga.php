<?php

    include_once "Pizza.php";

    $sabor = $_POST['sabor'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];
    $foto = $_FILES['foto'];



  

    
    if (Pizza::ActualizarPizza($sabor, $precio, $tipo, $cantidad)==false)
    {
        $nuevaPizza = new Pizza($sabor, $precio, $tipo, $cantidad,null,$foto);

        $arrayPizzas = Pizza::LeerPizzasJson();
    
        array_push($arrayPizzas,$nuevaPizza);

        Pizza::GuardarPizzasJson($arrayPizzas);
    }
?>