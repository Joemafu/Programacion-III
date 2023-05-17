<?php

include_once "Venta.php";

parse_str(file_get_contents("php://input"),$put_vars);
$nroPedido = (int)$put_vars['nroPedido'];

if (Venta::EliminarVenta($nroPedido))
{
    echo "Se eliminó la venta.";
}
else
{
    echo "El nro de pedido ingresado no existe.";
}

?>