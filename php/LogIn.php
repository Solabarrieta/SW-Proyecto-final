<?php
session_start();

$error = -1;
//Validación del registro en el servidor
if (isset($_POST['botonLogin'])) {
  $correo = "";
  $userpass = "";

  $correo = $_POST['correo'];
  $userpass = $_POST['userpass'];
  if ($correo == "") {
    $error = 1;
  } else if ($userpass == "") {
    $error = 2;
  } else {
    //Si no ha habido ningún error, se INTENTA logear al usuario
    //Conectamos con la base de datos mysql
    require_once 'DbConfig.php';

    try {
      $dsn = "mysql:host=$server;dbname=$basededatos";
      $dbh = new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    $stmt = $dbh->prepare("SELECT * FROM users WHERE correo = ?");

    $stmt->bindParam(1, $correo);

    $stmt->execute();
    $row = $stmt->fetch();



    if ($row == 0) {
      $error = 3;
    } else {
      if (password_verify($userpass, $row['pass'])) {

        if ($row['estado'] == 'baneado') {
          $error = 4;
        } else {
          $_SESSION['correo'] = $correo;
          $_SESSION['rol'] = $row['tipouser'];
          $_SESSION['imagen'] = $row['img'];
          $error = 0;
        }
      } else {
        $error = 5;
      }
    }
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
      <form id="flogin" name="flogin" action="LogIn.php" method="POST" actionstyle="width: 60%; margin: 0px auto;">
        <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
          <caption style="text-align:left">
            <h2>Login de usuario</h2>
          </caption>
          <tr>
            <td align="right">Dirección de correo (*): </td>
            <td align="left"><input type="text" id="correo" name="correo" autofocus></td>
          </tr>
          <tr>
            <td align="right">Contraseña (*): </td>
            <td align="left"><input style="width: 600px;" type="password" id="userpass" name="userpass" autofocus></td>
          </tr>
          <tr>
            <td></td> <!-- NO VALIDA SIMPLEMENTE EJECUTA EL SCRIPT-->
            <td align="left"><input type="submit" id="botonLogin" name="botonLogin" value="Acceder"></button></td>
          </tr>
        </table>
      </form>
      <?php
      //echo $error;
      if ($error == 1) {
        echo "<h3>Debes introducir una dirección de correo.</h3>";
        echo "<br>";
        echo "<a href='LogIn.php'>";
      } else if ($error == 2) {
        echo "<h3>Debes introducir una contraseña.</h3>";
        echo "<br>";
        echo "<a href='LogIn.php'>";
      } else if ($error == 3) {
        echo "<h3>No se ha encontrado a dicho usuario</h3>";
        echo "<br>";
      } else if ($error == 0) {
        echo '<script type="text/javascript"> alert("Bienvenido al Sistema: ' . $correo . ' ");
                        window.location.href="Layout.php";
                        </script>';
      } else if ($error == 4) {
        echo '<h3>Lo siento, estas <strong style="color: red;">BANEADO!!</strong></h3>';
      } else if ($error == 5) {
        echo '<h3>Contraseña <strong style="color: red;">INCORRECTA!!</strong></h3>';
      }


      ?>

    </div>
  </section>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <?php include '../html/Footer.html' ?>
</body>

</html>