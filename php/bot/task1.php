<?php 
// tarea programada que comprueba la condición del equipo y la reporta por Telegram

require_once "tbot.php"; //enviar notificaciones por el canal de Telegram

$app_description = "Task1";
if ($argc > 1 ) {
	echo $app_description . "\n";
    exit( 'Uso: ' . $argv[0] . '\n' );
}


check_espacio_unidades();
// ping_equipos();
exit(0);

//---------------------------------------------------------
function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r")); 
    }
    else {
        exec($cmd . " > /dev/null &");  
    }
} 

//---------------------------------------------------------
function ping_equipos() {
	execInBackground("ping -n 1 127.0.0.1");
	exit;
	
	$result = exec("ping -n 1 127.0.0.1"); 
	var_dump($result);
	
	if ($result == 0) { 
		echo "ping succeeded"; 
	} else { 
		echo "ping failed"; 
	}
	
	$url = '127.0.0.1';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	if($httpcode>=200 && $httpcode<300){
	  echo 'worked';
	} else {
	  echo "didn't work";
	}	
	
	$host = '127.0.0.1'; 
	$port = 8080; 
	$waitTimeoutInSeconds = 1; 
	if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
		echo "It worked";
	} else {
		echo "// It didn't work ";
	} 
	fclose($fp);
}

//---------------------------------------------------------
function check_espacio_unidades() {
	check_espacio("C:");
	check_espacio("D:");
}

//---------------------------------------------------------
function check_espacio($unidad = "C:") {
	//default
	$ds = disk_total_space($unidad);
	$df = disk_free_space ($unidad);
	$espacio_total = getSymbolByQuantity($ds);
	$espacio_libre = getSymbolByQuantity($df);

	//mensaje Telegram 
	$msg =  date("Y-m-d H:i:s") . " - Espacio en $unidad: " . $espacio_libre . " <strong>libre</strong> de " . $espacio_total;
	list($token, $chatID) = tbot_config();
	// sendMessage($chatID, "vamos", $token);
	sendMessage($chatID, $msg, $token);

	//fichero de log 
	$espacio_libre_gigas = $df / pow(1024, 3);
	$msg = date("Y-m-d H:i:s") . ";" . $espacio_libre_gigas;
	$file = "C:/tmp/logs/log_" . date("Y-m-d") . ".txt";
	$myfile = fopen($file, "a");
	fwrite($myfile, $msg . "\n");
}
// enviar_mensaje("va otro <strong>mensaje</strong> y formateado " . date("H:i:s"));

// $file = 'C:\Users\Usuario\Dropbox\catalogo_peliculas_series.txt';
// $file = "C:/Users/Usuario/Downloads/m.pdf";
// enviar_archivo($file);

// $file = 'C:\Users\Usuario\Dropbox\dat\dibujos_mosa\paint.png\ABSTRACTO.png';
// $file = '"C:\\Users\\Usuario\\Dropbox\\dat\\dibujos_mosa\\paint.png\\ABSTRACTO.png"';
// enviar_imagen($file);

//--------------------------------------------------------------
function getSymbolByQuantity($bytes) {
    $symbols = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
    $exp = floor(log($bytes)/log(1024));
    return sprintf('%.2f '.$symbols[$exp], ($bytes/pow(1024, floor($exp))));
}






