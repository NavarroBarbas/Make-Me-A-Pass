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
                <a href='http://localhost/Make-Me-A-Pass/verificar.php?type=vfyemail&id={$u->getIdUsuario()}&token={$u->getToken()}'>
                http://localhost/Make-Me-A-Pass/verificar.php?type=vfyemail&id={$u->getIdUsuario()}&token={$u->getToken()}</a></p>");
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