<?php
include_once "config.php";
include_once URL."/controladores/descargaController.php";

if ($datos){
   $xml = crearXML($datos,STORAGE . "/datos.xml");
}
if ($xml){
    echo "XML generado con exito";
}