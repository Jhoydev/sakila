<?php
include_once URL."/core/database.php";

function select_download($req){
    global $link;

    if ($req){
        $where = "WHERE 1=1";
        foreach ($req as $c => $r){
            if ($r){
                if ($c == "category_id") $c = "c.$c";
                if ($c == "title"){
                    $where .= " AND $c LIKE '%$r%'";
                }else{
                    $where .= " AND $c = '$r'";
                }
            }
        }
    }

    $sql = "select * from film f INNER JOIN film_category f2 ON f.film_id = f2.film_id INNER JOIN category c ON f2.category_id = c.category_id $where";
    $rs  = mysqli_query($link, $sql);
    $rows = array();

    while ($row = mysqli_fetch_assoc($rs)) {
        $rows[] = $row;
    }
    return $rows;
}