<?php
include 'session.php';
$_SESSION['show_search_text'] = true;
include 'header.php';
include 'functions.php';
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<?php 
				if(isset($_SESSION['homefolder'])){
					ListFiles();
				}
			?>
		</div>
	</div>
</div>

<?php
	include 'footer.php';
?>