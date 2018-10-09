$(document).ready(function(){

	// Cutom Flash notifications
	var msg = $('.message');

	$('.join-select').select2({
		width: '100%',
		selectOnClose: true
	});

	if(msg.text() != ''){
		notification(msg.text(), msg.attr('type'));
	}

	var datatables = {};
	
	// Just returns false
	$('.do-nothing').click(function(){
		return false;
	});


	/*
		Masks
	*/
	$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
	$('.money')
		.mask("#.##0,00", {reverse: true});

	function validarCNPJ(cnpj) {
 
	    cnpj = cnpj.replace(/[^\d]+/g,'');
	 
	    if(cnpj == '') return false;
	     
	    if (cnpj.length != 14)
	        return false;
	 
	    // Elimina CNPJs invalidos conhecidos
	    if (cnpj == "00000000000000" || 
	        cnpj == "11111111111111" || 
	        cnpj == "22222222222222" || 
	        cnpj == "33333333333333" || 
	        cnpj == "44444444444444" || 
	        cnpj == "55555555555555" || 
	        cnpj == "66666666666666" || 
	        cnpj == "77777777777777" || 
	        cnpj == "88888888888888" || 
	        cnpj == "99999999999999")
	        return false;
	         
	    // Valida DVs
	    tamanho = cnpj.length - 2
	    numeros = cnpj.substring(0,tamanho);
	    digitos = cnpj.substring(tamanho);
	    soma = 0;
	    pos = tamanho - 7;
	    for (i = tamanho; i >= 1; i--) {
	      soma += numeros.charAt(tamanho - i) * pos--;
	      if (pos < 2)
	            pos = 9;
	    }
	    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	    if (resultado != digitos.charAt(0))
	        return false;
	         
	    tamanho = tamanho + 1;
	    numeros = cnpj.substring(0,tamanho);
	    soma = 0;
	    pos = tamanho - 7;
	    for (i = tamanho; i >= 1; i--) {
	      soma += numeros.charAt(tamanho - i) * pos--;
	      if (pos < 2)
	            pos = 9;
	    }
	    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	    if (resultado != digitos.charAt(1))
	          return false;
	           
	    return true;
	    
	}
	/*
		Function that loads the applet
	*/
	var loadApplet = function(applet){

		var controller = applet.attr('data');
		var child = applet.attr('data-child');
		var link = applet.attr('data-link');
		var form = $('.data-modal-form_'+controller);

		// Datatable functions
		var dtFunctions = function(e){

			$('.datatable_' + controller + ' tbody tr').off('dblclick').dblclick(function(){
				if($(".data-modal-form_"+controller+".no-edit").length > 0){
					notification('Não é possível editar registros nesta tela');
					return false;
				}
				if($(this).children('td:first').hasClass('dataTables_empty')){
					return false;
				}
				$(this).children('td').each(function(){
					if($(this).children('span').attr('data-id')){
						$('#' + $(this).children('span').attr('name') + '_' + controller).val($(this).children('span').attr('data-id').trim()).trigger('change');	
					}
					else{
						$('#' + $(this).children('span').attr('name') + '_' + controller).val($(this).children('span').text().trim());	
					}
				})
				form.find('[name=id]').val($(this).attr('id'));
				$('#data-modal_'+controller).modal('show');
				$('.datatable_'+controller+' tbody tr').removeClass('selected');
				$('input, select, textarea').removeClass('invalid');



			});

			// Export button
			$('.buttons_'+controller+' > div .btn-group').remove() // avoid duplicated buttons
			dtable.buttons().container().appendTo('.buttons_'+controller+' > div');
			
		 	$('.dt-buttons').removeClass('dt-buttons');

		    // Apply the search
		    dtable.columns().every( function () {
		        var that = this;

		        $( 'input', this.footer() ).on( 'keyup change', function (e) {
		            if ( that.search() !== this.value ) {
		                that
		                    .search( this.value )
		                    .draw();
		            }
		            if (e.which == '27'){
		            	$(this).val('');
		            	that
		                    .search( this.value )
		                    .draw();
		            }
		            $('.datatable_' + controller + ' tbody tr').removeClass('selected');

		        });
		         $( 'input', this.footer() ).on('blur', function(e){   
		            if(datatables[child]){
			            datatables[child].destroy();
						$('.applet[data='+controller+']').attr('data-link-val', 0);
						loadApplet($('.applet[data='+child+']'));	
		            }
		        });
		    });

		    $('.save-data_'+controller).off('click').click(saveData);

		    $('.datatable_' + controller + ' tbody tr').click(function(){
		    	if(child){
		    		// Reload child applet
		    		if($(this).hasClass('selected')){
			    		return false;
			    	}

		    		datatables[child].destroy();	
		    		$('.applet[data-child='+child+']').attr('data-link-val', $(this).attr('id'));
		    		$('.applet[data='+child+']').attr('data-link-val', $(this).attr('id'));

					loadApplet($('.applet[data='+child+']'));
					
					$('.datatable_' + controller + ' tbody tr').removeClass('selected');
					$(this).toggleClass('selected');


		    	}
		    	else{
					$(this).toggleClass('selected');
				}
				
			});
			
		}


		// Datatable
		var dtable = $('.datatable_' + controller).DataTable({
			ajax: {
				url: '/' + controller + '/getData',
				data: function(d){
					if($('.applet[data-child='+controller+']').length > 0){
						var data = { 
							filter:{
								field: $('.applet[data-child='+controller+']').attr('data-link'), 
								val: $('.applet[data-child='+controller+']').attr('data-link-val')
							}	 
						};
						return $.extend( {}, d, data);
					}
				},
				error: function(xhr,error,thrown){
					if(thrown == 'Forbidden'){
						$('#expired-password-modal').modal('show');
					}
					else{
						notification('Erro: ' + thrown, 'error');	
					}
					
				}
			},
			rowId: 'rowid',
			scrollY: '50vh',
			scrollX: true,
			scrollCollapse: true,
	        paging: false,
	        buttons: [
	            {extend: 'csv', text: 'Exportar'}
	        ],
	        language: {
			    decimal:        '',
			    emptyTable:     'Não há dados disponíveis',
			    // info:           Showing _START_ to _END_ of _TOTAL_ entries,
			    info:           'Exibindo _TOTAL_ registros',
			    infoEmpty:      'Exibindo 0 registros',
			    infoFiltered:   '(de um total de _MAX_)',
			    infoPostFix:    '',
			    thousands:      '.',
			    loadingRecords: 'Carregando...',
			    processing:     'Processando...',
			    search:         'Buscar:',
			    zeroRecords:    'Nenhum registro encontrado',
			    paginate: {
			        first:      '<<',
			        last:       '>>',
			        next:       '>',
			        previous:   '<'
			    },
			    aria: {
			        sortAscending:  ': activate to sort column ascending',
			        sortDescending: ': activate to sort column descending'
			    }
			},
			initComplete: dtFunctions
		});

		datatables[controller] = dtable;

		$('.cancel-data_'+controller).off('click').click(function(){
			$('#data-modal_'+controller).modal('hide');
		});

		form.off('keyup').on('keyup', function(e){
			if(e.which == '13'){
				$('.save-data_'+controller).click();
			}
		});

		// Data saving function
		var saveData = function(){

			if(form.find('.link').length > 0){
				form.children('.link').val($('.applet[data='+controller+']').attr('data-link-val'));
			}

			var data = form.serialize();
			var l = loading();
			l.show();

			$.ajax({
				method: 'POST',
				url: '/' + controller + '/save',
				data: data,
				/*
					Required fields validation
				*/
				beforeSend: function (){
					
					var check = false;
					

					form.find('[required]').each(function(index, item){
						if(item.value == '' || item.value == null){
							var label = $('label[for='+item.name+']').html();
							notification('Campo obrigatório: '+label, 'error');
							item.className += " invalid";
							check = true;
						}
					});
					

					form.find('.cnpj').each(function(index, item){
						if(validarCNPJ(item.value) == false){
							notification('CNPJ Inválido');
							item.className += " invalid";
							check = true;
						}
					});

					
					if(check){
						return false;	
					}
					
				}	
			})
			.done(function(e){
				if(e == 'ok'){
					$('#data-modal_'+controller).modal('hide');
					notification('Registro salvo com sucesso.', 'success')
					datatables[controller].destroy();
					loadApplet(applet);
					if(datatables[child]){
						datatables[child].destroy();
						$('.applet[data='+controller+']').attr('data-link-val', 0);
						loadApplet($('.applet[data='+child+']'));
					}
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
				else if(e.statusText != "canceled"){
					notification('Falha ao salvar registro, contacte o administrador do sistema', 'error');	
					console.log(e)
				}
				
			})
			.always(function(){
				l.close();
			});
		}

		$('.newbtn_'+controller).off('click').click(function(){
			form.find('.join-select').each(function(e,item){
				$(this).val('').trigger('change');
			});
			$('input, select, textarea').removeClass('invalid');
			$('#data-modal_'+controller).modal('show');

		});

		// Delete Record
		$('.delbtn_'+controller).off('click').click(function(){
			// If there is an open modal, do nothing
			if($('.modal.show').length > 0){
				return false;
			}
			if($('.datatable_'+controller+' tbody tr.selected').length > 0){
				var data = []
				var cc = customConfirm({
					text: 'Deseja realmente excluir este registro?',
					functionYes: function(){
						var l = loading();
						$('.datatable_'+controller+' tbody tr.selected').each(function(){
							data.push($(this).attr('id'));
						});
						$.ajax({
							method: 'POST',
							url: location.href + '/delete/'+controller,
							data: {ids: data},
							beforeSend: function(){
								l.show();
							}
						})
						.done(function(e){
							var data = JSON.parse(e);
							if(data.success > 0){
								notification(data.success + ' registros excluído com sucesso', 'success');
								datatables[controller].destroy();
								loadApplet(applet);
							}
							if(data.error > 0){
								notification(data.erro + ' registros não podem ser excluidos', 'error');
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
				return false;
			}

			return false;

		});

		$('.restorebtn').off('click').click(function(){


			if($('.datatable_'+controller+' tbody tr.selected').length > 0){
				var data = []
				var cc = customConfirm({
					text: 'Deseja realmente restaurar os registros selecionados?',
					functionYes: function(){
						var l = loading();
						$('.datatable_'+controller+' tbody tr.selected').each(function(){
							data.push($(this).attr('id'));
						});
						console.log(data);
						$.ajax({
							method: 'POST',
							url: '/' + controller + '/restore',
							data: {ids: data},
							beforeSend: function(){
								l.show();
							}
						})
						.done(function(e){
							var data = JSON.parse(e);
							console.log(data);
							if(data.success > 0){
								notification(data.success + ' registros restaurados com sucesso', 'success');
								dtable.ajax.reload( dtFunctions );
							}
							if(data.error > 0){
								notification(data.erro + ' registros não puderam ser restaurados', 'error');
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
			else{
				return false;
			}
		});

		// applet.children('.newbtn').click(function(){
		// 	if(applet.attr(''))
		// });

		// Data Saving or Editing Modal
		$('#data-modal_'+controller).on('hidden.bs.modal', function () {
			form[0].reset();
			$('input#id_'+controller).val('');
			$(this).off('keyup');
		});

		$('#data-modal_'+controller).on('shown.bs.modal', function () {
			$('.first').focus();
		});

		$('#data-modal_'+controller).draggable({
		    handle: ".modal-header"
		});

	}


	$(".applet").each(function(){
		
		loadApplet($(this));
	});

	



	

// Expired Password Modal
	$('#expired-password-modal').on('shown.bs.modal', function () {
		$('#expired-password-form input[name=password]').focus();
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
	$('#change-password-modal').on('shown.bs.modal', function () {
		$('#change-password-form input[name=current]').focus();
	});

	$('.save-new-password').click(function(){

		$('#change-password-form input').removeClass('invalid');

		var password = $('#change-password-form input[name=new]').val();
		var confirm = $('#change-password-form input[name=confirm]').val();

		if(password == confirm){
			
			if(password.length < 6){
				notification('A senha deve ter no minimo 6 caracteres');
				$('#change-password-form input[name=new]').addClass('invalid');
				$('#change-password-form input[name=confirm]').addClass('invalid');
				return false;
			}

			var data = $('#change-password-form').serialize();

			$.ajax({
				url: window.location.origin + '/Users/change_password',
				type: 'POST',
				data: data
			})
			.done(function(e) {
				if(e == 'password_error'){
					notification('Senha Incorreta', 'error');
					$('#change-password-modal input[name=password]').addClass('invalid');
				}
				else{
					notification('Senha alterada com sucesso.', 'success');
					$('#change-password-modal').modal('hide');
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}
		else{
			notification('Nova senha e confirmação não batem');
			$('#change-password-form input[name=new]').addClass('invalid');
			$('#change-password-form input[name=confirm]').addClass('invalid');
		}
		

		
		

	});

});