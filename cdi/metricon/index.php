<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?
require_once "Metricon.php";
require_once "Tableador.php";

	go("../../cisne.des");
	go("../../cisne");
	go("../metricon");
	go("../../cisne.des/bbclone");
	
//-------------------------------------------------------------
function go($path) {
	echo "<h1>Analizando $path</h1>\n";
	$arr_excluir = array("jquery.js"
						 , "bbclone"	//carpeta
						 , "calendar"	//carpeta
						 , "jquery"		//carpeta
						 , "lang"		//carpeta
						 , "libs"		//carpeta
						 );
	$arr_extensiones_validas = array('.htaccess', 'css', 'htm', 'html', 'js', 'php');
	$m = new Metricon();
	$m->init($path, $arr_excluir, $arr_extensiones_validas);
	
	$m->analizar($metodo=1);
	$tabla = $m->resul_basico();
	echo $tabla;
	
	//$m->analizar($metodo=2);
	//$tabla = $m->resul_basico();
	//echo "<h1>Análisis método 2</h1>" . $tabla;
}
?> 
</body>
</html>