<?php
include_once "config.php";
include_once URL."/modelo/Descargar.php";
$datos = null;
$fillable = ["title","rating","release_year","language","category"];
if ($_REQUEST){
    $datos = select_download($_REQUEST);
}
echo "procesando...";



