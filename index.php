<?php
include('funciones.php');
cabecera('Inicio');

print "
  <!-- banner-->
  <div class='slider'>
    <ul >
        <li>
            <image src=\"images/img1.jpg\" width=\"800\" height=\"400\" alt=\"Imagen Esser 1\" />
        </li>
        
        <li>
            <image src=\"images/img2.jpg\" width=\"800\" height=\"400\" alt=\"Imagen Esser 2\" />
        </li>
        
        <li>
            <image src=\"images/img3.jpg\" width=\"800\" height=\"400\" alt=\"Imagen Esser 3\" />
        </li>
        
        <li>
            <image src=\"images/img4.jpg\" width=\"800\" height=\"400\" alt=\"Imagen Esser 4\" />
        </li>  
        
        <li>
            <image src=\"images/img1.jpg\" width=\"800\" height=\"400\" alt=\"Imagen Esser 1\" />
        </li>
        
        <li>
            <image src=\"images/img2.jpg\" width=\"800\" height=\"400\" alt=\"Imagen Esser 2\" />
        </li>
        
        <li>
            <image src=\"images/img3.jpg\" width=\"800\" height=\"400\" alt=\"Imagen Esser 3\" />
        </li> 
    </ul>
 </div>
 
  <!--menu inferior-->
  
  <div id=\"container2\">
  
    <ul>
        <li>
          
          <a href=\"listar.php?tipo=rock\"title='rock' id='rock' class='cajas'></a>
          
        </li>
         <li>
          
           <a href=\"listar.php?tipo=pop\" title='pop' id='pop' class='cajas'></a>
           
        </li>                      
    
        <li>
           
          <a href=\"listar.php?tipo=electro\" title='electronica' id='electro' class='cajas'></a>
          
        </li> 
        <li>
          
          <a href=\"listar.php?tipo=hiphop\" title='hip hop' id='hiphop' class='cajas'></a>
          
        </li> 
    </ul>
    <ul>
        <li>
        
          <a href=\"listar.php?tipo=world\" title='world music' id='world' class='cajas'></a>
         
        </li>
    
        <li>
        
          <a href=\"listar.php?tipo=solista\" title='solistas' id='solista' class='cajas'></a>
          
        </li> 
        <li>
         
          <a href=\"listar.php?tipo=latina\" title='m√∫sica latina' id='latina' class='cajas'></a>
         
        </li> 
        <li>
          
          <a href=\"listar.php?tipo=spot\" title='Bandas Sonoras, Audiolibros, Spot' id='spot' class='cajas'></a>
          
        </li>
    </ul>
    
 </div>



";

pie();
?>
