<?php

namespace controllers;

use Model\Blog;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

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
        $mensaje = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $respuesta  = $_POST['contacto'];
            
            //configuracion general
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '9daf845769fc4c';
            $phpmailer->Password = '5efe2d93194520';

            //configuracion para enviar mensaje
            $phpmailer->setFrom('admin@BienesRacices.com');
            $phpmailer->addAddress('admin@BienesRacices.com', 'BienereRaices.com');
            $phpmailer->Subject = 'Tienes un nuevo mensaje';

            //habilitar html
            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'UTF-8';

            //definir el contenido

            $contenido = '<html>';
            $contenido .= '<h1> Bienes Raices </h1>';
            $contenido .= '<h2> Tienes un nuevo Mensaje </h2>';
            $contenido .= '<p> Nombre: ' . $respuesta['nombre'] . '</p>';
            $contenido .= '<p> Mensaje: ' . $respuesta['mensaje'] . '</p>';

            if ($respuesta['forma_contacto'] == 'email') {
                $contenido .= '<p> El usuario prefiere ser contactado por: ' . $respuesta['forma_contacto'] . '</p>';
                $contenido .= '<p> Email: ' . $respuesta['email'] . '</p>';
            } else {
                $contenido .= '<p> El usuario prefiere ser contactado por: ' . $respuesta['forma_contacto'] . '</p>';
                $contenido .= '<p> Telefono: ' . $respuesta['telefono'] . '</p>';
                $contenido .= '<p> Fecha: ' . $respuesta['fecha'] . '</p>';
                $contenido .= '<p> Hora: ' . $respuesta['hora'] . '</p>';
            }
            $contenido .= '<p> El usuario desea hacer una : ' . $respuesta['accion'] . '</p>';
            $contenido .= '<p> Precio o Presupuesto : $' . $respuesta['precio'] . '</p>';
            $contenido .= '</html>';

            $phpmailer->Body = $contenido;
            $phpmailer->AltBody = 'holaaaa';

            //enviar email

            if ($phpmailer->send()) {
                $mensaje = '<div class="alerta correcto"> Mendaje enviado </div>';
            } else {
                $mensaje = '<div class="alerta error"> no se pudo enviar el mensaje </div>';
            }
        }

        $router->render('paginas/contacto', [
            'inicio' => $inicio,
            'mensaje' => $mensaje

        ]);
    }
}
