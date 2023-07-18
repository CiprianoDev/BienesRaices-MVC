<?php

namespace controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $resultado = $_GET['resultado'] ?? null;
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $propiedad = new Propiedad($_POST['propiedad']);

            if (!is_dir(CARPERTA_IMAGENES)) {
                mkdir(CARPERTA_IMAGENES);
            }

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $propiedad->setImagen($nombreImagen);
                $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            }

            $errores = $propiedad->validar();

            if (empty($errores)) {

                $imagen->save(CARPERTA_IMAGENES . $nombreImagen);
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $id = validarORedirigir('/admin');
        } else {
            $id = $_POST['id'];
        }

        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        $propiedad = Propiedad::find($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
            $errores = $propiedad->validar();

            if (!is_dir(CARPERTA_IMAGENES)) {
                mkdir(CARPERTA_IMAGENES);
            }

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $propiedad->setImagen($nombreImagen);
                $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            }

            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $imagen->save(CARPERTA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            }
        }

        $router->render("propiedades/actualizar", [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
            'id' => $id
        ]);
    }
}
