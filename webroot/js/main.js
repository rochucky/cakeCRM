$(document).ready(function(){
	

	// Cutom Flash notifications
	var msg = $('.message');
	var form = $('#data-modal form');

	if(msg.text() != ''){
		notification(msg.text(), msg.attr('type'));
	}

	// Delete record
	$('.delete').click(function(){
		var id = $(this).attr('data-id');
		var cc = customConfirm({
			text: 'Deseja realmente excluir este registro?',
			functionYes: function(){
				var l = loading();
				$.ajax({
					method: 'POST',
					url: location.href + '/delete/' + id,
					beforeSend: function(){
						l.show();
					},
					success: function(e){
						if(e == 'ok'){
							dtable
								.row($('tr#' + id))
								.remove()
								.draw();
							l.close();
							notification('Registro excluído com sucesso', 'success');
						}
						else{
							notification('Falha ao excluir registro', 'error');
						}
					},
					error: function(e){
						notification('Falha ao deletar registro, contacte o administrador do sistema', 'error');
						console.log(e)
					}

				});
				
				// location.href = location.href + '/delete/' + id;
			}
		});

		return false;

	});


	// Just returns false
	$('.do-nothing').click(function(){
		return false;
	});

	// Datatable
	var dtable = $('#datatable').DataTable({
		// "processing": true,
		// "serverSide": true,
		// "ajax": location.href + '/table',
		"scrollY": "50vh",
		"scrollX": true,
		"scrollCollapse": true,
        "paging": false,
        "fixedColumns":   {
            "leftColumns": 0,
            "rightColumns": 1,
            "heightMatch": 'none'
        },
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
		}
	});

	// Show modal on doubleclick
	$('#datatable tbody tr').dblclick(function(){
		$(this).children('td').each(function(){
			form.find('[name=' + $(this).attr('name') + ']').val($(this).text().trim());
		})
		form.find('[name=id]').val($(this).attr('id'));
		$('#data-modal').modal('show');
	});

	$('.newbtn').click(function(){
		$('#data-modal').modal('show');
	});

	$('#data-modal').on('hidden.bs.modal', function () {
		form[0].reset();
		$('input#id').val('');
	});

	$('.save-data').click(function(){

		var data = form.serialize();

		$.ajax({
			method: 'POST',
			url: location.href + '/save',
			data: data,
			success: function(e){
				location.reload();
			},
			error: function(){
				notification('Falha ao salvar, Contacte o administrador do sistema.', 'error');
			}
		});
		

	});

});