<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//conectarse a la base de datos
$db = conectarDB();

use App\Propiedad;

Propiedad::setDb($db);