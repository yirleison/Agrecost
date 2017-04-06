var tabla=null,
id_vacu;

var vacu_script={


	table_vacu:function(){

		$(function(){

			tabla=$('#tblList').DataTable({
				processing: true,
				serverSide: true,
				ajax: '/vacunacion/get',
				columns: [
				{data: 'Nombre', name: 'Vacunacion.Nombre'},
				{data: 'Periodicidad', name: 'Vacunacion.Periodicidad'},
				{data: 'Dosis', name: 'Vacunacion.Dosis'},
				{data: 'action', name: 'action', orderable: false, searchable: false}
				],
				'language':traduccion

			});

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




  // Guardar vacunacion del modal

  guardar_vacuna:function(){


  	datos=[

  	nom:$("#Nombre").val(),
  	tipo:$("Tipo").val(),
  	perio:$("#Periodicidad").val(),
  	dosis:$("#Dosis").val();
  	tipo_admin:($"#Tipo_administracion").val(),
  	stock:$("#Stock").val()

  	];
  	$.ajaxSetup({
  		headers: {
  			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
  	});
  	$.$.ajax({
  		url: '/path/to/file',
  		type: 'default GET (Other values: POST)',
  		dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
  		data: {param1: 'value1'},
  	})
  	.done(function() {
  		new PNotify (function(success){

  			'tittle':

  		})
  	})


  },



  // Actualizacion de un registro en el datatable


vacunacion_actualizar:function(){

  	var datos={

  		Nom:$('#Nombre').val(),
  		Tipo:$('#Tipo').val(),
  		perio:$('#Periodicidad').val(),
  		Dosis:$('#Dosis').val(),
  		T_Admin:$('#Tipo_administracion').val(),
  		Stock:$('#Stock').val()
  	};


  	$.ajaxSetup({
  		headers: {
  			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
  	});
  	$.ajax({
  		url: '/vacunacion/actualizar/'+id_vacu,          
  		type: 'post',
  		data: datos,
  		dataType: 'json'

  	}).done(function(respuesta){

  	});


  },


  // Eliminacion de un registro si es necesario 

vacunacion_eliminar:function(id_vacu){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "/vacunacion/"+id_vacu,
    type: "delete",


  }).done(function(success){


    new PNotify({

      title:'Eliminar',
      text:'Se elimino correctamente',
      type:'danger'
    });



  });
  tabla.ajax.reload();

},





}