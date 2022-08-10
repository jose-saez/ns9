<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8" />
<title>Sesiones</title>
</head>

<body>
<?php
echo 'Estamos en la sesión: ' . SID . '<br />';
session_start();

//aquí ya se ha instanciado la "constante" SID
echo 'Estamos en la sesión: ' . SID . '<br />';

//almacenamos algún dato en esa sesión
$_SESSION['mes']  = 'junio';

echo 'Seguimos en la sesión: ' . SID . '<br />';
?>

</body>

</html>
