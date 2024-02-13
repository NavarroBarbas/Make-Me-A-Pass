<?php
    /**
     * This file handles the logout functionality.
     * It destroys the session and displays a message indicating that the session has been closed.
     * 
     * JS FUNCTION: cerrarSesion()
     */

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_destroy();
        echo "Sesion Cerrada";
    }