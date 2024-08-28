<?php

use App\Propiedad;

require '../../includes/app.php';
estaAutenticado();


$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

$propiedad = Propiedad::find($id);

//consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);

//arreglo con mensaje de errores
$errores = [];

//ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('y/m/d');

    //asignar _files hacia una variable
    $imagen = $_FILES['imagen'];

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "Debes añadir un descripcion que contenga al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }

    if (!$wc) {
        $errores[] = "El numero de baños es obligatorio";
    }

    if (!$estacionamiento) {
        $errores[] = "El numero de lugares de estacionamiento es obligatorio";
    }

    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }

    //validar por tamaño (100kb = 100000 bites)
    $medida = 100000;

    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }

    //si el arreglo está vacio ingresa los datos a la bd
    if (empty($errores)) {
        // crear una carpeta
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        $nombreImagen = '';

        //si existe una imagen
        if ($imagen['name']) {
            //eliminar la imagen previa
            unlink($carpetaImagenes . $propiedad['imagen']);

            //generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //subir la imagen (crear archivos o moverlos)
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad['imagen'];
        }

        //insertar en la base de datos
        $query = "UPDATE propiedades SET 
        titulo = '{$titulo}', 
        precio = {$precio}, 
        imagen = '{$nombreImagen}', 
        descripcion = '{$descripcion}', 
        habitaciones = {$habitaciones}, 
        wc = {$wc},
        estacionamiento = {$estacionamiento}, 
        vendedorId = {$vendedorId} 
        WHERE id = {$id}; ";

        echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //redireccionar al usuario

            header('Location: /bienesraices/admin/index.php?resultado=2');
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar</h1>

    <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form method="POST" class="formulario" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" class="boton-verde btn-actualizar" value="Actualizar propiedad">
    </form>
</main>

<?php
incluirTemplate('footer');
?>