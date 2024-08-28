<?php
include '/includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen-contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form action="" class="formulario">
        <fieldset>
            <legend>Informacion personal</legend>
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" placeholder="Tu nombre">

            <label for="email">E-mail</label>
            <input id="email" type="email" placeholder="Tu email">

            <label for="telefono">Telefono</label>
            <input id="telefono" type="tel" placeholder="Tu telefono">

            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje"></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre la propiedad</legend>

            <label for="opciones">Vende o compra:</label>
            <select id="opciones">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Telefono</label>
            <input id="presupuesto" type="number" placeholder="Precio o presupuesto">
        </fieldset>

        <fieldset>
            <legend>Informacion sobre la propiedad</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Telefono</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                <label for="contactar-email">E-mail</label>
                <input name="contacto" type="radio" value="email" id="contactar-email">
            </div>

            <p>Si eligió telefono, elija la fecha y la hora</p>

            <label for="fecha">Fecha:</label>
            <input id="fecha" type="date">

            <label for="hora">Hora:</label>
            <input id="hora" type="time" min="09:00" max="18:00">
        </fieldset>

        <input type="submit" value="enviar" class="boton-verde">
    </form>
</main>

<?php
include './includes/templates/header.php';
?>

</html>