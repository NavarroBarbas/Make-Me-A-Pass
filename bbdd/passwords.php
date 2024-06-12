<?php
include_once(__DIR__."/conexiones.php");

class Password extends Conexion {
    private $passwordID;
    private $generatedPass;
    private $nombrePass;
    private $idUsuario;

    public function __construct(){
		parent::__construct();
		
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

    public function load($searchedPass = null){
        $this->clearErr();
        $searchedPassValue = "%$searchedPass%";
        if($searchedPass != null) {
            $stmt = $this->getPdo()->prepare("SELECT * FROM saved_passwords WHERE user_id = :id AND nombre_pass LIKE :searchedPass ORDER BY nombre_pass ASC");
            $stmt->bindParam(':id', $this->idUsuario);
            $stmt->bindParam(':searchedPass', $searchedPassValue);
        } else {
            $stmt = $this->getPdo()->prepare("SELECT * FROM saved_passwords WHERE user_id = :id ORDER BY nombre_pass ASC");
            $stmt->bindParam(':id', $this->idUsuario);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($result as $row) {
            $nombrePass = $row["nombre_pass"];
            $password = htmlspecialchars($this->descifrar($row["generated_pass"]));
            $passid = $row["password_id"];

            echo '<div id="savedpass" class="passwords__passdiv" data-cy="list-password">
                    <h4 class="passdiv__nombre" data-cy="password-nombre">' . $nombrePass . '</h4>
                    <a class="passdiv__password" id="'. $password . '" data-cy="password-pass">' . $password . '</a>
                    <nav class="passdiv__nav" data-cy="password-footer">
                    <a class="nav__eliminar" id="deleteClick" onclick="eliminarPass(\'' . $passid . '\')" data-cy="password-eliminar">Eliminar</a>
                    <a class="nav__copiar" onclick="copiar(\'' . $password . '\')" data-cy="password-copiar">Copiar</a>
                    </nav>
                </div>';
        }
    }

    public function savePass(){
		$this->clearErr();
        try {
            $password = $this->cifrar($this->generatedPass);
            $stmt = $this->getPdo()->prepare("INSERT INTO saved_passwords (generated_pass, nombre_pass, user_id) VALUES (:generatedPass, :nombrePass, :idUsuario)");
            $stmt->bindParam(':generatedPass', $password);
            $stmt->bindParam(':nombrePass', $this->nombrePass);
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $this->errCode = $e->getCode();
            $this->errMsg = $e->getMessage();
            return false;
        }
    }

    public function deletePass($id, $idUsuario){
        $stmt = $this->getPdo()->prepare("DELETE FROM saved_passwords WHERE password_id = :id AND user_id = :idUsuario");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->execute();
    }

    private function cifrar($texto){
		$key=$_SESSION['pass'];

		$ivlong=openssl_cipher_iv_length("AES-128-CBC"); //longitud del vector de inicialización
		$iv=openssl_random_pseudo_bytes($ivlong);

		$bruto=openssl_encrypt($texto, "AES-128-CBC", $key, $options=OPENSSL_RAW_DATA, $iv);
		$hmac=hash_hmac('sha256', $bruto, $key, true);

		$textoCifrado=base64_encode($iv.$hmac.$bruto);
		return $textoCifrado;
	}

    private function descifrar($texto){
		$key=$_SESSION['pass'];
		
		$ivlong=openssl_cipher_iv_length("AES-128-CBC");
		$decode=base64_decode($texto);
		$iv = substr($decode, 0, $ivlong);
		$hmac = substr($decode, $ivlong, 32);

		$brutoDes= substr($decode, $ivlong+32);
		$textoDescifrado=openssl_decrypt($brutoDes, "AES-128-CBC", $key, $options=OPENSSL_RAW_DATA, $iv);
		$hmac2=hash_hmac('sha256', $brutoDes, $key, true);
		if (hash_equals ($hmac, $hmac2)){
			return $textoDescifrado;
		} else {
			return "Contaseña no recuperable.";
		}
	}
}