<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $funcion)
    {
        $this->rutasGET[$url] = $funcion;
    }

    public function post($url, $funcion)
    {
        $this->rutasPOST[$url] = $funcion;
    }

    public function comprobarRutas()
    {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];


        if ($metodo === 'GET') {
            $funcion = $this->rutasGET[$urlActual] ?? null;
        } else {
            $funcion = $this->rutasPOST[$urlActual] ?? null;
        }

        if ($funcion) {
            call_user_func($funcion, $this);
        } else {
            echo 'pagina no encontrada';
        }
    }

    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once __DIR__ .  "/views/$view.php";
        $contenido = ob_get_clean();
        include_once __DIR__ .  "/views/layout.php";
    }
}
