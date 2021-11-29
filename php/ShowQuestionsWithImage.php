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
      <style>
        td,
        th {
          margin: 25px 0;
          font-size: 0.9em;
          font-family: sans-serif;
          padding: 6px;
          border: solid 2px #c1e9f6;
        }

        table {
          border-collapse: collapse;
        }

        .imgPrev {
          display: block;
          width: 100%;
          height: auto;
        }

        .imgPrev2 {
          display: block;
          width: 100px;
          height: 100px;
        }
      </style>
      <?php
      //Conectamos con la base de datos mysql
      include 'DbConfig.php';
      $conn = mysqli_connect($server, $user, $pass, $basededatos);
      $conn->set_charset("utf8");

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      //Cogemos los datos de la tabla
      $result = mysqli_query($conn, "SELECT * from preguntas");

      echo "<table " . " bgcolor=" . "'#9cc4e8'" . ">";
      echo "<tr>
        <th>Correo</th>
        <th>Enunciado</th>
        <th>Respuesta correcta</th>
        <th>Respuesta incorrecta 1</th>
        <th>Respuesta incorrecta 2</th>
        <th>Respuesta incorrecta 3</th>
        <th>Dificultad</th>
        <th>Tema</th>
        <th>Imagen asociada</th>
        </tr>";


      while ($row = mysqli_fetch_array($result)) {

        echo
        "<tr>
          <td>" . $row['correo'] . "</td>" .
          "<td>" . $row['enun'] . "</td>" .
          "<td>" . $row['correct'] . "</td>" .
          "<td>" . $row['inc1'] . "</td>" .
          "<td>" . $row['inc2'] . "</td>" .
          "<td>" . $row['inc3'] . "</td>" .
          "<td>" . $row['compl'] . "</td>" .
          "<td>" . $row['tema'] . "</td>" .
          "<td><img src=" . $row['imagen'] . " class='imgPrev2'></img></td></tr>";
      }

      echo "</table>";

      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>