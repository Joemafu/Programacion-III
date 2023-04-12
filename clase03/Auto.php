<?php

/*
    Realizar una clase llamada “Auto” que posea los siguientes atributos
    privados: 

        _color (String)
        _precio (Double)
        _marca (String).
        _fecha (DateTime)

    Realizar un constructor capaz de poder instanciar objetos pasándole como
    parámetros: 

        i. La marca y el color.
        ii. La marca, color y el precio.
        iii. La marca, color, precio y fecha.

    Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble
    por parámetro y que se sumará al precio del objeto.

    Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
    por parámetro y que mostrará todos los atributos de dicho objeto.

    Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
    devolverá TRUE si ambos “Autos” son de la misma marca.

    Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
    de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
    la suma de los precios o cero si no se pudo realizar la operación.

    Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);

    Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
    autos.csv.
    Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
    autos.csv
    Se deben cargar los datos en un array de autos.
*/

class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($marca, $color, $precio = 0, $fecha = "")
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $this->_color = $color;
        $this->_precio = $precio;
        $this->_marca = $marca;
        if ($fecha=="")
        {
            $fecha=date("l \ d\ \d\\e\ M \ \d\\e\ Y");
        }
        $this->_fecha = $fecha;
    }

    public function AgregarImpuestos($impuesto)
    {
        $this->_precio += $impuesto;
    }

    public static function MostrarAuto($auto)
    {
        echo "Color ->", $auto->_color, "<br>";
        echo "Precio ->", $auto->_precio, "<br>";
        echo "Marca ->", $auto->_marca, "<br>";
        echo "Fecha ->", $auto->_fecha, "<br><br>";
    }

    public function Equals($auto)
    {
        return $this->_marca == $auto->_marca;
    }

    public static function Add($auto1,$auto2)
    {
        $ret = 0;
        if($auto1->_color==$auto2->_color && $auto1->Equals($auto2))
        {
            $ret = $auto1->_precio+$auto2->_precio;
        }
        return $ret;
    }

    public static function GuardarAutoCSV($auto) //utilicé una lógica alternativa para guardar un solo auto al final del archivo, para practicar.
    {        
        if($archivo=fopen("autos.csv", "a"))
        {
            $string = $auto->_color.",".$auto->_precio.",".$auto->_marca.",".$auto->_fecha."\n";
            if(fwrite($archivo, $string))
            {
                echo "El auto se guardó en formato csv.<br>";
            }
            fclose($archivo);
        }
        else
        {
            echo "No se pudo abrir el archivo.<br>";
        }
    }

    public static function GuardarAutosCSV($arrayAutos)
    {
        if($archivo=fopen("autos.csv", "w"))
        {
            foreach($arrayAutos as $auto)
            {   
                $autoEnArray = get_object_vars($auto);

                if(fputcsv($archivo, $autoEnArray))
                {
                    echo "El auto se guardó en formato csv.<br>";
                }
                else
                {
                    echo "No se pudo escribir en el archivo.<br>";
                }
            }            
            fclose($archivo);
        }
        else
        {
            echo "No se pudo abrir el archivo.<br>";
        }
    }

    public static function LeerAutosCSV($ruta)
    {
        $arrayAutos= array();
        if($archivo=fopen($ruta, "r"))
        {
            while ($autoString = fgetcsv($archivo))
            {
                $auto = new Auto($autoString[0],$autoString[1],$autoString[2],$autoString[3]);
                array_push($arrayAutos, $auto);
            }
            fclose($archivo);
        }
        else
        {
            echo "No se pudo abrir el archivo.<br>";
        }

        return $arrayAutos;
    }
}

?>