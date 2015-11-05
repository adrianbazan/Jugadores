<HTML LANG="es">

<HEAD>

   <TITLE>Encuesta</TITLE>
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
	
	p{
		font-family:verdana,arial;
		width: 500px;
		font-size:12pt;
		color:#008000;
		border: 1px dotted red;
		}
	div#boton{
		margin:20px 150px 20px 150px;
		}
   </style>
</HEAD>

<BODY>
<div id="BODY2">
<h1>Encuesta de satisfaccion</h1>
<p>
<?PHP
  error_reporting(~E_ALL & ~E_NOTICE);
  $enviar = $_POST['enviar'];
  $conexion = mysql_connect("localhost","root","bazan") or die ("No se puede conectar con el servidor");
  mysql_select_db("Encuestas") or die ("La base de datos no existe");
  $instruccion = "select * from preguntas";
  $consulta = mysql_query($instruccion, $conexion);
  $filas = mysql_num_rows($consulta);
  
  if(isset($enviar)){
    $hora = date('h:i:s');
    $horainicio = $_POST['fechainicio'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $instruccion = "insert into encuestasrellenas (id_estudios,hora_comienzo,hora_fin,ip) values (1,'$horainicio','$hora','$ip')";
    $result = mysql_query($instruccion,$conexion);
    $consulta = mysql_query('select max(id) "maximo" from encuestasrellenas', $conexion);
    $resultado = mysql_fetch_array($consulta);
    $id = $resultado['maximo'];
    if(!$result) echo mysql_error();
    
    //inserto en la bd las preguntas
    //hago independientemente la insercion de la dimension 5 de las demas
    $instruccion = "select * from preguntas";
	$consulta = mysql_query($instruccion, $conexion);
    for($i=0;$i<$filas;$i++){
		$result = mysql_fetch_array($consulta);
		if($result['id_Dimensiones']==5)
		{
			$voto = $_POST['comentario'];
		}		
		else
		{
			$voto = $_POST['s'.$i];
		} 
		$instruccion = "insert into respuestas (id_encuestasrellenas,id_Preguntas,respuesta) values ($id,$i+1,'$voto');";
		$result = mysql_query($instruccion,$conexion);
		if (!$result) {print("Error en MySQL");}
		print($array[$i]);
    }

    print("<h1>Registrado</h1>");
  }
  else{
    $horainicio = date('h:i:s');

    print('<form action = "publico.php" method = "POST">');
    print('<input type = "hidden" name = "fechainicio" value ='.$horainicio.' />');
    for($i = 0; $i < $filas; $i++){
      $res = mysql_fetch_array($consulta);
     
     
     
     ////////////////////////////////////
     
      echo '<p>'.($res['pregunta']."\t")."</p>";
      
      if($res['id_Dimensiones'] == 1){
		print('<select name = "s'.$i.'">');
        $consulta2 = mysql_query("select * from opciones where id_preguntas =".$res['id'],$conexion);
        $filas2 = mysql_num_rows($consulta2);
        for($j = 0; $j < $filas2; $j++){
          $res2 = mysql_fetch_array($consulta2);
          print('<option value="'.$res2['nombre'].'">'.$res2['nombre']."</option>");
        }
      }
      else if ($res['id_Dimensiones'] == 2 or $res['id_Dimensiones'] == 3 or $res['id_Dimensiones'] == 4){
        print('<select name = "s'.$i.'">');
        for($j = 0; $j < 10; $j++){
          print('<option value="'.$j.'">'.$j."</option>");
        }
      }
      print("</select></br>");
    }
    if($res['id_Dimensiones'] == 5)
      {
		  print('<textarea name="comentario" cols="50" rows="4"></textarea>');
	  }
    echo '<div id="boton"'.('</br><input type="submit" name="enviar" value="Enviar">'."</div>");
    print("</form>");
  }
?>
</p>
</div>
</BODY>
</HTML>
