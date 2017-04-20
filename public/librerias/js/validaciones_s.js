var validar={

	validarPromedio:function () {	

	},


	validarVenta:function(){
		$("#btnGuardar").click(function(event) {
			$(function(){

				if (!$("#Valor").val() >= 4 && $("#Valor").val() <= 8 ) {
					new PNotify({
						title: 'Noticia',
						text: 'Por favor ingrese de 4 a 8 digitos',
						type:'error'
					});}					
					$("#Valor").parent().removeClass('has-success').addClass('has-error');
					return false;
				});

			if ($("#Animal").val() =='') {
				new PNotify({
					title: 'Campos vacios',
					text: 'Por favor completa los campos',
					type:'error'
				});
				$("#Animal").parent().removeClass('has-success').addClass('has-error');
				return false;

			}else if($("#Codigo_animal").val()==''){					
				return false;

			}else if($("#Valor").val()==''){
				new PNotify({
					title: 'Campos vacios',
					text: 'Por favor completa los campos',
					type:'error'
				});
				$("#Valor").parent().removeClass('has-success').addClass('has-error');
				return false;
			}
		});

	}



}