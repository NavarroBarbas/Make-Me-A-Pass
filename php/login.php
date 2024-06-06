<?php
    /**
     * This code handles the login functionality.
     *
     * @param string $_POST['correo'] The email entered by the user.
     * @param string $_POST['password'] The password entered by the user.
     *
     * JS FUNCTION: validarFormLogin()
     */
    include_once(__DIR__."/../bbdd/usuario.php");

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['correo'];
        $pass = $_POST['password'];
        $hashedPass = "";

        if(strlen($email) == 0 || strlen($email) == null) {
            echo "Email es obligatorio";
            return;
        } else if(!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',$email)) {
            echo "Email es incorrecto";
            return;
        }

        if(strlen($pass) == 0 || strlen($pass) == null) {
            echo "Contraseña es obligatoria";
            return;
        }

        $u=new Usuario();
        $u->setEmail($email);
        $u->setPassword($pass);
        if ($u->login()){
            $_SESSION['usuarioID']=$u->getIdUsuario();
            $_SESSION['isAuth']=true;
            $_SESSION['email'] = strtolower($u->getEmail());
            $_SESSION['nickname'] = $u->getNickname();
            echo "Login Correcto";
        } else{
            echo "Datos de usuario incorrectos o sin confirmar";
        }
    } else {
        echo "Error: Método no permitido.";
    }