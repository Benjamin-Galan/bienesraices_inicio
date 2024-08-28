<?php
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);


if(!$id){
    header('location: /bienesraices/index.php');
}

require 'includes/app.php';

//importar la conexion
$db = conectarDB();

//obtener los resultados
$query = "SELECT * FROM propiedades WHERE id = {$id}";
$resultado = mysqli_query($db, $query);

if (!$resultado->num_rows){
    header('location: /bienesraices/index.php');
}
$propiedad = mysqli_fetch_assoc($resultado);

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>

    <picture>
        <img loading="lazy" src="/bienesraices/imagenes/<?php echo $propiedad['imagen'];?>" alt="imagen de la propiedad">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio"><?php echo $propiedad['precio']?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono_wc">
                <p><?php echo $propiedad['wc']?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad['estacionamiento']?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p><?php echo $propiedad['habitaciones']?></p>
            </li>
        </ul>
        <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maxime, et. A omnis iure cupiditate
            repellendus quod veritatis, fuga odio ad rem dolorem impedit neque repellat dolorum itaque eius
            recusandae voluptatem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab dolorem
            aspernatur nemo, iusto facere ipsum possimus illum accusamus sit tenetur animi quasi, exercitationem
            odio rerum provident distinctio deserunt omnis sapiente.
        </p>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum quis perferendis magnam laudantium
            amet ducimus, molestias quia consectetur ratione hic omnis fugit vitae quod unde dolorem, nobis
            ullam eius tempore!
        </p>
    </div>
</main>

<?php
mysqli_close($db);
incluirTemplate('footer');
?>