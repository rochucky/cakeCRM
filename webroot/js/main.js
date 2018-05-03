$(document).ready(function(){
	
	$('.datatable').dataTable({
		"scrollY": "100%",
		// "scrollX": true,
		"scrollCollapse": true,
        "paging": false,
        "fixedColumns": {
        	"rightColumns": 1
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

});