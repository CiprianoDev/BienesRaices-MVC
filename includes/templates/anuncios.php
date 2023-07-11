<?php

use App\Propiedad;

if ($_SERVER["SCRIPT_NAME"] === "/anuncios.php") {
    $propiedades = Propiedad::all();
} else {
    $propiedades = Propiedad::get(3);
}

$carpertaImagenes = "/imagenes/";
?>

<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>

    <div class="contenedor-anuncios">

        <?php foreach ($propiedades as $propiedad) : ?>
            <div class="anuncio">

                <img loading="lazy" src="<?php echo $carpertaImagenes . $propiedad->imagen ?>" alt="anuncio">


                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad->titulo ?></h3>
                    <p><?php echo substr($propiedad->descripcion, 0, 50) . "..."  ?></p>
                    <p class="precio"><?php echo "$" . $propiedad->precio ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad->wc ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $propiedad->estacionamiento ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p><?php echo $propiedad->habitaciones ?></p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id= <?php echo $propiedad->id ?>" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div><!--.contenido-anuncio-->
            </div><!--anuncio-->
        <?php endforeach ?>


    </div> <!--.contenedor-anuncios-->

    <div class="alinear-derecha">
        <a href="anuncios.php" class="boton-verde">Ver Todas</a>
    </div>
</section>