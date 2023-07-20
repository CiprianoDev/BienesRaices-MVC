<?php

namespace controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{
    public static function crear(Router $router)
    {
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $vendedor = new vendedor($_POST['vendedor']);
            $errores = $vendedor->validar();


            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedirigir('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = $_POST['vendedor'];
            $vendedor->sincronizar($args);
            $errores = $vendedor->validar();


            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores,
            'id' => $id
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tipo = $_POST['tipo'];
            $id = $_POST['delete'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if (verificarTipo($tipo)) {
                if ($tipo === 'vendedor') {
                    $propiedad = Vendedor::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
