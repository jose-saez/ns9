param($param1, $param2=$param1, $param3=$param1)
$env:g = "C:\dat\CATALOGO_PERMISOS_HUVA_SELENE_GEAC_PERFILES_GRUPOS.csv"
echo " SERVICIO, PERFIL-CODIGO, PERFIL, GRUPO"
sls $param1 $env:g |select -exp line |sls $param2 |select -exp line |sls $param3
