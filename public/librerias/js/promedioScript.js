var tabla=null;
var variable=null;
var total;
var ruta;

var promedio={
	consulta:function(){

		var myObj = {
			variable:$("#Corrales").val()
		};

		var array = $.map(myObj, function(value, index) {
			return [value];
		});

		document.getElementById("Divpromedio").style.display = 'block';
		var num=1;
		tabla=$('#Tblpromedio').DataTable({
			
            bInfo: false, //Ocultar el show cuanto datos esta mostrando
            "order":[0,'desc'],
			searching: false, //Ocultar el campo para filtrar
			processing: true,
			serverSide: true,
			paging:false,//No pagina
			ajax: '/promedioleche/get/0',
			columns: [				      
			{data: 'Codigo', name: 'Codigo'},        
			{data: 'Nombre', name: 'Nombre'},        
			{data: 'Cantidad', name: 'Cantidad'},      

			],"fnRowCallback": function(nRow, aData, iDisplayIndex) {					
				var opciones = $('td:eq(2)', nRow);
				let html = '<input  required  maxlength="999"  digits="true"  onchange="acumulador.calcular()"  onclick="promedio.teclado(this)"  class="form-control" type="number" id="promedios'+num+'" name="cantidad[]" />';
				opciones.html(html);

				var opciones1 = $('td:eq(0)', nRow);
				let html1 = '<label for="" >'+aData.Codigo+'</label><input id="codigo"  name="codigo[]" type="text" value="'+aData.Codigo+'" style="width:20px; visibility :hidden"/>';

				opciones1.html(html1);
					// value="'+aData.id+'" Con esta linea puedo traer un valor de la tabla
					num++;

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
	},

	cargarTblpromedio:function(data){
		let id=$(data).val();
		tabla.ajax.url('/promedioleche/get/'+id).load();		
	},

	re:function(){
		tabla.ajax.reload();
	},


	teclado:function(date){
		ruta = $(this);
		if (window.matchMedia("(max-width:992px)").matches) {
			$("#fondoModalCalculadora").fadeIn("fast");
		}

		$(".num").click(function(){
			var atributo = $(this).attr("numero").toString();
			var valor = $("#pantalla").val().toString();
			$("#pantalla").val(valor + atributo);
			total = $("#pantalla").val();
		});

		$("#borrar").click(function(event) {
			$("#pantalla").val('');
		});

	}

}

$("#cerrarCalculadora").click(function(){
	$("#fondoModalCalculadora").fadeOut("fast");
});

$("#borrar").click(function(){
	$(ruta).val(total);
});