<!--Conexion a la base de datos-->
<?php
  $servidor="localhost";
  $usuario="root";
  $clave="";
  $baseDeDatos="chaotic";
    $enlace = mysqli_connect($servidor,$usuario,$clave,$baseDeDatos);

      if(!$enlace){
    echo"error en la conexion";}
?>

<!--Hinicio del codigo html-->
<!DOCTYPE html>
<html lang="es">
<head>

<!--Conexion con el js-->
    <script src="jquery.js"></script>
    <title>Formulario</title>
</head>
<body>
<center>

<!--Formulario de envio de la pagina web-->
    <br>
<form name="" method="POST">
<table width="359" border="10" align="center" bordercolor="orangered">
  <tbody>
    <tr bgcolor="lightblue" style="font-size: 24px">
      <td colspan="2">Para registrarse en nuestro sevidor de minecraft, le pedimos que llene los siguientes datos,
           despues recivira una notificacion en su correo</td>
      </tr>
    <tr bgcolor="lightgoldenrodyellow" style="font-size: 24px">
      <td width="159"><label for="textfield">Matricula:</label></td>
      <td width="166"><input type="text" name="m" id="m"></td>
    </tr>
    <tr bgcolor="lightgoldenrodyellow" style="font-size: 24px">
      <td><label for="textfield2">Nombre y apellidos:</label></td>
      <td><input type="text" name="n" id="n" ></td>
    </tr>
    <tr bgcolor="lightgoldenrodyellow" style="font-size: 24px">
        <td><label for="textfield3">Grupo:</label></td>
        <td><input type="text" name="g" id="g"></td>
      </tr>
    <tr bgcolor="lightgoldenrodyellow" style="font-size: 24px">
      <td><label for="textfield3">Correo electronico:</label></td>
      <td><input type="text" name="c" id="c"></td>
    </tr>
    <tr bgcolor="lightgoldenrodyellow" style="font-size: 24px">
        <td><label for="textfield3">Comentario:</label></td>
        <td><input type="text" name="co" id="co"></td>
      </tr>
      <tr bgcolor="lightgoldenrodyellow" style="font-size: 24px">
        <td><label for="textfield3">Contraseña:</label></td>
        <td><input type="text" name="con" id="con"></td>
      </tr>

<!--Boton de envio-->
    <tr bgcolor="lightgoldenrodyellow" style="text-align: center">
      <td colspan="2"><input type="submit" name="enviar" id="en" value="enviar"></td>
      </tr>
  </tbody>
</table>
</form>

<!--Boton de buscar-->
<br>
<input type="submit" name="Buscar" id="bu" value="buscar">
<br>

<!--Titulos de la tabla de datos-->
<div class="table">
<br>
<table border="10" align="center" bordercolor="orangered">
<tr>
  <th bgcolor="lightblue">Matricula</th>
  <th bgcolor="lightblue">Nombre</th>
  <th bgcolor="lightblue">Grupo</th>
  <th bgcolor="lightblue">Correo</th>
  <th bgcolor="lightblue">Comentario</th>
  <th bgcolor="lightblue">Contraseña</th>
  <th bgcolor="lightblue">Operacion</th>
</tr>

<!--Codigo para el llenado de la tabla de datos y su orden-->
<?php
crearTabla($enlace);
function crearTabla($enlace){
$consulta = "SELECT * FROM formulario ";
$ejecutarConsulta = mysqli_query($enlace,$consulta);
$verFilas = mysqli_num_rows($ejecutarConsulta);
$fila = mysqli_fetch_array($ejecutarConsulta);
if(!$ejecutarConsulta){
  echo"Error en la consulta";
}else{
  if($verFilas==0){
  echo"   <tr>
            <td>Sin registros</td>
            <td>Sin registros</td>
            <td>Sin registros</td>
            <td>Sin registros</td>
            <td>Sin registros</td>
            <td>Sin registros</td>
            <td>No aplica</td>
          </tr>";
  }else{
    for($i=0; $i<=$fila; $i++){
      echo'
        <form name="'.$fila[0].'" method="POST">
        <tr bgcolor="lightgoldenrodyellow" style="text-align: center">
          <td>
          <input type="text" name="m" value="'.$fila[0].'" id="m" readonly></td>
          </td>
          <td>'.$fila[1].'</td>
          <td>'.$fila[2].'</td>
          <td>'.$fila[3].'</td>
          <td>'.$fila[4].'</td>
          <td>'.$fila[5].'</td>
          <td><input type="submit" name="Eliminar" id="bor" value="Eliminar"><td>
        </tr>
        </form>
      ';
      $fila = mysqli_fetch_array($ejecutarConsulta);

    }

  }
}
}
?>
</table>
</div>
</center>

<!--Script para ocultar y mostrar la tabla de datos-->
<script>
  $(document).ready(function(){
  $('.table').hide();
  });
  $('#bu').on('click' ,function(){
  $('.table').show();
  });
</script>

</body>
</html>

<!--Codigo para el envio y eliminacion de datos de la base de datos-->
<?php
  if(isset($_POST['enviar'])){
	$Matricula=$_POST["m"];
	$Nombre=$_POST["n"];
	$Grupo=$_POST["g"];
  $Correo=$_POST["c"];
  $Comentario=$_POST["co"];
  $Contraseña=$_POST["con"];

		$insertarDatos = "INSERT INTO formulario VALUES ('$Matricula','$Nombre','$Grupo','$Correo','$Comentario','$Contraseña')";

		$ejecutarInsertar = mysqli_query($enlace,$insertarDatos);

    header("Refresh:0");

		if(!$ejecutarInsertar){
				echo"error en sql";
		}
	}

  if(isset($_POST['Eliminar'])){
    $Matricula=$_POST["m"];

  
      $insertarDatos = "DELETE from formulario WHERE Matricula = '$Matricula'";
  
      $ejecutarInsertar = mysqli_query($enlace,$insertarDatos);

      header("Refresh:0");
  
      if(!$ejecutarInsertar){
          echo"error en sql";
      }
    }
?>