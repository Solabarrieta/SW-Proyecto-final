<?php
session_start();
?>

<?php

//Validación del registro en el servidor
if (isset($_POST['botonReg'])) {
  $tipoUser = "";
  $correo = "";
  $nom = "";
  $apell = "";
  $pass = "";
  $repass = "";


  //Validación en servidor 
  $er = "/^([a-zA-Z]+[0-9]{3})@ikasle\.ehu\.(eus|es)$/";
  $er2 = "/^[a-zA-Z]+\.[a-zA-Z]+@ehu\.(eus|es)$/";
  $er3 = "/^[a-zA-Z]+@ehu\.(eus|es)$/";

  $tipoUser = $_POST['user'];
  $correo = $_POST['correo'];
  $nom = $_POST['nom'];
  $apell = $_POST['apell'];
  $userpass = $_POST['userpass'];
  $repass = $_POST['repass'];
  $imagen_nombre = $_FILES['subirImagen']['name'];
  $imagen_loc_tmp = $_FILES['subirImagen']['tmp_name']; //El directorio temporal donde está la imagen al subirla mediante el formulario.
  $nombre_imagen_separado = explode(".", $imagen_nombre); //Separamos el nobmre de la imagen para obtener su extensión.
  $imagen_extension = strtolower(end($nombre_imagen_separado)); //Cogemos la extensión.
  $nuevo_nombre_imagen = md5(time() . $imagen_nombre) . '.' . $imagen_extension; //Se le da un nombre único a la imagen que se va a guardar en el servidor.
  $imagen_dir = "../images/" . $nuevo_nombre_imagen; //La base de datos guardará los directorios de las imagenes en el servidor.
  $error = -1;


  if (preg_match($er, $correo) && $tipoUser == 'prof') {
    //No se ha introducido, cambiar por comprobar que el tipo de usuario coincide con el tipo de email...
    $error = 1;
  } else if ((preg_match($er2, $correo) || preg_match($er3, $correo)) && $tipoUser == 'alu') {
    $error = 1;
  } else if (!(preg_match($er, $correo) || preg_match($er2, $correo) || preg_match($er3, $correo))) {
    //El correo no es correcto
    $error = 2;
  } else if (strlen($nom) < 2) {
    //El nombre tiene menos de dos carácteres
    $error = 3;
  } else if (strlen($apell) < 2) {
    //El apellido tiene menos de 2 carácteres
    $error = 4;
  } else if (strlen($userpass) < 8) {
    //La contraseña tiene menos de 2 carácteres
    $error = 5;
  } else if ($repass != $userpass) {
    //Contraseña y confirmar contraseña no coinciden
    $error = 6;
  } else {
    $error = 0;
  }
}
?>




<!DOCTYPE html>
<html>

