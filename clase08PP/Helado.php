<?php

class Helado
{
    public $sabor;
    public $precio;
    public $tipo;
    public $vaso;
    public $stock;
    public $id;
    public $foto;

    public function __construct($sabor, $precio, $tipo, $vaso, $stock, $id=null, $foto=null)
    {
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->vaso = $vaso;
        $this->stock = $stock;

        if ($id == null)
        {
            $this->id = $this->AsignarID();
        }
        else
        {
            $this->id = $id;
        }

        if ($foto !== null)
        {
            $this->GuardarFotoHelado($foto);
        }
        else
        {
            $rutaFoto = "ImagenesDeHelados\\2023\\".$this->tipo.$this->sabor.".jpg";
            if (file_exists($rutaFoto))
            {
                $this->foto=$rutaFoto;
            }
        }
    }

    public static function AsignarID()
    {
        if (file_exists("lastIDHelado.txt"))
        {
            $archivo = fopen ("lastIDHelado.txt","r");
            $return = fgets($archivo)+1;
            fclose($archivo);
        }
        else
        {
            $return = rand(1,10000);
        }        

        $archivo = fopen ("lastIDHelado.txt","w");
        fputs($archivo,$return);
        fclose($archivo);

        return $return;
    }

    public static function GuardarHeladosJson($arrayHelados)
    {
        $return = false;
        $heladosJson="";

        for ($i=0; $i< count($arrayHelados);$i++)
        {
            $aux = json_encode(
                [
                    "sabor" => $arrayHelados[$i]->sabor, 
                    "precio" => (float)$arrayHelados[$i]->precio, 
                    "tipo" => $arrayHelados[$i]->tipo,
                    "vaso" => $arrayHelados[$i]->vaso,
                    "stock" => (int)$arrayHelados[$i]->stock, 
                    "id" => (int)$arrayHelados[$i]->id,
                    "foto" => $arrayHelados[$i]->foto
                ]);
            $heladosJson = $heladosJson.$aux;
            if($i+1!=count($arrayHelados))
            {
                $heladosJson = $heladosJson.",\n";
            }
        }

        if(file_put_contents("Helados.json", "[".$heladosJson."]")!==false)
        {
            $return = "[".$heladosJson."]";
        }
        return $return;
    }

    public static function LeerHeladosJson()
    {   
        $arrayObjetos = array();
        $arrayHelados = array();
        if (file_exists('Helados.json'))
        {   
            $contenidoJson = file_get_contents("Helados.json");
            $arrayObjetos = json_decode($contenidoJson);
            $nuevoHelado = null;

            if($arrayObjetos!=null)
            {
                foreach ($arrayObjetos as $helado)
                {
                    $nuevoHelado = new Helado($helado->sabor,$helado->precio,$helado->tipo,$helado->vaso,$helado->stock,$helado->id,$helado->foto);
                    array_push($arrayHelados,$nuevoHelado);
                }
            }       
        }

        return $arrayHelados;
    }

    public static function HeladoExiste($sabor, $tipo)
    {
        $return=array();
        $arrayHelados = Helado::LeerHeladosJson();

        if($arrayHelados!=false)
        {
            foreach ($arrayHelados as &$helado) 
            {
                if ($helado->sabor == $sabor && $helado->tipo == $tipo) 
                {
                    $return = $helado;
                    break;
                }
            }
        } 
        return $return;
    }

    public static function ActualizarHelado($sabor, $precio, $tipo, $vaso, $stock)
    {
        $return = false;
        $arrayHelados = Helado::LeerHeladosJson();

        foreach ($arrayHelados as &$helado) 
        {
            if ($helado->sabor == $sabor && $helado->tipo == $tipo) 
            {
                if($helado->stock + $stock>=0)
                {
                    if($precio!=0)
                    {
                        $helado->precio = $precio;
                    }
                    $helado->stock += $stock;
                    $return = $helado;
                }         
                else
                {
                    echo "No hay suficiente stock para cumplir con el pedido.";
                }       
                break;
            }
        }

        if($return!=false)
        {
            echo "Se actualizó el stock.<br>";

            if (Helado::GuardarHeladosJson($arrayHelados)!=false)
            {
                echo "Se guardaron los cambios.<br>";
            }
        }
        
        return $return;
    }

    public function GuardarFotoHelado($foto)
    {
        if (is_array($foto))
        {
            //guardo referencia del archivo temporal en una variable
            $archivoTemporal = $_FILES['foto']['tmp_name'];

            //guardo la ruta que le voy a dar a la foto en una variable
            $ruta = 'ImagenesDeHelados\\2023\\'.$this->sabor.$this->tipo.'.jpg';

            //creo el directorio de fotos para el usuario
            if (!is_dir("ImagenesDeHelados\\2023"))
            {
                mkdir('ImagenesDeHelados\\2023',0777,true);
            }
            //persisto el archivo temporal en la ruta que predefiní
            move_uploaded_file($archivoTemporal, $ruta);

            //le asigno un atributo al usuario con la ruta de su foto
            $this->foto = $ruta;
        }
        else
        {
            $this->foto = $foto;
        }
    }

    public static function GetPrecio($sabor, $tipo)
    {
        $return = false;
        $arrayHelados = Helado::LeerHeladosJson();

        foreach ($arrayHelados as $helado)
        {
            if ($helado->sabor == $sabor && $helado->tipo = $tipo)
            {
                $return = $helado->precio;
                break;
            }
        }
        return $return;
    } 
}

?>