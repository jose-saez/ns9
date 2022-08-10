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
	<title>Ejemplos de botones</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.24" />
</head>

<body>
<!-- Cabecera -->
<h1>Ejemplo de una página con botones</h1>

<hr>
<!-- ---------------------------------------------------------------- -->
<!-- BOTONES DE ACCIÓN -->
<!-- ---------------------------------------------------------------- -->
<form action=pag1.php method=post>
<input type=hidden name="param1" value="1">
<input type=hidden name="param2" value="2">

<!-- ---------------------------------------------------------------- -->
<p>Botones con etiqueta "button" (SÍ aceptan HTML + imágenes)</p>
<button>Botón0 <a href="pag2.php">con un enlace</a> (no Firefox33, no IE8, no Opera12, sí Chrome39)</button>
<br>

<button name='submit1' type='submit'>
<img src='../../iconos/Add.png' height=30> <br>
Botón1 (<strong>submit</strong>) con <strong>HTML</strong> en el form
<br>Sin acción onclick
</button>

<button onclick="alert('botón2 en el form')">
<img src='../../iconos/Book.png' height=30><br>
Botón2 <strong>con HTML</strong> en el form
<br>Con acción onclick (alert)
</button>

<button disabled='disabled'>
<img src='../../iconos/Address-Book.png' height=30><br>
Botón3 <strong>con HTML</strong> (disabled)
</button>

<button name='submit2' type='submit' onclick='confirm("¿Seguro que desea enviar el formulario?")'>
<img src='../../iconos/Alert.png' height=30> <br>
Botón4 (<strong>submit</strong>) con <strong>HTML</strong> en el form
<br>Confirma antes de hacer submit
</button>

<!-- ---------------------------------------------------------------- -->
<p>Botones con etiqueta "input" (NO aceptan HTML)</p>
<input type='button' value='Botón <strong>Input</strong> 1'>
<input type='button' value='Botón Input 2' onclick="alert('botónInput2 en el form')">

<!-- ---------------------------------------------------------------- -->
<!-- PARÁMETROS PARA LAS ACCIONES -->
<!-- ---------------------------------------------------------------- -->
<p></p>Introduce algo de texto: <input type='text' name='texto1'>
<p></p>Y aquí otro texto: <input type='date' name='texto2'>
</form>

<!-- ---------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------- -->

<hr>	
<hr>

<!-- ---------------------------------------------------------------- -->
<!-- PROCESAMIENTO -->
<!-- ---------------------------------------------------------------- -->
<?php
if (isset($_POST['submit1'])) {
	$dato1 = $_POST['param1'];
	$dato2 = $_POST['param2'];
	$texto1 = $_POST['texto1'];
	$texto2 = $_POST['texto2'];
	$resultados = "submit1 pulsado...datos: $dato1 $dato2 [$texto1] [$texto2]";
} elseif (isset($_POST['submit2'])) {
	$dato1 = $_POST['param1'];
	$dato2 = $_POST['param2'];
	$texto1 = $_POST['texto1'];
	$texto2 = $_POST['texto2'];
	$resultados = "submit2 pulsado...datos: $dato1 $dato2 [$texto1] [$texto2]";
} else {
	$resultados = "entrada normal...";
}
?>

<!-- ---------------------------------------------------------------- -->
<!-- PRESENTACIÓN - ZONA DE DATOS -->
<!-- ---------------------------------------------------------------- -->
<h1>Resultados de las acciones</h1>
<div id='resultados'>
<?php
	echo $resultados;
?>
</div>


<!-- Pie -->
<hr>
<h3>(c) 2014, autor </h3>

</body>

<?php
//----------------------------------------------------------------

?>	
</html>
