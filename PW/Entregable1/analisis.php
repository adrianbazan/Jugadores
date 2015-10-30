<HTML LANG="es">

<HEAD>
   <TITLE>Resultados encuesta</TITLE>
   <style type="text/css">
	body {background-color:#f0fcfb;}
	
	div#BODY2{
		padding :20px 0px 0px 30px;
		font-family:verdana,arial;
		font-size:9pt;
		}
	h1{
		color:#03897e;
		text+align:center;
		margin-top:30px;
		}		
	h2{
		color:#03c4b4;
		padding-left:20px;
		margin-top:50px;
		margin-bottom:50px;
		}
	p{
		font-family:verdana,arial;
		width: 500px;
		font-size:12pt;
		color:#008000;
		}
   </style>
</HEAD>

<BODY>
<div id="BODY2">
<h1>Resultados votaciones</h1>
<p></p>
<?PHP
  //conectamos con la base de datos
  error_reporting(~E_ALL & ~E_NOTICE);
	$conexion = mysql_connect("localhost","root","bazan") 
		or die ("No se puede conectar con el servidor");
  mysql_select_db("Encuestas") 
		or die ("La base de datos no existe");    
    
    //Valoración media del servicio
    $instruccion= "select avg(respuesta) from respuestas where id_preguntas not in (select id from preguntas where id_dimensiones=1)";
    $consulta = mysql_query($instruccion, $conexion)
		or die ("Fallo en la seleccion");
	  $consulta =mysql_fetch_array($consulta);
    print("<h2>Valoraci&oacute;n general</h2>");
    print("<p>Valoraci&oacute;n media de los servicios: ".$consulta[0]."<br/></p>");
    
    print("<TD CLASS='izquierda'></TD>");
    
    
    //valoración media PAS
    $instruccion= "SELECT AVG(respuesta) FROM respuestas 
                    WHERE id_preguntas NOT IN 
                    (SELECT id FROM preguntas WHERE id_dimensiones =1) 
                    AND id_encuestasrellenas IN 
                    (SELECT id_encuestasrellenas 
                      FROM respuestas 
                      WHERE id_preguntas=1 
                      AND respuesta = 'PAS')
                    ";
    $consulta = mysql_query($instruccion, $conexion)
    or die ("Fallo en la selecci&oacute;n");
    $consulta =mysql_fetch_array($consulta);
    
    print("<p>Valoraci&oacute;n media de los servicios por el PAS: ".$consulta[0]."<br/></p>");

     //valoración media Alumnos
    $instruccion= "SELECT AVG(respuesta) FROM respuestas 
                    WHERE id_preguntas NOT IN 
                    (SELECT id FROM preguntas WHERE id_dimensiones =1) 
                    AND id_encuestasrellenas IN 
                    (SELECT id_encuestasrellenas 
                      FROM respuestas 
                      WHERE id_preguntas=1 
                      AND respuesta = 'Alumno')
                    ";
    $consulta = mysql_query($instruccion, $conexion)
    or die ("Fallo en la selecci&oacute;n");
    $consulta =mysql_fetch_array($consulta);
    
    print("<p>Valoraci&oacute;n media de los servicios por los alumnos: ".$consulta[0]."<br/></p>");

     //valoración media PDI
    $instruccion= "SELECT AVG(respuesta) FROM respuestas 
                    WHERE id_preguntas NOT IN 
                    (SELECT id FROM preguntas WHERE id_dimensiones =1) 
                    AND id_encuestasrellenas IN 
                    (SELECT id_encuestasrellenas 
                      FROM respuestas 
                      WHERE id_preguntas=1 
                      AND respuesta = 'PDA')
                    ";
    $consulta = mysql_query($instruccion, $conexion)
    or die ("Fallo en la selecci&oacute;n");
    $consulta =mysql_fetch_array($consulta);
    
    print("<p>Valoraci&oacute;n media de los servicios por el PDA: ".$consulta[0]."<br/></p>");


    //Valoración media general de cada pregunta
    print("<h2>Desglose de preguntas</h2>");
    $instruccion = "select * from preguntas where id not in (SELECT id FROM preguntas WHERE id_dimensiones =1);";
    $consulta = mysql_query($instruccion,$conexion);
    $filas = mysql_num_rows($consulta);
    for($i = 0; $i < $filas; $i++){
      $res = mysql_fetch_array($consulta);
      $id = $res['id'];
      $instruccion = "select avg(respuesta) from respuestas where id_preguntas=$id";
      $consulta2 = mysql_query($instruccion,$conexion);
      $consulta2 = mysql_fetch_array($consulta2);
      $media = $consulta2[0];
      print('<p>Respuesta media a la pregunta: "'.$res['pregunta'].'": '.$media."<br/></p>");
    }

    
//desconectamos
	mysql_close($conexion);


?>
</p>
</div>
</BODY>
</HTML>
