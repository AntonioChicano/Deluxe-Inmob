<?php

function conectarDB()
{
    $db = new mysqli('bzeplstxdjxvchjfu8n2-mysql.services.clever-cloud.com', 'ueteq674ktqz09za', 'obWGMaodCzh4TlIykLr3', 'bzeplstxdjxvchjfu8n2');

    $db->set_charset('utf8');
    mysqli_set_charset($db, "utf8");

    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}
