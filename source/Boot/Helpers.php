<?php

/**
 *
 * ################
 * ###   DATE   ###
 * ################
  */

/**
 *
 * @param $data
 * @return false|string
 */
function formatarDateTime($data)
{
    return date("Y-m-d H:i:s", strtotime( str_replace("/", "-", $data) ) );
}

/**
 * @param $data
 * @param bool $mostrarSegundos
 * @param bool $possuiSeparador
 * @param string $separador
 * @return false|string
 */
function formatarMoment($data, $mostrarSegundos = true,
 $possuiSeparador = false, $separador = "")
{
    $format = "d/m/Y" . ($possuiSeparador ?
     " $separador " : " ") . "H:i" . ($mostrarSegundos ? ":s" : "");
    return $data ? date($format, strtotime( str_replace("/", "-", $data) ) ) :
         $data;
}


/**
 * #################
 * ### MONETARY ####
 * #################
 */
/**
 * @param $valor
 * @return float
 */
function formatarDecimal($valor): float
{
    return (float) str_replace(",", ".", str_replace(".", "", $valor));
}

/**
 * @param $valor
 * @return string
 */
function formatarMoney($valor): string
{
    return !is_null($valor) ? number_format($valor, 2, ",", ".") : $valor;
}


/**
 * ################
 * ###   DTAX   ###
 * ################
 */

/**
 * @param $total
 * @param $perc
 * @return float|int
 */
function Percentage($total, $perc)
{
    try {
        return ($total * $perc) / 100;
    } catch (\Exception $e) {
        return 0;
    }
}
