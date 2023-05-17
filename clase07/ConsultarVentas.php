<?php

include_once "Pizza.php";    
include_once "Venta.php";


$consulta = $_GET['consultaVenta'];
$errorDatos = "La consulta ingresada no es válida";

switch ($consulta)
{
    case "cantPizzasVendidas":
        {
            Venta::SumarPizzasVendidas();
            break;
        }        
    case "ventasEntreFechas":
        {
            if(isset($_GET['fechaUno']) && isset($_GET['fechaDos']))
            {
                Venta::FiltrarVentasEntreFechas($_GET['fechaUno'],$_GET['fechaUno']);
            }
            else
            {
                echo $errorDatos;
            }  
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
    default:
        echo $errorDatos;
        break;
}

?>