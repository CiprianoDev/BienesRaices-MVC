<?php

define('TEMPLATES_URL', __DIR__ . '/templates/');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPERTA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . "/imagenes/");


function incluirTemplate(string $nombre, bool $inicio = false,  bool $limite = false)
{
    include TEMPLATES_URL . "$nombre.php";
}

function estaAutenticado()
{
    session_start();


    if (!$_SESSION['login']) {
        header('location: /login.php');
    }
}

function debugear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//escapar html

function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

//validar tipo de registro a eliminar

function verificarTipo($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

function mostrarMensaje($resultado)
{
    $mensaje = '';

    switch ($resultado) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;

        default:
            $mensaje = false;
    }

    return $mensaje;
}

function validarORedirigir($url)
{   
    $id = $_GET['id'];
    
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {

        header("location: $url");
    }
    return $id;
}
