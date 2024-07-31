<?php

function conectarDB() : mysqli 
{
    $db = mysqli_connect('localhost', 'root', 'root', 'bienesraices_crud');

    if (!$db) {
        echo 'Error en la conexion';
        exit;
    }

    return $db;
}
