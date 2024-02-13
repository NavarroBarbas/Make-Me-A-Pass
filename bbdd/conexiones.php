<?php

    class Conexion extends PDO {
        private $hostBD = "bbdd.javiernavarroedib.com";
        private $nombreBD = "ddb219193";
        private $usuarioBD = "ddb219193";
        private $passwordBD = "r5D,f}?mN#+@5(";

        public function __construct() {

            try {
                parent::__construct('mysql:host=' . $this->hostBD . ';dbname=' . $this->nombreBD . ';charset=utf8', 
            $this->usuarioBD, $this->passwordBD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
                exit;
            }
        }
    }
?>