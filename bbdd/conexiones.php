<?php
    error_reporting(E_ALL ^ E_NOTICE);

    class Conexion {
        private $driver =  "mysql";
        private $hostBD = "bbdd.javiernavarroedib.com";
        private $nombreBD = "ddb219193";
        private $usuarioBD = "ddb219193";
        private $passwordBD = "r5D,f}?mN#+@5(";
        public $errCode=null;
        public $errMsg=null;
        private static $pdo;

        public function __construct() {
            try{
                if (Conexion::$pdo==null) {
                    Conexion::$pdo=new PDO("{$this->driver}:host={$this->hostBD};dbname={$this->nombreBD};charset=utf8",$this->usuarioBD, $this->passwordBD);
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
            return Conexion::$pdo;
        }
    }
