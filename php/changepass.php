<?php

    include '../bbdd/conexiones.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $emailPost = strtolower($_POST['email']);
        $newPass = $_POST['changepass'];
        $email = $_SESSION['email'];
        $hashed_pass = password_hash($newPass, PASSWORD_DEFAULT);

        if($emailPost != $email) {
            echo ("El email debe ser igual al del usuario");
        } else {
            $pdo = new Conexion();
            $update = $pdo->prepare('UPDATE usuarios 
                SET password = :pass
                WHERE email = :email');

            $update->bindValue(':email', $email);
            $update->bindValue(':pass', $hashed_pass);
            $update->execute();

            echo "Password Changed";
        }
    } else {
        echo "Error: Método no permitido.";
    }