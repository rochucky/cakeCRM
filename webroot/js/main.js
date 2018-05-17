$(document).ready(function(){
	

	// Cutom Flash notifications
	var msg = $('.message');
	var form = $('#data-modal form');

	if(msg.text() != ''){
		notification(msg.text(), msg.attr('type'));
	}

	// Just returns false
	$('.do-nothing').click(function(){
		return false;
	});

	// Data saving function
	var saveData = function(){

		var data = form.serialize();
		var l = loading();
		l.show();

		$.ajax({
			method: 'POST',
			url: location.href + '/save',
			data: data
		})
		.done(function(e){
			if(e == 'ok'){
				$('#data-modal').modal('hide');
				notification('Registro salvo com sucesso.', 'success')
				dtable.ajax.reload( dtFunctions );
			}
			else if(e == 'unique_error'){
				notification('Erro ao salvar registro, Já existe outro registro com o mesmo valor');
			}
			else{
				notification('Erro ao salvar registro');
				console.log(e)
			}
		})
		.fail(function(e){
			if(e.status == '403'){
				$('#expired-password-modal').modal('show');
			}
			else{
				notification('Falha ao deletar registro, contacte o administrador do sistema', 'error');	
			}
			console.log(e)
		})
		.always(function(){
			l.close();
		});

		
		

	}

	// datatable functions
	var dtFunctions = function(){
		// 
		$('#datatable tbody tr').dblclick(function(){
			if($("form.no-edit").length > 0){
				notification('Não é possível editar registros nesta tela');
				return false;
			}
			$(this).children('td').each(function(){
				if($(this).children('span').attr('data-id')){
					$('#' + $(this).children('span').attr('name')).val($(this).children('span').attr('data-id').trim());	
				}
				else{
					$('#' + $(this).children('span').attr('name')).val($(this).children('span').text().trim());	
				}
			})
			form.find('[name=id]').val($(this).attr('id'));
			$('#data-modal').modal('show');
		});

		$('#datatable tbody tr').click(function(){
			$('#datatable tbody tr').removeClass('selected');
			$(this).addClass('selected');
		});
	}

	// Datatable
	var dtable = $('#datatable').DataTable({
		"ajax": location.href + '/getData',
		"rowId": 'rowid',
		"scrollY": "50vh",
		"scrollX": true,
		"scrollCollapse": true,
        "paging": false,
        
        "language": {
		    "decimal":        "",
		    "emptyTable":     "Não há dados disponíveis",
		    // "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
		    "info":           "Exibindo _TOTAL_ registros",
		    "infoEmpty":      "Exibindo 0 registros",
		    "infoFiltered":   "(de um total de _MAX_)",
		    "infoPostFix":    "",
		    "thousands":      ".",
		    "loadingRecords": "Carregando...",
		    "processing":     "Processando...",
		    "search":         "Buscar:",
		    "zeroRecords":    "Nenhum registro encontrado",
		    "paginate": {
		        "first":      "<<",
		        "last":       ">>",
		        "next":       ">",
		        "previous":   "<"
		    },
		    "aria": {
		        "sortAscending":  ": activate to sort column ascending",
		        "sortDescending": ": activate to sort column descending"
		    }
		},
		initComplete: dtFunctions
		
	});

	
// Delete Record
	$('.delbtn').click(function(){
		// If there is an open modal, do nothing
		if($('.modal.show').length > 0){
			return false;
		}
		if($('#datatable tbody tr.selected').length > 0){

			var cc = customConfirm({
				text: 'Deseja realmente excluir este registro?',
				functionYes: function(){
					var l = loading();
					$.ajax({
						method: 'GET',
						url: location.href + '/delete/' + $('#datatable tbody tr.selected').attr('id'),
						beforeSend: function(){
							l.show();
						}
					})
					.done(function(e){
						if(e == 'ok'){
							notification('Registro excluído com sucesso', 'success');
							dtable.ajax.reload( dtFunctions );
						}
						else{
							notification('Falha ao excluir registro', 'error');
						}
					})
					.fail(function(e){
						if(e.status == '403'){
							$('#expired-password-modal').modal('show');
						}
						else{
							notification('Falha ao deletar registro, contacte o administrador do sistema', 'error');	
						}
						console.log(e)
					}).
					always(function(){
						l.close();
					});
				}
			});
		}
		else{
			notification('Nenhum registro selecionado');
		}

		return false;

	});

	$('.restorebtn').click(function(){

		if($('#datatable tbody tr.selected').length > 0){

			var cc = customConfirm({
				text: 'Deseja realmente Restaurar este registro?',
				functionYes: function(){
					var l = loading();
					$.ajax({
						method: 'GET',
						url: location.href + '/restore/' + $('#datatable tbody tr.selected').attr('id'),
						beforeSend: function(){
							l.show();
						}
					})
					.done(function(e){
						if(e == 'ok'){
							notification('Registro restaurado com sucesso', 'success');
							dtable.ajax.reload( dtFunctions );
						}
						else{
							notification('Falha ao restaurar registro', 'error');
						}
					})
					.fail(function(e){
						if(e.status == '403'){
							$('#expired-password-modal').modal('show');
						}
						else{
							notification('Falha ao restaurar registro, contacte o administrador do sistema', 'error');	
						}
						console.log(e)
					}).
					always(function(){
						l.close();
					});
				}
			});
		}
	});

// Data Saving or Editing Modal
	$('#data-modal').on('hidden.bs.modal', function () {
		form[0].reset();
		$('input#id').val('');
		$(this).off('keyup');
	});

	$('#data-modal').on('shown.bs.modal', function () {
		$('.first').focus();
	});

	$('.save-data').click(saveData);

// Expired Password Modal
	$('#expired-password-modal').on('shown.bs.modal', function () {
		$('#expired-password-form input[name=password]').focus();
		$('#expired-password-form').on('keyup', function(){
		})
	});

	$('.modal-login-button').click(function(){

		var data = $('#expired-password-form').serialize();

		$.ajax({
			url: window.location.origin + '/Users/login',
			type: 'POST',
			data: data
		})
		.done(function(e) {
			if(e == 'login_error'){
				notification('Usuário ou senha inválidos');
			}
			else{
				notification('Login efetuado com sucesso!', 'success');
				$('#expired-password-modal').modal('hide');
			}
		})
		.fail(function(e) {
			notification('Houve um erro inesperado, contacte o administrador do sistema', 'error');
			console.log(e);
		})
		.always(function() {
			$('#expired-password-form')[0].reset();
		});
		
	});
// Change Password Modal
	$('#expired-password-modal').on('shown.bs.modal', function () {
		$('#expired-password-form input[name=password]').focus();
		$('#expired-password-form').on('keyup', function(){
		})
	});

	$('.save-new-password').click(function(){

		var password = $('#password-form input[name=new]').val();
		var confirm = $('#password-form input[name=confirm]').val();

		if(password == confirm){
			notification('ok');
		}
		else{
			notification('Nova senha e confirmação não batem');
		}
		

		// $.$.ajax({
		// 	url: window.location.origin + '/Users/save',
		// 	type: 'POST',
		// 	data: {
		// 		password: password
		// 	}
		// })
		// .done(function() {
		// 	console.log("success");
		// })
		// .fail(function() {
		// 	console.log("error");
		// })
		// .always(function() {
		// 	console.log("complete");
		// });
		

	});

// Keymapping
	$(document).on('keyup', function(e){
		if(e.which == '27'){
			$('#datatable tbody tr').removeClass('selected');
		}
		if(e.which == '46'){
			$('.delbtn').click();
		}
		
	})

});