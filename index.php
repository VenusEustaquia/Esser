<?php
include('funciones.php');
cabecera('Inicio');

print "
  <!-- banner-->
  <div id=\"container\">
    <ul id=\"example1\">
        <li>
          <image src=\"images/img2.jpg\" width=\"800\" height=\"400\" alt=\"Imagen Esser 1\" />
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
  <center>
  <div id=\"container2\">
  
    <ul>
        <li>
          
          <a href=\"listar.php?tipo=rock\"title='rock'><div id='rock' class='cajas'></div></a>
          
        </li>
         <li>
          
           <a href=\"listar.php?tipo=pop\" title='pop'><div id='pop' class='cajas'></div></a>
           
        </li>                      
    
        <li>
           
          <a href=\"listar.php?tipo=electro\" title='electronica'><div id='electro' class='cajas'></div></a>
          
        </li> 
        <li>
          
          <a href=\"listar.php?tipo=hiphop\" title='hip hop'><div id='hiphop' class='cajas'></div></a>
          
        </li> 
        </ul>
        <ul>
        <li>
        
          <a href=\"listar.php?tipo=world\" title='world music'><div id='world' class='cajas'></div></a>
         
        </li>
    
        <li>
        
          <a href=\"listar.php?tipo=solista\" title='solistas'><div id='solista' class='cajas'></div></a>
          
        </li> 
        <li>
         
          <a href=\"listar.php?tipo=latina\" title='música latina'><div id='latina' class='cajas'></div></a>
         
        </li> 
        <li>
          
          <a href=\"listar.php?tipo=spot\" title='Bandas Sonoras, Audiolibros, Spot'><div id='spot' class='cajas'></div></a>
          
        </li>
    </ul>
    
 </div>
</center>


";

pie();
?>
