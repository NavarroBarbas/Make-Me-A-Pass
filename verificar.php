<?php
include_once(__DIR__."/bbdd/usuario.php");

$id=$_GET['id'];
$token=$_GET['token'];

$u=new Usuario($id);

  if ($token == $u->getToken() && $u->getIdUsuario() != null){
    session_start();
    $u->setToken(null);
    $u->update();
    $_SESSION['email'] = strtolower($u->getEmail());
    $_SESSION['usuarioID'] = $u->getIdUsuario();
    header("Location: index.php");
  } else {
    header("Location: index.php");
  }