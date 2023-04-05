<?php

    /*

        Aplicación No 4 (Auto - Garage)
        Crear la clase Garage que posea como atributos privados:

            _razonSocial (String)
            _precioPorHora (Double)
            _autos (Autos[], reutilizar la clase Auto del ejercicio anterior)

        Realizar un constructor capaz de poder instanciar objetos pasándole como

        parámetros: 
            i. La razón social.
            ii. La razón social, y el precio por hora.

        Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
        que mostrará todos los atributos del objeto.

        Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
        objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.

        Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
        (sólo si el auto no está en el garaje, de lo contrario informarlo).

        Ejemplo: $miGarage->Add($autoUno);

        Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
        “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
        $miGarage->Remove($autoUno);

    */
    require_once("Auto.php");

    class garage 
    {
        public $_razonSocial;
        public $_precioPorHora;
        public $_autos;

        public function __construct($razonSocial, $precioPorHora = 0)
        {
            $this->_razonSocial=$razonSocial;
            $this->_precioPorHora=$precioPorHora;
            $this->_autos = array();
        }

        public function MostrarGarage()
        {
            echo "Razón Social: ", $this->_razonSocial, "<br>";
            echo "Precio por hora: ", $this->_precioPorHora, "<br>";
            $contador=1;

            foreach($this->_autos as $auto)
            {
                echo "Auto Nº", $contador, "<br>";
                Auto::MostrarAuto($auto);
                $contador++;
            }
        }

        public function Equals($auto)
        {
            $ret = false;
            foreach ($this->_autos as $autoEnGarage)
            {
                if ($autoEnGarage->Equals($auto))
                {
                    $ret=true;
                    break;
                }
            }

            return $ret;
        }

        public function Add($auto)
        {
            if (!$this->Equals($auto))
            {
                array_push ($this->_autos, $auto);
                echo ("El auto fue agregado al garage<br><br>");
            }
            else 
            {
                echo ("El auto ya está en el garage<br><br>");
            }
        }

        public function Remove($auto)
        {
            $ret = false;
            if ($this->Equals($auto))
            {
                for($i=0; $i<count($this->_autos);$i++)
                {
                    if ($this->_autos[$i]->Equals($auto))
                    {
                        unset($this->_autos[$i]);
                        echo "Auto eliminado.<br><br>";
                        $ret = true;
                        break;
                    }
                }
            }
            return $ret;
        }
    }
?>