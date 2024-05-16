<?php
    include '../bbdd/conexiones.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $oldPass = $_POST['oldpass'];
        $newPass = $_POST['changepass'];
        $email = $_SESSION['email'];
        $hashed_pass = password_hash($newPass, PASSWORD_DEFAULT);
        $old_hashed_pass = "";

        $pdo = new Conexion();
        $vfyOldPass = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email');
        $vfyOldPass->bindValue(':email', $email);
        $vfyOldPass->execute();
        $numrows = $vfyOldPass->rowCount();
        $vfyOldPass->setFetchMode(PDO::FETCH_ASSOC);

        $resultado = $vfyOldPass->fetchAll();
        foreach($resultado as $row) {
            $old_hashed_pass = $row['Password'];
        }

        if(!password_verify($oldPass, $old_hashed_pass)) {
            echo "Contraseña incorrecta.";
        } else {
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