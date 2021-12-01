<div id='page-wrap'>
  <header class='main' id='h1'>
    <?php if (!isset($_SESSION['correo'])) { ?>



      <span class="right"><a href="SignUp.php">Registro</a></span>
      <span class="right"><a href="LogIn.php">Login</a></span>
    <?php } else { ?>
      <span class="right"><a href="LogOut.php">Logout</a><?php echo ' ' . $_SESSION['correo']; ?><?php '<img src="' . $_SESSION['imagen'] . '">' ?></span>
    <?php } ?>

  </header>
  <nav class='main' id='n1' role='navigation'>
    <span><a href="Layout.php"> Inicio</a></span>
    <span><a href="Credits.php">Creditos</a></span>

    <?php if (isset($_SESSION['correo']) && $_SESSION['correo'] != 'admin@ehu.es') { ?>

      <span><a href="HandlingQuizesAjax.php"> Insertar Pregunta </a></span>
      <span><a href="ShowQuestionsWithImage.php"> Ver Preguntas </a></span>
      <!-- Hay que añadir un gestionar preguntas, y dentro de este poner un boton para ver preguntas y otro para añadir la pregunta actual -->

      <?php
      if ($_SESSION['rol'] == 'prof') { ?>
        <span><a href="IsVip.php"> EsVip?</a></span>
        <span><a href="AddVipUser.php">Añadir usuario VIP</a></span>
        <span><a href="DeleteVipUser.php">Eliminar Usuario VIP</a></span>
        <span><a href="ShowVips.php">Mostrar VIPS</a></span>
      <?php
      } ?>
    <?php

    } else if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') { ?>
      <span><a href="HandlingAccounts.php">Gestionar cuentas</a></span>
    <?php
    } ?>
  </nav>