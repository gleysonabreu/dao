<?php
	require_once "config.php";

	// $sql = new Sql();

	// $usuarios = $sql->select("SELECT * FROM tbl_usuarios");

	// echo json_encode($usuarios);

	// $root = new Usuario();

	// $root->loadById(1);

	// echo $root;

	// $lista = Usuario::getList();

	// echo json_encode($lista);

	// $search = Usuario::getSearch('g');

		// echo json_encode($search);

	// $usuario = new Usuario();
	// $usuario->loginDados('121g', "33");

	// echo $usuario;

	// $aluno = new Usuario("Aluno", "Aluno10");
	// $aluno->setLogin('Aluno');
	// $aluno->setSenha('Aluno10');

		// $aluno->insert();

		// echo $aluno;

	// $update = new Usuario();
	// $update->loadById(1);

		// $update->update("prof", "123");

		// echo $update;

	$del = new Usuario();
	$del->loadById(1);

		$del->delete();

		echo $del;
?>