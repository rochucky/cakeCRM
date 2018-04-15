$(document).ready(function(){
	
	$('.datatable').dataTable({
		"scrollY": "200px",
		// "scrollX": true,
		"scrollCollapse": true,
        "paging": false,
        "fixedColumns": {
        	"rightColumns": 1
        }
	});

});