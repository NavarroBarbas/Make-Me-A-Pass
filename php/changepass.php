<?php

    /**
     * This script is responsible for changing the password of a user.
     * It receives the email and new password through a POST request,
     * verifies if the email matches the user's email stored in the session,
     * and updates the user's password in the database if the email matches.
     * It uses password_hash() function to securely hash the new password.
     * 
     * @param string $_POST['email'] The email entered by the user.
     * @param string $_POST['changepass'] The new password entered by the user.
     * @param string $_SESSION['email'] The email of the currently logged in user.
     * 
     * @return string The result of the password change operation.
     *         - If the email does not match the user's email, it returns an error message.
     *         - If the password is successfully changed, it returns a success message.
     *         - If the request method is not POST, it returns an error message.
     * 
     * JS FUNCTION: cambiarPass()
     */

    include '../bbdd/conexiones.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $emailPost = strtolower($_POST['email']);
        $newPass = $_POST['changepass'];
        $email = $_SESSION['email'];
        $hashed_pass = password_hash($newPass, PASSWORD_DEFAULT);

        if($emailPost != $email) {
            echo ("El email debe ser igual al del usuario");
        } else {
            $pdo = new Conexion();
            $update = $pdo->prepare('UPDATE usuarios 
                SET password = :pass
                WHERE email = :email');

            $update->bindValue(':email', $email);
            $update->bindValue(':pass', $hashed_pass);
            $update->execute();

            echo "Password Changed";
        }
    } else {
        echo "Error: Método no permitido.";
    }