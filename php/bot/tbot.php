<?php 
require_once 'C:/bin/src/php/bot/tbot_config.php';

//--------------------------------------------------------------
function sendMessage($chatID, $messaggio, $token) {
	$data = [
	 'chat_id' => $chatID
	 // , 'text' => htmlentities($messaggio)  . "\xF0\x9F\x98\x81" //smiley
	 , 'text' => $messaggio  . "\xF0\x9F\x98\x81" //smiley
	 , 'parse_mode' => 'HTML'
	];
	$result = http_post("https://api.telegram.org/bot$token/sendMessage", $data);
	// $result = file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
	// enviar_mensaje($messaggio);
    return $result;
	
	//otra forma
	// $result = file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );

    // $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    // $url = $url . "&text=" . urlencode($messaggio . "\xF0\x9F\x98\x81");
	// $result = file_get_contents($url);
	/*
	echo "la URL es [$url]\n";
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
	var_dump($result);
    curl_close($ch);
	*/	
}

function enviar_mensaje($msg) {
	list($token, $chat_id) = tbot_config();
	$urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
	$msg = "hola";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $urlMsg);
	curl_setopt($ch, CURLOPT_POST, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$chat_id}&parse_mode=HTML&text=" . urlencode($msg));
	curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$chat_id}&parse_mode=HTML&text=" . $msg);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id=$chat_id&text=$msg");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 
	$server_output = curl_exec($ch);
	var_dump($server_output);
	curl_close($ch);
}

function enviar_archivo($file) {
// $file = "m.pdf";
echo "fichero [" . realpath($file) . "]\n";
// $token = "xx";
// $id = "-1";
// $caption = "Texto o hashtag en el mensaje del archivo"; 
// $url = "https://api.telegram.org/bot{$token}/sendDocument"; 
// $post = array( 'chat_id' => $id, 
			   // 'document' => '@' . $file, 
			   // 'document' => curl_file_create($file),
               // 'caption' => $caption ); 
 
// if (file_exists($file)) : 
	// echo "existe fichero [$file]\n";
    // $ch = curl_init(); 
    // curl_setopt($ch, CURLOPT_URL, $url); 
    // curl_setopt($ch, CURLOPT_POST, 1); 
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    // $server_output = curl_exec($ch); 
	// var_dump($server_output);
    // curl_close($ch); 
// endif; 

// return;	
	
	
	list($token, $id) = config();
	$caption = "ahí va el fichero de consejos contra el coronavirus";
	$url = "https://api.telegram.org/bot{$token}/sendDocument"; 
	echo "la url es " . $url . "\n";
	$post = array( 'chat_id' => $id, 'document' => curl_file_create($file),
               'caption' => $caption ); 
if (file_exists($file)) {
	echo "existe el documento " . $file . "\n";
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $server_output = curl_exec($ch); 

	// var_dump ( curl_getinfo ( $ch ) );
	if (curl_errno ( $ch )) {
		echo "error en curl\n";
		print curl_error ( $ch );
	} else {
		curl_close ( $ch );
	}	
	
    // curl_close($ch); 
} else {
	echo "no encontrado " . $file;
}
}

function enviar_imagen($file) {
	list($token, $id) = config();
	$url = "https://api.telegram.org/bot{$token}/sendPhoto"; 
	$caption = "Texto o hashtag en el mensaje de la foto";
$post = array( 'chat_id' => $id, 'photo' => '@' . $file, 
               'caption' => $caption ); 
if (file_exists($file)) {
	echo "sí que existe " . $file;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $server_output = curl_exec($ch); 
    curl_close($ch); 
} else {
	echo "no encontrado " . $file;
}

}

//-------------------------------------------
function http_post($url, $json) {
    $ans = null;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); 
    try {
        $data_string = json_encode($json);
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        $ans = json_decode(curl_exec($ch));
        if($ans->ok !== TRUE) {
            $ans = null;
        }
    } catch(Exception $e) {
        echo "Error: ", $e->getMessage(), "\n";
    }
    curl_close($ch);
    return $ans;
}