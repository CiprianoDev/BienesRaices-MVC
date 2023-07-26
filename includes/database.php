<?php

function conectarDB(): mysqli
{
    $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD'],
        $_ENV['DB_NAME']
    );

    if (!$db) {
        echo "ocurrio un error inesperado";
        exit;
    }

    return $db;
}
