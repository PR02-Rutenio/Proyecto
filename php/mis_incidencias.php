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
		<a id="logo-header">
			<img src="../imagenes/logo.png">
		</a> <!-- / #logo-header -->
		<div class="login">
			<nav>
				<ul>
					<?php
					echo "<li><a href='desconectar.php'>Cerrar sesión 🔑</a></li>";
					?>
				</ul>
			</nav>
		</div>
		<div class="recursos">
			<nav>
				<ul>
					<?php
            // echo "<button<li><a href='index.php'>Recursos</a></li>";
					echo "<form action='../index.php' method='POST'>";
					echo "<button type='submit' class='btn btn-link'>Recursos</button>";
					echo "<input type='hidden' name='login' value='true'>";
					echo "</form>";
					
					?>
				</ul>
			</nav>
		</div>  
		<div class="recursos">
			<nav>
				<ul>
					<?php
					echo "<form action='mis_reservas.php' method='POST'>";
					echo "<button type='submit' class='btn btn-link'>Mis reservas</button>";
					echo "<input type='hidden' name='login' value='true'>";
					echo "</form>";
					?>
				</ul>
			</nav><!-- / nav -->
		</div> 
		<div class="recursos">
			<nav>
				<ul>
					<?php
					if (!isset($_POST['login'])) {
					}else{
						echo "<form action='mis_incidencias.php' method='POST'>";
						echo "<button type='submit' class='btn btn-link'>Mis incidencias</button>";
						echo "<input type='hidden' name='login' value='true'>";
						echo "</form>";
					}
					?>
				</ul>
			</nav>
		</div>
		<div class="recursos">
			<nav>
				<ul>
					<?php
					echo "<form action='incidencia.php' method='POST'>";
					echo "<button type='submit' class='btn btn-link'>Reportar incidencia</button>";
					echo "<input type='hidden' name='login' value='true'>";
					echo "</form>";
					?>
				</ul>
			</nav><!-- / nav -->
		</div>
	</header><!-- / #main-header -->
	<section id="main-menu">
		<article>
			<header>
			</header> 
			<div class="content">
				<?php
				$conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
				if(!$conexion){
					echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
					echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
					echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
					exit;
				}else{
				//Hacemos que lo mostrado de la BDD se muestre sin errores
					mysqli_query($conexion, "SET NAMES 'utf8'");

					session_start();

					$usuario=$_SESSION['id'];
				//Buscamos los recursos que hayan sido reservados por el id del usuario logeado
					$q="SELECT usu_nombre, usu_apellido FROM usuario WHERE usu_id='$usuario'";
					$nombreusuario = mysqli_query($conexion, $q);
					$nombre = mysqli_fetch_array($nombreusuario);
					echo "<center>";
					echo "$nombre[usu_nombre] $nombre[usu_apellido]<br>";
					echo "<hr>";
					echo "A continuación se mostrarán las incidencias a su nombre y el estado de estas";
					echo "<form method='POST' action='../index.php'>";
					echo "<input type='hidden' name='id_usuario' value='$usuario'>";
					echo "<input type='hidden' name='login' value='true'>";
					
					echo "<input type='submit' value='Volver'>";
					echo "</center></form>";
					echo"</div>";
					echo "</article>"; 
					echo"</section>";
					echo"<section id='main-content'>";
					echo"<article>";
					echo "<header>";
					echo "</header>";
					echo "<div class='content'>";
					// echo "<center>";
					$q="SELECT * FROM recurso WHERE usu_id='$usuario' AND rec_incidencia_estado='0'";

					$inci = mysqli_query($conexion, $q);
					
					while($incidencia = mysqli_fetch_array($inci)){	
					//Aquí se muestran los recursos reservados en los que puede poner una incidencia
						echo "<div id='div-recurso'>";
						echo "<div class='recurso-img'>";
						echo "<img src='../imagenes/$incidencia[rec_img]'>";
						echo "</div>";
						echo "<div class='recurso-cont'>";
						echo "Nombre del recurso: $incidencia[rec_nombre]<br>";
						$disponibilidad=$incidencia['rec_disponibilidad'];
						$estado=$incidencia['rec_incidencia_estado'];
						echo "Estado del recurso: EN REPARACIÓN<br>";
						echo "Con incidencia desde: $incidencia[rec_fecha]<br><br>";
						$idrecurso=$incidencia['rec_id'];
						echo "</center>";
						echo "</div>";
						echo "</div>";

				}//fin del while




				echo "<center>";
				if(mysqli_num_rows($inci)<=0){
					//Si no tiene recursos reservados, no puede escribir una incidencia:
					echo "<br>";
					echo "Cuando tenga una incidencia, se mostrará aquí.<br>";
					echo "Ahora mismo no tiene ninguna incidencia.<br><br>";
				}//fin del if (si no tiene recursos reservados)

				echo "</center>";
		}//fin else de la conexion
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