<?php

    class Conexion {
        private $driver =  "mysql";
        private $hostBD = "bbdd.javiernavarroedib.com";
        private $nombreBD = "ddb219193";
        private $usuarioBD = "ddb219193";
        private $passwordBD = "r5D,f}?mN#+@5(";
        private $errCode=null;
        private $errMsg=null;
        private static $pdo;

        public function __construct() {
            try{
                if ($this->pdo==null) {
                    $this->pdo=new PDO("{$this->driver}:host={$this->hostBD};dbname={$this->nombreBD};charset=utf8",$this->usuarioBD, $this->passwordBD);
                }
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public function clearErr(){
            $this->errCode=null;
            $this->errMsg=null;
        }
        
        public function getErrCode(){
            return $this->errCode;
        }
        
        public function getErrMsg(){
            return $this->errMsg;
        }
        
        public function getPdo(){
            return $this->pdo;
        }
    }
