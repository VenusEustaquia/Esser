<?php
/**
 Funciones
 */

define('CABECERA_CON_CURSOR',    TRUE);  // Para funciï¿½n cabecera()
define('CABECERA_SIN_CURSOR',    FALSE); // Para funciï¿½n cabecera()
define('FORM_METHOD',            'get'); // Formularios se envï¿½an con GET
//define('FORM_METHOD',            'post'); // Formularios se envï¿½an con POST
define('MYSQL',          'MySQL');


$dbMotor = MYSQL;                       // Base de datos empleada
if ($dbMotor==MYSQL) {
   define('MYSQL_HOST', 'mysql:host=localhost'); // Nombre de host MYSQL
   define('MYSQL_USUARIO', 'root');     // Nombre de usuario de MySQL
   define('MYSQL_PASSWORD', 'root');        // Contraseï¿½a de usuario de MySQL
//   define('MYSQL_HOST', 'mysql:host=db424092704.db.1and1.com'); // Nombre de host MYSQL
//   define('MYSQL_USUARIO', 'dbo424092704');     // Nombre de usuario de MySQL
//   define('MYSQL_PASSWORD', 'projectESSER&1');        // Contraseï¿½a de usuario de MySQL
   $dbDb      = 'esser';      // Nombre de la base de datos
   $dbEquipo = $dbDb.'.equipo';       // Nombre de la tabla de equipo
   $dbConsejos = $dbDb.'.consejos';       // Nombre de la tabla de 
   $dbMision = $dbDb.'.mision_vision';       // Nombre de la tabla de 
   $dbMusica = $dbDb.'.musica';       // Nombre de la tabla de 
} 
/*
if ($dbMotor==MYSQL) {
define('MYSQL_HOST', 'mysql:host=db424092704.db.1and1.com'); // Nombre de host MYSQL
define('MYSQL_USUARIO', 'dbo424092704'); // Nombre de usuario de MySQL
define('MYSQL_PASSWORD', 'projectESSER&1'); // Contraseï¿½a de usuario de MySQL
$dbDb = 'db424092704'; // Nombre de la base de datos
$dbEquipo = $dbDb.'.equipo'; // Nombre de la tabla de equipo
$dbConsejos = $dbDb.'.consejos'; // Nombre de la tabla de
$dbMision = $dbDb.'.mision_vision'; // Nombre de la tabla de
$dbMusica = $dbDb.'.musica'; // Nombre de la tabla de
} */

//definir campos de todas las tablas
define('TAM_NOM',           50); // Tamaï¿½o de los campos nombre (de cualquier tabla)
define('TAM_CURRICULUM',   500); // Tamaï¿½o del campo curriculum (tabla equipo)
define('TAM_TEXTO',        500); // Tamaï¿½o del campo TABLA CONSEJOS
define('MAX_MISION',       500); // Nï¿½mero mï¿½ximo de registros en la tabla mision
define('TAM_VISION',       500); // Tamaï¿½o del campo  TABLA MISION_VISIÓN
define('MAX_ESTILO',        50); // TABLA MÚSICA
define('MAX_GRUPO',         50); // Peso mï¿½ximo de un ingrediente
define('MAX_DIRECCION',     50); // DIRECCIÓN DE LA CANCION TABLA MÚSICA



function conectaDb()
{
   global $dbMotor, $dbDb;

   try {
       $db = new PDO(MYSQL_HOST, MYSQL_USUARIO, MYSQL_PASSWORD);
       $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, TRUE);
       return($db);
   } catch (PDOException $e) {
          print "<p>Error: No puede conectarse con la base de datos.</p>\n";
//        print "<p>Error: " . $e->getMessage() . "</p>\n";
       pie();
       exit();
   }
}

function recorta($campo, $cadena)
{
   global $recorta;

   $tmp = isset($recorta[$campo]) ? substr($cadena, 0,
$recorta[$campo]) : $cadena;
   return $tmp;
}

function recogeParaConsulta($db, $var, $var2='')
{
   $tmp = (isset($_REQUEST[$var])&&($_REQUEST[$var]!='')) ?
       trim(strip_tags($_REQUEST[$var])) : trim(strip_tags($var2));
   if (get_magic_quotes_gpc()) {
       $tmp = stripslashes($tmp);
   }
   $tmp = str_replace('&', '&amp;',  $tmp);
   $tmp = str_replace('"', '&quot;', $tmp);
   $tmp = recorta($var, $tmp);
   if (!is_numeric($tmp)) {
       $tmp = $db->quote($tmp);
   }
   return $tmp;
}

function recoge($var)
{
   $tmp = (isset($_REQUEST[$var])) ? strip_tags(trim(htmlspecialchars($_REQUEST[$var]))) : '';
   if (get_magic_quotes_gpc()) {
       $tmp = stripslashes($tmp);
   }
   return $tmp;
}

function recogeMatrizParaConsulta($db, $var)
{
   $tmpMatriz = array();
   if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
       foreach ($_REQUEST[$var] as $indice => $valor) {
           $tmp = trim(strip_tags($indice));
           if (get_magic_quotes_gpc()) {
               $tmp = stripslashes($tmp);
           }
           $tmp = str_replace('&', '&amp;',  $tmp);
           $tmp = str_replace('"', '&quot;', $tmp);
           $tmp = recorta($var, $tmp);
           if (!is_numeric($tmp)) {
               $tmp = $db->quote($tmp);
           }
           $indiceLimpio = $tmp;

           $tmp = trim(strip_tags($valor));
           if (get_magic_quotes_gpc()) {
               $tmp = stripslashes($tmp);
           }
           $tmp = str_replace('&', '&amp;',  $tmp);
           $tmp = str_replace('"', '&quot;', $tmp);
           $tmp = recorta($var, $tmp);
           if (!is_numeric($tmp)) {
               $tmp = $db->quote($tmp);
           }
           $valorLimpio  = $tmp;

           $tmpMatriz[$indiceLimpio] = $valorLimpio;
       }
   }
   return $tmpMatriz;
}

