<?php
session_start();

$error = -1;
//Validación del registro en el servidor
if (isset($_POST['botonLogin'])) {

    $correo = $_POST['correo'];
    if ($correo == "") {
        $error = 1;
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
            $error = 2;
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
            <form id="flogin" name="flogin" action="RestablecerContraseña.php" method="POST" actionstyle="width: 60%; margin: 0px auto;">
                <table style="border:4px solid #c1e9f6;" bgcolor="#9cc4e8">
                    <caption style="text-align:left">
                        <h2>Login de usuario</h2>
                    </caption>
                    <tr>
                        <td align="right">Dirección de correo (*): </td>
                        <td align="left"><input type="text" id="correo" name="correo" autofocus></td>
                    </tr>
                    <tr>
                        <td></td> <!-- NO VALIDA SIMPLEMENTE EJECUTA EL SCRIPT-->
                        <td align="left"><input type="submit" id="botonLogin" name="botonLogin" value="Restablecer contraseña"></button></td>
                    </tr>

                </table>
            </form>
            <?php
            if ($error == 1) {
                echo 'Para que esto funcione debes introducir tu correo :(';
            } else if ($error == 2) {
                echo 'No hemos encontrado el correo introducido, por favor, vuelve a intentar';
            } else {
                $link = 'http://localhost/~oier/proyecto-final/php/ContraseñaNueva.php';
                $to = $correo;
                $subject = "Restablecimiento de contraseña";
                $mailContent = 'Hola ' . $row['nom'] . ', 
                <br/>Hemos recibido una petición para restablecer la contraseña de tu cuenta. 
                <br/>Para restablecer la contraseña, clica el siguiente enlace : <a href="' . $link . '">' . $link . '</a>
                <br/><br/>Regards';

                $enviado = mail($to, $subject, $mailContent);
                if ($enviado) {
                    echo '<script type="text/javascript"> alert("Te hemos enviado un correo para que reestablezcas tu contraseña");
                    </script>';
                } else {
                    echo "Ha surgido algún problema, no hemos podido enviarte el email";
                }
            }
            ?>

        </div>
    </section>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <?php include '../html/Footer.html' ?>
</body>

</html>