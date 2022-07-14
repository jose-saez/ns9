<?php 
//enviar notificaciones por el canal de Telegram
//envía al canal todo lo que reciba por la entrada estándar 
require_once "tbot.php"; 

$app_description = "Palbot";
list($token, $chatID) = tbot_config();

$ic = 0;
$ic_max = 100;  // stops after this number of rows
$buffer = '';
$handle = fopen("php://stdin", "r");
while (!feof($handle) && ++$ic<=$ic_max) {
   $buffer .= fgets($handle, 4096);
}
// echo "enviando [" . $buffer . "]\n";
sendMessage($chatID, $buffer, $token);
exit(0);
