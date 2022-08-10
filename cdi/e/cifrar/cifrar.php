<?php
echo "Algoritmos disponibles <pre>"
	. print_r (mcrypt_list_algorithms(), TRUE)
	. "</pre>";
	

$alg = MCRYPT_RIJNDAEL_256;
$mode = MCRYPT_MODE_CBC;
$key = ",,+x";
$tam = mcrypt_get_iv_size($alg, $mode);
echo "el IV debe medir $tam<br>";

//$iv = mcrypt_create_iv(mcrypt_get_iv_size($alg, $mode), MCRYPT_DEV_URANDOM);
$iv = "un vector cualquiera que mida 32";
$data = "kk";

$c_data = mcrypt_encrypt($alg, $key, $data, $mode, $iv);	
$p_data = base64_encode($c_data);

echo "Sin cifrar: $data, cifrados=[$c_data] cifrados plano=[$p_data]";
echo "<hr>";

$c_data = base64_decode($p_data);
$d_data = mcrypt_decrypt($alg, $key, $c_data, $mode, $iv);

echo "Decodificados=[$c_data], Descifrados=[$d_data]";

?>
