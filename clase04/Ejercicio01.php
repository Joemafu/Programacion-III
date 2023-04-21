<?php

/*
    Archivo: registro.php
    método:POST
    Recibe los datos del usuario(nombre, clave,mail )por POST ,
    crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
    fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
    guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
    Usuario/Fotos/.
    retorna si se pudo agregar o no.
    Cada usuario se agrega en un renglón diferente al anterior.
    Hacer los métodos necesarios en la clase usuario.
*/

include_once "Usuario.php";

$nombre = $_POST["nombre"];
$clave = $_POST["clave"];
$mail = $_POST["mail"];
$foto = $_FILES["foto"];

if ($nombre !== null && $clave !== null && $mail !== null)
{
    if ($foto !== null)
    {
        $usuarioNuevo = new Usuario($nombre, $clave, $mail, $foto);
    }
    else
    {
        $usuarioNuevo = new Usuario($nombre, $clave, $mail);
    }

    $arrayUsuarios = array();

    //$arrayUsuarios = Usuario::LeerUsuariosJson("usuarios.json");


    




    array_push($arrayUsuarios, $usuarioNuevo);  
    
    
    echo "<br><br><br>";
    //var_dump($arrayUsuarios);
    echo "<br><br><br>";
    // var_dump($ruta);
    echo "<br><br><br>";

    if(Usuario::GuardarUsuariosJson($arrayUsuarios))
    {
        echo "Se guardaron los usuarios.<br><br>";
    }
    else
    {
        echo "No se pudieron guardar los usuarios.<br><br>";
    }    
}
else
{
    echo "Los valores son inválidos, verifique e intente nuevamente.<br><br>";
}

?>