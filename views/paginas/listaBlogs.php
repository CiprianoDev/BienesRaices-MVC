<?php

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;


?>
<?php foreach ($blogs as $blog) : ?>
        <article class="entrada-blog">
            <div class="imagen">

                <img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="Texto Entrada Blog">

            </div>

            <div class="texto-entrada">
                <a href="/blogs/entrada?id=<?php echo $blog->id; ?>">
                    <h4><?php echo $blog->titulo; ?></h4>
                    <p class="informacion-meta">Escrito el: <span><?php echo $blog->creado; ?></span> por: <span>Admin</span> </p>

                    <p>
                        <?php echo substr($blog->contenido, 0, 50) . "..."  ?>
                    </p>
                </a>
            </div>
        </article>


        <?php if ($auth && !$inicio) : ?>
            <div class="acciones-blog">
                <div class="boton-logo">
                    <a href="/blogs/actualizar?id=<?php echo s($blog->id); ?>">
                        <img src="/build/img/editar.svg" alt="boton">
                        <p>Editar</p>
                    </a>
                </div>

                <form class="boton-logo-form" action="/blogs/eliminar" method="POST">
                    <input type="hidden" name="delete" value="<?php echo s($blog->id); ?>">
                    <img src="/build/img/eliminar.svg" alt="boton eliminar">
                        <input type="submit" value="eliminar">
                    </img>
                </form>




            </div>
        <?php endif; ?>
    <?php endforeach; ?>