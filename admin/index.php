<?php
//importar la conexion

//escribir el query

//consultar la bd

//muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;

//incluye un template
include '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>

    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php endif; ?>

    <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- mostrar los resultados -->
            <tr>
                <td>1</td>
                <td>Casa en la playa</td>
                <td><img src="/bienesraices/imagenes/anuncio2.jpg" class="imagen-tabla" alt=""></td>
                <td>$12000000</td>
                <td>
                    <a class="boton-rojo-block" href="">Eliminar</a>
                    <a class="boton-amarillo-block" href="">Actualizar</a>
                </td>
            </tr>
        </tbody>
    </table>
</main>

<?php
incluirTemplate('footer');
?>