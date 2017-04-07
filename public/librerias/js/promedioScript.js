var tabla=null;
var variable=null;
var promedio={
	consulta:function(){

		var myObj = {
			variable:$("#Corrales").val()
		};

		var array = $.map(myObj, function(value, index) {
			return [value];
		});

		document.getElementById("Divpromedio").style.display = 'block';


		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: '/promedioleche/get/'+array,
			type: 'get',		
		}).done(function(){
			
			tabla=$('#Tblpromedio').DataTable({
				processing: true,
				serverSide: true,
				ajax: '/promedioleche/get/'+array,
				columns: [				      
				{data: 'Codigo', name: 'Codigo'},        
				{data: 'Nombre', name: 'Nombre'},        
				{data: 'Cantidad', name: 'Cantidad'},        

				// {data: 'action', name: 'action', orderable: false, searchable: false}      
				],"fnRowCallback": function(nRow, aData, iDisplayIndex) {
					var opciones = $('td:eq(2)', nRow);
					let html = '<input  onchange="acumulador.calcular()" class="form-control" type="text" id="cantidad" name="cantidad[]" />';
					opciones.html(html);

					var opciones1 = $('td:eq(0)', nRow);
					let html1 = '<input type="text"  name="codigo[]" value="'+aData.Codigo+'" class="form-control"/>';

					opciones1.html(html1);

					// value="'+aData.id+'" Con esta linea puedo traer un valor de la tabla
				}

			});

			var traduccion = {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			};
			tabla.destroy();
		});

	},

	guardar:function(){


		var fd = new FormData(document.getElementById("frmTabla"));
		
		$.ajax({
			url: "promedioleche",
			type: "POST",
			data: fd,
 			processData: false,  // tell jQuery not to process the data  				
  			contentType: false   // tell jQuery not to set contentType
  		});


		var datos={
			Fecha:$("#Fecha").val(),
			Jornada:$("#Jornada").val(),
			Corral:$("#Corrales").val(),
			Total:$("#to").text(),
			

		};

		console.log(datos);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: '/promedioleche/guardarproduccion',
			type: 'post',
			dataType: 'json',
			data: datos,
		});
		
		
		

	},

	marcado:function($data){
		var cod=$data;
		console.log(cod);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: '/promedioleche/marcado/'+cod,
			type: 'get',			
		});




	}

}