<?php

Class usuario
{
    public $_nombre;
    public $_clave;
    public $_mail;
    public $_id;
    public $_fechaAlta;
    public $_rutaFoto;

    public function __construct($nombre, $clave, $mail, $foto = null)
    {
        $this->_nombre=$nombre;
        $this->_clave=$clave;
        $this->_mail=$mail;

        $this->_id=Usuario::asignarID();
        $this->_fechaAlta=Usuario::asignarFechaAlta();

        if ($foto !== null)
        {
            $this->guardarFotoUsuario();
        }
    }

    public static function GuardarUsuariosCSV($arrayUsuarios)
    {
        $ret = false;
        if(($archivo = fopen("usuarios.csv", "a")) !== false && is_array($arrayUsuarios) && !empty($arrayUsuarios))
        {
            foreach($arrayUsuarios as $usuario)
            {
                if(!empty($usuario))
                {
                    $arrayUsuario = get_object_vars($usuario);
                    $usuario->_mail = strtolower($usuario->_mail);
                    $usuario->_nombre = strtolower($usuario->_nombre);
                    fputcsv($archivo, $arrayUsuario);
                    $ret = true;
                }                
            } 
            fclose($archivo);           
        }
        else
        {
            echo "No se pudo leer el archivo.<br><br>";
        }
        return $ret;
    }

    public static function LeerusuariosCSV($ruta)
    {
        $arrayUsuarios = array();
        
        if($archivo = fopen($ruta, "r"))
        {
            while (!empty($usuarioString = fgetcsv($archivo)))
            {
                $usuario = new Usuario($usuarioString[0],$usuarioString[1],$usuarioString[2], $usuarioString[3]);
                array_push($arrayUsuarios, $usuario);
            }
            fclose($archivo);
        }
        else
        {
            echo "No se pudo abrir el archivo.<br><br>";
        }

        return $arrayUsuarios;
    }

    public function MostrarUsuario()
    {
        echo "Nombre: $this->_nombre<br>Clave: $this->_clave<br>Mail: $this->_mail<br>";
    }

    public function MostrarUsuarioEnListaHTML()
    {
        echo "<ul><li>$this->_nombre</li><li>$this->_clave</li><li>$this->_mail</li></ul>";
    }

    public static function ValidarUsuario($mail, $clave, $arrayDeUsuarios)
    {
        $retorno = "Usuario no registrado.<br>";

        foreach ($arrayDeUsuarios as $usuario)
        {
            if (strtolower($usuario->_mail) === strtolower($mail))
            {
                $retorno = "Error en los datos.<br>";
                if ($usuario->_clave===$clave)
                {
                    $retorno = "Verificado.<br>";
                }
                break;
            }
        }
        return $retorno;
    }

    public static function AsignarID()
    {
        if (file_exists("lastID.txt"))
        {
            $archivo = fopen ("lastID.txt","r");
            $return = fgets($archivo)+1;
            fclose($archivo);
        }
        else
        {
            $return = rand(1,10000);
        }        

        $archivo = fopen ("lastID.txt","w");
        fputs($archivo,$return);
        fclose($archivo);

        return $return;
    }

    public static function AsignarFechaAlta()
    {
        return date('d/m/Y H:i:s');
    }

    public function _nombre() {
        return $this->_nombre;
    }
    
    public function _clave() {
        return $this->_clave;
    }
    
    public function _mail() {
        return $this->_mail;
    }
    
    public function _id() {
        return $this->_id;
    }
    
    public function _fechaAlta() {
        return $this->_fechaAlta;
    }
    
    public function _rutaFoto() {
        return $this->_rutaFoto;
    }

    public function GuardarFotoUsuario()
    {
        //guardo el nombre temporal del archivo en una variable
        $archivoTemporal = $_FILES["foto"]["tmp_name"];

        //creo el directorio de fotos del usuario
        if(mkdir($this->_id."\\Fotos",0777,true))
        {
            //guardo la ruta de la foto en una variable
            $ruta = $this->_id."\\Fotos\\".$this->_id.".jpg";
        }

        //persisto el archivo temporal en la ruta que predefiní
        move_uploaded_file($archivoTemporal, $ruta);

        //le asigno un atributo al usuario con la ruta de su foto ??
        $this->_rutaFoto = $ruta;
    }

    public static function GuardarUsuariosJson($arrayUsuarios)
    {
        $return = false;
        $usuariosJSON = json_encode($arrayUsuarios);
        if(file_put_contents("usuarios.json", $usuariosJSON)!==false)
        {
            $return = true;
        }
        return $return;
    }

    // public static function GuardarUsuariosJson($arrayUsuarios)
    // {
    //     $return = false;
    //     $usuariosJSON="";

    //     foreach ($arrayUsuarios as $usuario)
    //     {
    //         $aux = json_encode([
    //             $usuario->_nombre,
    //             $usuario->_clave,
    //             $usuario->_mail,
    //             $usuario->_id,
    //             $usuario->_rutaFoto,
    //             $usuario->_fechaAlta
    //         ],JSON_PRETTY_PRINT);
    //         $usuariosJSON = $usuariosJSON.$aux;
    //     }

    //     if(file_put_contents("usuarios.json", $usuariosJSON)!==false)
    //     {
    //         $return = true;
    //     }
    //     return $return;
    // }
}

?>