function quitaComillasExteriores($var)
{
   if (is_string($var)) {
       if (isset($var[0])&&($var[0]=="'")) {
           $var = substr($var, 1, strlen($var)-1);
       }
       if (isset($var[strlen($var)-1])&&($var[strlen($var)-1]=="'")) {
           $var = substr($var, 0, strlen($var)-1);
       }
   }
   return $var;
}

function fechaDma($amd)
{
   return substr($amd, 8, 2)."-".substr($amd, 5, 2)."-".substr($amd, 0, 4);
}

function fechaAmd($dma)
{
   return substr($dma, 7, 4)."-".substr($dma, 4, 2)."-".substr($dma, 1, 2);
}

function cabecera($texto)
{
   print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
      \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html lang='es' xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
 <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
 <title>Esser Estudio - $texto</title>
 <link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />
 <link href='http://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>
 
<script type=\"text/javascript\" src=\"js/jquery-1.6.1.min.js\"></script>
<script type=\"text/javascript\" src=\"js/jquery.easing.1.3.js\"></script>
<script type=\"text/javascript\" src=\"js/jquery.mousewheel.js\"></script>
<script type=\"text/javascript\" src=\"js/jScrollPane-1.2.3.min.js\"></script>
<script type='text/javascript' src='js/jquery.cleanSlider.js'></script>
<script type='text/javascript' src='js/jquery.jplayer.js'></script>    
<script type='text/javascript' src='js/ttw-music-player-min.js'></script>
<script type='text/javascript' src='js/ttw-music-player.js'></script>
<script type='text/javascript' src='js/myplaylist.js'></script>
      
           
<script type='text/javascript'>
        $(document).ready(
        
        function(){
            
             
            $('div#lista-rock').ttwMusicPlayer(rock, {
                autoPlay:false, 
                jPlayer:{
                    swfPath:'js' //You need to override the default swf path any time the directory structure changes
                }
            });
            $('div#lista-electro').ttwMusicPlayer(electro, {
                autoPlay:false, 
                jPlayer:{
                    swfPath:'js' //You need to override the default swf path any time the directory structure changes
                }
            });
            $('div#lista-pop').ttwMusicPlayer(pop, {
                autoPlay:false, 
                jPlayer:{
                    swfPath:'js' //You need to override the default swf path any time the directory structure changes
                }
            });
            $('div#lista-hiphop').ttwMusicPlayer(hiphop, {
                autoPlay:false, 
                jPlayer:{
                    swfPath:'js' //You need to override the default swf path any time the directory structure changes
                }
            });
            $('#lista-world').ttwMusicPlayer(world, {
                autoPlay:false, 
                jPlayer:{
                    swfPath:'js' //You need to override the default swf path any time the directory structure changes
                }
            });
            $('#lista-solista').ttwMusicPlayer(solista, {
                autoPlay:false, 
                jPlayer:{
                    swfPath:'js' //You need to override the default swf path any time the directory structure changes
                }
            });
            $('#lista-latina').ttwMusicPlayer(latina, {
                autoPlay:false, 
                jPlayer:{
                    swfPath:'js' //You need to override the default swf path any time the directory structure changes
                }
            });
            $('#lista-spot').ttwMusicPlayer(spot, {
                autoPlay:false, 
                jPlayer:{
                    swfPath:'js' //You need to override the default swf path any time the directory structure changes
                }
            });
             
            var config={};
            config.width =1024;  //slider width size in pixels 
            config.height=400;  //slider height size in pixels 
            config.intervalTime  =7000; //mili-seconds between slides   
            $('.slider').cleanSlider(config);

    
            $('#example1').zAccordion({
                timeout: 6000,
                slideWidth: 800,
                width: 1024,
                height: 350
                });
            
        });
    
           

   
    function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!='') {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' Te falta el email';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' Te has olvidad del telefono.';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' Debería haber un numero entre '+min+' y '+max+'.';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+'.'; }
    } if (errors) alert('Han ocurrido los siguientes errores:'+errors);
    document.MM_returnValue = (errors == '');
}
    }
     
             
   
</script>

           
</head>\n\n
<body>\n";


print"
<div id=\"contenedor\">
        <div id=\"menucabecera\">

        <ul>
                <li><a href=\"index.php\"><img src=\"images/logo.gif\" alt=\"logo\" id=\"imglogo\" /></a></li>
                <li><a href=\"consejos.php\" id=\"boton1\" class=\"boton\">Consejos Previos</a></li>
                <li><a href=\"quienes_somos.php\" id=\"boton2\" class=\"boton\">Quienes somos</a></li>
                <li><a href=\"contacto.php\" id=\"boton3\" class=\"boton\">Contacto</a></li>    
        </ul>
        
        </div>
        <!--<h1 id=\"tituloh1\">MÚSICOS QUE TRABAJAN PARA MÚSICOS</h1>-->
<!-- twitter -->
       <div id=\"enlaces\" >
       <ul>
            <li><a href=\"index.php\"><img src=\"images/twitter-logo.png\"></img></a></li>
            <li><a href=\"index.php\"><img src=\"images/facebook-logo.png\"></img></a></li>
            <li><a href=\"index.php\"><img src=\"images/youtube-logo.png\"></img></a></li>            
            </ul>
                        
        
       </div>
       
       \n
    ";
   
   


 
}

function pie()
{
   print '

</div>
<div id="pie">
<address>
 Copyright &copy Esser estudio pie
</address>


</div>
</body>
</html>';
}