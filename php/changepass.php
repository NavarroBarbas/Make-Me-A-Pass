<?php
include '../bbdd/usuario.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPass = $_POST['oldpass'];
    $newPass = $_POST['changepass'];
    $email = $_SESSION['email'];
    $hashed_pass = password_hash($newPass, PASSWORD_DEFAULT);
    $old_hashed_pass = "";

    $usuario = new Usuario($_SESSION['usuarioID']);

    if(password_verify($oldPass, $usuario->getPassword())) {
        $usuario->setPassword($hashed_pass);
        $usuario->update();
        echo "Password Changed";
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Error: Método no permitido.";
}