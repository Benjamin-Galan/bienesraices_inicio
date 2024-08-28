<?php

// Incluye el archivo que contiene funciones, db y configuración para la aplicación
require '../../includes/app.php';

//importar la clase
use App\Propiedad;
use Intervention\Image\ImageManager as image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

// Verifica si el usuario está autenticado
estaAutenticado();

// Conecta a la base de datos
$db = conectarDB();

//crear una nueva instancia
$propiedad = new Propiedad();

// Consulta para obtener los vendedores desde la base de datos
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);

// Inicializa un array para almacenar mensajes de error
$errores = Propiedad::getErrores();

// Ejecuta el código solo si el formulario ha sido enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //crea una nueva instancia
    $propiedad = new Propiedad($_POST);

    // Generar un nombre único para la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear la imagen
    //Realiza un resize a la imagen con intervention
    if ($_FILES['imagen']['tmp_name']) {
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($_FILES['imagen']['tmp_name']);
        $image->cover(800, 600);
        $propiedad->setImagen($nombreImagen);
    }


    //validar
    $errores = $propiedad->validar();

    // Si no hay errores, insertar los datos en la base de datos
    if (empty($errores)) {
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }

        //guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        $resultado = $propiedad->guardar();

        // Redirigir al usuario después de la inserción
        if ($resultado) {
            header('Location: /bienesraices/admin/index.php?resultado=1');
            // header('Location: /admin?resultado=1');
            exit; // Asegúrate de salir del script después de redirigir
        }
    }
}

// Incluye el archivo de plantilla para el encabezado
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

    <!-- Mostrar mensajes de error si los hay -->
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <!-- Formulario para crear una nueva propiedad -->
    <form action="/bienesraices/admin/propiedades/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" class="boton-verde" value="Crear propiedad">
    </form>
</main>

<?php
// Incluye el archivo de plantilla para el pie de página
incluirTemplate('footer');
?>