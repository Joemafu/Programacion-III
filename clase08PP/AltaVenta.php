<?php

    include_once "Helado.php";    
    include_once "Venta.php";


    $usuario = $_POST['usuario'];
    $sabor = $_POST['sabor'];
    $tipo = $_POST['tipo'];
    $vaso = $_POST['vaso'];
    $stock = $_POST['stock'];
    $foto = $_FILES['foto'];

    if(Helado::ActualizarHelado($sabor,0,$tipo,$vaso,0-$stock)!=false)
    {
        $nuevaVenta = new Venta ($usuario,$sabor,$tipo, $stock, $vaso,null,null,null,$foto);

        $arrayVentas = Venta::LeerVentasJson();

        array_push($arrayVentas, $nuevaVenta);

        Venta::GuardarVentasJson($arrayVentas);
        
        //echo "Se vendieron ".$stock." helados de ".$sabor." ".$tipo." al usuario ".$mail;
    }


?>