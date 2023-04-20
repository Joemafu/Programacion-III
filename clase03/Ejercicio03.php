<?php

/*
    Archivo: registro.php
    método:POST
    Recibe los datos del usuario(nombre, clave,mail )por POST ,
    crear un objeto y utilizar sus métodos para poder hacer el alta,
    guardando los datos en usuarios.csv.
    retorna si se pudo agregar o no.
    Cada usuario se agrega en un renglón diferente al anterior.
    Hacer los métodos necesarios en la clase usuario
*/
    
include_once "Usuario.php";

$nombre = $_POST["nombre"];
$clave = $_POST["clave"];
$mail = $_POST["mail"];

if ($nombre !== null && $clave !== null && $mail !== null)
{
    $usuarioNuevo = new Usuario($nombre,$clave,$mail);

    $arrayUsuarios = array();

    array_push($arrayUsuarios,$usuarioNuevo);    

    if(Usuario::GuardarUsuariosCSV($arrayUsuarios))
    {
        echo "Se agregó el usuario.<br><br>";
    }
    else
    {
        echo "No se pudo agregar el usuario.<br><br>";
    }
    
}

?>