<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?
require_once "Metricon1.php";

	analizar("../metricon1");
	
//-------------------------------------------------------------
function analizar($path) {
	$m = new Metricon1($path);
	$m->analizar();
}
?> 
</body>
</html>