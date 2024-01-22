<?php 

    include '../bbdd/conexiones.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pass_verify = $_POST['pass_verify'];

        
    }
?>