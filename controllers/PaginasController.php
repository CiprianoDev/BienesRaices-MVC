<?php

namespace controllers;

use Model\Blog;
use Model\Propiedad;
use MVC\Router;

class PaginasController
{
    public static function index(Router $router)
    {
        $inicio = true;
        $propiedades = Propiedad::get(3);
        $blogs = Blog::get(2);
        $router->render('paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propiedades,
            'blogs' => $blogs

        ]);
    }

    public static function blog(Router $router)
    {
        $inicio = false;
        $auth = true;
        $resultado = $_GET['resultado'] ?? null;
        $blogs = Blog::all();
        $router->render('paginas/blog', [
            'inicio' => $inicio,
            'auth' => $auth,
            'blogs' => $blogs,
            'resultado' => $resultado

        ]);
    }

    public static function nosotros(Router $router)
    {
        $inicio = false;
        $router->render('paginas/nosotros', [
            'inicio' => $inicio

        ]);
    }

    public static function anuncios(Router $router)
    {
        $inicio = false;
        $propiedades = Propiedad::all();
        $router->render('paginas/listaPropiedades', [
            'inicio' => $inicio,
            'propiedades' => $propiedades
            
        ]);
    }

    public static function anuncio(Router $router)
    {
        $inicio = false;
        $id = validarORedirigir('/');
        $propiedad = Propiedad::find($id);
        $router->render('paginas/anuncio', [
            'inicio' => $inicio,
            'propiedad' => $propiedad
            
        ]);
    }

    public static function contacto(Router $router)
    {
        $inicio = false;
        $router->render('paginas/contacto', [
            'inicio' => $inicio

        ]);
    }
}
