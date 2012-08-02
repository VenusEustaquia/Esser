<?php
/**
 Esser Estudio - consejos.php
 
 */

include('funciones.php');
cabecera('Consejos Previos');
$db = conectaDb();

$consulta = "SELECT COUNT(*) FROM $dbConsejos";
$result = $db->query($consulta);
if (!$result) {
   print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn()==0) {
   print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {
   
       print"
           
           <div id=\"consejos\">
           <h2>Consejos previos</h2>
        ";
       $consulta = "SELECT * FROM $dbConsejos";
       $result = $db->query($consulta);
       foreach ($result as $valor) {
       print " 
           <p id=\"consejo\">$valor[texto]</p>
           <img id='imgconsejo' alt=\"Consejos_previos\" src=\"$valor[imagen]\"></img> 
                 
       ";      
       
      }
      print "</div>\n"; 

      
}
pie();
?>
