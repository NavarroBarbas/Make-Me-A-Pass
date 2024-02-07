<?php
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