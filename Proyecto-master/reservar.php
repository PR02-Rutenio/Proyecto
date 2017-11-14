<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	
	$conexion=mysqli_connect("localhost", "root", "", "bbdd_rutenio");

	$idtipo=$_REQUEST['id'];
	
	$idusuario=$_REQUEST['usu'];
	
	$q = "UPDATE recurso SET rec_disponibilidad='0', usu_id='$idusuario', rec_fecha=now() WHERE rec_id='$idtipo'";
	
	$reservar = mysqli_query($conexion, $q);

	

	echo "Funciona";


	header('Location: filtro1.php?login=true&id='.$idusuario);

	?>
</body>
</html>