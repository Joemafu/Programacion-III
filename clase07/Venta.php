<?php

    include_once "Helado.php";

    class venta
    {
        private $mailUsuario;
        private $sabor;
        private $tipo;
        private $cantidad;
        private $fecha;
        private $numeroDePedido;
        private $id;
        private $imagenDeLaVenta;

        public function __construct($mailUsuario, $sabor, $tipo, $cantidad, $fecha=null, $numeroDePedido=null, $id=null, $imagenDeLaVenta=null)
        {
            $this->mailUsuario = $mailUsuario;
            $this->sabor = $sabor;
            $this->tipo = $tipo;
            $this->cantidad = $cantidad;

            if ($fecha===null)
            {
                $this->AsignarFecha();
            }
            else
            {
                $this->fecha = $fecha;
            }

            if ($numeroDePedido == null)
            {
                $this->numeroDePedido = $this->AsignarNumeroDePedido();
            }
            else
            {
                $this->numeroDePedido = $numeroDePedido;
            }

            if ($id == null)
            {
                $this->id = $this->AsignarID();
            }
            else
            {
                $this->id = $id;
            }

            $rutaFoto = "ImagenesDeHelados\\".$this->tipo.$this->sabor.".jpg";
            $this->GuardarFotoVenta($rutaFoto);
        }

        public static function AsignarID()
        {
            if (file_exists("lastIDVenta.txt"))
            {
                $archivo = fopen ("lastIDVenta.txt","r");
                $return = fgets($archivo)+1;
                fclose($archivo);
            }
            else
            {
                $return = rand(1,10000);
            }        

            $archivo = fopen ("lastIDVenta.txt","w");
            fputs($archivo,$return);
            fclose($archivo);

            return $return;
        }

        public static function AsignarNumeroDePedido()
        {
            if (file_exists("lastNumeroDePedido.txt"))
            {
                $archivo = fopen ("lastNumeroDePedido.txt","r");
                $return = fgets($archivo)+1;
                fclose($archivo);
            }
            else
            {
                $return = rand(1,10000);
            }        

            $archivo = fopen ("lastNumeroDePedido.txt","w");
            fputs($archivo,$return);
            fclose($archivo);

            return $return;
        }

        public function AsignarFecha()
        {
            $this->fecha=date('Y-m-d');
        }

        public function GuardarFotoVenta($foto)
        {
            if (!is_dir("ImagenesDeLaVenta"))
            {
                mkdir('ImagenesDeLaVenta',0777,true);
            }

            $partes = explode("@", $this->mailUsuario);

            $nombreUsuario = $partes[0];

            $rutaDestino = 'ImagenesDeLaVenta\\'.$this->tipo.$this->sabor.$nombreUsuario.$this->fecha.'.jpg';

            copy($foto, $rutaDestino);

            $this->imagenDeLaVenta=$rutaDestino;
        }

        public static function LeerVentasJson()
        {   
            $arrayObjetos = array();
            $arrayVentas = array();
            if (file_exists('Ventas.json'))
            {   
                $contenidoJson = file_get_contents("Ventas.json");
                $arrayObjetos = json_decode($contenidoJson);
                $nuevaVenta = null;

                if($arrayObjetos!=null)
                {
                    foreach ($arrayObjetos as $venta)
                    {
                        $nuevaVenta = new Venta($venta->mailUsuario,$venta->sabor,$venta->tipo,$venta->cantidad,$venta->fecha,$venta->numeroDePedido,$venta->id,$venta->imagenDeLaVenta);

                        array_push($arrayVentas,$nuevaVenta);
                    }
                }       
            }
            return $arrayVentas;
        }

        public static function GuardarVentasJson($arrayVentas)
        {
            $return = false;
            $ventasJson="";

            for ($i=0; $i< count($arrayVentas);$i++)
            {
                $aux = json_encode(
                    [
                        "mailUsuario" => $arrayVentas[$i]->mailUsuario, 
                        "sabor" => $arrayVentas[$i]->sabor, 
                        "tipo" => $arrayVentas[$i]->tipo,
                        "cantidad" => (int)$arrayVentas[$i]->cantidad,
                        "fecha" => $arrayVentas[$i]->fecha,
                        "numeroDePedido" => (int)$arrayVentas[$i]->numeroDePedido,                        
                        "id" => (int)$arrayVentas[$i]->id,
                        "imagenDeLaVenta" => $arrayVentas[$i]->imagenDeLaVenta
                    ]);
                $ventasJson = $ventasJson.$aux;
                if($i+1!=count($arrayVentas))
                {
                    $ventasJson = $ventasJson.",\n";
                }
            }

            if(file_put_contents("Ventas.json", "[".$ventasJson."]")!==false)
            {
                $return = "[".$ventasJson."]";
            }
            return $return;
        }

        public static function EliminarVenta($nroPedido)
        {
            $return = false;
            $arrayVentas = Venta::LeerVentasJson();

            for ($i=0; $i<count($arrayVentas);$i++)
            {
                if($arrayVentas[$i]->numeroDePedido == $nroPedido)
                {
                    if (!is_dir("BACKUPVENTAS"))
                    {
                        mkdir('BACKUPVENTAS',0777,true);
                    }
                    $partes = explode("\\", $arrayVentas[$i]->imagenDeLaVenta);

                    $rutaDestino = 'BACKUPVENTAS\\'.$partes[1];

                    rename($arrayVentas[$i]->imagenDeLaVenta, $rutaDestino);
                    
                    array_splice($arrayVentas,$i,1);
                    Venta::GuardarVentasJson($arrayVentas);
                    $return = true;
                    break;
                }
            }
            return $return;
        }

        public static function ModificarVenta($nroPedido, $mail, $sabor, $tipo, $cantidad)
        {
            $return = false;
            $arrayVentas = Venta::LeerVentasJson();

            for ($i=0; $i<count($arrayVentas);$i++)
            {
                if($arrayVentas[$i]->numeroDePedido == $nroPedido)
                {
                    $arrayVentas[$i]->mailUsuario = $mail;
                    $arrayVentas[$i]->sabor = $sabor;
                    $arrayVentas[$i]->tipo = $tipo;
                    $arrayVentas[$i]->cantidad = $cantidad;


                    Venta::GuardarVentasJson($arrayVentas);
                    $return = true;
                    break;
                }
            }
            return $return;
        }

        public static function SumarHeladosVendidas()
        {
            $return = 0;
            $arrayVentas = Venta::LeerVentasJson();
            if($arrayVentas!=null)
            {
                foreach ($arrayVentas as $venta)
                {
                    $return += $venta->cantidad;
                }
            }
            echo "Se vendió un total de " .$return. " pizzas.";
        }

        public static function FiltrarVentasPorUsuario($usuario)
        {
            $arrayVentas = Venta::LeerVentasJson();
            if($arrayVentas!=null)
            {
                foreach ($arrayVentas as $venta)
                {
                    if($venta->mailUsuario==$usuario)
                    {
                        $venta->mostrar();
                    }
                }
            }
        }

        public static function FiltrarVentasPorSabor($sabor)
        {
            $arrayVentas = Venta::LeerVentasJson();
            if($arrayVentas!=null)
            {
                foreach ($arrayVentas as $venta)
                {
                    if($venta->sabor==$sabor)
                    {
                        $venta->mostrar();
                    }
                }
            }
        }

        public static function FiltrarVentasEntreFechas($fechaUno, $fechaDos)
        {
            $objetoFechaUno= DateTime::createFromFormat('Y-m-d',$fechaUno);
            $objetoFechaDos= DateTime::createFromFormat('Y-m-d',$fechaDos);

            $arrayVentas = Venta::LeerVentasJson();
            if($arrayVentas!=null)
            {
                foreach ($arrayVentas as $venta)
                {
                    $objetoFechaVenta = DateTime::createFromFormat('Y-m-d',$venta->fecha);

                    if($objetoFechaVenta >= $objetoFechaUno && $objetoFechaVenta<=$objetoFechaDos)
                    {
                        $venta->mostrar();
                    }
                }
            }
        }

        public function mostrar() {
            echo "Mail Usuario: " . $this->mailUsuario . "<br>";
            echo "Sabor: " . $this->sabor . "<br>";
            echo "Tipo: " . $this->tipo . "<br>";
            echo "Cantidad: " . $this->cantidad . "<br>";
            echo "Fecha: " . $this->fecha . "<br>";
            echo "Número de Pedido: " . $this->numeroDePedido . "<br>";
            echo "ID: " . $this->id . "<br>";
            echo "Imagen de la Venta: " . $this->imagenDeLaVenta . "<br><br>";
        }

    }
?>