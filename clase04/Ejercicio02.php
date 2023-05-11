<?php   

/*

    Archivo: listado.php
    método:GET
    Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,etc.),por ahora solo tenemos
    usuarios).
    En el caso de usuarios carga los datos del archivo usuarios.json.
    se deben cargar los datos en un array de usuarios.
    Retorna los datos que contiene ese array en una lista.
    Hacer los métodos necesarios en la clase usuario

*/

    include_once "Usuario.php";

    $listado = $_GET["listado"];

    $array = array();

    switch ($listado) {
        case 'usuarios':
            $array = Usuario::LeerUsuariosJson("usuarios.json");

            foreach ($array as $usuario)
            {
                $usuario->MostrarUsuarioEnListaHTML();
            }
            break;
        
        default:
        echo "Entrada no válida";
            break;
    }
?>