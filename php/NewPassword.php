<?php
session_start();

/*if (!isset($_SESSION['correo-provisional'])) {
    echo '<script>alert("No puedes estar en esta pagina!")</script>';
    if (isset($_SESSION['correo'])) {
        echo '<script>window.location.href="Layout.php";
            </script>';
    } else {
        echo '<script>window.location.href="LogIn.php" </script>';
    }
}*/

$error = -1;
//Validación del registro en el servidor
if (isset($_POST['botonLogin'])) {

    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    //Si no ha habido ningún error, se INTENTA logear al usuario
    //Conectamos con la base de datos mysql
    if ($pass1 == '' || $pass2 == '') {
        $error = 1;
    } else {

        require_once 'DbConfig.php';

        try {
            $dsn = "mysql:host=$server;dbname=$basededatos";
            $dbh = new PDO($dsn, $user, $pass);

            $stmt = $dbh->prepare("UPDATE TABLE users SET pass = ? WHERE correo = ");

            if ($_POST['pass1' == $_POST['pass2']]) {
                $stmt->bindParam(1, $_POST['pass1']);
            } else {
                $error = 2;
            }

            $stmt->bindParam(2, $correo);

            $modified = $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
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
            <form id="flogin" name="flogin" action="RestablecerContraseña.php" method="POST" actionstyle="width: 60%; margin: 0px auto;">
                <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
                    <caption style="text-align:left">
                        <h2>Login de usuario</h2>
                    </caption>
                    <tr>
                        <td align="right">Nueva contraseña : </td>
                        <td align="left"><input type="text" id="pass1" name="pass1" autofocus></td>
                    </tr>
                    <tr>
                        <td align="right">Confirmar contraseña : </td>
                        <td align="left"><input type="text" id="pass2" name="pass2" autofocus></td>
                    </tr>
                    <tr>
                        <td></td> <!-- NO VALIDA SIMPLEMENTE EJECUTA EL SCRIPT-->
                        <td align="left"><input type="submit" id="botonLogin" name="botonLogin" value="Restablecer contraseña"></button></td>
                    </tr>

                </table>
            </form>
            <?php
            if ($error == 1) {
                echo 'Rellena todos los campos por favor';
            } else if ($error == 2) {
                echo 'Las contraseñas no coinciden';
            }
            ?>

        </div>
    </section>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <?php include '../html/Footer.html' ?>
</body>

</html>