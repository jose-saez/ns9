<?php
/*
 * pag1.php
 * 
 * Copyright 2014 Administrador <Administrador@120SMX>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Ejemplo de Barra de Estado</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.24" />
</head>

<body>
<!-- Cabecera -->
<h1>Ejemplo de una página con botones y barra de estado</h1>

<!-- los mensajes aparecerán debajo de la cabecera -->
<h2 id='barra_estado'>Aquí irán los mensajes de estado</h2>

<!-- Botones de acción -->
<?php 
	$param1 = 1; $param2 = 2; //estos parámetros se pueden recoger por POST, por ejemplo
	echo get_barra_botones($param1, $param2); 
?>
<hr>

<!-- Zona de datos -->
<h1>Datos / Resultados de las acciones</h1>
<div id='resultados'></div>

<!-- Pie -->
<hr>
<h3>(c) 2014, autor </h3>

</body>

<?php
//----------------------------------------------------------------
function get_barra_botones($param1, $param2) {
	$res = "<form action=pag1.php method=post>";
	$res.= "   <input type=hidden name=\"param1\" value=" . $param1 . "> ";
	$res.= "   <input type=hidden name=\"param2\" value=" . $param2 . "> ";
	$res.= "</form>";
	$res.= "<button onclick=\"Accion1('hola', $param1, $param2)\">Acción1 (hola)</button>";
	$res.= "<button onclick=\"Accion2('adiós', $param1, $param2)\">Acción2 (adiós)</button>";
	$res.= "<button onclick=\"alert('mensaje')\">Acción3 (mensaje)</button>";
	return $res;
}

?>	
</html>
