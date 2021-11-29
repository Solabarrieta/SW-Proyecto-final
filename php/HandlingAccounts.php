<?php
session_start();
if ($_SESSION['rol'] != 'admin') {
    echo '<script type="text/javascript"> alert("Debe debes ser ADMINISTRADOR para estar en esta pagina!! ");
                 window.location.href="LogIn.php";
    </script>';
}

?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/handleUsers.js"></script>
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
            //Conectamos con la base de datos mysql
            include 'DbConfig.php';
            $conn = mysqli_connect($server, $user, $pass, $basededatos);
            $conn->set_charset("utf8");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            //Cogemos los datos de la tabla
            $result = mysqli_query($conn, "SELECT * from users");

            echo "<table " . " bgcolor=" . "'#9cc4e8'" . ">";
            echo ' <tr>
        <th>EMAIL</th>
        <th>PASS</th>
        <th>IMAGEN</th>
        <th>ESTADO</th>
        <th>BLOQUEO</th>
        <th>BORRAR</th>
        </tr>';

            while ($row = mysqli_fetch_array($result)) {
                if ($row['correo'] != 'admin@ehu.es') {
                    $email = $row['correo'];
                    $estado = $row['estado'];
                    echo
                    "<tr>
                        <td>" . $row['correo'] . "</td>" .
                        "<td>" . $row['pass'] . "</td>" .
                        "<td><img src=" . $row['imagen'] . " class='imgPrev2'></img></td>" .
                        "<td>" . $row['estado'] . "</td>" .
                        '<td><input type = "button" onclick= "changeStatus(\'' . $email . '\',\'' . $estado . '\')" value= "Cambiar estado"></td>' .
                        '<td><input type = "button" onclick="deleteUser(\'' . $email . '\')" value = "Borrar"></td>' .
                        "</tr>";
                }
            }
            echo "</table>";
            ?>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>