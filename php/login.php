<?php
    include '../bbdd/conexiones.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['correo'];
        $pass = $_POST['password'];
        $hashedPass = "";

        $userPass = 'SELECT * FROM usuarios WHERE email = "' . $email . '" LIMIT 1';
        $result = mysqli_query($conexion, $userPass);

        if($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $hashedPass = $row['Password'];
            }

            if(password_verify($pass, $hashedPass)) {
                echo "Login Correcto";
                //Comienza la sesión
                session_start([
                    'cookie_lifetime' => 86400,
                    'read_and_close'  => true
                ]);
                $_SESSION["email"] = $_POST['correo'];
                $_SESSION["password"] = $_POST['password'];
            } else {
                echo "Datos de usuario incorrectos";
            }

        } else {
            echo "Datos de usuario incorrectos"; 
        }
    } else {
        echo "Error: Método no permitido.";
    }
?>