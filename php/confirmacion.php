<!DOCTYPE html>
<html>
<head>
	<title>Rutenio Recursos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/maincss.css">
	<link rel="shortcut icon" href="../imagenes/favicon.png"/>
</head>
<body><center>

	<?php
	session_start();

	$idusuario=$_SESSION['id'];
	$conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
	$q = "SELECT usu_nombre from usuario WHERE usu_id='$idusuario'";
	$resultados = mysqli_query($conexion, $q);

	if(mysqli_num_rows($resultados)>0){
		$usuario= mysqli_fetch_array($resultados);
		echo "<br><br>";
		echo "Bienvenido de nuevo $usuario[usu_nombre]";
		echo "<form method='POST' action='../index.php'>";
		echo "<input type='hidden' name='login' value='true'>";
		echo "<br>";
		echo "<input type='submit' value='Continuar'>";
		echo "</form>";
	}
	?>
	<header id="main-header">
	<center><a id="#" href="#">
      <img align="center" src="../imagenes/logo.png">
    </a></center> <!-- / #logo-header -->
  </header><!-- / #main-header -->
  <br><br>
  <img align="center" width="300" src="../imagenes/bienvenido.png">

</center></body>
</html>