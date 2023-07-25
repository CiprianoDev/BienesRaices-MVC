<main class="contenedor seccion contenido-centrado">
    <h1 class="titulo-login">Iniciar Sesion</h1>
    <?php foreach ($errores as $error) : ?>

<div class="alerta error"> <?php echo $error ?></div>


<?php endforeach ?>
    <form method="POST" class="formulario login" action="/login">

        
        <fieldset>
            <legend>E-mail y Password</legend>


            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="email" required>

            <label for="password">Password</label>

            <div class="relative">
                <input type="password" placeholder="Tu password" id="password" name="password" required>
                <button type="button" id="boton-mostrar" class="boton-mostrar">
                    <img id="icono-mostrar" class="icono-mostrar" src="/build/img/no-visible.svg" alt="" srcset="">
                </button>
            </div>

            <input type="submit" class="boton-verde-block" value="Iniciar Sesion">


        </fieldset>
    </form>
</main>