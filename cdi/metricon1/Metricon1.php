<?php
require_once "Util_Formato.php";

define("METODO1", 1);
define("METODO2", 2);

class Metricon1 {
var
	$ruta							//directorio a analizar, sin la barra final /
	, $fechahora_ini    			//fecha y hora del último análisis, inicio
	, $fechahora_fin    			//fecha y hora del último análisis, fin
	, $total_lineas = 0				//núm total de líneas de los ficheros en el directorio
	, $total_ficheros = 0			//total de ficheros contenidos en el directorio
	, $media_lineas_fichero = 0     //número medio de líneas por fichero
	, $fichero_mas_largo            //nombre del fichero más largo
	, $lineas_fichero_mas_largo = 0 //líneas que tiene el fichero más largo
	, $fichero_mas_corto            //nombre del fichero más corto
	, $lineas_fichero_mas_corto = PHP_INT_MAX //cuántas líneas tiene el fichero con menos líneas
	;

//-------------------------------------------------------------
function Metricon1($path) {
	$this->ruta = $path;
	$this->reset();
}

//-------------------------------------------------------------
//inicializa todas las métricas
function reset() {
	$this->total_lineas = 0;
	$this->total_ficheros = 0;
	$this->media_lineas_fichero = 0;
}

//-------------------------------------------------------------
//analiza el directorio indicado
function analizar() {
	$this->reset();
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
                echo("<p><strong>CARPETA: ". $elemento ."</strong></p>");
				$this->analizar_directorio($path."/".$elemento);
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
	$num_lineas1 = $this->contabilizar_lineas_fichero($filename);
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
	echo(basename($filename) . ", Líneas: " . $num_lineas1 . " subtotal: " . $this->total_lineas);
}

//-------------------------------------------------------------
function contabilizar_lineas_fichero($filename) {
	$num_lineas = 0;
	$file = fopen($filename, "r");
	while (!feof($file)) {
		if ($linea = fgets($file)){
			//$this->clasificar_tipo_linea($linea);
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
			return;
		} else {
			//si no es nada de lo anterior, entonces es de código
			$this->lineas_de_codigo++;
		}
	}
}

//-------------------------------------------------------------
function resul_basico() {
}



} //class
?>