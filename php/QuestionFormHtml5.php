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

      Versión HTML 5 del formulario para insertar preguntas.
      OPCIONAL.

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>