param($param1, $param2=$param1, $param3=$param1)
$env:h0 = "D:\Users\jsm52l.AD\OneDrive - Comunidad Autonoma de Murcia\j.his\dia20h.ini"
$env:h1 = "D:\Users\jsm52l.AD\OneDrive - Comunidad Autonoma de Murcia\j.his\dia21h.ini"
$env:h2 = "D:\Users\jsm52l.AD\OneDrive - Comunidad Autonoma de Murcia\j.his\dia22h.ini"
echo "-------------------- $env:h0 "
sls $param1 $env:h0 |select -exp line |sls $param2 |select -exp line |sls $param3
echo "-------------------- $env:h1 "
sls $param1 $env:h1 |select -exp line |sls $param2 |select -exp line |sls $param3
echo "-------------------- $env:h2 "
sls $param1 $env:h2 |select -exp line |sls $param2 |select -exp line |sls $param3
