<?php
//--------------------------------------------------------------
// CLASE DE UTILIDADES DE FORMATO
//--------------------------------------------------------------
class Util_Formato {
//--------------------------------------------------------------
//convierte una fecha en formato TS a formato dd-mm-yyyy para imprimir
function ff($fecha) {
	//echo "fecha1=[$fecha]"; 
	if (strlen($fecha) == 19) {
		$sufijo = substr($fecha, 11, 8);
		if ($sufijo == "00:00:00") { //es una fecha con hora = 00:00:00
			$fsal = substr($fecha, 8, 2) . "/" . substr($fecha, 5, 2) . "/" . substr($fecha, 0, 4);
			return $fsal;
		}
	}
	if ($fecha == "") { return "*"; } else { return date("d/m/Y H:i:s", $fecha); }
}

//----------------------------------------------------
//formatea un número
function fn($numero) { return number_format($numero, 2, ",", "."); }
function fni($numero) { return number_format($numero, 0, ",", "."); }

} //class Util_Formato
?>