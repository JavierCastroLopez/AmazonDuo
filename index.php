<?php

require_once "db.php";

//PROYECTO PARA UNA TIENDA ONLINE
$env = parse_ini_file(".env");
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
}

$db = db::connect();
if ($db->connect_error) {
    die("Error de conexión a la base de datos: " . $db->connect_error);
}
$db->set_charset("utf8mb4");

require_once "controllers/mainController.php";


?>