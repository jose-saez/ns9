param($param1, $param2=$param1, $param3=$param1)
$env:g = "C:\dat\CATALOGO_PERMISOS_HUVA_SELENE_GEAC_PERFILES_GRUPOS.csv"
$env:e = "C:\dat\rh\PER004040210.csv"
$env:l = "C:\dat\rh\ldap.txt"
$env:t = "C:\dat\j.drv\bas\telefonos_todos_jsm.txt"
echo "----------------- g"
sls $param1 $env:g |select -exp line |sls $param2 |select -exp line |sls $param3
echo "----------------- e"
sls $param1 $env:e |select -exp line |sls $param2 |select -exp line |sls $param3
echo "----------------- l"
sls $param1 $env:l |select -exp line |sls $param2 |select -exp line |sls $param3
echo "----------------- t"
sls $param1 $env:t |select -exp line |sls $param2 |select -exp line |sls $param3
