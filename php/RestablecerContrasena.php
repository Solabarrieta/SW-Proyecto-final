<?php
session_start();

$error = -1;
//Validación del registro en el servidor
if (isset($_POST['restablecer'])) {

    $correo = $_POST['correo'];
    $dominio = explode('@', $correo);
    if ($correo == "") {
        $error = 1;
    } else if ('gmail.com' != $dominio[1]) {
        $error = 2;
    } else {
        //Si no ha habido ningún error, se INTENTA logear al usuario
        //Conectamos con la base de datos mysql
        include 'DbConfig.php';
        try {
            $dsn = "mysql:host=$server;dbname=$basededatos";
            $dbh = new PDO($dsn, $user, $pass);

            $stmt = $dbh->prepare("SELECT * FROM users WHERE correogmail = ?");

            $stmt->bindParam(1, $correo);

            $stmt->execute();
            $row = $stmt->fetch();

            if ($row == 0) {
                $error = 2;
            }
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
            <form id="flogin" name="flogin" method="POST" actionstyle="width: 60%; margin: 0px auto;">
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
                        <td align="left"><input type="submit" id="restablecer" name="restablecer" value="Restablecer contraseña"></button></td>
                    </tr>

                </table>
            </form>
            <?php
            if (isset($_POST['restablecer'])) {
                if ($error == 1) {
                    echo 'Uupss parece que no has introducido el correo';
                } else if ($error == 2) {
                    echo '<script src="../js/EnlazarCorreo.js"></script>';
                    echo 'El correo debe ser del dominio gmail.com, si no tienes nigún correo de este dominio en lazado a tu cuenta, por favor, pulsa <a href="EnlazarCorreo.php">aquí</a>
                    ';
                } else {
                    $link = 'http://sw.ikasten.io/~osolabarrieta001/SW-Proyecto-final/php/NewPassword.php';
                    $to = $row['correogmail'];
                    $subject = "Restablecimiento de contraseña Quiz SW";
                    $mailContent = 'Hola ' . $row['nom'] . ', 
                    <br/>Hemos recibido una petición para restablecer la contraseña de tu cuenta. 
                    <br/>Para restablecer la contraseña, clica el siguiente enlace : <a href="' . $link . '">' . $link . '</a>
                    <br/><br/>Saludos';

                    $enviado = mail($to, $subject, $mailContent);

                    if ($enviado) {
                        echo '<script type="text/javascript"> alert("Te hemos enviado un correo para que reestablezcas tu contraseña");
                    </script>';
                    } else {
                        echo "Ha surgido algún problema, no hemos podido enviarte el email";
                    }
                }
            }
            ?>

        </div>
    </section>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <?php include '../html/Footer.html' ?>
</body>

</html>