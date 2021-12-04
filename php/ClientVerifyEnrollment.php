<?php
if (isset($correo)) {
    $soapClient = new SoapClient('http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl');
    die("error del client verify");
    $response = $soapClient->comprobar($correo);
    die($response);
    $valido = False;
    if ($response == 'SI') {
        $valido = True;
    } else {
        $valido = False;
    }
}
