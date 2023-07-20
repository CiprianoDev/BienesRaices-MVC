<?php

namespace Model;

class ActiveRecord
{
    // base de datos 

    protected static $db;
    protected static $columnasDB = [];
    protected static $errores = [];
    protected static $tabla = '';



    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function setImagen($imagen)
    {

        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen()
    {
        $existeArchivo = file_exists(CARPERTA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPERTA_IMAGENES . $this->imagen);
        }
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }

    public function actualizar()
    {
        $datos = $this->sanitizarDatos();

        $valores = [];
        foreach ($datos as $key => $value) {
            $valores[] = "$key = '$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";


        $resultado = self::$db->query($query);
        if ($resultado) {
            header('location: /admin?resultado=2');
        }
    }

    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . s($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {

            if (static::$tabla == "propiedades") {
                $this->borrarImagen();
            }
            header('location: /admin?resultado=3');
        }
    }

    public function crear()
    {
        $datos = $this->sanitizarDatos();

        $sql = "INSERT INTO " . static::$tabla . " ( ";
        $sql .= join(', ', array_keys($datos));
        $sql .= " ) VALUES (' ";
        $sql .= join("', '", array_values($datos));
        $sql .= "' )";


        $resultado = self::$db->query($sql);

        if ($resultado) {
            header('location: /admin?resultado=1');
        }
    }

    // identificar atributos y guardar en array
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna == 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function sanitizarDatos()
    {
        $datosSanitizados = [];
        $datos = $this->atributos();
        foreach ($datos as $key => $value) {
            $datosSanitizados[$key] = self::$db->escape_string($value);
        }
        return $datosSanitizados;
    }

    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultaSQL($query);
        return $resultado;
    }

    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultaSQL($query);
        return $resultado;
    }

    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $resultado = self::consultaSQL($query);
        return array_shift($resultado);
    }



    public static function consultaSQL($query)
    {
        $resultado = self::$db->query($query);
        $array = [];

        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        $resultado->free();

        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
