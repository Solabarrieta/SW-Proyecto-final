<?php
class Database
{

    public static function Conectar()
    {
        $link = mysqli_connect(_HOST_, _USERNAME_, _PASSWORD_, _DATABASE_);

        if (!$link) {
            throw new Exception("Error de conexi�n al servidor " . _HOST_ . ".");
        }

        return $link;
    }

    public static function Limpiar($link, $values)
    {
        if (gettype($values) == 'array') {
            $resultado = array();
            foreach ($values as $val) {
                if (function_exists("mysql_real_escape_string")) {
                    $val = mysqli_real_escape_string($val, $link);
                } else {
                    $val = addslashes($val);
                }
                $resultado[] = $val;
            }
            return $resultado;
        } else {
            if (function_exists("mysql_real_escape_string")) {
                $values = mysqli_real_escape_string($values, $link);
            } else {
                $values = addslashes($values);
            }
            return $values;
        }
    }

    public static function EjecutarConsulta($link = null, $sql = "")
    {
        if ($sql == "") {
            throw new Exception("No se ha establecido ninguna consulta para ejecutar.");
        }

        if (!$link) {
            throw new Exception("No se ha establecido ninguna conexi�n.");
        }

        $result = mysqli_query($link, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($link));
        }
        $datos = "";
        //if (gettype($result) == "resource") {
        while ($row = mysqli_fetch_array($result)) {
            $datos = $datos . " " . $row[0] . "<br>";
        }
        mysqli_free_result($result);
        return $datos;
        // } else {
        // return 0;
    }

    public static function EjecutarEscalar($link = null, $sql = "")
    {
        if ($sql == "") {
            throw new Exception("No se ha establecido ninguna consulta para ejecutar.");
        }

        if (!$link) {
            throw new Exception("No se ha establecido ninguna conexi�n.");
        }

        $result = mysqli_query($link, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($link));
        }
        $dato = null;
        if ($row = mysqli_fetch_row($result)) {
            $dato = $row[0];
        }
        mysqli_free_result($result);
        return $dato;
    }

    public static function EjecutarNoConsulta($link = null, $sql = "")
    {
        if ($sql == "") {
            throw new Exception("No se ha establecido ninguna consulta para ejecutar.");
        }

        if (!$link) {
            throw new Exception("No se ha establecido ninguna conexi�n.");
        }
        mysqli_query($link, $sql);
        if (mysqli_affected_rows($link) == 1) {
            return 1;
        } else {
            return 0;
        };
    }

    public static function Desconectar($link)
    {
        mysqli_close($link);
    }

    public static function LastInsertId($link)
    {
        $sql = "SELECT LAST_INSERT_ID();";
        if (!$link) {
            throw new Exception("No se ha establecido ninguna conexi�n.");
        }

        $result = mysqli_query($link, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($link));
        }
        $dato = null;
        if ($row = mysqli_fetch_row($result)) {
            $dato = $row[0];
        }
        mysqli_free_result($result);
        return $dato;
    }
}
