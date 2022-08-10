<?php
require_once "Util_Formato.php";

define("METODO1", 1);
define("METODO2", 2);

class Metricon {
var
	$ruta							//directorio a analizar, sin la barra final /
	, $fechahora_ini    			//fecha y hora del último análisis, inicio
	, $fechahora_fin    			//fecha y hora del último análisis, fin
	, $total_lineas = 0				//núm total de líneas de los ficheros en el directorio
	, $total_ficheros = 0			//total de ficheros contenidos en el directorio
	, $total_ficheros_analizados = 0 //los que tienen extensiones válidas
	, $total_ficheros_excluidos  = 0 //los que NO tienen extensiones válidas
	, $total_carpetas_excluidas = 0	//carpetas que no se analizarán
	, $media_lineas_fichero = 0     //número medio de líneas por fichero
	, $arr_excluir                  //array con nombre de ficheros a excluir
	, $arr_extensiones_validas      //array con nombre de ficheros a excluir
	, $fichero_mas_largo            //nombre del fichero más largo
	, $lineas_fichero_mas_largo = 0 //líneas que tiene el fichero más largo
	, $lineas_blancas = 0			//líneas en blanco
	, $lineas_de_codigo = 0			//líneas con código real
	, $lineas_de_comentario = 0		//líneas con comentarios
	, $fichero_mas_corto            //nombre del fichero más corto
	, $lineas_fichero_mas_corto = 999999 //cuántas líneas tiene el fichero con menos líneas
	
