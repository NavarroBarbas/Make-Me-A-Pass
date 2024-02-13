<?php
    /**
     * This code checks if a session is started and if the request method is POST.
     * If a session is started and the request method is POST, it checks if the 'email' session variable is set.
     * If the 'email' session variable is set, it echoes "Sesion iniciada".
     * If the 'email' session variable is not set, it echoes "Sesion no iniciada".
     * If the request method is not POST, it echoes "Error: Método no permitido."
     * 
     * JS FUNCTION: generarPass()
     */

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(isset( $_SESSION['email'])) {
            echo "Sesion iniciada";
        } else {
            echo "Sesion no iniciada";
        }

    } else {
        echo "Error: Método no permitido.";
    }