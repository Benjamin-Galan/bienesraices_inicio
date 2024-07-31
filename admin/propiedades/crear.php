<?php

require '../../includes/config/database.php';
$db = conectarDB();

//arreglo con mensaje de errores
$errores = [];


//ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedor'];

    if(!$titulo){
        $errores[] = "Debes añadir un titulo";
    }

    if(!$precio){
        $errores[] = "El precio es obligatorio";
    }

    if(strlen($descripcion) < 50){
        $errores[] = "Debes añadir un descripcion que contenga al menos 50 caracteres";
    } 

    if(!$habitaciones){
        $errores[] = "El numero de habitaciones es obligatorio";
    }

    if(!$wc){
        $errores[] = "El numero de baños es obligatorio";
    }

    if(!$estacionamiento){
        $errores[] = "El numero de lugares de estacionamiento es obligatorio";
    }

    if(!$vendedorId){
        $errores[] = "Elige un vendedor";
    }

    echo '<pre>';
    var_dump($errores);
    echo '</pre>';

    exit;

    //insertar en la base de datos
    $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId) 
    VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId')";

    $resultado = mysqli_query($db, $query);

    if($resultado){
        echo 'Insertado correctamente';
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

    <form action="/bienesraices/admin/propiedades/crear.php" method="POST" class="formulario">
        <fieldset>
            <legend>Informacion general de la propiedad</legend>

            <label for="titulo">Titulo de la propiedad</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad">

            <label for="precio">Tilulo de la propiedad</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad">

            <label for="imagen">Tilulo de la propiedad</label>
            <input type="file" id="imagen" accept="image/jpeg">

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion de la propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="ej. 3" min="1" max="9">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="ej. 3" min="1" max="9">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="ej. 3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="">-- Seleccione --</option>
                <option value="1">Juan</option>
                <option value="2">Karen</option>
            </select>
        </fieldset>

        <input type="submit" class="boton-verde" value="Crear propiedad">
    </form>
</main>

<?php
incluirTemplate('footer');
?>