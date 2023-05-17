<?php

class Cupon
{

    public $id;
    public $devolucion_id;
    public $causaDevolucion;
    public $porcentajeDescuento;
    public $valido;
    public $foto;
    
    public function __construct($id, $devolucion_id=null, $causaDevolucion, $foto)
    {
        $this->id = $id;
        $this->devolucion_id = Cupon::AsignarID();
        $this->causaDevolucion = $causaDevolucion;
        $this->porcentajeDescuento = 10;
        $this->valido = true;
        $this->foto = Cupon::GuardarFotoCupon($foto);
    }
    
    public static function AsignarID()
    {
        if (file_exists("lastIDcupon.txt"))
        {
            $archivo = fopen ("lastIDcupon.txt","r");
            $return = fgets($archivo)+1;
            fclose($archivo);
        }
        else
        {
            $return = rand(10000,50000);
        }        

        $archivo = fopen ("lastIDcupon.txt","w");
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
            $ruta = 'FotosCupon\\2023\\'.$this->id.'.jpg';

            //creo el directorio de fotos para el usuario
            if (!is_dir("FotosCupon\\2023"))
            {
                mkdir('FotosCupon\\2023',0777,true);
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