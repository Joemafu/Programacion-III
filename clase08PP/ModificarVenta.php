<?php

include_once "Venta.php";

parse_str(file_get_contents("php://input"),$put_vars);
$nroPedido = (int)$put_vars['nroPedido'];
$mail = (string)$put_vars['mail'];
$sabor = (string)$put_vars['sabor'];
$tipo = (string)$put_vars['tipo'];
$vaso = (string)$put_vars['vaso'];
$cantidad = (int)$put_vars['cantidad'];

if (Venta::ModificarVenta($nroPedido, $mail, $sabor, $tipo, $vaso, $cantidad))
{
    echo "Se modificó la venta.";
}
else
{
    echo "El nro de pedido ingresado no existe.";
}

?>