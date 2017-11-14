<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Rutenio Recursos</title>
  <link rel="stylesheet" href="css/maincss.css">
  <link rel="shortcut icon" href="imagenes/favicon.png"/>
  <script type="text/javascript" src="js/javascript.js"></script>
</head>
<body>
  <header id="main-header">
    <div id="searchform">
      <input type="text" placeholder="Buscar">
      <button type="submit">Buscar</button>
    </div>
    <div class="log">
      <nav>
        <ul>
          <li><a href="#">Iniciar sesión</a></li>
        </ul>
      </nav>
    </div>
    <a id="logo-header" href="#">
      <img src="imagenes/logo.png">
    </a> <!-- / #logo-header -->
    <nav>
      <ul>
        <li><a href="#">Recursos</a></li>
      </ul>
    </nav><!-- / nav -->
  </header><!-- / #main-header -->



  <section id="main-menu">
    <article>
      <header>
      </header> 
      <div class="content">
        <?php
        $conexion=mysqli_connect("localhost", "root", "", "bbdd_rutenio");
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
        echo "</select>";
        echo "<br>";
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
        $conexion=mysqli_connect("localhost", "root", "", "bbdd_rutenio");
        mysqli_query($conexion, "SET NAMES 'utf8'");



        if(isset($_POST['Enviar'])){

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
      //BUSQUEDAS

      //1 - Buscar cualquiera en ambos select
          if(($tiporecurso=="Cualquiera")&&($disponible=="Cualquiera")){
            $q = "SELECT * from recurso ORDER BY rec_nombre";
            $resultados = mysqli_query($conexion, $q);
            if(mysqli_num_rows($resultados)>0){
              while($recurso = mysqli_fetch_array($resultados)){
                echo "<div class='recurso-img'>";
                echo "$recurso[rec_img]<br>";
                echo "</div>";
                echo "<div class='recurso'>";
                echo "Nombre: $recurso[rec_nombre]<br>";
                $recursoid=$recurso['rec_id'];
                echo "Tipo de recurso: $recurso[rec_tipo]<br>";
                $dispo=$recurso['rec_disponibilidad'];
                if ($dispo==0) {
                  echo "Disponibilidad: RESERVADO <br>";
                  $j="SELECT usu_nombre, usu_apellido FROM usuario INNER JOIN recurso ON recurso.usu_id =usuario.usu_id WHERE rec_disponibilidad=0 AND rec_id='$recursoid'";
                  $nombrefk = mysqli_query($conexion, $j);
                  $nombre = mysqli_fetch_array($nombrefk);
                  echo "Reservado por: $nombre[usu_nombre] $nombre[usu_apellido]<br>";
                }else{
                  echo "Disponibilidad: DISPONIBLE <br>";
                }
                echo "Última vez reservado: $recurso[rec_fecha]<br>";
                echo "Descripción: $recurso[rec_descripcion]<br>";
                if ((isset($_REQUEST['login']))&&($dispo==1)) {
                  $usuario=$_REQUEST['id'];
                  echo "<a href='reservar.php?id=$recursoid&usu=$usuario'>Reservar</a><br>";
                }
                echo "</div>";
              }
            }else{
              echo "Lo sentimos, no hemos podido encontrar su búsqueda";
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
          $string2="AND rec_disponibilidad='1'";
          
        }
        if($disponible=="Reservado"){
          $string2="AND rec_disponibilidad='0'";
        }

        $q="SELECT * FROM recurso $string $string1 $string2";
        
        $resultado = mysqli_query($conexion, $q);

        if(mysqli_num_rows($resultado)>0){

          while($recurso = mysqli_fetch_array($resultado)){
            echo "<div class='recurso-img'>";
            echo "$recurso[rec_img]<br>";
            echo "</div>";
            echo "<div class='recurso'>";
            echo "Nombre: $recurso[rec_nombre]<br>";
            echo "Tipo de recurso: $recurso[rec_tipo]<br>";
            $recursoid=$recurso['rec_id'];
            $dispo=$recurso['rec_disponibilidad'];
            if ($dispo==0) {
              echo "Disponibilidad: RESERVADO <br>";
              $j="SELECT usu_nombre, usu_apellido FROM usuario INNER JOIN recurso ON recurso.usu_id =usuario.usu_id WHERE rec_disponibilidad=0 AND rec_id='$recursoid'";
              $nombrefk = mysqli_query($conexion, $j);
              $nombre = mysqli_fetch_array($nombrefk);
              echo "Reservado por: $nombre[usu_nombre] $nombre[usu_apellido]<br>";
            }else{
              echo "Disponibilidad: DISPONIBLE <br>";
            }
            echo "Última vez reservado: $recurso[rec_fecha]<br>";
            echo "Descripción: $recurso[rec_descripcion]<br>";
            if ((isset($_REQUEST['login']))&&($dispo==1)) {
              $usuario=$_REQUEST['id'];
              echo "<a href='reservar.php?id=$recursoid&usu=$usuario'>Reservar</a><br>";
            }
            echo "</div>";
          }
        }else{
          echo "Lo sentimos, no hemos podido encontrar su búsqueda";
        }

      }//Fin de la segunda busqueda

      if (($tiporecurso=="Cualquiera")&&($disponible!="Cualquiera")) {

        if ($disponible=="Disponible") {
          $string2="rec_disponibilidad='1'";
          
        }
        if($disponible=="Reservado"){
          $string2="rec_disponibilidad='0'";
        }

        $q="SELECT * FROM recurso WHERE $string2";

        $resultado = mysqli_query($conexion, $q);

        if(mysqli_num_rows($resultado)>0){

          while($recurso = mysqli_fetch_array($resultado)){
            echo "<div class='recurso-img'>";
            echo "$recurso[rec_img]<br>";
            echo "</div>";
            echo "<div class='recurso'>";
            echo "Nombre: $recurso[rec_nombre]<br>";
            $recursoid=$recurso['rec_id'];
            echo "Tipo de recurso: $recurso[rec_tipo]<br>";
            $dispo=$recurso['rec_disponibilidad'];
            if ($dispo==0) {
              echo "Disponibilidad: RESERVADO <br>";
              $j="SELECT usu_nombre, usu_apellido FROM usuario INNER JOIN recurso ON recurso.usu_id =usuario.usu_id WHERE rec_disponibilidad=0 AND rec_id='$recursoid'";
              $nombrefk = mysqli_query($conexion, $j);
              $nombre = mysqli_fetch_array($nombrefk);
              echo "Reservado por: $nombre[usu_nombre] $nombre[usu_apellido]<br>";
            }else{
              echo "Disponibilidad: DISPONIBLE <br>";
            }
            echo "Última vez reservado: $recurso[rec_fecha]<br>";
            echo "Descripción: $recurso[rec_descripcion]<br>";
            if ((isset($_REQUEST['login']))&&($dispo==1)) {
              $usuario=$_REQUEST['id'];
              echo "<a href='reservar.php?id=$recursoid&usu=$usuario'>Reservar</a><br>";
            }
            echo "</div>";
          }
        }else{
          echo "Lo sentimos, no hemos podido encontrar su búsqueda";
        }
        }//fin de la tercera consulta
    //En el caso en el que no le hayamos dado click a enviar y por lo tanto no hayamos elegido ningún filtro se muestran todos los recursos
      }else{
        $q = "SELECT * from recurso ORDER BY rec_nombre";
        $resultados = mysqli_query($conexion, $q);
        if(mysqli_num_rows($resultados)>0){
          while($recurso = mysqli_fetch_array($resultados)){
            echo "<div class='recurso-img'>";
            echo "$recurso[rec_img]<br>";
            echo "</div>";
            echo "<div class='recurso'>";
            echo "Nombre: $recurso[rec_nombre]<br>";
            $recursoid=$recurso['rec_id'];
            echo "Tipo de recurso: $recurso[rec_tipo]<br>";
            $dispo=$recurso['rec_disponibilidad'];
            if ($dispo==0) {
              echo "Disponibilidad: RESERVADO <br>";
              $j="SELECT usu_nombre, usu_apellido FROM usuario INNER JOIN recurso ON recurso.usu_id =usuario.usu_id WHERE rec_disponibilidad=0 AND rec_id='$recursoid'";
              $nombrefk = mysqli_query($conexion, $j);
              $nombre = mysqli_fetch_array($nombrefk);
              echo "Reservado por: $nombre[usu_nombre] $nombre[usu_apellido]<br>";
            }else{
              echo "Disponibilidad: DISPONIBLE <br>";
            }
            echo "Última vez reservado: $recurso[rec_fecha]<br>";
            echo "Descripción: $recurso[rec_descripcion]<br>";
            if ((isset($_REQUEST['login']))&&($dispo==1)) {
              $usuario=$_REQUEST['id'];
              echo "<a href='reservar.php?id=$recursoid&usu=$usuario'>Reservar</a><br>";
            }
            echo "</div>";
          }
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