<?php

include('funciones.php');
$db = conectaDb();
$tipo= recoge('tipo');
cabecera('Listar canciones');

$consulta = "SELECT COUNT(*) FROM esser.musica";
$result = $db->query($consulta);
if (!$result) {
   print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn()==0) {
   print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {
   $consulta = "SELECT nom_cancion FROM $dbMusica
       where estilo = '$tipo'";
   $result = $db->query($consulta);
   if (!$result) {
       print "<p>Error en la consulta 1.</p>\n";
   } else {
       print "<p>$tipo:</p>\n<div id='lista'>\n";
       $consulta = "SELECT * FROM $dbMusica
                    where estilo='$tipo' 
                    ORDER BY nom_cancion";
       $result = $db->query($consulta);
       foreach ($result as $valor) {
       print "<ul>\n";    
       print "      <li>Canción: $valor[nom_cancion]</li>\n";
       print "      <li>Grupo: $valor[grupo]</li>\n";
       print "      <li>Dirección: $valor[direccion]</li>\n";
       print "      <li><object type=\"application/x-shockwave-flash\" data=\"dewplayer-mini.swf\" width=\"160\" height=\"20\" id=\"$valor[nom_cancion]\" name=\"$valor[nom_cancion]\"> 
                        <param name=\"wmode\" value=\"transparent\" />
                            <param name=\"movie\" value=\"dewplayer-mini.swf\" /> 
                                <param name=\"flashvars\" value=\"mp3=$valor[direccion]\" /> 
                        </object>
                    </li>\n";
       
       print "</ul>\n";
      }
           
       
       
   }
}

$db = NULL;
pie();
?>
