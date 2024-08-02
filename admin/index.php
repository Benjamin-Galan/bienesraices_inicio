<?php
//importar la conexion
require '../includes/config/database.php';
$db = conectarDB();

//escribir el query
$query = "SELECT * FROM propiedades";

//consultar la bd
$resultadoConsulta = mysqli_query($db, $query);

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
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
            <tr>
                <td><?php echo $propiedad['id']?></td>
                <td><?php echo $propiedad['titulo']?></td>
                <td><img src="/bienesraices/imagenes/<?php echo $propiedad['imagen'];?>" class="imagen-tabla" alt=""></td>
                <td>$<?php echo $propiedad['precio'];?></td>
                <td>
                    <a class="boton-rojo-block" href="">Eliminar</a>
                    <a class="boton-amarillo-block" href="">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
//cerrar la conexion
mysqli_close($db);

incluirTemplate('footer');
?>