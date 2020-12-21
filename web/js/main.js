$(function(){


	$('#modalButton1').click(function(){

		$('#modal').modal('show')
		.find('#modalContent1')
		.load($(this).attr('value'));

	});

	$('#modalButton2').click(function(){

		$('#modal2').modal('show')
		.find('#modalContent2')
		.load($(this).attr('value'));

	});

	/*$('#modalButton_hijo').click(function(){

		$('#modal_abm_hijo').modal('show')
		.find('#modalContent_abm_hijo')
		.load($(this).attr('value'));

		document.getElementById('header_abm_hijo').innerHTML = 'Crear nuevo hijo o hija';
	});*/
	


	$('#modalButton_hijo').click(function(){

		$('#modal_hijo').modal('show')
		.find('#modalContent_hijo')
		.load($(this).attr('value'));

	});


	
    var detalle;
	$("#kv-adv-12").change(function () { 

		valor = $("#denuncia-ejercio_violencia_detalle").text();
		
		if($(this).is(":checked")){
			detalle = valor+' - Económica';
			$("#denuncia-ejercio_violencia_detalle").text(detalle); 
		}else{
			valor = valor.replace(" - Económica", "");
			$("#denuncia-ejercio_violencia_detalle").text(valor); 
		}

	});
	$("#kv-adv-13").change(function () { 
		valor = $("#denuncia-ejercio_violencia_detalle").text();
		
		if($(this).is(":checked")){
			detalle = valor+' - Psicológica';
			$("#denuncia-ejercio_violencia_detalle").text(detalle); 
		}else{
			valor = valor.replace(" - Psicológica", "");
			$("#denuncia-ejercio_violencia_detalle").text(valor); 
		}

	});
	$("#kv-adv-14").change(function () { 
		valor = $("#denuncia-ejercio_violencia_detalle").text();
		
		if($(this).is(":checked")){
			detalle = valor+' - Física';
			$("#denuncia-ejercio_violencia_detalle").text(detalle); 
		}else{
			valor = valor.replace(" - Física", "");
			$("#denuncia-ejercio_violencia_detalle").text(valor); 
		}

	});
	$("#kv-adv-15").change(function () { 
		valor = $("#denuncia-ejercio_violencia_detalle").text();
		
		if($(this).is(":checked")){
			detalle = valor+' - Sexual';
			$("#denuncia-ejercio_violencia_detalle").text(detalle); 
		}else{
			valor = valor.replace(" - Sexual", "");
			$("#denuncia-ejercio_violencia_detalle").text(valor); 
		}

	});

});