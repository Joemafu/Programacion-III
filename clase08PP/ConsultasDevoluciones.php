<?php

include_once "Helado.php";    
include_once "Venta.php";
include_once "Cupon.php";


$consulta = $_GET['consultaDevolucion'];
$errorDatos = "La consulta ingresada no es válida";

switch ($consulta)
{
    case "devolucionesConCupon":
        {
            Devolucion::ListarDevolucionesConCupon();
            break;
        }  
    case "cuponesEstado":
        {
            Cupon::ListarCupones();
            break;
        }        
    case "devolucionesCuponesEstado":
        {
            Devolucion::ListarDevolucionesConCupon();
            break;
        }    
    default:
        echo $errorDatos;
        break;
} 

?>