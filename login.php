<?php
session_start();
if(isset($_SESSION['name'])) {
	header('Location: index.php');
}
include 'header.php';
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 login-form">
			<form action="signin.php" method="POST" id='form_login'>
				<div class="form-group" id="username">
					<label for="txtusername" class="control-label">Nome:</label>
					<input type="text" name="txtusername" id="txtusername" class="form-control" required />
				</div>
				<div class="form-group" id="password">
					<label for="txtpwd" class="control-label">Senha:</label>
					<input type="password" name="txtpassword" id="txtpassword" class="form-control"  maxlength="15" required/>
				</div>
				<div class="form-group" id="submit">
					<input type="submit" name="sender" class="btn btn-primary" value="Entrar" />
				</div>
				<div class="form-group" <?php if(!isset($_SESSION['err_login'])) echo 'hidden';?>>
					<div class="alert alert-danger">
						<strong>Atenção!</strong> Usuário ou senha inválida.
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>