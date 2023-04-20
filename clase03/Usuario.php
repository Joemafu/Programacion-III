<?php

Class usuario
{
    private $_nombre;
    private $_clave;
    private $_mail;

    public function __construct($nombre, $clave, $mail)
    {
        $this->_nombre=$nombre;
        $this->_clave=$clave;
        $this->_mail=$mail;
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
                $usuario = new Usuario($usuarioString[0],$usuarioString[1],$usuarioString[2]);
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
}

?>