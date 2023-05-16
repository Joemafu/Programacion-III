<?php

    /*

        Archivo: listado.php
        método:GET
        Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
        cada objeto o clase tendrán los métodos para responder a la petición
        devolviendo un listado en JSON

    */

    include_once "AccesoDatos.php";
    include_once "Usuario.php";

    $listado = $_GET["listado"];

    if ($listado === "usuarios")
    {
        $objetoAcceso = AccesoDatos::dameUnObjetoAcceso();

        $arrayUsuarios = array();

        $arrayUsuarios = Usuario::LeerUsuariosDB();

        echo Usuario::GuardarUsuariosJson($arrayUsuarios);
    }
?>