<?php   

    /*
        Archivo: altaProducto.php
        método:POST
        Recibe los datos del producto(código de barra (6 cifras ),nombre ,tipo, stock, precio )por POST ,
        crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un objeto y
        utilizar sus métodos para poder verificar si es un producto existente, si ya existe el producto se le
        suma el stock , de lo contrario se agrega al documento en un nuevo renglón
        Retorna un :
        “Ingresado” si es un producto nuevo
        “Actualizado” si ya existía y se actualiza el stock.
        “no se pudo hacer“si no se pudo hacer
        Hacer los métodos necesarios en la clase
    */

    include_once "Producto.php";

    $codigoBarras = $_POST["codigoBarras"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];

    $arrayProductos = array();

    if (Producto::LeerProductosJson("productos.json")!= null)
    {
        $arrayProductos = Producto::LeerProductosJson("productos.json");
    }

    if ($codigoBarras !== null && $nombre !== null && $tipo !== null && $stock !== null && $precio !== null)
    {
        $existe = Producto::ProductoExiste($codigoBarras, $arrayProductos);

        if ($existe!==false)
        {
            $arrayProductos[$existe]->AgregarStock($stock);
            
            echo "Producto existente, se agregó el stock ingresado.";
        }
        else
        {
            $nuevoProducto = new Producto($codigoBarras,$nombre,$tipo,$stock,$precio);

            array_push($arrayProductos, $nuevoProducto); 
        }

        if(Producto::GuardarProductosJson($arrayProductos))
        {
            echo "Se guardaron los productos.<br><br>";
        }
        else
        {
            echo "No se pudieron guardar los productos.<br><br>";
        }   
    }
    else
    {
        echo "Los valores son inválidos, verifique e intente nuevamente.<br><br>";
    }

    foreach ($arrayProductos as $producto)
    {
        $producto->MostrarProductoEnListaHTML();
    } 

?>