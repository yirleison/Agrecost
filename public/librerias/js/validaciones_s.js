var validar={

	validarPromedio:function () {	
		$("#btnGuardar").click(function(event) {
			if ( $("#Jornada").val()==='' || $("#Fecha").val() ==='' ||  $("#Corrales").val() ==='') {
				new PNotify({
					title: 'Campos vacios',
					text: 'Por favor completa los campos',
					type:'error'
				});
				$("#Jornada").parent().parent().addClass('has-error');
				$("#Fecha").parent().addClass('has-error');			
				$("#Corrales").parent().addClass('has-error');
				return false;
			}else {
				$("#Fecha").parent().parent().removeClass('has-error').addClass('has-success');

				return true;
			}

		});
	},
	validarVenta:function(){
		$("#btnGuardar").click(function(event) {
			// if ($("#Animal").val() ==='' || $("#Codigo_animal").val()==='' || $("#Fecha_venta").val()==='' || $("#Valor").val() ==='') {
			// 	new PNotify({
			// 		title: 'Campos vacios',
			// 		text: 'Por favor completa los campos',
			// 		type:'error'
			// 	});
			// 	$("#Animal").parent().parent().removeClass('has-success').addClass('has-error');
			// 	$("#Fecha_venta").parent().parent().removeClass('has-success').addClass('has-error');
			// 	$("#Valor").parent().parent().removeClass('has-success').addClass('has-error');
			// 	return false;

			// }
			if ($("#Animal").val() ==='') {
				new PNotify({
					title: 'Campos vacios',
					text: 'Por favor completa los campos',
					type:'error'
				});
				$("#Animal").parent().parent().removeClass('has-success').addClass('has-error');
				return false;

			}else if($("#Codigo_animal").val()===''){
				new PNotify({
					title: 'Campos vacios',
					text: 'Por favor completa los campos',
					type:'error'
				});
				$("#Codigo_animal").parent().parent().removeClass('has-success').addClass('has-error');
				return false;
			}else if($("#Fecha_venta").val()===''){
				new PNotify({
					title: 'Campos vacios',
					text: 'Por favor completa los campos',
					type:'error'
				});
				$("#Fecha_venta").parent().parent().removeClass('has-success').addClass('has-error');
				return false;
			}else if($("#Valor").val()===''){
				new PNotify({
					title: 'Campos vacios',
					text: 'Por favor completa los campos',
					type:'error'
				});
				$("#Valor").parent().parent().removeClass('has-success').addClass('has-error');
				return false;
			}
		});

	}

}