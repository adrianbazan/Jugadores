<HTML LANG="es">

<HEAD>
   <TITLE>Resultados encuesta</TITLE>
</HEAD>

<BODY>
<h1> Resultados votaciones</h1>

<?PHP
  //conectamos con la base de datos
  error_reporting(~E_ALL & ~E_NOTICE);
	$conexion = mysql_connect("localhost","root","") 
		or die ("No se puede conectar con el servidor");
  mysql_select_db("Encuestas") 
		or die ("La base de datos no existe");    
    
    //Valoración media del servicio
    $instruccion= "select avg(respuesta) from respuestas where id_preguntas not in (select id from preguntas where id_dimensiones=1)";
    $consulta = mysql_query($instruccion, $conexion)
		or die ("Fallo en la seleccion");
	  $consulta =mysql_fetch_array($consulta);
    print("<h2>Valoraci&oacute;n general</h2>");
    print("Valoraci&oacute;n media de los servicios: ".$consulta[0]."<br/>");
    //valoración media PAS
    $instruccion= "SELECT AVG(RESPUESTA) FROM RESPUESTAS 
                    WHERE ID_PREGUNTAS NOT IN 
                    (SELECT ID FROM PREGUNTAS WHERE ID_DIMENSIONES =1) 
                    AND ID_ENCUESTASRELLENAS IN 
                    (SELECT ID_ENCUESTASRELLENAS 
                      FROM RESPUESTAS 
                      WHERE ID_PREGUNTAS=1 
                      AND RESPUESTA = 'PAS')
                    ";
    $consulta = mysql_query($instruccion, $conexion)
    or die ("Fallo en la selecci&oacute;n");
    $consulta =mysql_fetch_array($consulta);
    
    print("Valoraci&oacute;n media de los servicios por el PAS: ".$consulta[0]."<br/>");

     //valoración media Alumnos
    $instruccion= "SELECT AVG(RESPUESTA) FROM RESPUESTAS 
                    WHERE ID_PREGUNTAS NOT IN 
                    (SELECT ID FROM PREGUNTAS WHERE ID_DIMENSIONES =1) 
                    AND ID_ENCUESTASRELLENAS IN 
                    (SELECT ID_ENCUESTASRELLENAS 
                      FROM RESPUESTAS 
                      WHERE ID_PREGUNTAS=1 
                      AND RESPUESTA = 'Alumno')
                    ";
    $consulta = mysql_query($instruccion, $conexion)
    or die ("Fallo en la selecci&oacute;n");
    $consulta =mysql_fetch_array($consulta);
    
    print("Valoraci&oacute;n media de los servicios por los alumnos: ".$consulta[0]."<br/>");

     //valoración media PDI
    $instruccion= "SELECT AVG(RESPUESTA) FROM RESPUESTAS 
                    WHERE ID_PREGUNTAS NOT IN 
                    (SELECT ID FROM PREGUNTAS WHERE ID_DIMENSIONES =1) 
                    AND ID_ENCUESTASRELLENAS IN 
                    (SELECT ID_ENCUESTASRELLENAS 
                      FROM RESPUESTAS 
                      WHERE ID_PREGUNTAS=1 
                      AND RESPUESTA = 'PDA')
                    ";
    $consulta = mysql_query($instruccion, $conexion)
    or die ("Fallo en la selecci&oacute;n");
    $consulta =mysql_fetch_array($consulta);
    
    print("Valoraci&oacute;n media de los servicios por el PDA: ".$consulta[0]."<br/>");


    //Valoración media general de cada pregunta
    print("<h2>Desglose de preguntas</h2>");
    $instruccion = "select * from preguntas where id not in (SELECT ID FROM PREGUNTAS WHERE ID_DIMENSIONES =1);";
    $consulta = mysql_query($instruccion,$conexion);
    $filas = mysql_num_rows($consulta);
    for($i = 0; $i < $filas; $i++){
      $res = mysql_fetch_array($consulta);
      $id = $res['id'];
      $instruccion = "select avg(respuesta) from respuestas where id_preguntas=$id";
      $consulta2 = mysql_query($instruccion,$conexion);
      $consulta2 = mysql_fetch_array($consulta2);
      $media = $consulta2[0];
      print('Respuesta media a la pregunta: "'.$res['pregunta'].'": '.$media."<br/>");
    }

    
//desconectamos
	mysql_close($conexion);


?>

</BODY>
</HTML>