	, $metodo_analisis              //habrá distintos métodos de análisis
	//método 1: contar línea a línea
	//método 2: leer fichero en bloque (array) y usar "count"
	;

//-------------------------------------------------------------
function init($path, $excluir, $extensiones_validas) {
	$this->ruta = $path;
	$this->reset();
	$this->arr_excluir = $excluir;
	$this->arr_extensiones_validas = $extensiones_validas;
}

//-------------------------------------------------------------
//inicializa todas las métricas
function reset() {
	$this->total_lineas = 0;
	$this->total_ficheros = 0;
	$this->total_ficheros_analizados = 0;
	$this->total_ficheros_excluidos  = 0;
	$this->total_carpetas_excluidas = 0;
	$this->media_lineas_fichero = 0;
	$this->fichero_mas_largo = "";
	$this->lineas_fichero_mas_largo = 0;
	$this->fichero_mas_corto = "";
	$this->lineas_fichero_mas_corto = 999999;
}

//-------------------------------------------------------------
function mc($m) { //echo $m . "<br />";
}

//-------------------------------------------------------------
//analiza el directorio indicado
function analizar($metodo = METODO1) {
	$this->reset();
	$this->metodo_analisis = $metodo;
	$this->fechahora_ini = microtime(true);
	$this->analizar_directorio($this->ruta);
	$this->media_lineas_fichero = $this->total_lineas / $this->total_ficheros_analizados;
	$this->fechahora_fin = microtime(true);
}
	
//-------------------------------------------------------------
function analizar_directorio($path) {
    $dir = opendir($path);
    while ($elemento = readdir($dir)){
        // Tratar elementos . y .. 
        if( $elemento != "." && $elemento != ".."){
            // Si es una carpeta
            if( is_dir($path."/".$elemento) ){
                // Muestro la carpeta
                $this->mc("<p><strong>CARPETA: ". $elemento ."</strong></p>");
				if (in_array(basename($path."/".$elemento), $this->arr_excluir)) {
					$this->mc("Excluyendo carpeta " . $path."/".$elemento);
					$this->total_carpetas_excluidas++;
				} else {
					$this->analizar_directorio($path."/".$elemento);
				}
            // Si es un fichero
            } else {
                $this->analizar_fichero($path."/".$elemento) . "<br />";
				$this->total_ficheros++;
            }
        }
    }
}

//-------------------------------------------------------------
function analizar_fichero($filename) {
	$partes = explode(".", $filename); 
	$ext = end($partes);
	if (!in_array($ext, $this->arr_extensiones_validas)) {
		$this->mc("Excluyendo $filename (extensión no válida)");
		$this->total_ficheros_excluidos++;
		return;
	}
	if (in_array(basename($filename), $this->arr_excluir)) {
		$this->mc("Excluyendo $filename");
		$this->total_ficheros_excluidos++;
		return;
	}
	$num_lineas1 = $this->contabilizar_lineas_fichero($filename);
	//if ($this->metodo_analisis == METODO1) {
		//$num_lineas1 = $this->contar1($filename);
	//} else {
		//$num_lineas1 = $this->contar2($filename);
	//}
	if ($num_lineas1 > $this->lineas_fichero_mas_largo) {
		$this->lineas_fichero_mas_largo = $num_lineas1;
		$this->fichero_mas_largo = $filename;
	}
	if ($num_lineas1 < $this->lineas_fichero_mas_corto) {
		$this->lineas_fichero_mas_corto = $num_lineas1;
		$this->fichero_mas_corto = $filename;
	}
	$this->total_lineas += $num_lineas1;
	$this->total_ficheros_analizados++;
	$this->mc(basename($filename) . ", Líneas: " . $num_lineas1 . " subtotal: " . $this->total_lineas);
}

//-------------------------------------------------------------
function contabilizar_lineas_fichero($filename) {
	$num_lineas = 0;
	$file = fopen($filename, "r");
	while (!feof($file)) {
		if ($linea = fgets($file)){
			$this->clasificar_tipo_linea($linea);
			$num_lineas++;
		}
	}
	fclose($file);
	return $num_lineas;
	//echo "$filename COB [$this->lineas_de_codigo, $this->lineas_de_comentario, $this->lineas_blancas]";
}

//-------------------------------------------------------------
function clasificar_tipo_linea($linea) {
	//echo "clasificando [$linea] " . strlen(trim($linea)) . "<br>";
	if (strlen(trim($linea)) == 0) {
		$this->lineas_blancas++;
		return;
	} else {
		$doscar = substr($linea, 0, 2);
		if (($doscar == "//") or ($doscar == "/*") or ($doscar == "*/")) {
			$this->lineas_de_comentario++;
			$this->mc("comen [$linea]<br>");
			return;
		} else {
			//si no es nada de lo anterior, entonces es de código
			$this->lineas_de_codigo++;
		}
	}
}


//-------------------------------------------------------------
function contar1($filename) {
	$file = fopen($filename, "r");
	$num_lineas = 0;
	while (!feof($file)) {
		if ($line = fgets($file)){
		   $num_lineas++;
		}
	}
	fclose($file);
	return $num_lineas;
}

//-------------------------------------------------------------
function contar2($filename) {
	$num_lineas = count(file($filename));
	return $num_lineas;
}

//-------------------------------------------------------------
function resul_basico() {
	$u = new Util_Formato();
	$cabs = array("dir"
				  , "inicio", "fin", "duracion"
				  , "ficheros", "analizados", "excluidos"
				  , "lineas", "de código", "comentarios", "en blanco"
				  , "líneas/fichero", "fich. más largo", "lineas más largo"
				  , "fich. más corto", "lineas más corto");
	$tiempo_total = round($this->fechahora_fin - $this->fechahora_ini, 4);
	$d = array(basename($this->ruta), $u->ff($this->fechahora_ini)
			   , $u->ff($this->fechahora_fin)
			   , $tiempo_total
			   , $u->fni($this->total_ficheros)
			   , $u->fni($this->total_ficheros_analizados)
			   , $u->fni($this->total_ficheros_excluidos)
			   , $u->fni($this->total_lineas)
			   , $u->fni($this->lineas_de_codigo)
			   , $u->fni($this->lineas_de_comentario)
			   , $u->fni($this->lineas_blancas)
			   , $u->fni($this->media_lineas_fichero)
			   , $this->fichero_mas_largo
			   , $u->fni($this->lineas_fichero_mas_largo)
			   , $this->fichero_mas_corto
			   , $u->fni($this->lineas_fichero_mas_corto)
			   );
	$t = new Tableador($cabs);
	$tabla = $t->una_fila($d);
	return $tabla;
}



} //class
?>