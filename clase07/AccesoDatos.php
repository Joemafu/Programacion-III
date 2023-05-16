<?php

class AccesoDatos
{
    private static $ObjetoAccesoDatos;
    private $conexion;
 
    private function __construct()
    {
        try { 
            $this->conexion = new PDO('mysql:host=localhost;dbname=clase07;charset=utf8', 'root', '');
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }
 
    public function PrepararConsulta($sql)
    { 
        return $this->conexion->prepare($sql); 
    }
    
    public function RetornarUltimoIdInsertado()
    { 
        return $this->conexion->lastInsertId(); 
    }
 
    public static function dameUnObjetoAcceso()
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new AccesoDatos(); 
        } 
        return self::$ObjetoAccesoDatos;        
    }

    public function LeerTodaLaTabla($tabla)
    {
        try
        {
            $query = $this->conexion->query("SELECT * FROM ".$tabla);

            $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
            $arrayUsuarios = array();

            foreach($resultados as $fila)
            {
                $nuevoUsuario = new Usuario($fila['nombre'], $fila['apellido'], $fila['clave'], $fila['mail'], $fila['localidad'], $fila['fechaAlta'], $fila['id']);
                array_push($arrayUsuarios, $nuevoUsuario);
            }

            return $arrayUsuarios;
        }        
        catch(PDOException $e) 
        {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

  
    // Evita que el objeto se pueda clonar
    public function __clone()
    { 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }
}
?>