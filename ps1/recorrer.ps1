# recorrer recursivamente un directorio

function create-7zip([String] $aDirectory, [String] $aZipfile){ 
    [string]$pathToZipExe = "C:\Program Files\7-zip\7z.exe"; 
    [Array]$arguments = "a", "-tzip", "$aZipfile", "$aDirectory"; 
    & $pathToZipExe $arguments; 
} 

function descomprimir-7zip([String] $directorio, [String] $aZipfile, [String] $password){ 
    set-alias sz "$env:ProgramFiles\7-Zip\7z.exe"
    [Array]$arguments = "e", "-p$password", "-y", "-o$directorio", "$directorio\$aZipfile"; 
    write-host "Ejecutando sz $arguments"
    sz $arguments 
} 


function procesar_carpeta([String] $directorio, [String] $password) {
    write "pass2=$password, dir2=$directorio, pass2=$password"
    foreach( $item in Get-ChildItem $directorio ) {
        if ($item.mode.substring(0,1) -eq "d") {
            procesar_carpeta $item.fullname $password
        } elseif ([System.IO.Path]::GetExtension($item) -eq ".zip") {
            # Write-Host "descomprimiendo $item con $password..."
            descomprimir-7zip $directorio $item $password
            # exit
        }
    }
    write-Host "Terminado"
}

Write-Host ("El Numero de Argumentos es " + $args.count)
$directorio = $args[0]
$password = $args[1]
write "directorio=$directorio, pass=$password, otras"
procesar_carpeta $directorio $password
