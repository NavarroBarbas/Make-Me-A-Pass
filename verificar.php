<?php
include_once(__DIR__."/bbdd/usuario.php");

$id=$_GET['id'];
$token=$_GET['token'];

$u=new Usuario($id);

if ($token == $u->getToken()){
	$u->setToken(null);
	$u->update();
  header("Location: index.php");
} else {
  header("Location: index.php");
}