<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

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



    <a href="/propiedades/crear" class="boton boton-verde">Nueva propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-verde">Nuevo vendedor(a)</a>
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>

            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>

        <tbody>
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>


                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>
                        <div class="imagen">
                            <img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>">

                        </div>
                    </td>
                    <td><?php echo $propiedad->precio; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="delete" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input class="boton-rojo-block" type="submit" value="Eliminar "></input>
                        </form>

                        <a class="boton-amarillo-block" href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>

                </tr>
            <?php endforeach ?>


        </tbody>

        </thead>
    </table>

</main>