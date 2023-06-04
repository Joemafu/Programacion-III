<?php

class Cupon
{
    public $id;
    public $devolucion_id;
    public $causaDevolucion;
    public $porcentajeDescuento;
    public $estado;
    public $foto;
    
    public function __construct($id, $devolucion_id, $causaDevolucion, $porcentajeDescuento, $estado, $foto)
    {
        $this->id = $id;

        if($devolucion_id===null)
        {
            $this->devolucion_id = Cupon::AsignarID();
        }       
        else
        {
            $this->devolucion_id = $devolucion_id; 
        }        
        
        $this->causaDevolucion = $causaDevolucion;
        if ($porcentajeDescuento===null)
        {
            $this->porcentajeDescuento = 10;
        }
        else
        {
            $this->porcentajeDescuento = $porcentajeDescuento;   
        }       
        $this->estado = $estado;
        $this->GuardarFotoCupon($foto);    
    }
    
    public static function AsignarID()
    {
        if (file_exists("lastIDcupon.txt"))
        {
            $archivo = fopen ("lastIDCupon.txt","r");
            $return = fgets($archivo)+1;
            fclose($archivo);
        }
        else
        {
            $return = rand(10000,50000);
        }       
        $archivo = fopen ("lastIDCupon.txt","w");
        fputs($archivo,$return);
        fclose($archivo);

        return $return;
    }

    public function GuardarFotoCupon($foto)
    {
        if (is_array($foto))
        {
            //guardo referencia del archivo temporal en una variable
            $archivoTemporal = $_FILES['foto']['tmp_name'];

            //guardo la ruta que le voy a dar a la foto en una variable
            $ruta = 'ImagenesDeCupones\\2023\\'.$this->id.'.jpg';

            //creo el directorio de fotos para el cupon
            if (!is_dir("ImagenesDeCupones\\2023"))
            {
                mkdir('ImagenesDeCupones\\2023',0777,true);
            }
            //persisto el archivo temporal en la ruta que predefiní
            move_uploaded_file($archivoTemporal, $ruta);

            //le asigno un atributo al cupon con la ruta de su foto
            $this->foto = $ruta;
        }
        else
        {
            $this->foto = $foto;
        }
    }

    public static function LeerCuponesJson()
    {   
        $arrayObjetos = array();
        $arrayCupones = array();
        if (file_exists('Cupones.json'))
        {   
            $contenidoJson = file_get_contents("Cupones.json");
            $arrayObjetos = json_decode($contenidoJson);
            $nuevoCupon = null;

            if($arrayObjetos!=null)
            {
                foreach ($arrayObjetos as $cupon)
                {
                    $nuevoCupon = new Cupon($cupon->id,$cupon->devolucion_id,$cupon->causaDevolucion,$cupon->porcentajeDescuento,$cupon->estado,$cupon->foto);

                    array_push($arrayCupones,$nuevoCupon);
                }
            }       
        }
        return $arrayCupones;
    }

    public static function GuardarCuponesJson($arrayCupones)
    {
        $return = false;
        $cuponesJson="";

        for ($i=0; $i< count($arrayCupones);$i++)
        {
            $aux = json_encode(
                [
                    "id" => $arrayCupones[$i]->id, 
                    "devolucion_id" => $arrayCupones[$i]->devolucion_id, 
                    "causaDevolucion" => $arrayCupones[$i]->causaDevolucion,
                    "porcentajeDescuento" => $arrayCupones[$i]->porcentajeDescuento,
                    "estado" => $arrayCupones[$i]->estado,
                    "foto" => $arrayCupones[$i]->foto
                ]);
            $cuponesJson = $cuponesJson.$aux;
            if($i+1!=count($arrayCupones))
            {
                $cuponesJson = $cuponesJson.",\n";
            }
        }

        if(file_put_contents("Cupones.json", "[".$cuponesJson."]")!==false)
        {
            $return = "[".$cuponesJson."]";
        }
        return $return;
    }

    public function mostrar() {
        echo "ID: " . $this->id . "<br>";
        echo "Devolución ID: " . $this->devolucion_id . "<br>";
        echo "Causa de Devolución: " . $this->causaDevolucion . "<br>";
        echo "Porcentaje de Descuento: " . $this->porcentajeDescuento . "<br>";
        echo "Estado: " . $this->estado . "<br>";
        echo "Foto: " . $this->foto . "<br>";
    }

    public static function ValidarCupon($codigoCupon)
    {
        $return = 0;
        if ($codigoCupon!=null)
        {
            $arrayCupones = Cupon::LeerCuponesJson();

            foreach($arrayCupones as $cupon)
            {
                if((int)$cupon->devolucion_id === (int)$codigoCupon)
                {
                    if ($cupon->estado == "No usado")
                    {
                        $cupon->estado = "Usado";
                        $return = $cupon->porcentajeDescuento;
    
                        echo "Cupón de descuento ".$cupon->devolucion_id." utilizado. Se aplicó un ".$cupon->porcentajeDescuento."% de descuento!";
                        Cupon::GuardarCuponesJson($arrayCupones);
                    }
                    else
                    {
                        echo "El cupon ya fue utilizado con anterioridad. No se aplicó descuento.";
                    }
                    break;
                }
            }
        }
        return $return;
    }

    public static function ListarCupones()
    {
        $arrayCupones = Cupon::LeerCuponesJson();
        {
            foreach ($arrayCupones as $cupon)
            {
                $cupon->mostrar();
                echo "<br>";
            }
        }
    }
}

?>