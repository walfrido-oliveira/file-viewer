<?php

include 'config.php';

function login($username, $password){
	$conn = connect();

	$sql = 'SELECT * FROM dv_users  du
	INNER JOIN dv_users_permissions dup ON dup.uid = du.id 
	WHERE username=? AND password=? AND activated = 1 LIMIT 1';

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ss',$username,md5($password));
	$stmt->execute();
	$rslt = mysqli_stmt_get_result($stmt);
	$usuario = array();
	$usuario = mysqli_fetch_array($rslt);
	$stmt->close();
	$conn->close();
	setLastLogin($usuario['id']);
	return $usuario;	
}

function listUsers() {
	$conn = connect();

	$sql = 'SELECT * FROM dv_users';

	$result = mysqli_query($conn,$sql);
	$users = array();
	while($user = mysqli_fetch_array($result)){
		$users[] = $user;
	}
	$conn->close();
	return $users;
}

function getUser($id) {
	$conn = connect();

	$sql = 'SELECT * FROM dv_users du 
	LEFT JOIN dv_users_permissions dup ON dup.uid = du.id 
	WHERE du.id=?';

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i',$id);
	$stmt->execute();

	$rslt  = mysqli_stmt_get_result($stmt);
	$user  = array();
	$user = mysqli_fetch_array($rslt);
	
	$stmt->close();
	$conn->close();
	return $user;
}

function addUser($user) {
	$conn = connect();
	$b = false;
	$sql = "INSERT INTO dv_users 
	(`username`,`password`,`activated`,`email`,
	`name`,`name2`,`phone`,`company`,`description`,
	`logo_url`)
	VALUES
	(?,?,?,?,?,?,?,?,?,?)";

	$username = $user['username'];
	$password = md5($user['password']);
	$activated = 1;
	$email = $user['email'];
	$name = $user['name'];
	$name2 = $user['name2'];
	$phone = $user['phone'];
	$company = $user['company'];
	$description = $user['description'];
	$logo_url = null;
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ssisssssss',$username,$password,$activated,
		$email,$name,$name2,$phone,$company,
		$description,$logo_url);
	
	$stmt->execute();
	$stmt->close();
	$conn->close();
	$b = true;

	if($b) {
		$user['id'] = getNextIDUser();
		$user['homefolder'] = setFolderUser($user);
		addPermissions($user);
	}
	return $b;
}

function getNextIDUser() {
	$conn = connect();
	$query = "SELECT MAX(id) FROM dv_users";

	$stmt = $conn->prepare($query);
	$stmt->execute();

	$rslt  = mysqli_stmt_get_result($stmt);
	$result  = array();
	$result = mysqli_fetch_array($rslt);
	
	$stmt->close();
	$conn->close();
	return $result[0];
}

function updateUser($user) {
	$conn = connect();
	$b = false;
	$sql = null;

	$id = $user['id'];
	$username = $user['username'];
	$password = md5($user['password']);
	if(isset($_POST['activated']))  $activated = 0; else $activated = 1;
	$email = $user['email'];
	$name = $user['name'];
	$name2 = $user['name2'];
	$phone = $user['phone'];
	$company = $user['company'];
	$description = $user['description'];
	$logo_url = null;

	if (!empty($password)) {
		$sql = "UPDATE dv_users 
		SET  username=?, password=?, activated=?,
		email=?,name=?,name2=?,phone=?,company=?,
		description=?,logo_url=?
		WHERE id=?";
	}else {
		$sql = "UPDATE dv_users 
		SET  username=?, activated=?,
		email=?,name=?,name2=?,phone=?,company=?,
		description=?,logo_url=?
		WHERE id=?";
	}
	
	$stmt = $conn->prepare($sql);
	if (!empty($password)) {
		$stmt->bind_param('ssisssssssi',$username,$password,$activated,
			$email,$name,$name2,$phone,$company,$description,$logo_url,$id);
	} else {
		$stmt->bind_param('sisssssssi',$username,$activated,
			$email,$name,$name2,$phone,$company,$description,$logo_url,$id);
	}
	
	$b = $stmt->execute();
	$stmt->close();
	$conn->close();
	if($b) updatePermissions($user);

	return $b;
}

