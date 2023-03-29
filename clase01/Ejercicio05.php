<?php

/*

    Aplicación No 5 (Números en letras)
    Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
    por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
    entre el 20 y el 60.
    Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.

*/
$aux;
$numeroEnLetras;

for ($num = 19; $num<62; $num = $num+1)
{
    $numeroEnLetras = "Debe ser un numero entre el 20 y el 60.";
    $aux = $num;
    if($num>19 && $num <61)
    {
        if ($num==20)
        {
            $numeroEnLetras="veinte";
        }
        else if ($num >20 && $num < 30)
        {
            $numeroEnLetras="veinti";
        }
        else if($num >29 && $num < 40)
        {
            $numeroEnLetras="treinta";
        }
        else if($num >39 && $num < 50)
        {
            $numeroEnLetras="cuarenta";
        }
        else if($num >49 && $num < 60)
        {
            $numeroEnLetras="cincuenta";
        }
        else if ($num == 60)
        {
            $numeroEnLetras="sesenta";
        }

        if($num>30 && $num % 10 != 0)
        {
            $numeroEnLetras.=" y ";
        }

        $aux = $num % 10;

        switch ($aux)
        {
            case 1:
                {
                    $numeroEnLetras .="uno";
                }
                break;
            case 2:
                {
                    $numeroEnLetras .= "dos";
                }
                break;
            case 3:
                {
                    $numeroEnLetras .= "tres";
                }
                break;
            case 4:
                {
                    $numeroEnLetras .= "cuatro";
                }
                break;
            case 5:
                {
                    $numeroEnLetras .= "cinco";
                }
                break;
            case 6:
                {
                    $numeroEnLetras .= "seis";
                }
                break;
            case 7:
                {
                    $numeroEnLetras .= "siete";
                }
                break;
            case 8:
                {
                    $numeroEnLetras .= "ocho";
                }
                break;
            case 9:
                {
                    $numeroEnLetras .= "nueve";
                }
                break;
        }
    }

    echo $num, " => ", $numeroEnLetras, "<br>";
}

?>