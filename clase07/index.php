<?php

/*
    Se debe realizar una aplicación para dar de ingreso con imagen del item.
    Se deben respetar los nombres de los archivos y de las clases.
    Se debe crear una clase en PHP por cada entidad y los archivos PHP solo deben llamar a métodos de las clases.
*/
/*
    1era parte

    1-
    A- (1 pt.) index.php:Recibe todas las peticiones que realiza el postman, y administra a que archivo se debe incluir.
*/
/*
    B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
    guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
    identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
*/
/*
    2-
    (1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
    retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.
*/
/*
    2da parte

    3-
    a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
    Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
    debe descontar la cantidad vendida del stock .
*/
/*
    b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
    el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.
*/
/*
    3era parte

    4- (3 pts.)ConsultasVentas.php: necesito saber :
    a- la cantidad de pizzas vendidas
    b- el listado de ventas entre dos fechas ordenado por sabor.
    c- el listado de ventas de un usuario ingresado
    d- el listado de ventas de un sabor ingresado
*/
/*
    4ta parte
    5- (2 pts.)PizzaCarga.php:.(continuación) Cambio de get a post.
    completar el alta con imagen de la pizza, guardando la imagen con el tipo y el sabor como nombre en la carpeta
    /ImagenesDePizzas.
*/
/*
    6- (2 pts.) ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el sabor,tipo y
    cantidad, si existe se modifica , de lo contrario informar.
*/
/*
    7- (2 pts.) borrarVenta.php(por DELETE), debe recibir un número de pedido,se borra la venta y la foto se mueve a
    la carpeta /BACKUPVENTAS
*/
/*

    Código Obsoleto, copiado y pegado que no tenga utilidad (-1 punto).

    Se pueden bajar templetes de internet o traer código hecho, pero en ningún caso se debe incluir código obsoleto o que no
    cumpla ninguna función dentro del parcial.
    Se tiene que sumar 8 puntos para lograr un cuatro (4).
    Nueve puntos equivalen a un cinco (5),
    Diez puntos equivalen a seis (6),
    Once puntos: siete (7),
    Doce puntos a un ocho (8),
    Trece puntos equivale a un nueve (9)
    Y si se suman los catorce puntos la nota será de diez (10).

*/
    
    $metodoRequest = $_SERVER['REQUEST_METHOD'];

    switch ($metodoRequest) 
    {
        case 'GET':
        {
            if (isset($_GET['consultaVenta'])) 
            {
                include_once "ConsultarVentas.php";
            }
            else
            {            
                echo "Error: Faltan datos para realizar la operación.";
            }
            break;
        }
        case 'POST':
        {            
            if (isset($_POST['sabor']) && isset($_POST['tipo'])) 
            {
                if (isset($_POST['mail']) && isset($_POST['cantidad']))
                {
                    include_once "AltaVenta.php";
                }
                else if (isset($_POST['cantidad']) && isset($_POST['precio']) && isset($_FILES['foto']))
                {
                    include_once "PizzaCarga.php";
                }
                else
                {
                    include_once "PizzaConsultar.php";
                }
            }
            else
            {            
                echo "Error: Faltan datos para realizar la operación.";
            }
            
            break;
        }  
        case 'PUT':
        {
            parse_str(file_get_contents("php://input"),$put_vars);

            if (isset($put_vars['nroPedido']) && isset($put_vars['sabor']) && isset($put_vars['mail']) && isset($put_vars['tipo']) && isset($put_vars['cantidad']))
            {
                include_once "ModificarVenta.php";
            }
            else
            {            
                echo "Error: Faltan datos para realizar la operación.";
            }
            break;
        }
        case "DELETE":
        {
            parse_str(file_get_contents("php://input"),$put_vars);
            if (isset($put_vars['nroPedido'])) 
            {
                include_once "BorrarVenta.php";
            }
            else
            {            
                echo "Error: Faltan datos para realizar la operación.";
            }
            break;
        }
        default:{
            
            break;
        }        
    }
?>