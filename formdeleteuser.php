<?php
include 'session.php';
include 'functions.php';
isAdm();

if(isset($_POST['id'])) {
	if(deleteUser($_POST['id'])) {
		http_response_code(200);
		echo "Usuário deletado com sucesso!";
	} else {
		http_response_code(400);
		echo "O servidor retornou um erro ao excluír o usuário!";
	}
} else {
	http_response_code(400);
	echo "O servidor retornou um erro ao excluír o usuário!";
}
?>