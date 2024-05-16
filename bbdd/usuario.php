<?php
include_once(__DIR__."/conexiones.php");

class Usuario extends Conexion {
    private $idUsuario;
    private $nickname;
    private $email;
    private $password;
    private $token;
	private $errCode=null;
	private $errMsg=null;

    public function __construct($id=null){
		parent::__construct();
		if ($id!=null){
			$this->load($id);
		}
	}

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getNickname(){
        return $this->nickname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getToken(){
        return $this->token;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function setNickname($nickname){
        $this->nickname = $nickname;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setToken($token){
        $this->token = $token;
    }

    public function load($id){
		$this->clearErr();
		if ($id) {
			try{
				$stm=$this->getPdo()->prepare("Select * from usuarios where idUsuario=?");
				$stm->bindParam(1, $id);
				$stm->execute();
				
				$result = $stm->fetch(PDO::FETCH_ASSOC);
				if ($result) {
					$this->idUsuario=	$result['user_id'];
					$this->email=		$result['email'];
					$this->nickname=	$result['nickname'];
					$this->password=	$result['password'];
					$this->token=		$result['token'];
					return true;
				}
			} catch (PDOException $e){
				//$this->errCode=$e->getCode();
				//$this->errMsg=$e->getMessage();
				return false;
			}
			
		}
		return false;
	}

    public function login(){
		$this->clearErr();
		try{
			$stm=$this->getPdo()->prepare("Select * from usuarios where email=?");
			$stm->bindParam(1, $this->email, PDO::PARAM_STR);
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_ASSOC);
			if (password_verify($this->password, $result['Password'])) {
				$this->idUsuario = $result['user_id'];
				$this->load($this->idUsuario);
				return true;
			}
			
		} catch (PDOException $e){
			$this->errCode=$e->getCode();
			$this->errMsg=$e->getMessage();
		}
		return false;
	}

	public function registro(){
		$this->clearErr();
		try{
			$stm=$this->getPdo()->prepare("insert into usuarios (email, password) values (?,?,?)");
			$stm->bindParam(1, $this->email);
			$stm->bindParam(2, $this->password);
			$stm->execute();
			$this->idUsuario=$this->getPdo()->lastInsertId();
			if ($this->idUsuario) return true;
		} catch (PDOException $e){
			$this->errCode=$e->getCode();
			$this->errMsg=$e->getMessage();
		}
		return false;
	}

	public function deleteUser(){
		$this->clearErr();
		if ($this->idUsuario) {
			try{
				$stm=$this->getPdo()->prepare("delete from usuarios where user_id=?");
				$stm->bindParam(1, $this->idUsuario);
				$stm->execute();
				return true;
			} catch (PDOException $e){
				$this->errCode=$e->getCode();
				$this->errMsg=$e->getMessage();
			}
		}
		return false;
	}

	public function updatePassword(){
		$this->clearErr();
		if ($this->idUsuario) {
			try{
				$stm=$this->getPdo()->prepare("update usuarios set password=? where idUsuario=?");
				$stm->bindParam(2, $this->password);
				$stm->bindParam(5, $this->idUsuario);
				$stm->execute();
				return true;
			} catch (PDOException $e){
				$this->errCode=$e->getCode();
				$this->errMsg=$e->getMessage();
			}
		}
		return false;
	}

	public function updateNickname(){
		$this->clearErr();
		if ($this->idUsuario && $this->nickname) {
			try{
				$stm=$this->getPdo()->prepare("update usuarios set nickname=? where idUsuario=?");
				$stm->bindParam(1, $this->nickname);
				$stm->bindParam(2, $this->idUsuario);
				$stm->execute();
				return true;
			} catch (PDOException $e){
				$this->errCode=$e->getCode();
				$this->errMsg=$e->getMessage();
			}
		}
		return false;
	}
}