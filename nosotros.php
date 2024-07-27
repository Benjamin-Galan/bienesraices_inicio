<?php
include './includes/templates/header.php';
?>

<main class="contenedor seccion">
    <h1>Conoce sobre nosotros</h1>

    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="sobre nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>
                25 Años de experiencia
            </blockquote>
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
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más sobre nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
            <h3>seguridad</h3>
            <p>Iure nisi facilis, optio deleniti harum
                explicabo quia molestiae laudantium inventore dignissimos consectetur accusamus? Animi quo, ipsam
                adipisci labore atque excepturi mollitia!</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
            <h3>Precio</h3>
            <p>Iure nisi facilis, optio deleniti harum
                explicabo quia molestiae laudantium inventore dignissimos consectetur accusamus? Animi quo, ipsam
                adipisci labore atque excepturi mollitia!</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy">
            <h3>tiempo</h3>
            <p>Iure nisi facilis, optio deleniti harum
                explicabo quia molestiae laudantium inventore dignissimos consectetur accusamus? Animi quo, ipsam
                adipisci labore atque excepturi mollitia!</p>
        </div>
    </div>
</section>

<?php
include './includes/templates/header.php';
?>