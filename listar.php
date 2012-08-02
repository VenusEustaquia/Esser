<?php

include('funciones.php');
$tipo= recoge('tipo');
cabecera('Listar canciones');

       print "<p>$tipo:</p>\n<div id='lista-$tipo'></div>\n";

pie();
?>
