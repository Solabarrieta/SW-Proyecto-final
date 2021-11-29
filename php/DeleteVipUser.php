<?php
session_start();
if ($_SESSION['rol'] != 'prof') {
    echo '<script>
    alert("Debes estar logueado como profesor!! ");
    window.location.href = "LogIn.php";</script>';
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
        <h2>Cliente REST para borrar un usuario VIP</h2>
        <form action="" method="post">
            <h1>Borra un usuario</h1>
            <input name="email" type="text">
            <input type="submit" value="Es VIP?">
        </form>
        <div id="esVipResponse">
            <?php
            if (isset($_POST['email'])) {
                $id = $_POST['email'];

                //URL local

                //$url = 'http://localhost/~oier/REST/vipusers/';

                //URL servidor

                $url = "https://sw.ikasten.io/~G22/REST/vipusers/";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $id);
                $vip = curl_exec($curl);
                echo $vip;
            }
            ?>

        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>