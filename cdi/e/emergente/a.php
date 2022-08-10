<html>
<head>
<title>Untitled</title>
<script>
ancho=800
alto=500
function abrir_flotante(){
x=(screen.width-ancho)/2;
y=(screen.height-alto)/2;
propiedades="width="+ancho+",height="+alto+",top="+y+",left="+x;
ventana=window.open('','ventana',propiedades)
}

</script>
</head>

<body>
<form action="b.php" method="post" target="ventana" onsubmit="abrir()">
Calendario 2014
<input type="submit" value="Ver" />
<input type="hidden" value=123 name="cal">
</form>


</body>
</html>
