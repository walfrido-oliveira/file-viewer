<?php

include 'session.php';
include 'functions.php';
include 'header.php';
$_SESSION['show_search_text'] = false;
isAdm();
$user = null;
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$user = getUser($id);
} 
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 mt-5">
			<form action="formdatauser.php" method="POST" id='form_adduser'>
				<div class="form-row">
					<div class="col-md-2 mb-3" id="id">
						<label for="txtid" class="control-label">ID:</label>
						<input type="text" name="id" id="txtid" class="form-control" maxlength="255" required readonly value="<?php if($user != null) echo $user['id']; ?>"/>
					</div>
					<div class="col-md-6 mb-3" id="username">
						<label for="txtusername" class="control-label">Login:</label>
						<input type="text" name="username" id="txtusername" class="form-control" maxlength="255" required value="<?php if($user != null) echo $user['username']; ?>" />
					</div>
					<div class="col-md-4 mb-3" id="password">
						<label for="txtpwd" class="control-label">Senha:</label>
						<input type="password" name="password" id="txtpassword" class="form-control"  maxlength="255" <?php if($user == null) echo 'required' ?> value="<?php if($user != null) echo ''; ?>" autocomplete="off"/>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3" id="name">
						<label for="txtname" class="control-label">Nome:</label>
						<input type="text" name="name" id="txtname" class="form-control"  maxlength="100" required value="<?php if($user != null) echo $user['name']; ?>"/>
					</div>
					<div class="col-md-6 mb-3" id="name2">
						<label for="txtname2" class="control-label">Sobrenome:</label>
						<input type="text" name="name2" id="txtname2" class="form-control"  maxlength="100" required value="<?php if($user != null) echo $user['name2']; ?>"/>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3" id="phone">
						<label for="txtphone" class="control-label">Telefone:</label>
						<input type="text" name="phone" id="txtphone" class="form-control"  maxlength="255" required value="<?php if($user != null) echo $user['phone']; ?>"/>
					</div>
					<div class="col-md-6 mb-3" id="email">
						<label for="txtemail" class="control-label">Email:</label>
						<input type="email" name="email" id="txtemail" class="form-control"  maxlength="255" required value="<?php if($user != null) echo $user['email']; ?>"/>
					</div>
				</div>
				<div class="form-group" id="company">
					<label for="txtcompany" class="control-label">Empresa:</label>
					<input type="text" name="company" id="txtcompany" class="form-control"  maxlength="255" required value="<?php if($user != null) echo $user['company']; ?>"/>
				</div>
				<div class="form-group" id="description">
					<label for="txtdescription" class="control-label">Descrição:</label>
					<textarea name="description" id="txtdescription" class="form-control"  maxlength="255" required><?php if($user != null) echo $user['description']; ?></textarea>
				</div>
				<div class="form-group" id="homefolder">
					<label for="txtdescription" class="control-label">Pasta Raíz:</label>
					<input type="text" name="homefolder" id="txthomefolder" class="form-control"  maxlength="255" readonly value="<?php if($user != null) echo $user['homefolder']; ?>">
				</div>
				<div class="form-row">
					<div class="col-md-6 ml-4" id="activated">
						<input type="checkbox" name="activated" id="txtactivated" class="form-check-input"  maxlength="255" <?php if($user != null) if(!$user['activated']) echo 'checked'; ?> />
						<label for="txtactivated" class="form-check-label">Conta inativa</label>
					</div>
					<div class="col-md-6 ml-4 mb-4" id="admin_users">
						<input type="checkbox" name="admin_users" id="txtadmin_users" class="form-check-input"  maxlength="255" <?php if($user != null) if($user['admin_users']) echo 'checked'; ?> />
						<label for="txtadmin_users" class="form-check-label">Administrador</label>
					</div>
				</div>
				<div class="form-group" id="submit">
					<input type="hidden" name="type" value="<?php if($user != null) echo '_update_'; else echo '_add_';?>" hidden="hidden" readonly="readonly">
					<input type="submit" name="sender" class="btn btn-primary" value="<?php if($user != null) echo 'Alterar'; else echo 'Cadastrar';?>" id="sender"/>
					<a class="btn btn-success" href="listuser.php" role="button">Voltar</a>
				</div>
			</form>			
		</div>
	</div>
</div>

<div class="modal fade" id="confirm-useradd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Módulo Usuário</h4>
			</div>
			<div class="modal-body">
				<div id="form-messages"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" id='prevmodal'>Voltar</button>
				<a type="button" class="btn btn-success" id='exitmodal' href="listuser.php" role="button">OK</a>
			</div>
		</div>
	</div>
</div>

<?php
include 'footer.php';
?>
