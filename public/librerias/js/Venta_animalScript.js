var tabla=null,
id_vacu;


var vacunacion_js={


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


  	datos={

      Tipo:$("#Tipov").val(),
      Nombre:$("#Nombre").val(), 
      Periodicidad:$("#Periodicidad").val(),
      Dosis:$("#Dosis").val(),
      Tipo_administracion:$("#Tipo_administracion").val(),
      Stock:$("#Stock").val()
    };
    console.log(datos);

    $.ajaxSetup({
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
    $.ajax({
      url: 'vacunacion',
      type: 'post',
      dataType: 'json',
      data: datos
    }).done(function() {
      new PNotify({

       title:'Noticia',
       text: 'Se guardo correctamente',
       type:'success'
     });
    });


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
      if(respuest.mensaje == 1){

       new PNotify({

         title:'Actualizar',
         text: 'Se actualizo correctamente',
         type:'success'
       });
     }else if (respuesta.mensaje == 3){

       new PNotify({

         title:'Noticia',
         text:'Error al actualizar',
         type:'danger'
       });
     }
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

  			title:'Noticia',
  			text:'Se elimino correctamente',
  			type:'danger'
  		});



  	});
  	tabla.ajax.reload();


  },

  guardar_tipo:function(){

    datos={
      Nom:$("#Nombretipo").val()

    };
    $.ajaxSetup({
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
    $.ajax({
      type: "post",
      url: "/vacunacion/tipo",
      data: datos,
      dataType: "post",

    }).done(function(success) {
      new PNotify({
       title:'Noticia',
       text: 'Se guardo correctamente',
       type:'success'
     });


    });
    $("#mod_Tipovacunaciones").modal("toggle");

  },



  vacunacion_editar:function(id){
	//   var datos=null;
  	// $.ajax({
  	// 	url: '/vacunacion/'+id+'/edit',
  	// 	type: 'get',
  	// 	dataType: 'json'
  	// }).done(function(datos){

	// 	console.log(datos);

  	// $('#Codigo').val(datos[0].Codigo);
  	// $('#Nombre').val(datos[0].Nombre);
  	// $('#Tipo').val(datos[0].Tipo);
  	// $('#Periodicidad').val(datos[0].Periodicidad);
  	// $('#Dosis').val(datos[0].Dosis);
  	// $('#Tipo_administracion').val(datos[0].Tipo_administracion);
  	// $('#Stock').val(datos[0].Stock);
   $("#mod_vacunaciones_editar1").modal();
  	// });



  }
}










































// Scripts para ventas de animal



var ventas={



  table_venta:function(){


    $(function(){

      tabla=$('#tabla_venta').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/ventaAnimal/getAnimal',
        columns: [
        {data: 'Marcado', name: 'Marcado'},
        {data: 'Nombre', name: 'Nombre'},
        {data: 'Fecha_nacimiento', name: 'Fecha_nacimiento'},
        {data: 'Sexo', name: 'Sexo'},
        {data: 'Peso', name: 'Peso'},
        {data: 'razav', name: 'razav'},
        {data: 'estado', name: 'estado'},

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


 


  listar_ventas:function(){

    $(function(){

      tabla=$('#tblVenta').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/ventaAnimal/listarventas',
        columns: [
        {data: 'Nombre', name: 'Nombre'},        
        {data: 'Fecha_venta', name: 'Fecha_venta'},        
        {data: 'Valor', name: 'Valor'},        
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



  editar_ventas:function(id){
    $("#mod_ventas").modal();

    $.ajax({
      url: '/ventaAnimal/'+id+'/edit',
      type: 'get',

    }).done(function(datos){
      console.log(datos);
      $("#Nombre").val(datos[0].Nombre);
      $("#Fecha_venta").val(datos[0].Fecha_venta);
      $("#Valor").val(datos[0].Valor);
      $("#Marcado").val(datos[0].Marcado);
      $("#Sexo").val(datos[0].Sexo);
      $("#raza").val(datos[0].ra);
      $("#Peso").val(datos[0].Peso);
      $("#Fecha_nacimiento").val(datos[0].Fecha_nacimiento);
      $("#Codigo").val(datos[0].Codigo);

    });

  },



  seleccionarAnimal:function(id){

    $.ajax({
      url: '/ventaAnimal/consulta/'+id,
      type: 'get',

    })

    .done(function(dato){
      $.each(dato, function(index, el) {
        $("#Animal").val(el.Nombre);
        $("#Codigo_animal").val(el.Codigo);



      });

    });

    $("#mod_animal").modal("toggle");

  },

  

  actualizar_venta:function(){

    var id_venta=$("#Codigo").val();

    var datos={


      Fecha_venta:$("#Fecha_venta").val(),
      Valor:$("#Valor").val()

    };

    $.ajaxSetup({
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
    $.ajax({
     url: '/ventaAnimal/'+id_venta,
     type: 'put',
     dataType: 'json',
     data: datos
   }).done(function(respuesta){

    if (respuesta.mensaje == 1) {

      new PNotify({
       title:'Noticia',
       text: 'Se actualizo correctamente',
       type:'success'
     });

      $("#mod_ventas").modal("toggle");
      tabla.ajax.reload();


    }else if(respuesta.mensaje == 2){

     new PNotify({
       title:'Noticia',
       text: 'Error al actualizar , vuelva a intentarlo',
       type:'info'
     });

   }

 });



 },



}