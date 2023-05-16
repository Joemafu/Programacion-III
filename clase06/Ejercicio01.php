<?php

    /*

        Archivo: registro.php
        método:POST
        Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST , crear
        un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
        guardando los datos la base de datos retorna si se pudo agregar o no.

    */

    include_once "Usuario.php";

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $localidad = $_POST["localidad"];


    if ($nombre !== null && $apellido !== null && $clave !== null && $mail !== null && $localidad !== null)
    {
        $arrayUsuarios = array();

        $usuarioNuevo = new Usuario($nombre, $apellido, $clave, $mail, $localidad);

        array_push($arrayUsuarios, $usuarioNuevo);

        $usuarioNuevo->EscribirUsuarioEnDB();
    }
    else
    {
        echo "Los valores son inválidos, verifique e intente nuevamente.<br><br>";
    }
?>