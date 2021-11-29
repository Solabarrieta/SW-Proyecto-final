<?php
session_start();
if (!isset($_SESSION['correo'])) {
  echo '<script type="text/javascript"> alert("Debes estar logueado!! ");
    window.location.href="LogIn.php";
    </script>';
}
?>
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
      $json = file_get_contents('../json/Questions.json');
      $jsonarr = json_decode($json);

      echo "<table " . " bgcolor=" . "'#9cc4e8'" . ">";
      echo "<tr>
        <th>Autor</th>
        <th>Enunciado</th>
        <th>Respuesta correcta</th>
        </tr>";

      foreach ($jsonarr->assessmentItems as $pregunta) {
        echo
        "<tr><td>" . $pregunta->author . "</td>" .
          "<td>" . $pregunta->itemBody->p . "</td>" .
          "<td>" . $pregunta->correctResponse->value . "</td></tr>";
      }

      echo "</table>";

      ?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>