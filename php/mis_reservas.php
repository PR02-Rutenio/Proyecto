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
          
            echo "<form action='mis_incidencias.php' method='POST'>";
            echo "<button type='submit' class='btn btn-link'>Mis incidencias</button>";
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
        <?php
        if ((isset($_POST['devolver']))||(isset($_POST['reservar']))) {
          if (isset($_POST['reservar'])) {
            $conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
            $idrecurso=$_POST['idrecurso'];
            $idusuario=$_SESSION['id'];
            $q = "UPDATE recurso SET rec_disponibilidad='0', usu_id='$idusuario', rec_fecha=now() WHERE rec_id='$idrecurso'";
            $reservar = mysqli_query($conexion, $q);
            echo "<script type='text/javascript'>alert('Ha reservado el recurso correctamente');</script>";
          }elseif(isset($_POST['devolver'])){
            $conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
            $idrecurso=$_POST['idrecurso'];
            $q = "UPDATE recurso SET rec_disponibilidad='1', usu_id='9', rec_fecha=now() WHERE rec_id='$idrecurso'";  
            $devolver = mysqli_query($conexion, $q);
            echo "<script type='text/javascript'>alert('Ha devuelto el recurso correctamente');</script>";
          }
        }
        ?>
      </header> 
      <div class="content">
        <?php
        echo "<center>";
        echo "Mis reservas";
        echo "<hr>";
        $conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
        if(!$conexion){
          echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
          echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
          echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
          exit;
        }else{
          mysqli_query($conexion, "SET NAMES 'utf8'");
          session_start();
          $id=$_SESSION['id'];
          $sql="SELECT COUNT(rec_id) FROM recurso WHERE usu_id='$id' AND rec_incidencia_estado='0'";
          $rs = mysqli_query($conexion, $sql);
          $result = mysqli_fetch_array($rs);
          echo "Mostrando su reservas<br>";
          if ($result[0]==0) {
            echo "<br>";
            echo "Cuando haga una reserva podrá verla aquí<br>";  
          }else{
            echo "tiene un total de $result[0] reservas<br>";
          }
          echo"<form action='../index.php' method='POST'><input type='hidden' name='login' value='true'><input type='submit' value='Volver'></form>";
        }
        echo "</center>";
        ?>
      </div>
    </article> <!-- /article -->
  </section>
  <section id="main-content">
    <article>
      <header>
      </header> 
      <div class="content">
        <?php
        $usuario=$_SESSION['id'];

        $q="SELECT * FROM recurso WHERE usu_id='$usuario' AND rec_disponibilidad='0'";
        $sql = mysqli_query($conexion, $q);
        if (mysqli_num_rows($sql)>0) {

          while($incidencia = mysqli_fetch_array($sql)){

            echo "<div id='div-recurso'>";
            echo "<div class='recurso-img'>";
            echo "<img src='../imagenes/$incidencia[rec_img]'>";
            echo "</div>";
            echo "<div class='recurso-cont'>";
            echo "Nombre del recurso: $incidencia[rec_nombre]<br>";
            $disponibilidad=$incidencia['rec_disponibilidad'];
            $estado=$incidencia['rec_incidencia_estado'];
            if (($disponibilidad=="0")&&($estado=="1")) {
              echo "Estado del recurso: EN REPARACIÓN<br>";
              echo "Incidencia: $incidencia[rec_incidencia]<br>";
              echo "Con incidencia desde: $incidencia[rec_fecha]<br><br>";
            }elseif (($disponibilidad=="0")&&($estado=="0")) {
              echo "Estado del recurso: RESERVADO<br>";
              echo "Reservado desde: $incidencia[rec_fecha]<br><br>";
              echo "<form method='POST' action='mis_reservas.php'>";
              $recursoid=$incidencia['rec_id'];
              echo "<input type='hidden' name='idrecurso' value='$recursoid'>";
              echo "<input type='submit' name='devolver' value='Devolver'>";
              echo "</form>";
              echo "</div>";
              echo "</div>";
            }
          }
          
        }else{
          echo "<center><br>";
          echo "No tiene reservas sin incidencias, por lo que no se muestra ninguna de sus reservas";
          echo "</center><br>";
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