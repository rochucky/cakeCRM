$(document).ready(function(){

	var controller = 'Clientes';


	var ver1 = function(){
		notification('Ok');
	}

	var ver2 = function(){
		notification('Ok 2');
	}

	button(controller, 'Verificar alguma coisa', ver1);
	button(controller, 'Verificar oura coisa', ver2);
});