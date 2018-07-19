<?php
include 'session.php';
include 'functions.php';
isAdm();

if(isset($_POST['username']) && isset($_POST['type']) &&
	isset($_POST['name']) && isset($_POST['name2']) &&
	isset($_POST['phone']) && isset($_POST['email']) &&
	isset($_POST['company']) && isset($_POST['description'])) {
	if($_POST['type'] == '_add_') {
		if(addUser($_POST)) {
			http_response_code(200);
			echo "Usuário cadastrado com sucesso!";
		}
		else {
			http_response_code(400);
			echo "O servidor retornou um erro ao cadastrar o usuário!";
		}
	} elseif ($_POST['type'] == '_update_') {
		if(updateUser($_POST)) {
			http_response_code(200);
			echo "Usuário alterado com sucesso!";
		}
		else {
			http_response_code(400);
			echo "O servidor retornou um erro ao cadastrar o usuário!";
		}
	}
} else {
	http_response_code(400);
	echo "Há campos que faltam ser preenchidos!";
}

?>