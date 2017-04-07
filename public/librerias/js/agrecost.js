
var tabla = null;

var tanque = {

  tabla_tanque:function () {

    $(function() {
      tabla =  $('#tabla-tanques').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/tabla/tanques',
        columns: [
          { data: 'Codigo', name: 'Codigo' },
          { data: 'Cantidad', name: 'Cantidad' },
          { data: 'Capacidad', name: 'Capacidad' },
          { data: 'Estado', name: 'Estado' },
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        'language': traduccion
      });
    });
    var traduccion = {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
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

  editar:function (id) {
    $.ajax({
      url: '/editar/tanque/'+id,
      type: 'get',
      dataType: 'json'
    })
    .done(function(datos) {
      $('#codigo').val(datos[0].Codigo);
      $('#cantidad').val(datos[0].Cantidad);
      $('#capacidad').val(datos[0].Capacidad);

      if (datos[0].Estado == "Disponible") {
        $('#estado').val(0);
      }
      if (datos[0].Estado == "Lleno") {
        $('#estado').val(1);
      }
      if (datos[0].Estado == "Produccion") {
        $('#estado').val(2);
      }
      $('#mod_editar').modal();
    });
  },

  actualizar:function () {
    var id = $('#codigo').val();
    var datos = {
      cantidad:$('#cantidad').val(),
      capacidad:$('#capacidad').val(),
      estado:$('#estado').val()
    };

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: '/actualizar/tanque/'+id,
      type: 'post',
      dataType: 'json',
      data: datos
    })
    .done(function(respuesta) {
      if (respuesta.mensaje == 1) {
        new PNotify({
          title: 'Actualizar tanque',
          text: 'Actualización realizada con éxito',
          type:'success'
        });
      }
      $('#mod_editar').modal('toggle');
      antidad:$('#cantidad').val('');
      capacidad:$('#capacidad').val('');
      estado:$('#estado').val('');
      tabla.ajax.reload();
      console.log(respuesta.mensaje);
    });
  }
};

var corral = {
  tabla_corrales:function () {

    $(function() {
      tabla =  $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/tabla/corrales',
        columns: [
          { data: 'Codigo', name: 'Codigo' },
          { data: 'Tipo', name: 'Tipo' },
          { data: 'Estado', name: 'Estado' },
          { data: 'Capacidad', name: 'Capacidad' },
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        'language': traduccion
      });
    });
    var traduccion = {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
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

  editar:function (id) {
    $.ajax({
      url: '/editar/corral/'+id,
      type: 'get',
      dataType: 'json'
    })
    .done(function(datos) {

      $('#codigo').val(datos[0].Codigo);
      $('#capaci').val(datos[0].Capacidad);

      if (datos[0].Estado == "Disponible") {
        $('#estado').val(0);
      }
      if (datos[0].Estado == "Lleno") {
        $('#estado').val(1);
      }
      if (datos[0].Estado == "Produccion") {
        $('#estado').val(2);
      }

      if (datos[0].Tipo == "Enfermos") {
        $('#tipo').val(0);
      }
      if (datos[0].Tipo == "Terneros") {
        $('#tipo').val(1);
      }
      if (datos[0].Tipo == "Produccion") {
        $('#tipo').val(2);
      }
      if (datos[0].Tipo == "Parto") {
        $('#tipo').val(3);
      }
      $('#mod_editar_corral').modal();
    });
  },

  actualizar_corral:function(){

    var id = $("#codigo").val();
    var datos = {
      tipo: $("#tipo").val(),
      estado: $("#estado").val(),
      capacidad: $("#capaci").val(),
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/actualizar/corral/'+id,
      type: 'post',
      dataType: 'json',
      data: datos
    })
    .done(function(respuesta){
      console.log(respuesta);
      if (respuesta.mensaje==1) {
        new PNotify({
          title: 'Actualizar corral',
          text: 'Actualización realizada con éxito',
          type:'success'
        });

      }else if (respuesta.mensaje==2) {
        new PNotify({
          title: 'Actualizar corral',
          text: 'Ha ocurrido un error  al realizar esta operación',
          type:'info'
        });
      }else if (respuesta.mensaje==3) {
        new PNotify({
          title: 'Actualizar corral',
          text: 'No se pudo realizar esta operación',
          type:'info'
        });
      }
      tabla.ajax.reload();
    });
  }

};
