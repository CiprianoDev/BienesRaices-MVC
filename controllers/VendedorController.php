<?php

namespace controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController
{
    public static function crear(Router $router){
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $vendedor = new vendedor($_POST['vendedor']);
            $errores = $vendedor->validar();
        
        
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear',[
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
}