<head>
  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <style>
        .imgPrev {
          display: block;
          width: auto;
          height: 100%;
        }
      </style>
      <form id="fregister" name="fregister" action="SignUp.php" enctype="multipart/form-data" method="POST" actionstyle="width: 60%; margin: 0px auto;">
        <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
          <caption style="text-align:left">
            <h2>Registro de usuario</h2>
          </caption>
          <tr>
            <td align="right">Tipo de usuario: </td>
            <td align="left">
              <select name="user" id="user" form="fregister">
                <option value="alu">Alumno</option>
                <option value="prof">Profesor</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="right">Dirección de correo (*): </td>
            <td align="left"><input type="text" id="correo" name="correo" autofocus></td>
          </tr>
          <tr>
            <td align="right">Nombre (*): </td>
            <td align="left"><input style="width: 600px;" type="text" id="nom" name="nom" autofocus></td>
          </tr>
          <tr>
            <td align="right">Apellido/s (*): </td>
            <td align="left"><input style="width: 600px;" type="text" id="apell" name="apell" autofocus></td>
          </tr>
          <tr>
            <td align="right">Contraseña (*): </td>
            <td align="left"><input style="width: 600px;" type="password" id="userpass" name="userpass" autofocus></td>
          </tr>
          <tr>
            <td align="right">Repetir contraseña (*): </td>
            <td align="left"><input style="width: 600px;" type="password" id="repass" name="repass" autofocus></td>
          </tr>
          <tr>
            <td align="right">Foto de perfil: </td>
            <td align="left"><input id="subirImagen" name="subirImagen" type="file" onchange="" accept="image/png, image/jpeg"></td>
          </tr>
          <tr>
            <td></td>
            <td align="left"><img id="preview" name="preview" class="imgPreview" src="" height="200"></td>
          </tr>
          <tr>
            <td></td>
            <td align="left"><button type="button" id="borrarImagen" name="borrarImagen">Borrar Imagen</button></td>
          </tr>
          <tr>
            <td></td>
            <td align="left"><input type="submit" id="botonReg" name="botonReg" value="Registrarse"></button></td>
          </tr>
        </table>
      </form>

      <?php
      if (isset($_POST['botonReg'])) {
        if ($error == 1) {
          echo '<h3>El correo introducido y el tipo de usuario<strong style="color: red"> NO COINCIDEN</strong></h3>';
          echo '<h3>Si tu correo es de tipo <strong style="color: red">ESTUDIANTE</strong>, escoge tipo de usuario <strong style="color: red">ALUMNO</strong></h3>';
          echo '<h3>Si tu correo es de tipo <strong style="color: red">PROFESOR</strong>, escoge tipo de usuario <strong style="color: red">PROFESOR</strong></h3>';
        } else if ($error == 2) {
          echo '<h3>Por favor, introduce un correo de la UPV/EHU</h3>';
        } else if ($error == 3) {
          echo '<h3>El nombre debe tener <strong style="color: red">DOS</strong> o más caracteres</h3>';
        } else if ($error == 4) {
          echo '<h3>El apellido debe tener <strong style="color: red">DOS</strong> o más caracteres</h3>';
        } else if ($error == 5) {
          echo '<h3>La contraseña  debe tener como mínimo <strong style="color: red">OCHO</strong> caracteres</h3>';
        } else if ($error == 6) {
          echo '<h3>Las contraseñas que has introducido <strong style="color: red">NO COINCIDEN</strong></h3>';
        } else if ($error == 0) {

          //include 'ClientVerifyEnrollment.php';
          $valido = true; //El soap ha dejado de funcionar porque la URL no existe...

          require_once 'DbConfig.php';

          if ($valido) {
            try {
              $dsn = "mysql:host=$server;dbname=$basededatos";
              $dbh = new PDO($dsn, $user, $pass);
              /*Prepare */

              $stmt = $dbh->prepare("INSERT INTO users (tipouser, correo, nom, apell, pass, img) VALUES (?,?,?,?,?,?)");


              /*BIND*/

              if ($correo == 'admin@ehu.es' && $tipoUser = 'prof') {
                $tipoUser = 'admin';
              }

              $hashpass = password_hash($userpass, PASSWORD_DEFAULT);

              $stmt->bindParam(1, $tipoUser);
              $stmt->bindParam(2, $correo);
              $stmt->bindParam(3, $nom);
              $stmt->bindParam(4, $apell);
              $stmt->bindParam(5, $hashpass);
              $stmt->bindParam(6, $imagen_dir);
              $stmt->execute();
            } catch (PDOException $e) {
              echo $e->getMessage();
            }
          } else {
            echo 'El correo <span style="color: red;">' . $correo . '</span> NO esta matriculado en la asignatura Sistemas Web';
          }
          echo '<script type="text/javascript"> alert("Se ha realizado el registro de forma correcta");
          window.location.href="LogIn.php";
          </script>';
        } else {
          die("Estado 2");
          echo '<script>alert("Ha ocurrido un error inesperado, por favor, intentelo de nuevo ")
                  window.location.href="SignUp.php"
        </script>';
        }
      }

      ?>

    </div>
  </section>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/ShowImageInForm.js"></script>
  <script type="text/javascript" src="../js/RemoveImageInForm.js"></script>
  <?php include '../html/Footer.html' ?>
</body>

</html>