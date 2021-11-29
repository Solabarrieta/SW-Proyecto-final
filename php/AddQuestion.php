<?php
session_start();

if (!isset($_SESSION['correo'])) {
  echo '<script type="text/javascript"> alert("Debes estar logueado!! ");
    window.location.href="LogIn.php";
    </script>';
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
      <?php

      //Inicializamos las variables que van a contener la información enviada por el formulario de login
      $correo = "";
      $enun = "";
      $correct = "";
      $inc1 = "";
      $inc2 = "";
      $inc3 = "";
      $compl = "";
      $tema = "";
      //die(print_r($_POST,1));

      if (isset($_POST['botonPreg'])) { //Si se ha pulsado el submit con nombre "login" se comienza a procesar el formulario

        $correo = $_POST['correo'];
        $enun = $_POST['enun'];
        $correct = $_POST['correct'];
        $inc1 = $_POST['inc1'];
        $inc2 = $_POST['inc2'];
        $inc3 = $_POST['inc3'];
        $compl = $_POST['dif'];
        $tema = $_POST['tema'];

        //Conectamos con la base de datos mysql
        include 'DbConfig.php';
        $conn = mysqli_connect($server, $user, $pass, $basededatos);
        $conn->set_charset("utf8");

        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO preguntas (correo, enun, correct, inc1, inc2, inc3, compl, tema) VALUES ('$correo', '$enun', '$correct', '$inc1', '$inc2', '$inc3', '$compl', '$tema')";
        $anadir = mysqli_query($conn, $sql);
        if (!$anadir) {
          echo "<h3>Se ha producido un error al intentar insertar la pregunta en la base de datos. :(</h3>";
          echo "<br>";
          echo "<a href=" . "QuestionFormWithImage.php" . ">VOLVER A INSERTAR PREGUNTA</a>";
        } else {
          echo "<h3>Se ha introducido la pregunta en la base de datos. :)</h3>";
          echo "<br>";
          echo "<a href=" . "ShowQuestions.php" . ">VISUALIZAR PREGUNTAS</a>";
          mysqli_close($conn);
        }
      }
      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>