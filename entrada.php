<?php
include '/includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Casa en venta frente al bosque</h1>

    <picture>
        <source srcset="build/img/destacada2.webp" type="image/webp">
        <source srcset="build/img/destacada2.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
    </picture>

    <p class="informacion-meta">Escrito el <span>20/10/24</span> por: <span>Admin</span></p>

    <div class="resumen-propiedad">
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
include './includes/templates/header.php';
?>