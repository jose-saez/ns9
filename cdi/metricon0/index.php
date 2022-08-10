<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php
	$path = "../../rips";
	$total_ficheros = analizar_directorio($path);
	echo "Hay $total_ficheros ficheros en el directorio $path<br>";
	
//-------------------------------------------------------------	
function analizar_directorio($path) {
	$total_ficheros = 0;
    $dir = opendir($path);
    while ($elemento = readdir($dir)){
        if( $elemento != "." && $elemento != ".."){
            // Si es una carpeta
            if( is_dir($path."/".$elemento) ){
                // Muestro la carpeta
                echo("Procesando subdirectorio: ". $elemento . "<br>");
				$total_ficheros += analizar_directorio($path."/".$elemento);
            // Si es un fichero
            } else {
				$total_ficheros++;
            }
        }
    }
	return $total_ficheros;
}

?>