<?php

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;


?>
<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>
    <?php
    if ($resultado) {
        $mensaje = mostrarMensaje($resultado);
        if ($mensaje) {
    ?>
            <div class="alerta correcto">
                <?php echo $mensaje; ?>
            </div>

    <?php }
    }

    ?>
    <?php if ($auth) : ?>
        <a class="boton boton-verde" href="/blogs/crear">Nueva Entrada De Blog</a>
    <?php endif; ?>


    <?php include 'listaBlogs.php'; ?>
   
</main>