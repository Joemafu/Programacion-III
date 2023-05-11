<?php   

    /*

        Archivo: RealizarVenta.php
        método:POST
        Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
        POST .
        Verificar que el usuario y el producto exista y tenga stock.
        crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). carga
        los datos necesarios para guardar la venta en un nuevo renglón.
        Retorna un :
        “venta realizada”Se hizo una venta
        “no se pudo hacer“si no se pudo hacer
        Hacer los métodos necesaris en las clases

    */

    include_once "Usuario.php";
    include_once "Producto.php";

    $codigoBarrasProdcto = $_POST["codigoBarrasProdcto"];
    $idUsuario = $_POST["idUsuario"];
    $stock = $_POST["stock"];


    $arrayUsuarios = array();

    if (Usuario::LeerUsuariosJson("usuarios.json")!= null)
    {
        $arrayUsuarios = Usuario::LeerUsuariosJson("usuarios.json");
    }

    $arrayProductos = array();

    if (Producto::LeerProductosJson("productos.json")!= null)
    {
        $arrayProductos = Producto::LeerProductosJson("productos.json");
    }

    $productoValido = Producto::ProductoExiste($codigoBarrasProdcto,$arrayProductos);

    if(Usuario::UsuarioExiste($idUsuario,$arrayUsuarios)!=false)
    {
        if($productoValido !== false)
        {
            if($arrayProductos[$productoValido]->RestarStock($stock))
            {
                if(Producto::GuardarProductosJson($arrayProductos))
                {
                    echo "Se actualizó el stock disponible.";
                }
            }
            else{
                echo "Stock insuficiente.";
            }
        }
        else
        {
            echo "El código de barras provisto no es válido.";
        }
    }
    else
    {
        echo "El id de usuario provisto no existe.";
    }
?>