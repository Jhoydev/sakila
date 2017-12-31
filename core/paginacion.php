<?php

function paginacion_crear($campos, $tabla, $pag, $tampag=10, $where = "", $condicionales = "")
{
    global $link;
    $paginacion = array();

    $numregistro = (($pag - 1) * $tampag) + 1;
    if ($numregistro == 1) {
        $numregistro = 0;
    }

    $sql   = "SELECT $campos from $tabla $where $condicionales";
    $rs    = mysqli_query($link, $sql);
    $total = mysqli_num_rows($rs); // total de registros
    mysqli_free_result($rs); // Liberamos el recorset para la siguiente SELECT
    $sql = "SELECT $campos from $tabla $where $condicionales LIMIT $numregistro,$tampag";
    $rs  = mysqli_query($link, $sql);
    //total de páginas

    $numreg = mysqli_num_rows($rs); // total de registros
    $totalpag = intval($total / $tampag);

    $resto    = $total % $tampag;

    if ($resto > 1) {
        $totalpag++;
    }

    $paginacion["items"] = array();
    $paginacion["total"] = $total;

    while ($row = mysqli_fetch_assoc($rs)) {
        $paginacion["items"][] = $row;
    }

    $paginacion["render"]["pag"] = $pag;
    $paginacion["render"]["numreg"] = $numreg;
    $paginacion["render"]["totalpag"] = $totalpag;
    $paginacion["render"]["total"] = $total;

    return $paginacion;
}

function paginacion_render($render,$tampag=10){
    $pag = $render["pag"];
    $numreg = $render["numreg"];
    $totalpag = $render["totalpag"];
    //Mostramos la paginacion

    /*
     * Definimo como $drango como la pagina en la que estamos actualmente
     * $hrango = el numero de registros que va a mostrar partiendo desde la pagina actual
     * */

    if (!$numreg) return false;

    $drango = $pag;
    $hrango = $pag + $tampag;
    if ($hrango >= ($totalpag - $tampag)){
        $hrango = $totalpag;
    }

    /*
     * $firstpag indica si mostrara el icono de ir a la primer pagina
     * $lastpag indica si mostrar el icono de la ultima pagina
     * */

    $firstpag = true;
    $lastpag = true;
    switch($pag){
        case 1:
            $drango = 1;
            if($totalpag < 5){
                $hrango = $totalpag;
            }else{
                $hrango = 5;
            }
            $previous = false;
            $next = true;
            $firstpag = false;
            if ($totalpag == 0){
                $next = false;
                $lastpag = false;
            }
            break;
        case 2:
            $drango = 1;
            if($totalpag < 5){
                $hrango = $totalpag;
            }else{
                $hrango = 5;
            }
            $next = true;
            $previous = true;
            break;
        case ($totalpag-1):
            $drango = $pag - 3;
            if ($drango < 1){
                $drango = 1;
            }
            $hrango = $totalpag;
            $next = true;
            $previous = true;
            break;
        case $totalpag:
            $drango = $pag - 4;
            if ($drango < 1){
                $drango = 1;
            }
            $hrango = $totalpag;
            $previous = true;
            $next = false;
            $lastpag = false;
            break;
        default:
            $drango = $pag - 2;
            $hrango = $pag + 2;
            $next = true;
            $previous = true;
            break;
    }

    /***** Generar la paginacion ******/
    $pagParameter = $_SERVER['QUERY_STRING'];

    echo " <nav>
            <ul class='pagination'>";
    if($firstpag == true){
        $pagParameter = substr_replace($pagParameter, 'pag=1', strpos($pagParameter,"pag="));
        echo"<li class='page-item' class='page-item'><a class='page-link' href='?".$pagParameter."'  aria-label='Previous'><i class=\"fa fa-fast-backward\" aria-hidden=\"true\"></i></a></li>";
    }
    if($previous == true){
        $prevpag = $pag - 1;
        $pagParameter = substr_replace($pagParameter, 'pag='.$prevpag, strpos($pagParameter,"pag="));
        echo "<li class='page-item'><a class='page-link' href='?".$pagParameter."'><span class='fa fa-step-backward '></span></a></li>";
    }
    for($i=$drango;$i<=$hrango;$i++){
        $pagParameter = substr_replace($pagParameter, 'pag='.$i, strpos($pagParameter,"pag="));
        if($i == $pag){
            echo "<li class='page-item active'><a class='page-link' href='?".$pagParameter."'>$i </a></li>";
        }else{
            echo "<li class='page-item'><a class='page-link' href='?".$pagParameter."'>$i </a></li>";
        }
    }

    if($next == true){
        $nextpag = $pag + 1;
        $pagParameter = substr_replace($pagParameter, 'pag='.$nextpag, strpos($pagParameter,"pag="));
        echo "
        <li class='page-item'><a class='page-link' href='?".$pagParameter."'><span class='fa fa-step-forward '></span></a></li>
    ";
    }
    if($lastpag == true){
        $pagParameter = substr_replace($pagParameter, 'pag='.$totalpag, strpos($pagParameter,"pag="));
        echo "
        <li class='page-item'><a class='page-link' href='?".$pagParameter."'><span class='fa fa-fast-forward '></span></a></li>
    ";
    }

}
