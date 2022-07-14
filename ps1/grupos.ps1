#mostrar grupos de Selene
param($param1, $param2=$param1, $param3=$param1)
echo "=== Grupos de $param1"
$response = wget https://app.area1.sms.carm.es/guinda/selene/usuario/grupos/$param1
write $response.content |ConvertFrom-Json

if ($param1 -ne $param2) {
	echo "=== Grupos de $param2"
	$response = wget https://app.area1.sms.carm.es/guinda/selene/usuario/grupos/$param2
	write $response.content |ConvertFrom-Json
}

if ($param1 -ne $param3) {
	echo "=== Grupos de $param3"
	$response = wget https://app.area1.sms.carm.es/guinda/selene/usuario/grupos/$param3
	write $response.content |ConvertFrom-Json
}
