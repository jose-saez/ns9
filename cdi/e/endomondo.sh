#!/bin/bash

desde=1
hasta=100
ruta1=http://image.endomondo.com/resources/gfx/picture/
ruta2=/big.jpg

i=$desde
while [ $i -le $hasta ]; do
    echo "descargando $ruta1$i$ruta2"
    wget $ruta1$i$ruta2 -O big.$i.jpg
    let i=$i+1
done 

