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

	$usuario = new Usuario();
	$usuario->loginDados('121g', "33");

	echo $usuario;
?>