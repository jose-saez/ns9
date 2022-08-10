<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
        <meta name="author" content="jsm52l">
	<meta charset="utf-8">
	<title>MiOfU</title>
	<link rel="stylesheet" href="../jquery/development-bundle/themes/base/jquery.ui.all.css">
	<script src="../jquery/development-bundle/jquery-1.5.1.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.tabs.js"></script>
	<script src="ld.js"></script>
	<script src="../scripts/ConstructorXMLHttpRequest.js"></script>
	<script>
	$(function() {
		$( "#tabs" ).tabs({
			ajaxOptions: {
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. " +
						"If this wouldn't be a demo." );
				}
			}
		});
	});
	</script>
</head>

    <body>
<h1>OFU</h1>
<a href="ofu.php">Nueva</a>
<p></p>
<?php
echo "b\120r\157c t\145\170t\157";
echo "<br>";
echo "\110\x6f\154\x61\40\x6d\165\x6e\144\x6f\41";
//exit;
/*
iconv_set_encoding("internal_encoding", "UTF-8");
iconv_set_encoding("input_encoding", "UTF-8");
iconv_set_encoding("output_encoding", "UTF-8");
*/
echo "<br>";

//if (isset($_POST["\x62\120\x72\x6f\143"])) {echo "<\x68\162\76";$c = $_POST["\164e\170\x74\x6f"];echo "\x3c\x66o\x72m>". 'Original<br><textarea rows="10" cols="80">' . $c . "<\57te\170\164a\162\x65\x61\x3e\x3cb\162\x3e". "<\x2f\x66or\x6d\x3e";echo "<\x68\162\76";$p = new ProcesadorBloque();$d = $p->procesar($c);echo "\x3c\x66o\x72m>". 'Procesado<br><textarea id="texto" name="texto" rows="10" cols="80">' . $d . "\74\57\x74\145\x78tar\145\x61\x3e". "<\x2f\x66or\x6d\x3e";exit;}
//echo "adiós"; exit;

if (isset($_POST['bProc'])) {
	echo "<hr>";
	$c = $_POST['texto'];
	echo '<form>'
		. 'Original<br><textarea rows="10" cols="80">' . $c . '</textarea><br>'
		. '</form>'
		;
	echo "<hr>";
	$p = new ProcesadorBloque();
	$d = $p->procesar($c);
	echo '<form>'
		. 'Procesado<br><textarea id="texto" name="texto" rows="10" cols="80">' . $d . '</textarea>'
		. '</form>'
		;
	exit;
}

