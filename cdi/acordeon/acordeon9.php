<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Ejemplo de un acordeón con jQuery</title>
	<script type="text/javascript" src="../libs/jquery/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#ver_bloque1").click(function() {
				$("#contenido_bloque1" ).slideToggle("slow")
			});
			$("#ver_bloque2").click(function() {
				$("#contenido_bloque2" ).slideToggle("slow")
			});
			$("#ver_bloque3").click(function() {
				$("#contenido_bloque3" ).slideToggle("slow")
			});
		});
	</script>
</head>

<body>
Organizar la interfaz de usuario con un "acordeón"
<div id="bloque1">
	<span id="ver_bloque1">
		<h1>Mis personas favoritas</h1>
	</span>
	<div id="contenido_bloque1" style='display: none'>
		Esto está dentro del bloque1
		<ul>
			<li>Claudia Chífer</li>
			<li>Mariano Gandhi</li>
			<li>Jason Voorhees</li>
		</ul>
	</div>
</div>
<div id="bloque2">
	<span id="ver_bloque2">
		<h1>Mis animales favoritos</h1>
	</span>
	<div id="contenido_bloque2" style='display: none'>
		Esto está dentro del bloque2
		<ul>
			<li>Lassie</li>
			<li>El pollo a la brasa</li>
			<li>Claudia Chífer</li>
		</ul>
	</div>
</div>
<div id="bloque3">
	<span id="ver_bloque3">
		<h1>Mis plantas favoritas</h1>
	</span>
	<div id="contenido_bloque3" style='display: none'>
		Esto está dentro del bloque3
		<ul>
			<li>El algarrobo mediterráneo</li>
			<li>María</li>
			<li>Claudia Chífer</li>
		</ul>		
	</div>
</div>
</body>
</html>