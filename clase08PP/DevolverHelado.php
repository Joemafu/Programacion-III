<?php

include_once "Venta.php";

$nroPedido = $_POST['nroPedido'];
$causaDevolucion = $_POST['causaDevolucion'];
$foto = $_FILES['foto'];

$cupon = Venta::DevolverPedido($nroPedido,$causaDevolucion,$foto);

if ($cupon != false)
{
    echo "Se realizó la devolución. 10% de descuento en la proxima compra con codigo :".$cupon->devolucion_id;
}
else
{
    echo "El nro de pedido ingresado no existe.";
}

?>