<?php

/*
    Archivo: Login.php
    método:POST
    Recibe los datos del usuario(clave,mail )por POST ,
    crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
    un :
    “Verificado” si el usuario existe y coincide la clave también.
    “Error en los datos” si esta mal la clave.
    “Usuario no registrado si no coincide el mail“
    Hacer los métodos necesarios en la clase usuario.
*/

include_once "Usuario.php";

$clave = $_POST["clave"];
$mail = $_POST["mail"];

$arrayUsuarios = Usuario::LeerusuariosCSV("usuarios.csv");

echo Usuario::ValidarUsuario($mail, $clave, $arrayUsuarios);

?>