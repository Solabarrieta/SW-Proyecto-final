<?php
session_start();
if (!isset($_SESSION['correo'])) {
  echo '<script type="text/javascript"> alert("Debes estar logueado!! ");
    window.location.href="LogIn.php";
    </script>';
}
?>
      
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
