<?php
include_once URL."/modelo/Descargar.php";

if ($_REQUEST["formato"] == "xml" && validar_request($_REQUEST)){
    $datos = select_download($_REQUEST);
}

function crearXML($datos,$url){
    $xw = xmlwriter_open_uri($url);
    xmlwriter_set_indent($xw, 1);
    $res = xmlwriter_set_indent_string($xw, "\t");
    
    xmlwriter_start_document($xw, '1.0', 'UTF-8');
    
        // A first element
        xmlwriter_start_element($xw, 'films');
            foreach ($datos as $dato) {
                xmlwriter_start_element($xw, 'film');
                foreach ($dato as $key => $value) {
                    escribir_elemento($xw, $key, $value);
                }
                xmlwriter_end_element($xw); // film
            }
        xmlwriter_end_element($xw); // films
    
    xmlwriter_end_document($xw);
    return $xw;
}

function escribir_elemento($xw, $key, $value){
    $elementos_cdata = ["title","description","special_features"];
    $elementos_otro_nombre = ["name"];
    if (in_array($key,$elementos_cdata)){
        xmlwriter_start_element($xw, $key);
            xmlwriter_write_cdata($xw, $value);
        xmlwriter_end_element($xw); // testc    
    
    }elseif (in_array($key,$elementos_otro_nombre)){
        switch ($key) {
            case 'name':
                xmlwriter_write_element($xw, 'category', $value);                
                break;
        }
    }
    else{
        xmlwriter_write_element($xw, $key, $value);        
    }
}