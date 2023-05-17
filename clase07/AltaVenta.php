<?php

    include_once "Pizza.php";    
    include_once "Venta.php";


    $mail = $_POST['mail'];
    $sabor = $_POST['sabor'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];

    if(Pizza::ActualizarPizza($sabor,0,$tipo,0-$cantidad)!=false)
    {
        $nuevaVenta = new Venta ($mail,$sabor,$tipo, $cantidad,null,null,null,null);

        $arrayVentas = Venta::LeerVentasJson();

        array_push($arrayVentas, $nuevaVenta);

        Venta::GuardarVentasJson($arrayVentas);
        
        //echo "Se vendieron ".$cantidad." pizzas de ".$sabor." ".$tipo." al usuario ".$mail;
    }


?>