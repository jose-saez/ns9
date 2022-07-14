<?php 
// tarea que ejecuta determinadas consultas en las BD las reporta por Telegram
require_once "tbot.php"; //enviar notificaciones por el canal de Telegram

$app_description = "Task2-Consultas";
if ($argc > 1 ) {
	echo $app_description . "\n";
    exit( 'Uso: ' . $argv[0] . '\n' );
}


consultas();
exit(0);

//---------------------------------------------------------
function consultas() {
	//mensaje Telegram 
	$msg =  date("Y-m-d H:i:s") . " - Consultas ";
	list($token, $chatID) = tbot_config();
	sendMessage($chatID, $msg, $token);	
}

//---------------------------------------------------------
function check_espacio() {
	//default
	$ds = disk_total_space("C:");
	$df = disk_free_space ("C:");
	$espacio_total = getSymbolByQuantity($ds);
	$espacio_libre = getSymbolByQuantity($df);

	//mensaje Telegram 
	$msg =  date("Y-m-d H:i:s") . " - Espacio en C: " . $espacio_libre . " <strong>libre</strong> de " . $espacio_total;
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