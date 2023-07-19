<fieldset>
    <legend>Informacion General</legend>

    <input type="hidden" name="id" value="<?php echo s($id) ?>">
    <label for="titulo">Titulo:</label>
    <input name="propiedad[titulo]" type="text" id="titulo" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo) ?>">

    <label for="precio">Precio:</label>
    <input name="propiedad[precio]" type="number" id="precio" placeholder="ej: 3000000" value="<?php echo s($propiedad->precio) ?>">

    <label for="imagen">Imagen:</label>
    <input name="propiedad[imagen]" type="file" id="imagen" accept="image/jpeg, image/png">

    <?php if ($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="Imagen de propiedad" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripcion:</label>
    <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad->descripcion) ?></textarea>

</fieldset>

<fieldset>
    <legend>Informacion de la Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input name="propiedad[habitaciones]" type="number" id="habitaciones" placeholder="ej: 3" min="1" max="10" value="<?php echo s($propiedad->habitaciones) ?>">

    <label for="wc">Baños:</label>
    <input name="propiedad[wc]" type="number" id="wc" placeholder="ej: 3" min="1" max="5" value="<?php echo s($propiedad->wc) ?>">

    <label for="estacionamiento">Estacionamientos:</label>
    <input name="propiedad[estacionamiento]" type="number" id="estacionamiento" placeholder="ej: 3" min="1" max="5" value="<?php echo s($propiedad->estacionamiento) ?>">


</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <select name="propiedad[vendedores_id]" id="vendedor">
        <option value="">--Selecionar--</option>
        <?php foreach ($vendedores as $vendedor) : ?>
            <option <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?> value="<?php echo $vendedor->id ?>"> <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?> </option>
        <?php endforeach ?>
    </select>
</fieldset>