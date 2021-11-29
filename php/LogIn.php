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
    include 'DbConfig.php';
    $conn = mysqli_connect($server, $user, $pass, $basededatos);
    $conn->set_charset("utf8");

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    //die(password_hash("admin000", PASSWORD_DEFAULT) . "    " . password_hash("admin000", PASSWORD_DEFAULT));
    $sql = "SELECT * from users where correo = '$correo'"; //. "' and pass = '" . password_hash($userpass, PASSWORD_DEFAULT) . "'";
    $logear = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($logear, MYSQLI_ASSOC); //Lo convertimos a array


    if ($row == 0) {
      $error = 3;
      die("No se ha encontrado a dicho usuario");
    } else {

      $hash = $row['pass'];
      // error_log($userpass . " " . $hash . "\n", 3, "/tmp/error.log");
      // die($userpass . " " . $hash);
      //  $now = time();

      if (password_verify($userpass, $hash)) {
        // die(time() - $now);

        // error_log((time() - $now) . "\n", 3, "/tmp/error.log");
        /*  $sql2 = "SELECT * from users where correo = '$correo'";
        $logear = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($logear, MYSQLI_ASSOC); //Lo convertimos a array*/

        //Comprueba si el usuario existe
        /* if (is_null($row)) {
          $error = 3;
        } else {*/
        //Comprueba si el usuario esta baneado
        if ($row['estado'] == 'baneado') {
          $error = 4;
        } else {
          if (($row['correo'] == $correo)) {
            $_SESSION['correo'] = $correo;
            $_SESSION['rol'] = $row['tipouser'];
            $error = 0;
          } else {
            $error = 3;
          }
        }

        //die("Estado 5" . $error);
      }
      //die("estado 4");
      /*  } else {
        $error = 3;
      }*/
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
        echo "<h3>Datos de login incorrectos. :(</h3>";
        echo "<br>";
      } else if ($error == 0) {
        echo '<script type="text/javascript"> alert("Bienvenido al Sistema: ' . $correo . ' ");
                        window.location.href="Layout.php";
                        </script>';
      } else if ($error == 4) {
        echo '<h3>Lo siento, estas <strong style="color: red;">BANEADO!!</strong></h3>';
      }


      ?>

    </div>
  </section>
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <?php include '../html/Footer.html' ?>
</body>

</html>