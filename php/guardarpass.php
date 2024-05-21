<?php

    /**
     * This script is responsible for saving a password in the database.
     * It receives the password details through a POST request and inserts them into the 'saved_passwords' table.
     * The user ID is retrieved from the 'usuarios' table based on the user's email stored in the session.
     * 
     * @param string $_POST['nombre'] The name of the password.
     * @param string $_POST['password'] The generated password.
     * @param string $_SESSION['email'] The user's email stored in the session.
     * 
     * JS FUNCTION: guardarPass()
     */
    include '../bbdd/passwords.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombrepass = $_POST['nombre'];
        $randompass = $_POST['password'];
        $userID = $_SESSION['usuarioID'];

        $u = new Password();
        $u->setGeneratedPass($randompass);
        $u->setNombrePass($nombrepass);
        $u->setIdUsuario($userID);
        if ($u->savePass()) {
            echo "Insert realizado";
        } else {
            echo "Error al insertar la contraseña";
        }


        /*$pdo = new Conexion();
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
        echo "Insert realizado";*/
    } else {
        echo "Error: Método no permitido.";
    }