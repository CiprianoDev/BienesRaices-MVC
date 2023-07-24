<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $blog->titulo; ?></h1>
    
    <img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="imagen de la propiedad">


    <p class="informacion-meta">Escrito el: <span><?php echo $blog->creado; ?></span> por: <span>Admin</span> </p>


    <div class="resumen-propiedad texto-descripcion-entrada">
        <p><?php echo $blog->contenido; ?></p>

        </div>
</main>