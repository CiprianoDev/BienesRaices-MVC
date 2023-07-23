<?php

namespace controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Router $router)
    {   $inicio = false;
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores,
            'inicio' => $inicio
        ]);
    }

    public static function crear(Router $router)
    {   
        $inicio = false;
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
            'errores' => $errores,
            'inicio' => $inicio
        ]);
    }
    public static function actualizar(Router $router)
    {   
        $inicio = false;
        $id = validarORedirigir('/admin');
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
            'inicio' => $inicio

        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tipo = $_POST['tipo'];
            $id = $_POST['delete'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if (verificarTipo($tipo) && $id) {
                if ($tipo === 'propiedad') {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
