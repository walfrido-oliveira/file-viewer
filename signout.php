<?php
	include 'session.php';
	include 'functions.php';
	setLastLogout($_SESSION['id']);
	session_start();
	session_destroy();
	header('Location: login.php');
	exit();
?>