class ProcesadorBloque {
	var $resultado = "";
	
//-------------------------------------------------------------
function procesar($c) {
	$this->resultado = $c;
	$arr_tokens = array(" \n\t\r", "+-*", ";,()[]");
	$tokens = implode("", $arr_tokens);
	//echo "<pre>tokens[$tokens]</pre>";
	$tok = strtok($c, $tokens);
	while ($tok !== false) {
		$tok = $this->limpiar_token($tok);
		if ($tok == "\"<pre>\"") {
			//exit("es pre");
		}
		$this->procesar_token($tok);
		$tok = strtok($tokens);
	}
	//$this->resultado = str_replace(" ", "", $this->resultado);
	$this->resultado = str_replace("\n", "", $this->resultado);
	$this->resultado = str_replace("\r", "", $this->resultado);
	$this->resultado = str_replace("\t", "", $this->resultado);
	return $this->resultado;
	//echo "</pre>";
}

//-------------------------------------------------------------
function limpiar_token($tok) {
	$tok = trim($tok);
	$largo = strlen($tok);
	if ($largo > 1) {
		if (($tok[0] == "\"") and ($tok[1] == "<")) {
			//$tok = str_replace("<", "_", $tok);
			//$tok = str_replace(">", "_", $tok);
			//exit("limpiando $tok");
		}
	}
	return $tok;
}

//-------------------------------------------------------------
function procesar_token($tok) {
	$categ_token = $this->clasificar_token($tok);
	$tt = str_replace("<", "_*", $tok);
	$tt = str_replace(">", "*_", $tt);
	echo "$categ_token [" .  $tt . "]<br />\n";
}

//-------------------------------------------------------------
function clasificar_token($tok) {
	if ($this->es_funcion_php($tok))  	{
		return "FUNC";
	}
	if ($this->es_palclave_php($tok)) 	{
		return "PALCLAVE";
	}
	if ($this->es_blanco($tok))       	{
		return "BLANCO";
	}
	if ($this->es_cadena($tok))       	{
		$this->codificar($tok, "CAD");
		return "CAD";
	}
	if ($this->es_variable_especial($tok)) {
		return "VAR_ESPECIAL";
	}
	if ($this->es_variable($tok))     	{
		return "VAR";
	}
	return "OTRO";
}

//-------------------------------------------------------------
function codificar_cadena($s) {
	//$sc = md5($s);
	$sc = "\"";
	for ($i=1; $i<strlen($s)-1; $i++) {
		$acc = rand(0,2);
		if ($acc == 0) {
			$sc .= "\\" . decoct(ord($s[$i]));
		} elseif ($acc == 1) {
			$sc .= "\\x" . dechex(ord($s[$i]));
		} else {
			$sc .= $s[$i];
		}
	}
	$sc .= "\"";
	echo "codificando [$s][$sc]";
	return $sc;
}

//-------------------------------------------------------------
function codificar($tok, $categ_token) {
	if ($categ_token == "CAD") {
		$codi = $this->codificar_cadena($tok);
		$this->resultado = str_replace($tok, $codi, $this->resultado);
	}
}

//-------------------------------------------------------------
function es_variable_especial($tok) {
	$arr_vars_especiales = array(
		"\$_POST"
	);
	if (($tok[0] == "$") and ($tok[0] == "$")) {
		if (in_array($tok, $arr_vars_especiales)) {
			return true;
		}
	}
	return false;
}

//-------------------------------------------------------------
function es_variable($tok) {
	if (($tok[0] == "$") and ($tok[0] == "$")) {
		return true;
	}
	return false;
}

//-------------------------------------------------------------
function es_cadena($tok) {
	$largo = strlen($tok);
	if (($tok[0] == "'") and ($tok[$largo-1] == "'")) {
		return true;
	}
	if (($tok[0] == '"') and ($tok[$largo-1] == '"')) {
		return true;
	}
	return false;
}

//-------------------------------------------------------------
function es_funcion_php($tok) {
	$arr_funciones_php = array(
		"isset"
		, "new"
	);
	if (in_array($tok, $arr_funciones_php)) {
		return true;
	}
	return false;
}

//-------------------------------------------------------------
function es_palclave_php($tok) {
	$arr_palclave_php = array(
		"echo"
		, "if"
	);
	if (in_array($tok, $arr_palclave_php)) {
		return true;
	}
	return false;
}
//-------------------------------------------------------------
function es_blanco($tok) {
	$arr_blancos = array(" ", "\n", "\t");
	if (in_array($tok, $arr_blancos)) { return true; }
	return false;
}

} //class

?>
<form action="ofu.php" method="post">
    Opción<textarea id="opcion" name="opcion" rows="1" cols="5"></textarea><br>
    <textarea id="texto" name="texto" rows="8" cols="80">texto</textarea>
<input type="submit" id="bProc" name="bProc" value="Procesar">
</form>
<br>
<textarea id="resultado" name="resultado" rows="4" cols="80">hola</textarea><br>
<textarea id="mensajes" name="mensajes" rows="4" cols="80">mensajes</textarea>
<div class="demo">

<div id="tabs">
	<ul>
		<li id="rresul">Resultado</li>
		<li><a href="ldcod.php">Codificado</a></li>
		<li><a href="#tabs-1">Preloaded</a></li>
		<li><a href="content1.html">Tab 1</a></li>
		<li><a href="content2.html">Tab 2</a></li>
		<li><a href="content3-slow.php">Tab 3 (slow)</a></li>
		<li><a href="content4-broken.php">Tab 4 (broken)</a></li>
	</ul>
	<div id="tabs-1">
		<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
	</div>
</div>

</div><!-- End demo -->

	
              		
    </body>
</html>
