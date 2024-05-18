<?php
include '../bbdd/usuario.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPass = $_POST['oldpass'];
    $nickname = $_POST['nickname'];
    $email = $_SESSION['email'];
    $old_hashed_pass = "";

    $usuario = new Usuario($_SESSION['usuarioID']);

    if (preg_match('/^[a-zA-Z0-9\_]+$/', $nickname)) {
        if(password_verify($oldPass, $usuario->getPassword())) {
            $usuario->setNickname($nickname);
            $usuario->update();
            $_SESSION['nickname'] = $nickname;
            echo "Nickname Changed";
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Nickname no válido. Solo se permite letras, números y guiones bajos.";
    }
} else {
    echo "Error: Método no permitido.";
}