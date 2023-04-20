<?php

/*
    Archivo: listado.php
    método:GET
    Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
    usuarios).
    En el caso de usuarios carga los datos del archivo usuarios.csv.
    se deben cargar los datos en un array de usuarios.
    Retorna los datos que contiene ese array en una lista

    <ul>
        <li>Coffee</li>
        <li>Tea</li>
        <li>Milk</li>
    </ul>

    Hacer los métodos necesarios en la clase usuario
*/
include_once "Usuario.php";

$listadoSolicitado = $_GET["listado"];

$path = $listadoSolicitado.".csv";

$arrayUsuarios = Usuario::LeerusuariosCSV($path);

foreach ($arrayUsuarios as $usuario)
{
    $usuario->MostrarUsuarioEnListaHTML();
}
?>