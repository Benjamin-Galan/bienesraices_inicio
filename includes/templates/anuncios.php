<?php

//importar la conexion
require '../../includes/app.php';

$db = conectarDB();

//consultar
$query = "SELECT * FROM propiedades LIMIT {$limite}";

//obtener los resultados
$resultado = mysqli_query($db, $query);
?>

<div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
        <div class="anuncio">
            <picture>
                <img loading="lazy" src="/bienesraices/imagenes/<?php echo $propiedad['imagen'];?>" alt="imagen anuncio">
            </picture>

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['titulo'];?></h3>
                <p>Casa en el lago con excelente vista, acabados de lujo a un excelente precio</p>
                <p class="precio"><?php echo $propiedad['precio'];?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono_wc">
                        <p><?php echo $propiedad['wc'];?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad['estacionamiento'];?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?php echo $propiedad['habitaciones'];?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad['id'];?>" class="boton-amarillo-block">Ver propiedad</a>
            </div> <!--.contenido-anuncio-->
        </div><!--.anuncio-->
    <?php endwhile; ?>
</div><!--.contenedor-anuncio-->

<?php
//cerrar la conexion
mysqli_close($db);
?>