<?php

include 'session.php';
include 'header.php';
include 'functions.php';
$_SESSION['show_search_text'] = true;
isAdm();
$users = listUsers();
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover table-border-bottom persist-area" id="table-usuarios">
					<thead>
						<tr>
							<th>#</th>
							<th>LOGIN</th>
							<th data-orderable="false"></th>
							<th data-orderable="false"></th>
						</tr>
					</thead> 
					<tbody>
						<?php
						foreach ($users as $user) {
							?>
							<tr id="<?php echo 'user_id_'.$user['id']; ?>">
								<td><?php echo $user['id']; ?></td>
								<td id="value-filter"><?php echo $user['username']; ?></td>
								<td>
									<a class="btn btn-success" href="adduser.php?id=<?php echo $user['id']; ?>" role="button" id="alterar">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"> </span> Alterar
									</a>
								</td>
								<td>
									<a class="btn btn-danger confirm-delete" href="#" role="button" data-toggle="modal" data-target="#confirm-delete" data-id="<?php echo $user['id']; ?>">
										<span class="glyphicon glyphicon-trash" aria-hidden="true"> </span> Excluír
									</a>
								</td>
							</tr>
							<?php
						} 
						?>
					</tbody>
				</table>
			</div>
			<a class="btn btn-primary" href="adduser.php" role="button"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Novo</a>
		</div>
	</div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Confirmar Exclusão</h4>
			</div>

			<div class="modal-body">
				<p>Você tem certeza que deseja excluír esse usuário?</p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<form action="formdeleteuser.php" method="POST" class="formDelete" id="formDelete">
					<input type="hidden" name="id" id="idUser" value="" readonly />  
					<input type="submit" name="" value="Deletar" class="btn btn-danger btn-ok"/>
				</form>
			</div>
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
				<button type="button" class="btn btn-primary" data-dismiss="modal" id='prevmodalDelete'>OK</button>
			</div>
		</div>
	</div>
</div>

<?php
include 'footer.php';
?>