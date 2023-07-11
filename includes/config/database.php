<?php

function conectarDB() : mysqli
{
    $db = new mysqli('localhost', 'root', '16ecb0016t', 'bienesraices_crud');

    if (!$db) {
        echo "ocurrio un error inesperado";
        exit;
    }

    return $db; 
}
