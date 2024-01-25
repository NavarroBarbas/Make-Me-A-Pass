<?php
    include '../bbdd/conexiones.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombrepass = $_POST['nombre'];
        $randompass = $_POST['password'];
        $email = $_SESSION['email'];

        $sqlid = 'SELECT user_id FROM usuarios WHERE email = "' . $email . '"';
        $resid = mysqli_query($conexion, $sqlid);
        $column = $resid -> fetch_assoc();
        $userid = $column['user_id'];

        $sqlinsert = 'INSERT INTO saved_passwords (generated_pass, nombre_pass, user_id)
            VALUES ("' . $randompass . '", "' . $nombrepass . '", ' . $userid . ')';
        $resins = mysqli_query($conexion, $sqlinsert);
        
        echo "Insert realizado";
    } else {
        echo "Error: Método no permitido.";
    }