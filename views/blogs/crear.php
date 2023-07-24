
<main class="contenedor seccion">
    <h1>Crear Nueva Entrada De Blog</h1>
    <a href="/blog" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>

    <?php endforeach ?>



    <form action="/blogs/crear" class="formulario" method="POST" enctype="multipart/form-data">
        
        <?php include __DIR__ . '/formulario.php' ?>

        <input type="submit" value="Crear Entrada" class="boton boton-verde">
    </form>
</main>