function setFolderUser($user) {
	$homefolder = __DIR__.'/'.getConfig()['files']['homefolder'].$user['username'];
	mkdir($homefolder,0777,true);
	return getConfig()['files']['homefolder'].$user['username'];
}

function addPermissions($user) {
	$conn = connect();
	$b = false;
	$sql = "INSERT INTO dv_users_permissions 
	(`uid`,`admin_users`,`homefolder`)
	VALUES
	(?,?,?)";

	$uid = $user['id'];
	$homefolder = $user['homefolder'];
	if(isset($user['admin_users']))  $admin_users = 1; else $admin_users = 0;

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('iss',$uid,$admin_users,$homefolder);
	
	$b = $stmt->execute();
	$stmt->close();
	$conn->close();

	return $b;
}

function updatePermissions($user) {
	$conn = connect();
	$b = false;
	$sql = "UPDATE dv_users_permissions 
	SET `admin_users`=?,`homefolder`=?
	WHERE uid=?";

	$uid = $user['id'];
	$homefolder = $user['homefolder'];
	if(isset($user['admin_users']))  $admin_users = 1; else $admin_users = 0;

	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ssi',$admin_users,$homefolder,$uid);
	
	$b = $stmt->execute();
	$stmt->close();
	$conn->close();

	return $b;
}

function setLastLogin($id) {
	$conn = connect();

	$sql = "UPDATE dv_users SET last_login_date=NOW() WHERE id=?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i',$id);
	$stmt->execute();
	$stmt->close();
	$conn->close();
}

function setLastLogout($id) {
	$conn = connect();

	$sql = "UPDATE dv_users SET last_logout_date=NOW() WHERE id=?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i',$id);
	$stmt->execute();
	$stmt->close();
	$conn->close();
}

function deleteUser($id){
	$conn = connect();
	$b = false;
	$sql = "DELETE FROM dv_users WHERE id=?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i',$id);
	$b = $stmt->execute();
	$stmt->close();
	$conn->close();
	if ($b) deletePermission($id);
	return $b;
}

function deletePermission($uid) {
	$conn = connect();
	$b = false;
	$sql = "DELETE FROM dv_users_permissions WHERE uid=?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i',$uid);
	$b = $stmt->execute();
	$stmt->close();
	$conn->close();
	return $b;
}

function connect() {
	$config = getConfig()['database'];
	return new mysqli('localhost',$config['user'],$config['pwd'],$config['name']);
}

function ListFiles() {
	$types = getConfig()['files']['types'];
	$path = $_SESSION['homefolder'];
	$user['username'] = $_SESSION['username'];
	if (!is_dir($path)) setFolderUser($user);
	$dir = new DirectoryIterator($path);
	$count = 0;

	foreach ($dir as $fileInfo) {
		$ext = strtolower($fileInfo->getExtension());
		$name = pathinfo($fileInfo->getFilename(), PATHINFO_FILENAME);

		if(array_key_exists($ext, $types)) {
			echo '<div class="x-unselectable tmbItem" id="ext-gen-'.$count.'">';

			echo '<div class="tmbInner" style="background-image:url('.getIcon($ext).')"></div>';

			echo '<div class="title">';

			echo '<div class="name" data-toggle="tooltip" data-placement="bottom" title="'.$fileInfo->getFilename().'" data-nome="'.$name.'" style="max-width:136px;">'.$name.'<span class="ext-list">'.strtoupper($ext).'</span></div>';
			echo '<a class="iconsHolder" href=download.php?file='. $fileInfo->getFilename(). ' target="_blank"><i class="fa fa-cloud-download" style="font-size:24px"></i></a>';

			echo '</div>';
			echo '</div>';

			$count++;
		}
	}
}

function getIcon($ext) {
	$pathIco = getConfig()['files']['iconfolder'];
	$fileTypes = getConfig()['files']['types'];

	if (array_key_exists($ext, $fileTypes)) {
		$typeInfo = $fileTypes[$ext];
	} else {
		$typeInfo = reset($fileTypes);
	}
	$filename = $typeInfo[3];
	if (!$filename) {
		$filename = 'generic.png';
	}
	return $pathIco.$filename;
}

function isAdm() {
	if(!isset($_SESSION['admin_users'])) header('Location: index.php');
}
?> 