<?php

class Pizza
{
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;
    public $id;
    public $foto;

    public function __construct($sabor, $precio, $tipo, $cantidad, $id=null, $foto=null)
    {
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;

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
            $this->guardarFotoPizza($foto);
        }
        else
        {
            $rutaFoto = "ImagenesDePizzas\\".$this->tipo.$this->sabor.".jpg";
            if (file_exists($rutaFoto))
            {
                $this->foto=$rutaFoto;
            }
        }
    }

    public static function AsignarID()
    {
        if (file_exists("lastIDPizza.txt"))
        {
            $archivo = fopen ("lastIDPizza.txt","r");
            $return = fgets($archivo)+1;
            fclose($archivo);
        }
        else
        {
            $return = rand(1,10000);
        }        

        $archivo = fopen ("lastIDPizza.txt","w");
        fputs($archivo,$return);
        fclose($archivo);

        return $return;
    }

    public static function GuardarPizzasJson($arrayPizzas)
    {
        $return = false;
        $pizzasJson="";

        for ($i=0; $i< count($arrayPizzas);$i++)
        {
            $aux = json_encode(
                [
                    "sabor" => $arrayPizzas[$i]->sabor, 
                    "precio" => (float)$arrayPizzas[$i]->precio, 
                    "tipo" => $arrayPizzas[$i]->tipo,
                    "cantidad" => (int)$arrayPizzas[$i]->cantidad, 
                    "id" => (int)$arrayPizzas[$i]->id,
                    "foto" => $arrayPizzas[$i]->foto
                ]);
            $pizzasJson = $pizzasJson.$aux;
            if($i+1!=count($arrayPizzas))
            {
                $pizzasJson = $pizzasJson.",\n";
            }
        }

        if(file_put_contents("Pizzas.json", "[".$pizzasJson."]")!==false)
        {
            $return = "[".$pizzasJson."]";
        }
        return $return;
    }

    public static function LeerPizzasJson()
    {   
        $arrayObjetos = array();
        $arrayPizzas = array();
        if (file_exists('Pizzas.json'))
        {   
            $contenidoJson = file_get_contents("Pizzas.json");
            $arrayObjetos = json_decode($contenidoJson);
            $nuevaPizza = null;

            if($arrayObjetos!=null)
            {
                foreach ($arrayObjetos as $pizza)
                {
                    $nuevaPizza = new Pizza($pizza->sabor,$pizza->precio,$pizza->tipo,$pizza->cantidad,$pizza->id,$pizza->foto);
                    array_push($arrayPizzas,$nuevaPizza);
                }
            }       
        }

        return $arrayPizzas;
    }

    public static function PizzaExiste($sabor, $tipo)
    {
        $return=array();
        $arrayPizzas = Pizza::LeerPizzasJson();

        if($arrayPizzas!=false)
        {
            foreach ($arrayPizzas as &$pizza) 
            {
                if ($pizza->sabor == $sabor && $pizza->tipo == $tipo) 
                {
                    $return = $pizza;
                    break;
                }
            }
        } 
        return $return;
    }

    public static function ActualizarPizza($sabor, $precio, $tipo, $cantidad)
    {
        $return = false;
        $arrayPizzas = Pizza::LeerPizzasJson();

        foreach ($arrayPizzas as &$pizza) 
        {
            if ($pizza->sabor == $sabor && $pizza->tipo == $tipo) 
            {
                if($pizza->cantidad + $cantidad>=0)
                {
                    if($precio!=0)
                    {
                        $pizza->precio = $precio;
                    }
                    $pizza->cantidad += $cantidad;
                    $return = $pizza;
                }         
                else
                {
                    echo "No hay suficiente stock para cumplir con el pedido.";
                    return false;
                }       
                break;
            }
        }

        if($return!=false)
        {
            echo "Se actualizó el stock.<br>";
        }

        if (Pizza::GuardarPizzasJson($arrayPizzas)!=false)
        {
            echo "Se guardaron los cambios.<br>";
        }
        return $return;
    }

    public function GuardarFotoPizza($foto)
    {
        if (is_array($foto))
        {
            //guardo referencia del archivo temporal en una variable
            $archivoTemporal = $_FILES['foto']['tmp_name'];

            //guardo la ruta que le voy a dar a la foto en una variable
            $ruta = 'ImagenesDePizzas\\'.$this->tipo.$this->sabor.'.jpg';

            //creo el directorio de fotos para el usuario
            if (!is_dir("ImagenesDePizzas"))
            {
                mkdir('ImagenesDePizzas',0777,true);
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
}




?>