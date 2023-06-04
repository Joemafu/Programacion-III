<?php

include_once "Venta.php";

class Devolucion{

    public static function LeerDevolucionesJson()
    {   
        $arrayObjetos = array();
        $arrayDevoluciones = array();
        if (file_exists('Devoluciones.json'))
        {   
            $contenidoJson = file_get_contents("Devoluciones.json");
            $arrayObjetos = json_decode($contenidoJson);
            $nuevaDevolucion = null;

            if($arrayObjetos!=null)
            {
                foreach ($arrayObjetos as $Devolucion)
                {
                    $nuevaDevolucion = new Venta($Devolucion->mailUsuario,$Devolucion->sabor,$Devolucion->tipo,$Devolucion->stock,$Devolucion->vaso,$Devolucion->fecha,$Devolucion->numeroDePedido,$Devolucion->id,$Devolucion->imagenDeLaVenta);

                    array_push($arrayDevoluciones,$nuevaDevolucion);
                }
            }       
        }
        return $arrayDevoluciones;
    }

    public static function GuardarDevolucionesJson($arrayDevoluciones)
    {
        $return = false;
        $devolucionesJson="";

        for ($i=0; $i< count($arrayDevoluciones);$i++)
        {
            $aux = json_encode(
                [
                    "mailUsuario" => $arrayDevoluciones[$i]->getMailUsuario(), 
                    "sabor" => $arrayDevoluciones[$i]->getSabor(), 
                    "tipo" => $arrayDevoluciones[$i]->getTipo(),
                    "vaso" => $arrayDevoluciones[$i]->getVaso(),
                    "stock" => (int)$arrayDevoluciones[$i]->getStock(),
                    "fecha" => $arrayDevoluciones[$i]->getFecha(),
                    "numeroDePedido" => (int)$arrayDevoluciones[$i]->getNumeroDePedido(),                        
                    "id" => (int)$arrayDevoluciones[$i]->getId(),
                    "imagenDeLaVenta" => $arrayDevoluciones[$i]->getFoto()
                ]);
            $devolucionesJson = $devolucionesJson.$aux;
            if($i+1!=count($arrayDevoluciones))
            {
                $devolucionesJson = $devolucionesJson.",\n";
            }
        }

        if(file_put_contents("Devoluciones.json", "[".$devolucionesJson."]")!==false)
        {
            $return = "[".$devolucionesJson."]";
        }
        return $return;
    }

    public static function ListarDevolucionesConCupon()
    {
        $arrayDevoluciones = Devolucion::LeerDevolucionesJson();
        $arrayCupones = Cupon::LeerCuponesJson();

        foreach ($arrayDevoluciones as $devolucion)
        {
            echo "Datos de la devolución:<br>";
            $devolucion->mostrar();
            foreach($arrayCupones as $cupon)
            {
                
                if($cupon->id==$devolucion->getNumeroDePedido())
                {
                    echo "Datos del cupón asociado:<br>";
                    $cupon->mostrar();
                    echo "<br><br>";
                    break;
                }
            }
        }
    }
}

    