<HTML LANG="es">

<HEAD>
   <TITLE>Encuesta</TITLE>
</HEAD>

<BODY>

<?PHP
  error_reporting(~E_ALL & ~E_NOTICE);
  $enviar = $_POST['enviar'];
  $conexion = mysql_connect("localhost","root","") or die ("No se puede conectar con el servidor");
  mysql_select_db("encuestas") or die ("La base de datos no existe");
  
  if(isset($enviar)){
    $instruccion = "select * from preguntas";
    $consulta = mysql_query($instruccion, $conexion);
    $filas = mysql_num_rows($consulta);

    for($i=0;$i<$filas;$i++){
      $voto = $_POST['s'.$i];
      $instruccion = "insert into respuestas (id_Preguntas,respuesta) values ($i,$voto)";
      $result = mysql_query($instruccion,$conexion);
      if (!$result) {echo mysql_error();}
      print($array[$i]);

    }

    print("<h1>Registrado</h1>");
  }
  else{
    $instruccion = "select * from preguntas";
    $consulta = mysql_query($instruccion, $conexion);

    $filas = mysql_num_rows($consulta);
    print('<form action = "publico.php" method = "POST">');
    for($i = 0; $i < $filas; $i++){
      $res = mysql_fetch_array($consulta);
      print($res['pregunta']."\t");
      print('<select name = "s'.$i.'">');
      if($res['id_Dimensiones'] == 1){
        $consulta2 = mysql_query("select * from opciones where id_preguntas =".$res['id']);
        $filas2 = mysql_num_rows($consulta2);
        for($j = 0; $j < $filas2; $j++){
          $res2 = mysql_fetch_array($consulta2);
          print('<option value="'.$res2['nombre'].'">'.$res2['nombre']."</option>");
        }
      }
      else{
        for($j = 0; $j < 10; $j++){
          print('<option value="'.$j.'">'.$j."</option>");
        }
      }
      print("</select></br>");
    }
    print('</br><input type="submit" name="enviar" value="Enviar">');
    print("</form>");
  }
?>

</BODY>
</HTML>
