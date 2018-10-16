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
				$this->setData($result[0]);
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
				$this->setData($result[0]);
			} else{
				throw new Exception("Login ou senha inválidos", 1);
				
			}
		}

		public function setData($data){
				$this->setId($data['id']);
				$this->setLogin($data['login']);
				$this->setSenha($data['senha']);
				$this->setDtc(new DateTime($data['dtc']));
		}

		public function insert(){
			$sql = new Sql();

			$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
				":LOGIN"=>$this->getLogin(),
				":SENHA"=>$this->getSenha()
			));

			if(count($result) > 0){
				$this->setData($result[0]);
			}
		}

		public function __construct($login = "", $senha = ""){
			$this->setLogin($login);
			$this->setSenha($senha);
		}

		public function update($login, $password){
			$this->setLogin($login);
			$this->setSenha($password);
			$sql = new Sql();

			$sql->query("UPDATE tbl_usuarios SET login = :login, senha = :senha WHERE id = :id", array(
				":login"=>$this->getLogin(),
				":senha"=>$this->getSenha(),
				":id"=>$this->getId()
			));
		}

		public function delete(){
			$sql = new Sql();

			$sql->query("DELETE FROM tbl_usuarios WHERE id = :id", array(
				":id"=>$this->getId()
			));

			$this->setId(0);
			$this->setLogin('');
			$this->setSenha('');
			$this->setDtc(new DateTime());

		}


	}
?>