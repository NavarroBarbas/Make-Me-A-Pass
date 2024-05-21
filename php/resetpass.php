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
                <a href='http://localhost/Make-Me-A-Pass/verificar.php?type=reset&id={$u->getIdUsuario()}&token={$u->getToken()}'>
                http://localhost/Make-Me-A-Pass/verificar.php?type=reset&id={$u->getIdUsuario()}&token={$u->getToken()}</a></p>");
            echo "Email enviado";
        } else {
            echo "Este usuario no existe en el sistema";
        }
    } else if($_POST['action'] == 'resetPass') {
        $email = $_POST['emailregistro']; //TODO

        $u=new Usuario();
        $u->setEmail($email);
        $u->setToken(rand(100000000,900000000));
        if ($u->registro()) {
            sendEmail(
                $u->getEmail(), 
                "Registro de Usuario", 
                "<p>para finalizar el registro visite: ");
            
            echo "Añadiendo usuario";
        } else {
            sendEmail(
                $u->getEmail(), 
                "Registro de Usuario", 
                "<p>Alguien esta intentando registrarse con su email</p>");
            echo "Este usuario ya existe en el sistema";
        }
    }
} else {
    echo "Error: Método no permitido.";
}