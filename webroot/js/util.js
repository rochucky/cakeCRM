var customConfirm = function(param){
	var n = new Noty({
		theme: 'metroui',
		text: '<h6>' + param.text + '</h6>',
		layout: 'center',
		modal: true,
		id: 'noty-confirm',
		callbacks: {
			afterShow: function(){
				$(document).on('keyup', function(e){
					if (e.keyCode == '27'){
						n.close();
						$(document).off('keyup');
						// $('.datatable')[0].row( $(this).parents('tr') ).remove()
					}
				});
			}
		},
		buttons: [
			Noty.button('Sim', 'btn btn-primary confirm-button yesbtn', function(){
				n.close();
				param.functionYes();
			}),
			Noty.button('Não', 'btn btn-secondary confirm-button', function () {
			    n.close();
			    $(document).off('keyup');
			    return false;
			})
		]
	}).show();

	$('.yesbtn').focus();

}

var notification = function(msg, type){
	new Noty({
    	layout: 'topRight',
    	type: type || 'info',
		text: msg,
		timeout: 5000
	}).show();
}

var loading = function(){
	return new Noty({
    	layout: 'topRight',
    	type: 'info',
		text: 'Processando...\nPor favor aguarde',
		modal: true
	});
}

