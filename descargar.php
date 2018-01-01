<?php
include_once "config.php";
include_once URL."/modelo/Descargar.php";

$datos = null;

$fillable = ["title","rating","release_year","language_id","category_id"];

if ($_REQUEST["formato"] == "xml" && validar_request($_REQUEST)){
    $datos = select_download($_REQUEST);
}

echo "procesando...";

