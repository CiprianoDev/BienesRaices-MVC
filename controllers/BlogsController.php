<?php

namespace controllers;

use Model\Blog;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class BlogsController
{

   
    public static function crear(Router $router)
    {
        $inicio = false;
        $blog = new Blog();
        $errores = Blog::getErrores();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $blog = new Blog($_POST['blog']);

            if (!is_dir(CARPERTA_IMAGENES)) {
                mkdir(CARPERTA_IMAGENES);
            }

            if ($_FILES['blog']['tmp_name']['imagen']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $blog->setImagen($nombreImagen);
                $imagen = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
            }

            $errores = $blog->validar();

            if (empty($errores)) {

                $imagen->save(CARPERTA_IMAGENES . $nombreImagen);
                $blog->guardar();
            }
        }

        $router->render('blogs/crear', [
            'errores' => $errores,
            'blog' => $blog,
            'inicio' => $inicio
        ]);
    }

    public static function actualizar(Router $router)
    {
        $inicio = false;
        $id = validarORedirigir('/blogs/blog');
        $errores = Blog::getErrores();
        $blog = Blog::find($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $args = $_POST['blog'];
            $blog->sincronizar($args);
            $errores = $blog->validar();

            if (!is_dir(CARPERTA_IMAGENES)) {
                mkdir(CARPERTA_IMAGENES);
            }

            if ($_FILES['blog']['tmp_name']['imagen']) {
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $blog->setImagen($nombreImagen);
                $imagen = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
            }

            if (empty($errores)) {
                if ($_FILES['blog']['tmp_name']['imagen']) {
                    $imagen->save(CARPERTA_IMAGENES . $nombreImagen);
                }
                $blog->guardar();
            }
        }

        $router->render("blogs/actualizar", [
            'blog' => $blog,
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

            if ($id) {

                $propiedad = Blog::find($id);
                $propiedad->eliminar();
            }
        }
    }

    public static function entrada(Router $router)
    {
        $inicio = false;
        $id = validarORedirigir('/blog');
        $blog = Blog::find($id);
        $router->render('blogs/entrada', [
            'inicio' => $inicio,
            'blog' => $blog
            
        ]);
    }
}
