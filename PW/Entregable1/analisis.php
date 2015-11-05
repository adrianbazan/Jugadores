<HTML LANG="es">

<HEAD>

   <TITLE>Analisis</TITLE>
   <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
	<script src="https://code.highcharts.com/stock/highstock.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
   
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
		margin:10px 100px 10px 100px;
		}
   </style>
   
   
</HEAD>

<BODY>
<div id="BODY2">
<h1>Generador de informe</h1>
<p>
<?PHP
  error_reporting(~E_ALL & ~E_NOTICE);
  $enviar = $_POST['enviar'];
  $conexion = mysql_connect("localhost","root","bazan") or die ("No se puede conectar con el servidor");
  mysql_select_db("Encuestas") or die ("La base de datos no existe");
  
  
  $instruccion = "select * from preguntas";
  $consulta = mysql_query($instruccion, $conexion);
  $filas = mysql_num_rows($consulta);
  
  
  
  
  if(isset($enviar))
  {
	  $persona= $_POST['s'.'0'];
	  $facultad= $_POST['s'.'1'];
	  $biblioteca= $_POST['s'.'2'];
	  $sexo= $_POST['s'.'3'];
	  
	  //Valoracion media de los servicios de la $persona
      $instruccion= "select avg(respuesta) 
					from respuestas 
					where id_preguntas in 
							(select id 
							from preguntas 
							where id_dimensiones=2)
					and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=1 
                      and respuesta = '$persona') 
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=2 
                      and respuesta = '$facultad') 
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=3 
                      and respuesta = '$biblioteca')
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=4 
                      and respuesta = '$sexo')";
      $consulta = mysql_query($instruccion, $conexion)
		or die ("Fallo en la seleccion");
	  $consulta =mysql_fetch_array($consulta);
	  print("<h2>Valoraci&oacute;n general por el ".$persona."</h2>");
	  $servicio=round($consulta[0],2);
	  print("<p>Valoraci&oacute;n media de los servicios: ".$servicio."<br/></p>");
	  
	  
	  //Valoracion media de las nstalaciones de la $persona
	  $instruccion= "select avg(respuesta) 
					from respuestas 
					where id_preguntas in 
							(select id 
							from preguntas 
							where id_dimensiones=3)
					and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=1 
                      and respuesta = '$persona') 
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=2 
                      and respuesta = '$facultad') 
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=3 
                      and respuesta = '$biblioteca')
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=4 
                      and respuesta = '$sexo')";
      $consulta = mysql_query($instruccion, $conexion)
		or die ("Fallo en la seleccion");
	  $consulta =mysql_fetch_array($consulta);
	  $instalaciones=round($consulta[0],2);
	  print("<p>Valoraci&oacute;n media de las instalaciones: ".$instalaciones."<br/></p>");
	 
	  
	  //Valoracion media de los materiales de la $persona
	  $instruccion= "select avg(respuesta) 
					from respuestas 
					where id_preguntas in 
							(select id 
							from preguntas 
							where id_dimensiones=4)
					and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=1 
                      and respuesta = '$persona') 
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=2 
                      and respuesta = '$facultad') 
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=3 
                      and respuesta = '$biblioteca')
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=4 
                      and respuesta = '$sexo')";
      $consulta = mysql_query($instruccion, $conexion)
		or die ("Fallo en la seleccion");
	  $consulta =mysql_fetch_array($consulta);
	  $materiales=round($consulta[0],2);
	  print("<p>Valoraci&oacute;n media de los materiales: ".$materiales."<br/></p>");

	
	?>
	<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            backgroundColor:'rgba(255,255,255,0.1)'
        },

        title: {
            text: 'Grafica estadistica por tipos'
        },

        xAxis: {
            categories: ['Servicio', 'Instalaciones', 'Materiales']
        },

        yAxis: {
            allowDecimals: true,
            min: 0,
            max:10,
            title: {
                text: 'Puntuacion media preguntas'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },
        series: [{
            name: 'Servicio',
            data: [<?php echo $servicio ?>,],     
            stack: 'Servicio'
        }, {
            name: 'Instalaciones',
            data: [<?php echo $instalaciones ?>,],
            stack: 'Instalaciones'
        }, {
            name: 'Materiales',
            data: [<?php echo $materiales ?>,],
            stack: 'Materiales'
        },]
    });
});
		</script>
	
	<div id="container" style="min-width: 250px; height: 400px; margin: 0 auto"></div>
	<?php 
    
    //valoracion media de cada pregunta
    print("<h2>Media de preguntas respondidas por el ".$persona."</h2>");
    $instruccion = "select * 
					from preguntas 
					where id not in 
						(SELECT id 
						FROM preguntas 
						WHERE id_dimensiones =1 
						or id_dimensiones=5);";
											
	$consulta = mysql_query($instruccion,$conexion);
    $filas = mysql_num_rows($consulta);
    for($i = 0; $i < $filas; $i++)
    {
      $res = mysql_fetch_array($consulta);
      $id = $res['id'];
					 
	$instruccion= "select avg(respuesta) 
					from respuestas 
					where id_preguntas=$id
					and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=1 
                      and respuesta = '$persona') 
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=2 
                      and respuesta = '$facultad') 
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=3 
                      and respuesta = '$biblioteca')
                    and id_encuestasrellenas in 
                    (select id_encuestasrellenas 
                      from respuestas 
                      where id_preguntas=4 
                      and respuesta = '$sexo')";
					  
					  
      $consulta2 = mysql_query($instruccion,$conexion);
      $consulta2 = mysql_fetch_array($consulta2);
      $media = round($consulta2[0],2);
      print('<p>'.$res['pregunta'].'": '.$media."<br/></p>");
	}
	  
  }
  else
  {
	print('<form action = "analisis.php" method = "POST">');
  
	for($i = 0;$i<$filas;$i++)
	{
	  $res = mysql_fetch_array($consulta);
	  
	  ////
	  if($res['id_Dimensiones'] == 1)
	  {
		echo '<p>'.($res['pregunta']."\t")."</p>";
		print('<select name = "s'.$i.'">');
		$consulta2 = mysql_query("select * from opciones where id_preguntas =".$res['id'],$conexion);
        $filas2 = mysql_num_rows($consulta2);
        for($j = 0; $j < $filas2; $j++){
          $res2 = mysql_fetch_array($consulta2);
          print('<option value="'.$res2['nombre'].'">'.$res2['nombre']."</option>");
        }
	  }
	  print("</select></br>");
	}
	echo '<div id="boton"'.('</br><input type="submit" name="enviar" value="Generar Informe">'."</div>");
    print("</form>");
    
   
  }
  
	//desconectamos
	mysql_close($conexion);
?>
</p>
</div>
</BODY>
</HTML>
