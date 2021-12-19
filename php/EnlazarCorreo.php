<?php
session_start();

$error = -1;
//Validación del registro en el servidor
if (isset($_POST['enlazar'])) {

    $correoehu = $_POST['correoehu'];
    $correogmail = $_POST['correogmail'];
    $dominio = explode('@', $correo);
    if ($correoehu == "" || $correogmail == "") {
        $error = 1;
    } else {
        //Si no ha habido ningún error, se INTENTA logear al usuario
        //Conectamos con la base de datos mysql
        include 'DbConfig.php';
        $_SESSION['correo-provisional'] = $_POST['correo'];
        try {
            $dsn = "mysql:host=$server;dbname=$basededatos";
            $dbh = new PDO($dsn, $user, $pass);

            $stmt = $dbh->prepare("UPDATE users SET correogmail=? WHERE correoehu=?");

            $stmt->bindParam(1, $correogmail);
            $stmt->bindParam(2, $correoehu);

            $stmt->execute();
            echo '<script>alert("Se ha añadido correctamente tu correo gmail)"</script>';
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
                        <td align="right">Dirección de correo EHU(*): </td>
                        <td align="left"><input type="text" id="correo" name="correoehu" autofocus></td>
                    </tr>
                    <tr>
                        <td align="right">Dirección de correo gmail(*): </td>
                        <td align="left"><input type="text" id="correo" name="correogmail" autofocus></td>
                    </tr>
                    <tr>
                        <td></td> <!-- NO VALIDA SIMPLEMENTE EJECUTA EL SCRIPT-->
                        <td align="left"><input type="submit" id="enlazar" name="enlazar" value="Enlazar correo"></button></td>
                    </tr>

                </table>
            </form>
            <?php
            if (isset($_POST['enlazar'])) {
                if ($error == 1) {
                    echo 'Uupss parece que no has introducido alguno de los dos correos';
                } else {
                    echo '<script type="text/javascript"> alert("Se ha enlazado el correo de forma correcta");
                    window.location.href="RestablecerContrasena.php";
                    </script>';
                }
            }
            ?>

        </div>
    </section>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <?php include '../html/Footer.html' ?>
</body>

</html>