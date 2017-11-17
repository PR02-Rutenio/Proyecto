<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Rutenio Recursos</title>
  <link rel="stylesheet" href="css/maincss.css">
  <link rel="shortcut icon" href="imagenes/favicon.png"/>
  <script type="text/javascript" src="js/javascript.js"></script>
  <script type="text/javascript" src="js/login.js"></script>
</head>
<body>
  <SCRIPT LANGUAGE="JavaScript">
    function no_login () {
      alert ("Necesita iniciar sesión para notificar una incidencia!");
    }
  </SCRIPT>
  <header id="main-header">
    <a id="logo-header">
      <img src="imagenes/logo.png">
    </a>
    <div class="login">
      <nav>
        <ul>
          <?php
          if (isset($_POST['login'])) {
            session_start();
          }
          if (isset($_POST['login'])) {
            echo "<li><a href='php/desconectar.php'>Cerrar sesión 🔑</a></li>";
          }else {
            echo "<li><a href='#resultado' onclick='funcionInicioSesion()'>Iniciar sesión 🔑</a></li>";
          }
          ?>
        </ul>
      </nav>
    </div>
    <div class="recursos">
      <nav>
        <ul>
          <?php
          if (!isset($_POST['login'])) {
            echo "<li><a href='index.php'>Recursos</a></li>";
          }else{
            // echo "<button<li><a href='index.php'>Recursos</a></li>";
            echo "<form action='index.php' method='POST'>";
            echo "<button type='submit' class='btn btn-link'>Recursos</button>";
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
          if (!isset($_POST['login'])) {
          }else{
            echo "<form action='php/mis_reservas.php' method='POST'>";
            echo "<button type='submit' class='btn btn-link'>Mis reservas</button>";
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
          if (!isset($_POST['login'])) {
          }else{
            echo "<form action='php/mis_incidencias.php' method='POST'>";
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
          if (!isset($_POST['login'])) {
          }else{
            echo "<form action='php/incidencia.php' method='POST'>";
            echo "<button type='submit' class='btn btn-link'>Reportar incidencia</button>";
            echo "<input type='hidden' name='login' value='true'>";
            echo "</form>";
          }
          ?>
        </ul>
      </nav><!-- / nav -->
    </div> 
    <div class="log">
      <nav>
        <ul>
          <div id="resultado" class="modalmask">
            <div class="modalbox movedown" id="InicioContent">
              <a href="#close" title="Close" class="close">X</a>
              <h2 id="tituloInicio">Iniciar sesión 🔑</h2>
              <div id="contenidoInicio">
                <form action="php/login.php" method="POST">
                  <ul>
                    <li>
                      <label class="description" for="element_1">Correo electrónico 📧</label>
                      <input id="element_1" name="email" class="element text medium" type="email" maxlength="255" placeholder="tucorreo@tudominio.com" value=""/> 
                    </li>   
                    <li>
                      <label class="description" for="element_2">Contraseña 🔒</label>
                      <input id="element_2" name="pwd" class="element text medium" type="password" maxlength="255" placeholder="●●●●●●●●●●" value=""/>  
                    </li>
                    <br>
                    <li class="buttons">
                      <input type="hidden" name="form_id" value="58760" />
                      <center>
                        <input id="saveForm" class="buttonSubmit" type="submit" name="submit" value="Acceder"/>
                      </center>
                    </li>
                  </ul>
                </form>
                <ul>
                  <form method="POST" action="php/cambiar_password.php">
                    <input type="submit"  name="olvidar" value="¿Ha olvidado su contraseña?">
                  </form>
                </ul>
              </div>
            </div>
          </div>
        </ul>
      </nav>
    </div>
    <nav>
      <?php
      if ((isset($_POST['devolver']))||(isset($_POST['reservar']))) {
        if (isset($_POST['reservar'])) {
          $conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
          $idrecurso=$_POST['idrecurso'];
          $idusuario=$_SESSION['id'];
          $q="SELECT rec_usado FROM recurso WHERE rec_id='$idrecurso'";
          $consulta=mysqli_query($conexion, $q);
          while ($contador=mysqli_fetch_array($consulta)) {
            $veces=$contador['rec_usado'];
            $veces=$veces+1;
            $q = "UPDATE recurso SET rec_usado='$veces' WHERE rec_id='$idrecurso'";
            $count = mysqli_query($conexion, $q);
          }
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
    </nav><!-- / nav -->
  </header><!-- / #main-header -->
  <section id="main-menu">
    <article>
      <header>
      </header> 
      <div class="content">
        <?php
        $conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
        mysqli_query($conexion, "SET NAMES 'utf8'");       
        $q = "SELECT DISTINCT(rec_tipo) from recurso ORDER BY rec_tipo";
        $resultados = mysqli_query($conexion, $q);
        if(mysqli_num_rows($resultados)>0){
          echo "<form action='index.php' method='POST'>";
          echo "Busqueda por tipo";
          echo "<hr>";
          echo "Tipo de recurso:";
          echo "<select name=tipo id='tipo'>";
          echo "<option>Cualquiera</option>";
          while ($tipo= mysqli_fetch_array($resultados)){
          //Creamos la variable opciones para distinguir la sala de teoría y las salas del resto y así poder trabajar con sus ids en javascript
            $opciones=$tipo['rec_tipo'];
            if($opciones=="Aula de teoría"){
              echo "<option value='teoria'>$tipo[rec_tipo]</option>";
            }elseif($opciones=="Sala"){
              echo "<option value='sala'>$tipo[rec_tipo]</option>";
            }else{
              echo "<option>$tipo[rec_tipo]</option>";
            }
          }
          echo "</select>";
        }
//Creamos este span donde se mostrará otro select en caso en el que se haya elegido las opciones de "sala de teoría" o "sala"
        echo "<span id='span'></span>";
        echo "Disponibilidad del recurso";
        echo "<select name='disponible'>";
        echo "<option>Cualquiera</option>";
        echo "<option>Disponible</option>";
        echo "<option>Reservado</option>";
        $q="SELECT rec_incidencia_estado FROM recurso WHERE rec_incidencia_estado='1'";
        $consulta=mysqli_query($conexion, $q);
        if (mysqli_num_rows($consulta)>0) {
          echo "<option>Incidencias</option>";
        }
        echo "</select>";
        if ((isset($_POST['login']))||(isset($_SESSION['id']))) {
          echo "<input type='hidden' name='login' value='true'>";
        }
        echo "<br>";
        echo "<input type='checkbox' name='popularidad'>";
        echo "<label>Filtrar por popularidad</label><br>";
        echo"<input type='submit' name='Enviar' value='Buscar'>";
        echo "</form>"
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
        $conexion=mysqli_connect("sql200.mipropia.com", "mipc_21061854", "qweQWE123", "mipc_21061854_bbdd_rutenio");
        mysqli_query($conexion, "SET NAMES 'utf8'");
        if(isset($_POST['Enviar'])){
          $reparacion=false;
      //Definimos los POST en variables
          if(isset($_POST['tipo'])){
            $tiporecurso=$_POST['tipo'];
          }
          if(isset($_POST['subtipo'])){
            $subtiporecurso=$_POST['subtipo'];
          }else{
            $subtiporecurso="";
          }
          if (isset($_POST['disponible'])) {
            $disponible=$_POST['disponible'];
          }
          if (isset($_POST['popularidad'])) {
            $popularidad="ORDER BY rec_usado DESC";
          }else{
            $popularidad="";
          }
      //BUSQUEDAS

      //1 - Buscar cualquiera en ambos select
          if(($tiporecurso=="Cualquiera")&&($disponible=="Cualquiera")){
          	if (isset($_POST['popularidad'])) {
              $q = "SELECT * from recurso ORDER BY rec_usado DESC";
            }else{
              $q = "SELECT * from recurso ORDER BY rec_tipo";
            }
            $resultados = mysqli_query($conexion, $q);
        //A partir de esta búsqueda se muestran los resultados encontrados
            if(mysqli_num_rows($resultados)>0){
              if (!isset($_SESSION)) {
                session_start();
              }
              while($recurso = mysqli_fetch_array($resultados)){
                echo "<div id='div-recurso'>";
            echo "<div class='recurso-img'>";
            echo "<img src='imagenes/$recurso[rec_img]'>";
            echo "</div>";
            echo "<div class='recurso-cont'>";
            echo "Nombre: $recurso[rec_nombre]<br>";
            $recursoid=$recurso['rec_id'];
            $dispo=$recurso['rec_disponibilidad'];
            $incidencia=$recurso['rec_incidencia_estado'];
            if($incidencia==0){
              if ($dispo==0) {
                echo "Estado: RESERVADO <br>";
                $j="SELECT usu_nombre, usu_apellido FROM usuario INNER JOIN recurso ON recurso.usu_id =usuario.usu_id WHERE rec_disponibilidad=0 AND rec_id='$recursoid'";
                $nombrefk = mysqli_query($conexion, $j);
                $nombre = mysqli_fetch_array($nombrefk);
                echo "Reservado por: $nombre[usu_nombre] $nombre[usu_apellido]<br>";
              }else{
                echo "Estado: DISPONIBLE <br>";
              }
            }
            if($incidencia==1){
              echo "Estado: EN REPARACIÓN<br>";
              $reparacion=true;
              echo "Incidencia: $recurso[rec_incidencia]<br>";
            }else{
              $reparacion=false;
            }
            $fecha=$recurso['rec_fecha'];
            if (($fecha!="0000-00-00 00:00:00")&&($incidencia==0)) {
              echo "Última vez reservado: $fecha<br>";
            }elseif (($fecha!="0000-00-00 00:00:00")&&($incidencia==1)) {
              echo "Con incidencia desde: $fecha<br>";
            }
            echo "Veces usado: $recurso[rec_usado]<br><br>";
            if (((isset($_POST['login']))||(isset($_SESSION['id'])))&&($dispo==1)&&($reparacion==false)) {
              $usuario=$_SESSION['id'];
              echo "<form method='POST' action='index.php'>";
              echo "<input type='hidden' name='login' value='true'>";
              echo "<input type='hidden' name='idrecurso' value='$recursoid'>";
              echo "<input type='submit' name='reservar' value='Reservar'>";
              echo "</form>";
            }
            //Si hemos hecho el login de usuario y el recurso está ocupado, no mostramos la opción de reservar
            if (((isset($_POST['login']))||(isset($_SESSION['id'])))&&($dispo==0)&&($reparacion==false)) {
              $usuario=$_SESSION['id'];
              $j="SELECT usu_id FROM recurso WHERE rec_id='$recursoid'";
              $usuariofk = mysqli_query($conexion, $j);
              $idusuario = mysqli_fetch_array($usuariofk);
              $id=$idusuario['usu_id'];
              //Comprobamos que el usuario logeado es el mismo usuario quien ha hecho la reserva, si es así mostramos la opción de devolver el recurso
              if ($id==$usuario) {
                echo "<form method='POST' action='index.php'>";
                echo "<input type='hidden' name='login' value='true'>";
                echo "<input type='hidden' name='idrecurso' value='$recursoid'>";
                echo "<input type='submit' name='devolver' value='Devolver'>";
                echo "</form>";
              } 
            }
            echo "</div>";
            echo "</div>";
          }//fin del while
        }else{
          //En el caso en que esta búsqueda no devuelva un resultado, mostramos un mensaje de error:
          echo "Lo sentimos, no hemos podido encontrar lo que estaba buscando";
        }

      }//Fin busqueda de tipo:cualquiera y disponible:cualquiera

      //2- Buscar ambos select
      $string="";
      $string1="";
      $string2="";

      if ($tiporecurso!="Cualquiera") {

        $string="WHERE rec_tipo='$tiporecurso'";

        if ($tiporecurso=="teoria") {
          $string="WHERE rec_tipo='Aula de teoría'";
        }

        if ($tiporecurso=="sala") {
          $string="WHERE rec_tipo='Sala'";
        }

        if ($subtiporecurso!="") {
          if ($subtiporecurso=="Cualquiera") {
            $string1="";
          }else{
            $string1=" AND rec_nombre LIKE '%$subtiporecurso%'";
          }
        }else{
          $string1="";
        }

        if ($disponible=="Disponible") {
          $string2="AND rec_disponibilidad='1' AND rec_incidencia_estado='0'";
          
        }
        if($disponible=="Reservado"){
          $string2="AND rec_disponibilidad='0' AND rec_incidencia_estado='0'";
        }

        if($disponible=="Incidencias"){
          $string2="AND rec_incidencia_estado='1'";
        }

        $q="SELECT * FROM recurso $string $string1 $string2 $popularidad";
        
        $resultados = mysqli_query($conexion, $q);

        if(mysqli_num_rows($resultados)>0){
          if (!isset($_SESSION)) {
            session_start();
          }
          while($recurso = mysqli_fetch_array($resultados)){
            echo "<div id='div-recurso'>";
            echo "<div class='recurso-img'>";
            echo "<img src='imagenes/$recurso[rec_img]'>";
            echo "</div>";
            echo "<div class='recurso-cont'>";
            echo "Nombre: $recurso[rec_nombre]<br>";
            $recursoid=$recurso['rec_id'];
            $dispo=$recurso['rec_disponibilidad'];
            $incidencia=$recurso['rec_incidencia_estado'];
            if($incidencia==0){
              if ($dispo==0) {
                echo "Estado: RESERVADO <br>";
                $j="SELECT usu_nombre, usu_apellido FROM usuario INNER JOIN recurso ON recurso.usu_id =usuario.usu_id WHERE rec_disponibilidad=0 AND rec_id='$recursoid'";
                $nombrefk = mysqli_query($conexion, $j);
                $nombre = mysqli_fetch_array($nombrefk);
                echo "Reservado por: $nombre[usu_nombre] $nombre[usu_apellido]<br>";
              }else{
                echo "Estado: DISPONIBLE <br>";
              }
            }
            if($incidencia==1){
              echo "Estado: EN REPARACIÓN<br>";
              $reparacion=true;
              echo "Incidencia: $recurso[rec_incidencia]<br>";
            }else{
              $reparacion=false;
            }
            $fecha=$recurso['rec_fecha'];
            if (($fecha!="0000-00-00 00:00:00")&&($incidencia==0)) {
              echo "Última vez reservado: $fecha<br>";
            }elseif (($fecha!="0000-00-00 00:00:00")&&($incidencia==1)) {
              echo "Con incidencia desde: $fecha<br>";
            }
            echo "Veces usado: $recurso[rec_usado]<br><br>";
            if (((isset($_POST['login']))||(isset($_SESSION['id'])))&&($dispo==1)&&($reparacion==false)) {
              $usuario=$_SESSION['id'];
              echo "<form method='POST' action='index.php'>";
              echo "<input type='hidden' name='login' value='true'>";
              echo "<input type='hidden' name='idrecurso' value='$recursoid'>";
              echo "<input type='submit' name='reservar' value='Reservar'>";
              echo "</form>";
            }
            //Si hemos hecho el login de usuario y el recurso está ocupado, no mostramos la opción de reservar
            if (((isset($_POST['login']))||(isset($_SESSION['id'])))&&($dispo==0)&&($reparacion==false)) {
              $usuario=$_SESSION['id'];
              $j="SELECT usu_id FROM recurso WHERE rec_id='$recursoid'";
              $usuariofk = mysqli_query($conexion, $j);
              $idusuario = mysqli_fetch_array($usuariofk);
              $id=$idusuario['usu_id'];
              //Comprobamos que el usuario logeado es el mismo usuario quien ha hecho la reserva, si es así mostramos la opción de devolver el recurso
              if ($id==$usuario) {
                echo "<form method='POST' action='index.php'>";
                echo "<input type='hidden' name='login' value='true'>";
                echo "<input type='hidden' name='idrecurso' value='$recursoid'>";
                echo "<input type='submit' name='devolver' value='Devolver'>";
                echo "</form>";
              } 
            }
            echo "</div>";
            echo "</div>";

          }//fin del while
        }else{
          echo "Lo sentimos, no hemos podido encontrar su búsqueda";
        }
      }//Fin de la segunda busqueda

      if (($tiporecurso=="Cualquiera")&&($disponible!="Cualquiera")) {

        if ($disponible=="Disponible") {
          $string2="rec_disponibilidad='1' AND rec_incidencia_estado='0'";
          
        }
        if($disponible=="Reservado"){
          $string2="rec_disponibilidad='0' AND rec_incidencia_estado='0'";
        }

        if($disponible=="Incidencias"){
          $string2="rec_incidencia_estado='1'";
        }

        $q="SELECT * FROM recurso WHERE $string2 $popularidad";

        $resultados = mysqli_query($conexion, $q);

        if(mysqli_num_rows($resultados)>0){
          while($recurso = mysqli_fetch_array($resultados)){
            echo "<div id='div-recurso'>";
            echo "<div class='recurso-img'>";
            echo "<img src='imagenes/$recurso[rec_img]'>";
            echo "</div>";
            echo "<div class='recurso-cont'>";
            echo "Nombre: $recurso[rec_nombre]<br>";
            $recursoid=$recurso['rec_id'];
            $dispo=$recurso['rec_disponibilidad'];
            $incidencia=$recurso['rec_incidencia_estado'];
            if($incidencia==0){
              if ($dispo==0) {
                echo "Estado: RESERVADO <br>";
                $j="SELECT usu_nombre, usu_apellido FROM usuario INNER JOIN recurso ON recurso.usu_id =usuario.usu_id WHERE rec_disponibilidad=0 AND rec_id='$recursoid'";
                $nombrefk = mysqli_query($conexion, $j);
                $nombre = mysqli_fetch_array($nombrefk);
                echo "Reservado por: $nombre[usu_nombre] $nombre[usu_apellido]<br>";
              }else{
                echo "Estado: DISPONIBLE <br>";
              }
            }
            if($incidencia==1){
              echo "Estado: EN REPARACIÓN<br>";
              $reparacion=true;
              echo "Incidencia: $recurso[rec_incidencia]<br>";
            }else{
              $reparacion=false;
            }
            $fecha=$recurso['rec_fecha'];
            if (($fecha!="0000-00-00 00:00:00")&&($incidencia==0)) {
              echo "Última vez reservado: $fecha<br>";
            }elseif (($fecha!="0000-00-00 00:00:00")&&($incidencia==1)) {
              echo "Con incidencia desde: $fecha<br>";
            }
            echo "Veces usado: $recurso[rec_usado]<br><br>";
            if (((isset($_POST['login']))||(isset($_SESSION['id'])))&&($dispo==1)&&($reparacion==false)) {
              $usuario=$_SESSION['id'];
              echo "<form method='POST' action='index.php'>";
              echo "<input type='hidden' name='login' value='true'>";
              echo "<input type='hidden' name='idrecurso' value='$recursoid'>";
              echo "<input type='submit' name='reservar' value='Reservar'>";
              echo "</form>";
            }
            //Si hemos hecho el login de usuario y el recurso está ocupado, no mostramos la opción de reservar
            if (((isset($_POST['login']))||(isset($_SESSION['id'])))&&($dispo==0)&&($reparacion==false)) {
              $usuario=$_SESSION['id'];
              $j="SELECT usu_id FROM recurso WHERE rec_id='$recursoid'";
              $usuariofk = mysqli_query($conexion, $j);
              $idusuario = mysqli_fetch_array($usuariofk);
              $id=$idusuario['usu_id'];
              //Comprobamos que el usuario logeado es el mismo usuario quien ha hecho la reserva, si es así mostramos la opción de devolver el recurso
              if ($id==$usuario) {
                echo "<form method='POST' action='index.php'>";
                echo "<input type='hidden' name='login' value='true'>";
                echo "<input type='hidden' name='idrecurso' value='$recursoid'>";
                echo "<input type='submit' name='devolver' value='Devolver'>";
                echo "</form>";
              }
            }
            echo "</div>";
            echo "</div>";
          }//fin del while
        }else{
          echo "Lo sentimos, no hemos podido encontrar su búsqueda";
        }
        }//fin de la tercera consulta
    //En el caso en el que no le hayamos dado click a enviar y por lo tanto no hayamos elegido ningún filtro se muestran todos los recursos
      }else{
        $q = "SELECT * from recurso ORDER BY rec_tipo";
        $resultados = mysqli_query($conexion, $q);
        if(mysqli_num_rows($resultados)>0){
          while($recurso = mysqli_fetch_array($resultados)){
            echo "<div id='div-recurso'>";
            echo "<div class='recurso-img'>";
            echo "<img src='imagenes/$recurso[rec_img]'>";
            echo "</div>";
            echo "<div class='recurso-cont'>";
            echo "Nombre: $recurso[rec_nombre]<br>";
            $recursoid=$recurso['rec_id'];
            $dispo=$recurso['rec_disponibilidad'];
            $incidencia=$recurso['rec_incidencia_estado'];
            if($incidencia==0){
              if ($dispo==0) {
                echo "Estado: RESERVADO <br>";
                $j="SELECT usu_nombre, usu_apellido FROM usuario INNER JOIN recurso ON recurso.usu_id =usuario.usu_id WHERE rec_disponibilidad=0 AND rec_id='$recursoid'";
                $nombrefk = mysqli_query($conexion, $j);
                $nombre = mysqli_fetch_array($nombrefk);
                echo "Reservado por: $nombre[usu_nombre] $nombre[usu_apellido]<br>";
              }else{
                echo "Estado: DISPONIBLE <br>";
              }
            }
            if($incidencia==1){
              echo "Estado: EN REPARACIÓN<br>";
              $reparacion=true;
              echo "Incidencia: $recurso[rec_incidencia]<br>";
            }else{
              $reparacion=false;
            }
            $fecha=$recurso['rec_fecha'];
            if (($fecha!="0000-00-00 00:00:00")&&($incidencia==0)) {
              echo "Última vez reservado: $fecha<br>";
            }elseif (($fecha!="0000-00-00 00:00:00")&&($incidencia==1)) {
              echo "Con incidencia desde: $fecha<br>";
            }
            echo "Veces usado: $recurso[rec_usado]<br><br>";
            if (((isset($_POST['login']))||(isset($_SESSION['id'])))&&($dispo==1)&&($reparacion==false)) {
              $usuario=$_SESSION['id'];
              echo "<form method='POST' action='index.php'>";
              echo "<input type='hidden' name='login' value='true'>";
              echo "<input type='hidden' name='idrecurso' value='$recursoid'>";
              echo "<input type='submit' name='reservar' value='Reservar'>";
              echo "</form>";
            }
            //Si hemos hecho el login de usuario y el recurso está ocupado, no mostramos la opción de reservar
            if (((isset($_POST['login']))||(isset($_SESSION['id'])))&&($dispo==0)&&($reparacion==false)) {
              $usuario=$_SESSION['id'];
              $j="SELECT usu_id FROM recurso WHERE rec_id='$recursoid'";
              $usuariofk = mysqli_query($conexion, $j);
              $idusuario = mysqli_fetch_array($usuariofk);
              $id=$idusuario['usu_id'];
              //Comprobamos que el usuario logeado es el mismo usuario quien ha hecho la reserva, si es así mostramos la opción de devolver el recurso
              if ($id==$usuario) {
                echo "<form method='POST' action='index.php'>";
                echo "<input type='hidden' name='login' value='true'>";
                echo "<input type='hidden' name='idrecurso' value='$recursoid'>";
                echo "<input type='submit' name='devolver' value='Devolver'>";
                echo "</form>";
              } 
            }
            echo "</div>";
            echo "</div>";
          }//fin del while
        }//fin del mysqli_num_rows
    }//fin del else (en el caso en que no hayamos hecho ninguna búsqueda)
    //fin else de la conexion
    ?>
  </div>
</article> <!-- /article -->
</section> <!-- / #main-content -->
<!-- <footer id="main-footer">
  <p>&copy; 2017 <a href="#">RutenioPR02</a></p>
</footer> --> <!-- / #main-footer -->
</body>
</html>