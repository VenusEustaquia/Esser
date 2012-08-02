<?php


include('funciones.php');
$db = conectaDb();
cabecera('Quienes somos');
print "
 
       <div id=\"quienes\"><h2>El estudio</h2>
 
   <div>    

";
$consulta = "SELECT mision FROM $dbMision";
   $result = $db->query($consulta);
   if (!$result) {
       print "<p>Error en la consulta .</p>\n";
   } else {
       $consulta = "SELECT * FROM $dbMision";
       $result = $db->query($consulta);
       foreach ($result as $valor) {
print "
<div id\"mision-vision\">$valor[mision] </div>
      
";
       }
   }
   
$consulta = "SELECT COUNT(*) FROM $dbEquipo";
$result = $db->query($consulta);
if (!$result) {
   print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn()==0) {
   print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {
   $consulta = "SELECT nom FROM $dbEquipo";
   $result = $db->query($consulta);
   if (!$result) {
       print "<p>Error en la consulta 2.</p>\n";
   } else {
      
       $consulta = "SELECT * FROM $dbEquipo 
                    ORDER BY tipo desc";
       $result = $db->query($consulta);
       foreach ($result as $valor) {
       print "
     <div id=\"divquienes\" class=\"cambiable\">
       <div id='divfoto' class='initial'>
           <img src=\"$valor[foto]\" alt=\"foto_equipo\"></img>
       </div>
       <div id='divcurriculo' class='final'>
           <h2 id='h2nom'>$valor[nom]</h2>  
           <h3 id=h3tp>$valor[tipo]</h3>
           <p id='pcv'>$valor[curriculm]</p>
       </div>
     </div>
       ";      
       
      }
      print "</div>\n";  
   }
}

$db = NULL;
pie();
?>