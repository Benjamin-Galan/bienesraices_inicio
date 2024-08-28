<?php

// Define la ruta a la carpeta de plantillas utilizando el directorio actual
define('TEMPLATES_URL', __DIR__ . '/templates');

// Define la ruta al archivo de funciones utilizando el directorio actual
define('FUNCIONES_URL', __DIR__ . '/funciones.php');

define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

// Función para incluir un archivo de plantilla
// $nombre: Nombre del archivo de plantilla a incluir (sin extensión)
// $inicio: Booleano que indica si es la página de inicio (opcional, por defecto es false)
function incluirTemplate($nombre, bool $inicio = false)
{
    // Incluye el archivo de plantilla especificado en la ruta TEMPLATES_URL
    include TEMPLATES_URL . "/{$nombre}.php";
}

// Función para verificar si el usuario está autenticado
function estaAutenticado()
{
    // Inicia la sesión PHP
    session_start();

    // Verifica si la variable de sesión 'login' está establecida y es verdadera
    if (!$_SESSION['login']) {
        // Si no está autenticado, redirige al usuario a la página de inicio
        header('Location: /');
        // exit; // Termina la ejecución del script después de la redirección
    }
}

// Función para depurar variables y mostrar su contenido formateado
// $variable: La variable a depurar
function debugear($variable)
{
    // Imprime la variable formateada en una etiqueta <pre> para mejor legibilidad
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit; // Termina la ejecución del script después de mostrar la variable
}

function stz($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}
