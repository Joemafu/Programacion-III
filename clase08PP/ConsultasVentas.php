<?php

include_once "Helado.php";    
include_once "Venta.php";


$consulta = $_GET['consultaVenta'];
$errorDatos = "La consulta ingresada no es válida";

switch ($consulta)
{
    case "cantHeladosVendidos":
        {
            $fecha = "";
            if(isset($_GET['fechaVentas']))
            {
                $fecha = $_GET['fechaVentas'];
            }
            if ($fecha=="")
            {
                $fecha = ((string)date('Y-m-d', strtotime('-1 day')));
                echo "Fecha no indicada, de contabiliazarán las ventas de ayer:<br>";
            }
            Venta::SumarHeladosVendidos($fecha);
            break;
        }  
    case "ventasSegunUsuario":
        {
            if(isset($_GET['usuario']))
            {
                Venta::FiltrarVentasPorUsuario($_GET['usuario']);
            }        
            else
            {
                echo $errorDatos;
            }  
            break;
        }        
    case "ventasEntreFechas":
        {
            if(isset($_GET['fechaUno']) && isset($_GET['fechaDos']))
            {
                Venta::FiltrarVentasEntreFechas($_GET['fechaUno'],$_GET['fechaDos']);
            }
            else
            {
                echo $errorDatos;
            }  
            break;
        }             
    case "ventasSegunSabor":
        {
            if(isset($_GET['sabor']))
            {
                Venta::FiltrarVentasPorSabor($_GET['sabor']);
            }
            else
            {
                echo $errorDatos;
            }
            break;
        }                
    case "ventasCucurucho":
        {
            Venta::FiltrarVentasCucurucho();
            break;
        }        
    default:
        echo $errorDatos;
        break;
}

?>