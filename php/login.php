<?php
    /**
     * This code handles the login functionality.
     *
     * @param string $_POST['correo'] The email entered by the user.
     * @param string $_POST['password'] The password entered by the user.
     *
     * JS FUNCTION: validarFormLogin()
     */
    include '../bbdd/conexiones.php';

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['correo'];
        $pass = $_POST['password'];
        $hashedPass = "";

        $pdo = new Conexion();
        $sql = $pdo->prepare('SELECT * FROM usuarios WHERE email =:email LIMIT 1');
        $sql->bindValue(':email', $email);
        $sql->execute();
        $numrows = $sql->rowCount();
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        if($numrows > 0) {
            $resultado = $sql->fetchAll();
            foreach($resultado as $row) {
                $hashedPass = $row['Password'];
            }

            if(password_verify($pass, $hashedPass)) {
                $_SESSION['email'] = strtolower($email);
                echo "Login Correcto";
            } else {
                echo "Datos de usuario incorrectos";
            }
        } else {
            echo "Datos de usuario incorrectos"; 
        }
    } else {
        echo "Error: Método no permitido.";
    }