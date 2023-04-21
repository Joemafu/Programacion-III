<?php

Class usuario
{
    private $_nombre;
    private $_clave;
    private $_mail;
    private $_id;
    private $_fechaAlta;
    private $_rutaFoto;

    public function __construct($nombre, $clave, $mail, $foto = null, $id = null, $fechaAlta = null)
    {
        $this->_nombre=$nombre;
        $this->_clave=$clave;
        $this->_mail=$mail;

        if ($id === null)
        {
            $this->_id = Usuario::asignarID();
        }
        else
        {
            $this->_id = $id;
        }        

        if ($foto !== null)
        {
            $this->guardarFotoUsuario();
        }
        else
        {
            $rutaFoto = $this->_id."\\Fotos\\".$this->_id.".jpg";
            if (file_exists($rutaFoto))
            {
                $this->_rutaFoto=$rutaFoto;
            }
        }

        if ($fechaAlta === null)
        {
            $this->_fechaAlta=Usuario::asignarFechaAlta();
        }   
        else 
        {
            $this->_fechaAlta = $fechaAlta;
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
                    $usuario->_mail = strtolower($usuario->_mail);
                    $usuario->_nombre = strtolower($usuario->_nombre);
                    $arrayUsuario = get_object_vars($usuario);
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
                $usuario = new Usuario($usuarioString[0],$usuarioString[1],$usuarioString[2], $usuarioString[3], $usuarioString[4], $usuarioString[5]);
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

    // public static function GuardarUsuariosJson($arrayUsuarios)
    // {
    //     $return = false;
    //     $usuariosJSON = json_encode($arrayUsuarios);
    //     if(file_put_contents("usuarios.json", $usuariosJSON)!==false)
    //     {
    //         $return = true;
    //     }
    //     return $return;
    // }

    public static function GuardarUsuariosJson($arrayUsuarios)
    {
        $return = false;
        $usuariosJSON="";

        foreach ($arrayUsuarios as $usuario)
        {
            //Si lo quiero serializar como "valor" solo

            // $aux = json_encode([
            //     $usuario->_nombre, 
            //     $usuario->_clave,
            //     $usuario->_mail,
            //     $usuario->_id,
            //     $usuario->_fechaAlta,
            //     $usuario->_rutaFoto  
            // ]);

            //Si lo quiero serializar como "clave:valor"

            $aux = json_encode(
                [
                    "_nombre" => $usuario->_nombre, 
                    "_clave" => $usuario->_clave,
                    "_mail" => $usuario->_mail,
                    "_id" => $usuario->_id,
                    "_fechaAlta" => $usuario->_fechaAlta,
                    "_rutaFoto" => $usuario->_rutaFoto                    
                ]);
            $usuariosJSON = $usuariosJSON.$aux."\n";
        }

        if(file_put_contents("usuarios.json", $usuariosJSON)!==false)
        {
            $return = true;
        }
        return $return;
    }

    public static function LeerUsuariosJson($ruta)
    {
        $arrayUsuarios = array();
        $contenidoJson = file_get_contents($ruta);

        var_dump(json_decode($contenidoJson));

        

        //json_decode()


        

        //esto es para csv, tengo que adaptarlo
        $arrayUsuarios = array();
        
        if($archivo = fopen($ruta, "r"))
        {
            while (!empty($usuarioString = fgetcsv($archivo)))
            {
                $usuario = new Usuario($usuarioString[0],$usuarioString[1],$usuarioString[2], $usuarioString[3], $usuarioString[4], $usuarioString[5]);
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
}
?>