<?php
include_once(__DIR__."/conexiones.php");

class Password extends Conexion {
    private $passwordID;
    private $generatedPass;
    private $nombrePass;
    private $idUsuario;

    public function __construct($id=null){
		parent::__construct();
		if ($id!=null){
			$this->load($id);
		}
	}

    public function getPasswordID(){
        return $this->passwordID;
    }

    public function getGeneratedPass(){
        return $this->generatedPass;
    }

    public function getNombrePass(){
        return $this->nombrePass;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setPasswordID($passwordID){
        $this->passwordID = $passwordID;
    }

    public function setGeneratedPass($generatedPass){
        $this->generatedPass = $generatedPass;
    }

    public function setNombrePass($nombrePass){
        $this->nombrePass = $nombrePass;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function load($id){
        $stmt = $this->prepare("SELECT * FROM passwords WHERE password_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->passwordID = $result['password_id'];
        $this->generatedPass = $result['generated_pass'];
        $this->nombrePass = $result['nombre_pass'];
        $this->idUsuario = $result['user_id'];
    }

    public function savePass(){
        if ($this->passwordID){
            $stmt = $this->prepare("UPDATE passwords SET generated_pass = :generatedPass, nombre_pass = :nombrePass, user_id = :idUsuario WHERE user_id = :id");
            $stmt->bindParam(':id', $this->passwordID);
            $stmt->bindParam(':generatedPass', $this->generatedPass);
            $stmt->bindParam(':nombrePass', $this->nombrePass);
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->execute();
        } else {
            $stmt = $this->prepare("INSERT INTO passwords (generated_pass, nombre_pass, user_id) VALUES (:generatedPass, :nombrePass, :idUsuario)");
            $stmt->bindParam(':generatedPass', $this->generatedPass);
            $stmt->bindParam(':nombrePass', $this->nombrePass);
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->execute();
        }
    }

    public function deletePass(){
        $stmt = $this->prepare("DELETE FROM passwords WHERE idPassword = :id");
    }
}