<?php 

    include '../bbdd/conexiones.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email-registro'];
        $pass = $_POST['pass-registro'];
        $pass_verify = $_POST['pass_verify'];

        
    }
?>