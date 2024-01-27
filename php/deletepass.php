<?php
    include '../bbdd/conexiones.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $nombrepass = $_POST['nombrepass'];
        $passid = $_POST['passid'];
        $email = $_SESSION['email'];

        $sqlid = 'SELECT user_id FROM usuarios WHERE email = "' . $email . '"';
        $resid = mysqli_query($conexion, $sqlid);
        $column = $resid -> fetch_assoc();
        $userid = $column['user_id'];

        $sqldel = 'DELETE FROM saved_passwords 
            WHERE password_id = "' . $passid . '" 
            AND nombre_pass = "' . $nombrepass . '"';

        mysqli_query($conexion, $sqldel);
        
        echo "Contraseña Eliminada";
    } else {
        echo "Error: Método no permitido.";
    }