<?php

include_once "AccesoDatos.php";

Class usuario
{

    private $_nombre;
    private $_apellido;
    private $_clave;
    private $_mail;
    private $_localidad;
    private $_fechaAlta;
    private $_id;

    public function __construct($nombre, $apellido, $clave, $mail, $localidad, $fechaAlta = null, $id = null)
    {
        $this->_nombre=$nombre;
        $this->_apellido=$apellido;
        $this->_clave=$clave;
        $this->_mail=$mail;
        $this->_localidad=$localidad;

        if ($fechaAlta === null)
        {
            $this->_fechaAlta=Usuario::asignarFechaAlta();
        }   
        else 
        {
            $this->_fechaAlta = $fechaAlta;
        }
        $this->_id = $id;

        // if ($id === null)
        // {
        //     $this->_id = Usuario::asignarID();
        // }
        // else
        // {
        //     $this->_id = $id;
        // }        

        // if ($foto !== null)
        // {
        //     $this->guardarFotoUsuario();
        // }
        // else
        // {
        //     $rutaFoto = $this->_id.'\\Fotos\\'.$this->_id.'.jpg';
        //     if (file_exists($rutaFoto))
        //     {
        //         $this->_rutaFoto=$rutaFoto;
        //     }
        // }
    }

    public function EscribirUsuarioEnDB()
    {
        try
        {
            $objetoAcceso = AccesoDatos::dameUnObjetoAcceso();

            $query = "INSERT INTO usuarios (nombre, apellido, clave, mail, localidad, fechaAlta) VALUES (?, ?, ?, ?, ?, ?)";

            $query = $objetoAcceso->PrepararConsulta($query);

            $query->execute([$this->_nombre, $this->_apellido, $this->_clave, $this->_mail, $this->_localidad, $this->_fechaAlta]);

            echo 'Registro insertado correctamente.';
        }
        catch (PDOException $e) 
        {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public static function LeerUsuariosDB()
    {   
        $datosDeTabla = null;
        try
        {
            $objetoAcceso = AccesoDatos::dameUnObjetoAcceso();

            $datosDeTabla = $objetoAcceso->LeerTodaLaTabla("usuarios");
        }
        catch (PDOException $e) 
        {
            echo 'Error: ' . $e->getMessage();
        }
        return $datosDeTabla;
    }

    public static function AsignarFechaAlta()
    {
        return date('Y-m-d');
    }

    public static function GuardarUsuariosJson($arrayUsuarios)
    {
        $return = false;
        $usuariosJSON="";

        for ($i=0; $i< count($arrayUsuarios);$i++)
        {
            $aux = json_encode(
                [
                    "_nombre" => $arrayUsuarios[$i]->_nombre, 
                    "_apellido" => $arrayUsuarios[$i]->_apellido, 
                    "_clave" => $arrayUsuarios[$i]->_clave,
                    "_mail" => $arrayUsuarios[$i]->_mail,
                    "_localidad" => $arrayUsuarios[$i]->_localidad,
                    "_fechaAlta" => $arrayUsuarios[$i]->_fechaAlta,  
                    "_id" => $arrayUsuarios[$i]->_id      
                ]);
            $usuariosJSON = $usuariosJSON.$aux;
            if($i+1!=count($arrayUsuarios))
            {
                $usuariosJSON = $usuariosJSON.",\n";
            }
        }

        if(file_put_contents("usuarios.json", "[".$usuariosJSON."]")!==false)
        {
            $return = "[".$usuariosJSON."]";
        }
        return $return;
    }

    // public function MostrarUsuarioEnListaHTML()
    // {
    //     echo "<ul>";
    //     echo "<li>";
    //     echo "Nombre: $this->_nombre<br>";
    //     echo "</li>";
    //     echo "<li>";
    //     echo "Apellido: $this->_apellido<br>";
    //     echo "</li>";
    //     echo "<li>";
    //     echo "Clave: $this->_clave<br>";
    //     echo "</li>";
    //     echo "<li>";
    //     echo "Mail: $this->_mail<br>";
    //     echo "</li>";
    //     echo "<li>";
    //     echo "Localidad: $this->_localidad<br>";
    //     echo "</li>";
    //     echo "<li>";
    //     echo "Fecha de alta: $this->_fechaAlta<br>";
    //     echo "</li>";
    //     echo "<li>";
    //     echo "ID: $this->_id<br>";
    //     echo "</li>";
    //     echo "</ul>";
    // }

    // public static function GuardarUsuariosCSV($arrayUsuarios)
    // {
    //     $ret = false;
    //     if(($archivo = fopen("usuarios.csv", "a")) !== false && is_array($arrayUsuarios) && !empty($arrayUsuarios))
    //     {
    //         foreach($arrayUsuarios as $usuario)
    //         {
    //             if(!empty($usuario))
    //             {
    //                 $usuario->_mail = strtolower($usuario->_mail);
    //                 $usuario->_nombre = strtolower($usuario->_nombre);
    //                 $arrayUsuario = get_object_vars($usuario);
    //                 fputcsv($archivo, $arrayUsuario);
    //                 $ret = true;
    //             }                
    //         } 
    //         fclose($archivo);           
    //     }
    //     else
    //     {
    //         echo "No se pudo leer el archivo.<br><br>";
    //     }
    //     return $ret;
    // }

    // public static function LeerusuariosCSV($ruta)
    // {
    //     $arrayUsuarios = array();
        
    //     if($archivo = fopen($ruta, "r"))
    //     {
    //         while (!empty($usuarioString = fgetcsv($archivo)))
    //         {
    //             $usuario = new Usuario($usuarioString[0],$usuarioString[1],$usuarioString[2], $usuarioString[3], $usuarioString[4], $usuarioString[5]);
    //             array_push($arrayUsuarios, $usuario);
    //         }
    //         fclose($archivo);
    //     }
    //     else
    //     {
    //         echo "No se pudo abrir el archivo.<br><br>";
    //     }

    //     return $arrayUsuarios;
    // }

    // public function MostrarUsuario()
    // {
    //     echo "Nombre: $this->_nombre<br>Clave: $this->_clave<br>Mail: $this->_mail<br>Foto: $this->_rutaFoto<br>ID: $this->_id<br>Fecha de alta: $this->_fechaAlta<br>";
    // }

    // public static function ValidarUsuario($mail, $clave, $arrayDeUsuarios)
    // {
    //     $retorno = "Usuario no registrado.<br>";

    //     foreach ($arrayDeUsuarios as $usuario)
    //     {
    //         if (strtolower($usuario->_mail) === strtolower($mail))
    //         {
    //             $retorno = "Error en los datos.<br>";
    //             if ($usuario->_clave===$clave)
    //             {
    //                 $retorno = "Verificado.<br>";
    //             }
    //             break;
    //         }
    //     }
    //     return $retorno;
    // }

    // public static function UsuarioExiste($id, $arrayUsuarios)
    // {
    //     $return = false;

    //     for ($i = 0; $i<count($arrayUsuarios); $i++)
    //     {
    //         if($arrayUsuarios[$i]->_id==$id)
    //         {
    //             $return = $i;
    //             break;
    //         }
    //     }

    //     return $return;
    // }

    // public static function AsignarID()
    // {
    //     if (file_exists("lastIDUsuario.txt"))
    //     {
    //         $archivo = fopen ("lastIDUsuario.txt","r");
    //         $return = fgets($archivo)+1;
    //         fclose($archivo);
    //     }
    //     else
    //     {
    //         $return = rand(1,10000);
    //     }        

    //     $archivo = fopen ("lastIDUsuario.txt","w");
    //     fputs($archivo,$return);
    //     fclose($archivo);

    //     return $return;
    // }

    // public function GuardarFotoUsuario()
    // {
    //     //guardo referencia del archivo temporal en una variable
    //     $archivoTemporal = $_FILES['foto']['tmp_name'];

    //     //guardo la ruta que le voy a dar a la foto en una variable
    //     $ruta = $this->_id.'\\Fotos\\'.$this->_id.'.jpg';

    //     //creo el directorio de fotos para el usuario
    //     if(mkdir($this->_id.'\\Fotos',0777,true))
    //     {
    //         //persisto el archivo temporal en la ruta que predefiní
    //         move_uploaded_file($archivoTemporal, $ruta);
    //     }    

    //     //le asigno un atributo al usuario con la ruta de su foto
    //     $this->_rutaFoto = $ruta;
    // }


    // NUEVA VERSION
    // public static function GuardarUsuariosJson($arrayUsuarios)
    // {
    //     $return = false;
    //     $usuariosJSON = json_encode($arrayUsuarios);

    //     var_dump($usuariosJSON);

    //     //$return = file_put_contents('usuarios.json', $usuariosJSON);

    //     return $return;
    // }

    // public static function LeerUsuariosJson($ruta)
    // {
    //     $arrayObjetos = array();
    //     $arrayUsuarios = array();
    //     $contenidoJson = file_get_contents($ruta);
    //     $arrayObjetos = json_decode($contenidoJson);
    //     $nuevoUsuario = null;

    //     if($arrayObjetos!=null)
    //     {
    //         foreach ($arrayObjetos as $usuario)
    //         {
    //             $nuevoUsuario = new Usuario($usuario->_nombre,$usuario->_clave,$usuario->_mail,null,$usuario->_id,$usuario->_fechaAlta);
    //             array_push($arrayUsuarios,$nuevoUsuario);
    //         }
    //     }       

    //     return $arrayUsuarios;
    // }
}
?>