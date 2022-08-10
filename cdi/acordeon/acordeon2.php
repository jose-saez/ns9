<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Ejemplo de un acordeón con jQuery</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
  $(function() {
	var icons = {
		header: "ui-icon-circle-arrow-e",
		activeHeader: "ui-icon-circle-arrow-s"
	};
    $("#bloque_acordeon" ).accordion(
		{ collapsible: true, 
		 icons: icons }
	);
  });
  </script>
  
</head>

<body>
Organizar la interfaz de usuario con un "acordeón"
<div id="bloque_acordeon">
	<h1>Mis personas favoritas</h1>
	<div>
		Esto está dentro del bloque1
		<ul>
			<li>Claudia Chífer</li>
			<li>Mariano Gandhi</li>
			<li>Jason Voorhees</li>
		</ul>
	</div>
	
	<h1>Mis animales favoritos</h1>
	<div>
		Esto está dentro del bloque2
		<ul>
			<li>Lassie</li>
			<li>El pollo a la brasa</li>
			<li>Claudia Chífer</li>
		</ul>
	</div>
	
		<h1>Mis plantas favoritas</h1>
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