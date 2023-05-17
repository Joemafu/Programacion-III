<?php

    include_once "Helado.php";

    $sabor = $_POST['sabor'];
    $tipo = $_POST['tipo'];

    if(Helado::HeladoExiste($sabor,$tipo))
    {
        echo "Si Hay.";
    }
    else
    {
        echo "La combinación de tipo y sabor de helado ingresados no existe.";
    }   
?>