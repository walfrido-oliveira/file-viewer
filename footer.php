<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<p></p>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery.mask.min.js" type="text/javascript"></script>
<script src="js/javascript.js"></script>

<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});

	$('.tmbItem').click(function() {
		var itens = $(".tmbItem");

		itens.each( function(index, value) {
			$(this).removeClass('tmbItemSel');
		});

		$(this).addClass('tmbItemSel');
	});

	$("#textSearch").on("input",function() {
		var itens = $(".tmbItem");
		var text = $(this).val();

		itens.each( function(index, value) {
			var value = $(this).find(".title .name").data('nome');
			var regex = new RegExp(text);
			
			if(regex.test(value) == false) $(this).hide(500);
			else $(this).show(500);
			if(text == '') $(this).show(500);
		});
	});

	$('#textSearch').on("input",function() {
		$('table').show();
		var selection = $(this).val();
		var dataset = $('#table-usuarios tbody').find('tr');
		dataset.show();
		dataset.filter(function(index, item) {
			var regex = new RegExp(selection);
			var value = $(item).find('#value-filter').text();
			return !regex.test(value);
		}).hide();
		dataset.filter(function(index, item) {
			return selection == '';
		}).show();
	});

	$(document).ready(function() {
		$('#form_adduser').submit(function(event) {
			
			event.preventDefault();
			
			var data = $(this).serialize();
			var formMessages = $('#form-messages');
			
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: data
			}).done(function(response) {
				$(formMessages).removeClass('alert alert-danger');
				$(formMessages).addClass('alert alert-success');

				$(formMessages).text(response);

				$('html, body').animate({scrollTop: $(formMessages).offset().top}, 500);
				$('#prevmodal').hide();
				$('#confirm-useradd').modal('show');

			}).fail(function(data) {

				$(formMessages).removeClass('alert alert-success');
				$(formMessages).addClass('alert alert-danger');

				if (data.responseText !== '') {
					$(formMessages).text(data.responseText);
				} else {
					$(formMessages).text('Oops! An error occured and your message could not be sent.');
				}

				$('html, body').animate({scrollTop: $(formMessages).offset().top}, 500);
				$('#prevmodal').show();
				$('#confirm-useradd').modal('show');
			});
			
		});
	});

	$(document).ready(function() {
		$('#formDelete').submit(function(event) {
			
			event.preventDefault();
			
			var data = $(this).serialize();
			var formMessages = $('#form-messages');
			
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: data
			}).done(function(response) {
				$(formMessages).removeClass('alert alert-danger');
				$(formMessages).addClass('alert alert-success');

				$(formMessages).text(response);

				$('#confirm-delete').modal('hide');
				$('#confirm-useradd').modal('show');

			}).fail(function(data) {

				$(formMessages).removeClass('alert alert-success');
				$(formMessages).addClass('alert alert-danger');

				if (data.responseText !== '') {
					$(formMessages).text(data.responseText);
				} else {
					$(formMessages).text('Oops! An error occured and your message could not be sent.');
				}

				$('#confirm-delete').modal('hide');
				$('#confirm-useradd').modal('show');
			});
			
		});
	});	

	$('.confirm-delete').click(function() {
		$('#idUser').val($(this).data('id'));
	});

	$('#prevmodalDelete').click(function() {
		var tr = $('#user_id_' + $('#idUser').val());
		tr.css('"background-color","#FF3700"');
		tr.fadeOut(400, function() {
			tr.remove();
		});
	});

</script>

</body>
</html>