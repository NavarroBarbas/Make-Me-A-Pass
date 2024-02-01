<?php
    include '../bbdd/conexiones.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombrepass = $_POST['nombre'];
        $randompass = $_POST['password'];
        $email = $_SESSION['email'];

        $pdo = new Conexion();
        $resid = $pdo->prepare('SELECT user_id FROM usuarios WHERE email =:email');
        $resid->bindValue(':email', $email);
        $resid->execute();

        $resultado = $resid->fetchAll();
        foreach($resultado as $row) {
            $userid = $row['user_id'];
        }

        $insert = $pdo->prepare('INSERT INTO saved_passwords (generated_pass, nombre_pass, user_id)
            VALUES (:randompass, :nombrepass, :userid)');
        $insert->bindValue(':randompass', $randompass);
        $insert->bindValue(':nombrepass', $nombrepass);
        $insert->bindValue(':userid', $userid);
        $insert->execute();
        echo "Insert realizado";

        /*$sqlid = 'SELECT user_id FROM usuarios WHERE email = "' . $email . '"';
        $resid = mysqli_query($conexion, $sqlid);
        $column = $resid -> fetch_assoc();
        $userid = $column['user_id'];

        $sqlinsert = 'INSERT INTO saved_passwords (generated_pass, nombre_pass, user_id)
            VALUES ("' . $randompass . '", "' . $nombrepass . '", ' . $userid . ')';
        $resins = mysqli_query($conexion, $sqlinsert);
        
        echo "Insert realizado";*/
    } else {
        echo "Error: Método no permitido.";
    }