<?php

// require_once 'C:/bin/scripts/php/conn/conectar_desa.php';
require_once 'C:/dat/conn/conectar_desa.php';


echo "Conectando ubica.../n";

$conn = conectar_coco_desa();
// print_r($conn);
echo "conectado/n";

$sql = "select 'ZONA', COUNT(ID) AS CUANTAS FROM COCO.ZONA 
UNION 
select 'UBICACION_TIPO', COUNT(ID) AS CUANTAS FROM COCO.UBICACION_TIPO
UNION 
select 'CECO', COUNT(ID) AS CUANTAS FROM COCO.CECO 
UNION 
select 'PLANTA', COUNT(ID) AS CUANTAS FROM COCO.PLANTA 
UNION 
select 'EDIFICIO', COUNT(ID) AS CUANTAS FROM COCO.EDIFICIO
UNION 
select 'UBICACION', COUNT(ID) AS CUANTAS FROM COCO.UBICACION 
ORDER BY CUANTAS  
";

// $sql = "select count(*) as cuantas from COCO.CECO";

$sentencia = $conn->prepare($sql);
if ($sentencia->execute()) {
  while ($fila = $sentencia->fetch()) {
    print_r($fila);
  }
}



