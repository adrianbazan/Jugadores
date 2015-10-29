<HTML LANG="es">

<HEAD>
   <TITLE>Resultados encuesta</TITLE>
</HEAD>

<BODY>
<h1> Resultados votaciones</h1>

<?PHP
//conectamos con la base de datos
	$conexion = mysql_connect("localhost","root","bazan") 
		or die ("No se puede conectar con el servidor");
  mysql_select_db("Encuestas") 
		or die ("La base de datos no existe");

    
    //numero filas encuesta
    $filas = mysql_num_rows($consulta);
    
    
    //NUMERO DE RESPUESTAS DEL PAS 
    $instruccion= "select count(*) from respuestas where id_Preguntas=1 && respuesta ='PAS'";
    $consulta = mysql_query($instruccion, $conexion)
		or die ("Fallo en la seleccion");
	$consulta =mysql_fetch_array($consulta);
    
    print($consulta[0]);
    
    
//desconectamos
	mysql_close($conexion);


?>

</BODY>
</HTML>
