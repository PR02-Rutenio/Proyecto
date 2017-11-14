<!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body>
	<?php
	session_start();

	$okpass=false;
	$okemail=false;

	$conexion=mysqli_connect("localhost", "root", "", "bbdd_rutenio");

	$email=$_POST['email'];
	$password=$_POST['pwd'];

	$q = "SELECT * FROM usuario WHERE usu_correo = '$email'";
	
	$login = mysqli_query($conexion, $q);

	if (mysqli_num_rows($login)>0) {
		while ($usuario = mysqli_fetch_array($login)) {
			$pass_usu=$usuario['usu_password'];
			$email_usu=$usuario['usu_correo'];
			if ($pass_usu==$password) {
				$okpass=true;
			}
			if($email_usu==$email){
				$okemail=true;
			}
			if (($okpass==true)&&($okemail==true)) {
				$q = "SELECT usu_id FROM usuario WHERE usu_correo = '$email'";
	

				$id= mysqli_query($conexion, $q);

				$idusuario=mysqli_fetch_array($id);

				$iddeusuario=$idusuario['usu_id'];

				header('Location: filtro1.php?login=true&id='.$iddeusuario);
			}else{
				header('Location: login.html');
				session_destroy();
			}

		}
	}

	
	?>
</body>
</html>