	<?php

	session_start();
	$okpass=false;
	$okemail=false;

	$conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");

	$_SESSION['email']=$_POST['email'];
	$_SESSION['pwd']=$_POST['pwd'];;


	$email=$_SESSION['email'];
	$password=$_SESSION['pwd'];

	
	
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
				$_SESSION['id']=$iddeusuario;
				header('Location: confirmacion.php');
			}else{
				header('Location: ../index.php#resultado');
				session_destroy();
			}
		}
	}else{
		header('Location: ../index.php#resultado');
		session_destroy();
	}
	?>