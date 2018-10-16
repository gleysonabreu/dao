<?php
	/**
	 * Usuario
	 */
	class Usuario
	{
		private $id;
		private $login;
		private $senha;
		private $dtc;
		
		public function getId():int{
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}
		public function getLogin(){
			return $this->login;
		}
		public function setLogin($lg){
			$this->login = $lg;
		}
		public function getSenha(){
			return $this->senha;
		}
		public function setSenha($pass){
			$this->senha = $pass;
		}
		public function getDtc(){
			return $this->dtc;
		}
		public function setDtc($dtc){
			$this->dtc = $dtc;
		}

		public function loadById($id){
			$sql = new Sql();
			$result = $sql->select("SELECT * FROM tbl_usuarios WHERE id = :ID", array(
				":ID" => $id
			));

			if(count($result) > 0 ){
				$row = $result[0];

				$this->setId($row['id']);
				$this->setLogin($row['login']);
				$this->setSenha($row['senha']);
				$this->setDtc(new DateTime($row['dtc']));
			}
		}

		public function __toString(){
			return json_encode(array(
				"id"=>$this->getId(),
				"login"=>$this->getLogin(),
				"senha"=>$this->getSenha(),
				"dtc"=>$this->getDtc()->format("d/m/Y H:i:s")
			));
		}

		public static function getList(){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tbl_usuarios ORDER BY id DESC");
		}

		public static function getSearch($login){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tbl_usuarios WHERE login LIKE :SEARCH ORDER BY login", array(
				":SEARCH"=>"%$login%"
			));
		}

		public function loginDados($login, $senha){
			$sql = new Sql();
			$result = $sql->select("SELECT * FROM tbl_usuarios WHERE login = :login AND senha = :pass", array(
				":login" => $login,
				":pass"=>$senha
			));

			if(count($result) > 0 ){
				$row = $result[0];

				$this->setId($row['id']);
				$this->setLogin($row['login']);
				$this->setSenha($row['senha']);
				$this->setDtc(new DateTime($row['dtc']));
			} else{
				throw new Exception("Login ou senha inválidos", 1);
				
			}
		}
	}
?>