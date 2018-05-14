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

		$.ajax({
			method: 'POST',
			url: location.href + '/save',
			data: data,
			success: function(e){
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
			},
			error: function(e){
				notification('Falha ao salvar, Contacte o administrador do sistema.', 'error');
				$('html').append(e.responseText);
			}
		});
		

	}

	// datatable functions
	var dtFunctions = function(){
		// 
		$('#datatable tbody tr').dblclick(function(){
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
			$(document).on('keyup', function(e){
				if(e.which == '27'){
					$('#datatable tbody tr').removeClass('selected');
					$(document).off('keyup');
				}
				if(e.which == '46'){
					$('.delbtn').click();
					$(document).off('keyup');
				}
				
			})
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

	

	$('.newbtn').click(function(){
		$('#data-modal').modal('show');
	});

	$('.delbtn').click(function(){
		var id = $(this).attr('data-id');
		var cc = customConfirm({
			text: 'Deseja realmente excluir este registro?',
			functionYes: function(){
				var l = loading();
				$.ajax({
					method: 'POST',
					url: location.href + '/delete/' + $('#datatable tbody tr.selected').attr('id'),
					beforeSend: function(){
						l.show();
					},
					success: function(e){
						if(e == 'ok'){
							dtable
								.row($('tr.selected'	))
								.remove()
								.draw();
							l.close();
							notification('Registro excluído com sucesso', 'success');
						}
						else if(e == '403'){
							document.location.href == location.href;
						}
						else{
							notification('Falha ao excluir registro', 'error');
							l.close();
						}
					},
					error: function(e){
						notification('Falha ao deletar registro, contacte o administrador do sistema', 'error');
						l.close();
						console.log(e)
					}

				});
				
				// location.href = location.href + '/delete/' + id;
			}
		});

		return false;

	});

	// data-modal
	$('#data-modal').on('hidden.bs.modal', function () {
		form[0].reset();
		$('input#id').val('');
	});

	$('#data-modal').on('shown.bs.modal', function () {
		$('.first').focus();
		$(this).on('keyup', function(e){
			if(e.which == '13'){
				$(this).off('keyup');
				saveData();
			}
		});
	});

	$('.save-data').click(saveData);

});