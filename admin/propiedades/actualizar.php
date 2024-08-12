<?php

require '../../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
    header('location: /');
}

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
echo $id;
if (!$id) {
    header('Location: /bienesraices/admin/index.php');
}

require '../../includes/config/database.php';
$db = conectarDB();

//obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = {$id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

//consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);

//arreglo con mensaje de errores
$errores = [];

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedorId'];
$imagen = $propiedad['imagen'];

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
        <fieldset>
            <legend>Informacion general de la propiedad</legend>

            <label for="titulo">Titulo de la propiedad</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio de la propiedad</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio ?>">

            <label for="imagen">Imagen de la propiedad</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="/bienesraices/imagenes/<?php echo $imagen; ?>" alt="" class="imagen-pequeña">

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion de la propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="ej. 3" min="1" max="9" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="ej. 3" min="1" max="9" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="ej. 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="">-- Seleccione --</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido'] ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" class="boton-verde btn-actualizar" value="Actualizar propiedad">
    </form>
</main>

<?php
incluirTemplate('footer');
?>