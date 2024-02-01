<?php
    include '../bbdd/conexiones.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $nombrepass = $_POST['nombrepass'];
        $passid = $_POST['passid'];
        $email = $_SESSION['email'];

        $pdo = new Conexion();
        $sql = $pdo->prepare('DELETE FROM saved_passwords 
            WHERE password_id = :passid 
            AND nombre_pass = :nombrepass');

        $sql->bindValue(':passid', $passid);
        $sql->bindValue(':nombrepass', $nombrepass);
        $sql->execute();
        
        echo "Contraseña Eliminada";
    } else {
        echo "Error: Método no permitido.";
    }