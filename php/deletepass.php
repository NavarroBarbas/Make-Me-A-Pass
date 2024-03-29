<?php
    
    /**
     * This script is responsible for deleting a saved password from the database.
     * It receives the password, password name, password ID, and user email through a POST request.
     * The script connects to the database, executes a DELETE query to remove the specified password,
     * and returns a success message if the deletion is successful.
     * If the request method is not POST, an error message is returned.
     *
     * @param string $_POST['password'] The password to be deleted.
     * @param string $_POST['nombrepass'] The name of the password to be deleted.
     * @param int $_POST['passid'] The ID of the password to be deleted.
     * @param string $_SESSION['email'] The email of the user who is deleting the password.
     *
     * @return string The result message indicating whether the password was successfully deleted or an error occurred.
     * 
     * JS FUNCTION: eliminarPass()
     */

    include '../bbdd/conexiones.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $nombrepass = $_POST['nombrepass'];
        $passid = $_POST['passid'];
        $email = $_SESSION['email'];

        $pdo = new Conexion();
        $sql = $pdo->prepare('DELETE FROM saved_passwords 
            WHERE password_id = :passid 
            AND nombre_pass = :nombrepass');

        $sql->bindValue(':passid', $passid);
        $sql->bindValue(':nombrepass', $nombrepass);
        $sql->execute();
        
        echo "Contraseña Eliminada";
    } else {
        echo "Error: Método no permitido.";
    }