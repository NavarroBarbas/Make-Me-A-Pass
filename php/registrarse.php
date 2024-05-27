<?php 
    /**
     * This script handles the registration process.
     * It receives the user's email, password, and password verification from a POST request.
     * It checks if the user already exists in the database.
     * If the user does not exist, it adds the user to the database with the hashed password.
     * It also starts a session and stores the user's email in the session.
     * Finally, it outputs a message indicating the result of the registration process.
     *
     * @param string $_POST['emailregistro'] The user's email from the registration form.
     * @param string $_POST['passregistro'] The user's password from the registration form.
     * @param string $_POST['passverify'] The user's password verification from the registration form.
     * @return void
     * 
     * JS FUNCTION: validarFormRegistro()
     */

    include_once(__DIR__."/../bbdd/usuario.php");
    include_once(__DIR__."/../bbdd/email.php");

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['emailregistro'];
        $pass = $_POST['passregistro'];
        $passvfy = $_POST['passvfy'];

        if(strlen($email) == 0 || strlen($email) == null) {
            echo "Email es obligatorio";
            return;
        } else if(!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',$email)) {
            echo "Email es inválido";
            return;
        }

        if(strlen($pass) == 0 || strlen($pass) == null) {
            echo "Contraseña es obligatoria";
            return;
        } else if(!preg_match('/^.{8,}$/', $pass)) {
            echo "Contraseña debe tener mínimo 8 carácteres";
            return;
        }

        if(strlen($passvfy) == 0 || strlen($passvfy) == null) {
            echo "Confirmar contraseña es obligatorio";
            return;
        }

        if($pass != $passvfy) {
            echo "Las contraseñas deben coincidir";
            return;
        }

        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

        $u=new Usuario();
        $u->setEmail($email);
        $u->setPassword($hash_pass);
        $u->setToken(rand(100000000,900000000));
        if ($u->registro()) {
            sendEmail(
                $u->getEmail(), 
                "Registro de Usuario", 
                "<p>para finalizar el registro visite: 
                <a href='http://makemeapass.javiernavarroedib.com/verificar.php?id={$u->getIdUsuario()}&token={$u->getToken()}'>
                http://makemeapass.javiernavarroedib.com/verificar.php?id={$u->getIdUsuario()}&token={$u->getToken()}</a></p>");

            echo "Añadiendo usuario";
        } else {
            sendEmail(
                $u->getEmail(), 
                "Registro de Usuario", 
                "<p>Alguien esta intentando registrarse con su email</p>");
            echo "Este usuario ya existe en el sistema";
        }
    } else {
        echo "Error: Método no permitido.";
    }