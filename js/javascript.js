    $('#confirm-delete').on('show.bs.modal', function(e) {
    	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $(function(){
    	$(".moeda").mask("#.##0,00", {reverse: true});

    	var SPMaskBehavior = function (val) {
    		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    	},
    	spOptions = {
    		onKeyPress: function(val, e, field, options) {
    			field.mask(SPMaskBehavior.apply({}, arguments), options);
    		}
    	};

    	$('.telefone').mask(SPMaskBehavior, spOptions);

    	$('.date').mask('00/00/0000', {placeholder: "__/__/____"});
    });
