<?php

namespace controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores
        ]);
    }
    public static function actualizar()
    {
        echo "actualizar";
    }
}
