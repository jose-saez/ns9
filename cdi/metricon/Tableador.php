<?php

class Tableador {
	var
		$cabeceras; //array con los títulos de las cabeceras
		
//-------------------------------------------------------------
function Tableador($cabeceras) {
	$this->cabeceras = $cabeceras;
}

//-------------------------------------------------------------
function una_fila($arr_datos) {
	$res = $this->h_table1de2($this->cabeceras, "border=1", "#f87820");
	$res .= $this->h_td_n($arr_datos);
	$res .= $this->h_table2de2();
	return $res;
}

//-------------------------------------------------------------
function h_table1de2($cabs, $atribs, $header_color) {
    $res = "<table $atribs><tr bgcolor=$header_color>";
	if (isset($cabs)) {
		foreach($cabs as $i => $value) {
			$res .= "<th>" . $value . "</th>"; 
		}
	}
    $res .= "</tr>";
    return $res;
}

//-------------------------------------------------------------
function h_table2de2() { return "</table>"; }

//-------------------------------------------------------------
function h_td_n($arr) {$n=count($arr); $res=""; for($i=0; $i<$n; $i++) { $res.="<td>".$arr[$i]."</td>"; } return $res; }

} //class
?>