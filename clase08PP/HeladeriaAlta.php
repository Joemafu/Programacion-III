<?php

    include_once "Helado.php";

    $sabor = $_POST['sabor'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $vaso = $_POST['vaso'];
    $stock = $_POST['stock'];
    $foto = $_FILES['foto'];


    if (Helado::ActualizarHelado($sabor, $precio, $tipo, $vaso, $stock)==false)
    {
        $nuevaHelado = new Helado($sabor, $precio, $tipo, $vaso, $stock,null, $foto);

        $arrayHelados = Helado::LeerHeladosJson();
    
        array_push($arrayHelados,$nuevaHelado);

        Helado::GuardarHeladosJson($arrayHelados);
    }
?>