<?php
//PRODUCTOS
//METODOS: verProductos, verCarrito, agregarCarrito, eliminarCarrito, comprarCarrito

require_once 'models/User.php';
require_once 'models/Products.php';
require_once 'models/Cart.php';
require_once 'models/CartProducts.php';

global $db;
session_start();

// --- Cerrar sesión ---
if (isset($_GET['logout'])){
    unset($_SESSION['user']);
    session_destroy();
    header("Location: index.php");
    exit();
}

// --- Procesar registro (POST) ---
if (isset($_GET['register']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
        // Validar que las contraseñas coinciden
        if ($_POST['password'] !== $_POST['password_confirm']) {
            $_SESSION['info'] = "Las contraseñas no coinciden";
            header("Location: index.php?register");
            exit();
        }
        
        $username = $db->real_escape_string($_POST['username']);
        $password = md5($_POST['password']);
        
        // Comprobar si el usuario ya existe
        $check = $db->query("SELECT id FROM users WHERE username = '$username'");
        if ($check && $check->num_rows > 0) {
            $_SESSION['info'] = "El usuario ya existe";
        } else {
            $q = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            $result = $db->query($q);
            if ($result) {
                // Auto-login tras registro
                $newId = $db->insert_id;
                $_SESSION['user'] = new User($newId, $_POST['username']);
                $_SESSION['info'] = "Usuario registrado con éxito";
            } else {
                $_SESSION['info'] = "Error al registrar el usuario: " . $db->error;
            }
        }
        header("Location: index.php");
        exit();
    }
}

// --- Procesar login (POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])){
    $username = $db->real_escape_string($_POST['username']);
    $password = md5($_POST['password']);
    $q = "SELECT id, username FROM users WHERE username = '$username' AND password = '$password'";
    $result = $db->query($q);
    if ($result && $row = $result->fetch_assoc()) {
        $_SESSION['user'] = new User((int)$row['id'], $row['username']);
        $_SESSION['info'] = "Sesión iniciada con éxito";
    } else {
        $_SESSION['info'] = "Usuario o contraseña incorrectos";
    }
    header("Location: index.php");
    exit();
}
