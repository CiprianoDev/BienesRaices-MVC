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

    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];


        if($metodo === 'GET'){
            $funcion = $this->rutasGET[$urlActual] ?? null;
        }

        if($funcion){
            call_user_func($funcion,$this);
        }else{
            echo 'pagina no encontrada';
        }
    } 

    public function render($view){
        include __DIR__ .  '/views/' . $view . '.php';
    }
}

?>