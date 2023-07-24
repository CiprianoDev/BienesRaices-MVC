<fieldset>
    <legend>Informacion General</legend>
    
    <label for="Titulo">Titulo:</label>
    <input name="blog[titulo]" type="text" id="nombre" placeholder="Titulo de entrada de blog" value="<?php echo s($blog->titulo) ?>">

    <label for="imagen">Imagen:</label>
    <input name="blog[imagen]" type="file" id="imagen" accept="image/jpeg, image/png">

    <?php if ($blog->imagen) { ?>
        <img src="/imagenes/<?php echo $blog->imagen ?>" alt="Imagen de blog" class="imagen-small">
    <?php } ?>

    <label for="contenido">Contenido:</label>
    <textarea name="blog[contenido]"  id="contenido" ><?php echo s($blog->contenido) ?></textarea>

    
</fieldset>