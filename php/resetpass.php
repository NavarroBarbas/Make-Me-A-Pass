<?php

include_once(__DIR__."/../bbdd/usuario.php");
include_once(__DIR__."/../bbdd/email.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['action'] == 'sendEmailResetPass') {
        $email = $_POST['correo'];
        $u=new Usuario();
        $u->setEmail($email);
        $u->load($email);
        $u->setToken(rand(100000000,900000000));
        if ($u->update()) {
            sendEmail(
                $u->getEmail(), 
                "Recuperar Contraseña", 
                "<p>para recuperar su contraseña visite: 
                <a href='http://makemeapass.javiernavarroedib.com/reestablecer-pass.php?&id={$u->getIdUsuario()}&token={$u->getToken()}'>
                http://makemeapass.javiernavarroedib.com/reestablecer-pass.php?&id={$u->getIdUsuario()}&token={$u->getToken()}</a></p>");
            echo "Email enviado";
        } else {
            echo "Este usuario no existe en el sistema";
        }
    } else if($_POST['action'] == 'resetPass') {
        $newpass = $_POST['newpass'];
        $id = $_POST['id'];
        $token = $_POST['token'];

        $u=new Usuario($id);
        if ($token == $u->getToken()) {
            $newpass =  password_hash($newpass, PASSWORD_DEFAULT);
            $u->setPassword($newpass);
            $u->setToken(null);
            if ($u->update()) {
                echo "Contraseña cambiada";
            } else {
                echo "Error al cambiar contraseña";
            }
        } else {
            echo "Error al cambiar contraseña";
        }
    }
} else {
    echo "Error: Método no permitido.";
}