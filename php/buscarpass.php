<?php
include_once("../bbdd/passwords.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombrepass = $_POST['searchTerm'];
    $userID = $_SESSION['usuarioID'];

    $u = new Password();
    $u->setNombrePass($nombrepass);
    $u->setIdUsuario($userID);
    $u->load($nombrepass);
    
} else {
    echo "Error: Método no permitido.";
}