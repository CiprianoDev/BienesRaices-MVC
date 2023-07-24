<?php

namespace Model;

class Blog extends ActiveRecord
{
    protected static $tabla = 'blogs';
    protected static $columnasDB = ['id', 'titulo', 'imagen', 'creado', 'contenido'];

    public $id;
    public $titulo;
    public $imagen;
    public $creado;
    public $contenido;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->creado = date("Y/m/d");
        $this->contenido = $args['contenido'] ?? '';
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if (strlen($this->contenido) < 100) {
            self::$errores[] = "El contenido debe ser de al menos 100 caracteres";
        }

        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }


        return self::$errores;
    }
}
