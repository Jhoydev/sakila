<?php

include_once URL."/core/database.php";

function get_film_group_field($field){
    global $link;
    $sql = "SELECT $field FROM film GROUP by $field";
    $rs  = mysqli_query($link, $sql);
    $rows = array();

    while ($row = mysqli_fetch_assoc($rs)) {
        $rows[] = $row;
    }

    return $rows;
}

function get_film_language(){
    global $link;
    $sql = "select l.language_id as id,l.name from film INNER JOIN language l ON film.language_id = l.language_id GROUP by l.name";
    $rs  = mysqli_query($link, $sql);
    $rows = array();

    while ($row = mysqli_fetch_assoc($rs)) {
        $rows[] = $row;
    }

    return $rows;
}

function get_film_category(){
    global $link;
    $sql = "select c.category_id as id,c.name from film f INNER JOIN film_category f2 ON f.film_id = f2.film_id INNER JOIN category c ON f2.category_id = c.category_id GROUP BY c.category_id";
    $rs  = mysqli_query($link, $sql);
    $rows = array();

    while ($row = mysqli_fetch_assoc($rs)) {
        $rows[] = $row;
    }

    return $rows;
}
