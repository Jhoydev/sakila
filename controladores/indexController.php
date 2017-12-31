<?php

include_once URL."/core/database.php";
include_once URL."/core/paginacion.php";
include_once URL."/modelo/Film.php";

if (!empty($_GET["pag"])){
    $pag=$_GET["pag"];
}else{
    $pag=1;
}
$tabla = "film";

$films = paginacion_crear("*",$tabla,$pag,20);
$opt_release_year = get_film_group_field("release_year");
$opt_rating = get_film_group_field("rating");
$opt_languages = get_film_language();
$opt_category = get_film_category();

