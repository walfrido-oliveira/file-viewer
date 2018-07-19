<?php
session_start();
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if(!isset($_POST['username']) || !isset($_POST['txtpassword'])) {
		header('Location: login.php');	
	}

	$username  = $_POST['txtusername'];
	$password  = $_POST['txtpassword'];

	$result = login($username,$password);

	$count = count($result[0]);

	if($count == 1) {
		$_SESSION['id'] = $result['id'];
		$_SESSION['name'] = $result['name'];
		$_SESSION['name2'] = $result['name2'];
		$_SESSION['username'] = $result['username'];
		$_SESSION['homefolder'] = $result['homefolder'];
		$_SESSION['logo_url'] = $result['logo_url'];
		$_SESSION['admin_users'] = $result['admin_users'];
		unset($_SESSION['err_login']);
		header('Location: index.php');
	}
	else{
		header('Location: login.php');
		$_SESSION['err_login'] = 'Usuario ou senha inválida'; 
		unset($_SESSION['name']);
		unset($_SESSION['name2']);
		unset($_SESSION['username']);
		unset($_SESSION['homefolder']);
		unset($_SESSION['logo_url']);
		unset($_SESSION['admin_users']);
	}
}
?>