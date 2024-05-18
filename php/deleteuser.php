<?php
include '../bbdd/usuario.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    $usuario = new Usuario($_SESSION['usuarioID']);
    
    if ($usuario->deleteUser()) {
        session_destroy();
        echo "Usuario eliminado";
    } else {
        echo "Error al eliminar usuario";
    }
} else {
    echo "Error: Método no permitido.";
}