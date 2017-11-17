<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Rutenio Recursos</title>
  <link rel="stylesheet" href="../css/maincss.css">
  <link rel="shortcut icon" href="../imagenes/favicon.png"/>
  <script type="text/javascript" src="../js/javascript.js"></script>
</head>
<body>
  <header id="main-header">
    
    <a id="logo-header" href="#">
      <img src="../imagenes/logo.png">
    </a> <!-- / #logo-header -->
    <nav>
    </nav><!-- / nav -->
  </header><!-- / #main-header -->
  </section>
  <section id="contenidopassword">
    <article>
      <header>
      </header> 
      <div class="content_pass">	
	<?php
		if (isset($_POST['olvidar'])) {
			echo "<center>";
			echo "<br>";
			echo "<form method='POST' action='cambiar_password.php'>";
			echo "<label>Escriba a continuación su e-mail:<br><br></label>";
			echo "<input id='pass' type='text' name='email' placeholder='Escriba aquí su email'><br><br>";
			echo "<label>¿Cuál es el nombre de su primera mascota?<br><br></label>";
			echo "<input id='pass' type='password' name='respuesta' placeholder='Escriba aquí el nombre'><br><br>";
			echo "<input type='submit' name='enviar' value='Comprobar'><br>";
			echo "</form>";
			echo "<br><a href='../index.php'><button>Volver a la página principal</button></a>";
			echo "</center>";
		}
		if (isset($_POST['enviar'])) {
			$email=$_POST['email'];
			$mascota=$_POST['respuesta'];
			$conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
        	mysqli_query($conexion, "SET NAMES 'utf8'");

        	$q="SELECT usu_seguridad FROM usuario WHERE usu_correo='$email' AND usu_seguridad='$mascota'";
        	
        	$resultados = mysqli_query($conexion, $q);

        	if (mysqli_num_rows($resultados)>0) {
        		echo "<center>";
				echo "<br>";
        		echo "<form method='POST' action='cambiar_password.php'>";
				echo "<label>Elija su nueva contraseña:<br><br>";
				echo "<input id='pass' type='password' name='password' placeholder='Escriba su nueva contraseña' required><br><br>";
				echo "<input id='pass' type='password' name='password2' placeholder='Vuelva a escribir su contraseña' required><br><br>";
				echo "<input type='hidden' name='mail' value='$email'>";
				echo "<input type='hidden' name='respuesta' value='$mascota'>";
				echo "<input type='submit' name='nuevopassword' value='Continuar'><br>";
				echo "</form>";
				echo "</center>";
        	}else{
        		echo "<center>";
				echo "<br>";
        		echo "Su email o su respuesta a la pregunta de seguridad son incorrectos<br>";
        		echo "<br>";
        		echo "<form method='POST' action='cambiar_password.php'>";
        		echo "<input type='submit' name='olvidar' value='Volver'><br>";
				echo "</form>";
				echo "</center>";
        	}
		}

		if (isset($_POST['nuevopassword'])) {
			$pass1=$_POST['password'];
			$pass2=$_POST['password2'];
			$email=$_POST['mail'];
			if ($pass1==$pass2) {
				$conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
        		mysqli_query($conexion, "SET NAMES 'utf8'");
				$q="UPDATE usuario SET usu_password='$pass1' WHERE usu_correo='$email'";
				$resultados = mysqli_query($conexion, $q);
				echo "<center>";
				echo "<br>";
				echo "Ha cambiado su contraseña con éxito<br><br>";
				echo "<a href='../index.php'><button>Volver</button></a>";
				echo "</center>";
			}else{
				$mascota=$_POST['respuesta'];
				echo "<center>";
				echo "<br>";
				echo "Las contraseñas introducidas no se corresponden, vuelva a intentarlo<br><br>";
				echo "<form method='POST' action='cambiar_password.php'>";
				echo "<input type='hidden' name='email' value='$email'>";
				echo "<input type='hidden' name='respuesta' value='$mascota'>";
				echo "<input type='submit' name='enviar' value='Volver'><br>";
				echo "</form>";
				echo "</center>";
			}
		}
	?>
</div>
  </div>
</article> <!-- /article -->
</section> <!-- / #main-content -->
<!-- <footer id="main-footer">
  <p>&copy; 2017 <a href="#">RutenioPR02</a></p>
</footer> --> <!-- / #main-footer -->
</body>
</html>