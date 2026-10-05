<?php  


$db = new mysqli("localhost", "javiercl", "admin", "test");
if ($db->connect_error) {
    die("Error de conexión a la base de datos: " . $db->connect_error);
}
$db->set_charset("utf8mb4");


require_once "models/User.php";
require_once "models/Post.php";
require_once "models/Coment.php";
require_once "controllers/mainController.php";


?>   