<?php

    Class Producto
    {
        private $_codigoBarras;
        private $_nombre;
        private $_tipo;
        private $_stock;
        private $_precio;
        private $_id;

        public function __construct($codigoBarras, $nombre, $tipo, $stock, $precio, $id = null)
        {
            $this->_codigoBarras=$codigoBarras;
            $this->_nombre=$nombre;
            $this->_tipo=$tipo;
            $this->_stock=$stock;
            $this->_precio=$precio;
            
            $this->_id = Producto::asignarID($id);
        }

        public static function AsignarID($id)
        {
            $return = $id;

            if ($id==null)
            {
                if (file_exists("lastIDProducto.txt"))
                {
                    $archivo = fopen ("lastIDProducto.txt","r");
                    $return = fgets($archivo)+1;
                    fclose($archivo);
                }
                else
                {
                    $return = rand(1,10000);
                }        

                $archivo = fopen ("lastIDProducto.txt","w");
                fputs($archivo,$return);
                fclose($archivo);
            }       

            return $return;
        }

        public static function GuardarProductosJson($arrayProductos)
        {
            $return = false;
            $productosJSON="";

            for ($i=0; $i< count($arrayProductos);$i++)
            {
                $aux = json_encode(
                    [
                        "_codigoBarras" => $arrayProductos[$i]->_codigoBarras, 
                        "_nombre" => $arrayProductos[$i]->_nombre,
                        "_tipo" => $arrayProductos[$i]->_tipo,
                        "_stock" => $arrayProductos[$i]->_stock,
                        "_precio" => $arrayProductos[$i]->_precio,
                        "_id" => $arrayProductos[$i]->_id            
                    ]);

                $productosJSON = $productosJSON.$aux;
                if($i+1!=count($arrayProductos))
                {
                    $productosJSON = $productosJSON.",\n";
                }
            }


            if(file_put_contents("productos.json", "[".$productosJSON."]")!==false)
            {
                $return = true;
            }
            return $return;
        }

        public static function LeerProductosJson($ruta)
        {
            $arrayObjetos = array();
            $arrayProductos = array();
            $contenidoJson = file_get_contents($ruta);
            $arrayObjetos = json_decode($contenidoJson);
            $nuevoProducto = null;

            if($arrayObjetos!=null)
            {
                foreach ($arrayObjetos as $producto)
                {
                    $nuevoProducto = new Producto($producto->_codigoBarras,$producto->_nombre,$producto->_tipo,$producto->_stock,$producto->_precio,$producto->_id);
                    array_push($arrayProductos, $nuevoProducto);
                }
            }       

            return $arrayProductos;
        }

        public static function ProductoExiste($codigoBarras, $arrayProductos)
        {
            $return = false;

            for ($i = 0; $i<count($arrayProductos); $i++)
            {
                if($arrayProductos[$i]->_codigoBarras==$codigoBarras)
                {
                    $return = $i;
                    break;
                }
            }

            return $return;
        }

        public function MostrarProductoEnListaHTML()
        {
            echo "<ul>";
            echo "<li>";
            echo "Nombre: $this->_nombre<br>";
            echo "</li>";
            echo "<li>";
            echo "Tipo: $this->_tipo<br>";
            echo "</li>";
            echo "<li>";
            echo "Stock: $this->_stock<br>";
            echo "</li>";
            echo "<li>";
            echo "Precio: $this->_precio<br>";
            echo "</li>";
            echo "<li>";
            echo "Codigo de Barras: $this->_codigoBarras<br>";
            echo "</li>";
            echo "<li>";
            echo "ID: $this->_id<br>";
            echo "</li>";
            echo "</ul>";
        } 

        public function AgregarStock($stock)
        {
            $this->_stock+=$stock;
        }

        public function RestarStock($stock)
        {
            $return = false;
            if($this->_stock>=$stock)
            {
                $this->_stock-=$stock;
                $return=true;
            }
            return $return;
        }
        
    }
?>