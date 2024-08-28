<fieldset>
    <legend>Información general de la propiedad</legend>

    <label for="titulo">Título de la propiedad</label>
    <input type="text" id="titulo" name="titulo" placeholder="Título propiedad" value="<?php echo stz($propiedad->titulo); ?>">

    <label for="precio">Precio de la propiedad</label>
    <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo stz($propiedad->precio); ?>">

    <label for="imagen">Imagen de la propiedad</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

    <?php
        if($propiedad->imagen){ ?>
        <img src="../../imagenes/<?php echo $propiedad->imagen?>" class="imagen-pequeña">
    <?php } ?> 

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion"><?php echo stz($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="habitaciones" placeholder="ej. 3" min="1" max="9"
        value="<?php echo stz($propiedad->habitaciones); ?>">

    <label for="wc">Baños</label>
    <input type="number" id="wc" name="wc" placeholder="ej. 3" min="1" max="9" value="<?php echo stz($propiedad->wc);?>">

    <label for="estacionamiento">Estacionamiento</label>
    <input type="number" id="estacionamiento" name="estacionamiento" placeholder="ej. 3" min="1" max="9" 
    value="<?php echo stz($propiedad->estacionamiento);?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
</fieldset>