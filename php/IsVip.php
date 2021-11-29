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
        <h2>Cliente REST para saber si el usuario dado es VIP</h2>
        <form action="" method="post">
            <h1>Es VIP?</h1>
            <input name="email" type="text">
            <input name="form-button" type="submit" value="Es VIP?">
        </form>
        <div id="esVipResponse">
            <?php
            if (isset($_POST['email'])) {
                $id = $_POST['email'];
                $curl = curl_init();

                //URL local

                //$url = 'http://localhost/~oier/REST/vipusers/' . $id;

                //URL servidor

                $url = "https://sw.ikasten.io/~G22/REST/vipusers/" . $id;
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $vip = curl_exec($curl);
                echo $vip;
            }
            ?>

        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>