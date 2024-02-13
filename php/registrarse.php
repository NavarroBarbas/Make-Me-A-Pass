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

    include '../bbdd/conexiones.php';

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['emailregistro'];
        $pass = $_POST['passregistro'];
        $pass_verify = $_POST['passverify'];
        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

        $pdo = new Conexion();
        $sql = $pdo->prepare('SELECT * FROM usuarios WHERE email =:email');
        $sql->bindValue(':email', $email);
        $sql->execute();
        $numrows = $sql->rowCount();
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        if($numrows > 0) {
            echo "Este usuario ya existe en el sistema";
        } else {
            $adduser = $pdo->prepare('INSERT INTO usuarios (email, password)
                VALUES (:email, :hashedpass)');
            $adduser->bindValue(':email', $email);
            $adduser->bindValue(':hashedpass', $hash_pass);
            $adduser->execute();

            $_SESSION['email'] = strtolower($email);
            echo "Añadiendo usuario";
        }
    } else {
        echo "Error: Método no permitido.";
    }