var usuarios = {
  

  tabla_usuarios:function(){
    $(function() {
      tabla = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/usuarios/tabla/usuarios',
        columns: [
        { data: 'nombre', name: 'nombre' },
        { data: 'email', name: 'email' },
        { data: 'rol', name: 'rol' },
        { data: 'estado', name: 'estado' },
        {data: 'action', name: 'action',class:'td', orderable: false, searchable: false}
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

  registrar_usuario:function () {
    var datos = {
      nombre: $('#nombre').val(),
      email: $('#email').val(),
      password: $('#password').val(),
      rol: $('#rol').val(),
    };

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: '/usuarios',
      type: 'post',
      data: datos,
    }).done(function(success){
      if(success!= null){
        new PNotify({
          title: "Felicidades",
          text: "Registro ha sido exitoso",
          type: "success",
        });
      }else {
        new PNotify({
          title: "Error",
          text: "No se pudo guardar el usuario",
          type: "danger",
        });
      }
      tabla.ajax.reload();
      console.log(success);
    });
  },

  editar_usuario:function (id) {
    // metodo para editar....
    var nombre= $('#nombre'),
    email= $('#email'),
    password = $('#password'),
    datos = id;
    id_usuario = id;
    $.ajax({
      url: '/usuarios/'+datos+'/edit',
      type: 'get',
      dataType: 'json',
    }).done(function(success){
      console.log(success);
      var option;
      var da = success;
      $('#nom').val(da.nombre);
      $('#ema').val(da.email);
      $('#pass').val(da.password);
      $('#roll').val(da.rol_id);
      $('#esta').val(da.estado);
      console.log(da.rol_id);
      // abro el modal para actualizar con los datos cargados...
      $('#modal_edit').modal();
    });

  },

  actualizar_usuario:function () {
    var datos = {
      nombre:  $('#nom').val(),
      email:  $('#ema').val(),
      password:  $('#pass').val(),
      rol:  $('#rol').val(),
      estado:  $('#esta').val()
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: '/usuarios/'+id_usuario,
      type: 'put',
      dataType: 'json',
      data:datos
    })
    .done(function(dato) {
      if(dato.mensaje == 1){
        new PNotify({
          title: "Actualización",
          text: "Actualización realizada con exito",
          type: "info",
        });
      }
      if (dato.mensaje == 2) {
        new PNotify({
          title: "Actualización",
          text: "No se pudo realizar la Actualización",
          type: "danger",
        });
      }
      $('#modal_edit').modal('toggle');
    });

  },

  cambiar_estado:function (id,estado) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/usuarios/estado/'+id,
      type: 'post',
      dataType: 'json',
      data: {estado:estado}
    })
    .done(function(estado) {
      if (estado.mensaje==1) {
        new PNotify({
          title: "Actualización",
          text: "Se ha cambiado el estado",
          type: "success",
        });
        tabla.ajax.reload();
      }else {
        if (estado.mensaje==2) {
          new PNotify({
            title: "Actualización",
            text: "Ha ocurrido un error no se pudo realizar esta operación",
            type: "info",
          });
        }
      }
    });
  },

  eliminar:function (id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    (new PNotify({
      title: 'Confirmacion eliminación',
      text: 'Esta seguro que desea eliminar este registro?',
      icon: 'glyphicon glyphicon-question-sign',
      hide: false,
      type:"info",
      confirm: {
        confirm: true
      },
      buttons: {
        closer: 'false',
        sticker: false
      },
      history: {
        history: false
      },
      addclass: 'stack-modal',
      stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
    })).get().on('pnotify.confirm', function(){
      $.ajax({
        url: '/usuarios/'+id,
        type: 'DELETE',
        dataType: 'json'
      })

      .done(function(success) {
        tabla.ajax.reload();
        console.log(success);
      });
    }).on('pnotify.cancel', function(){

    });

  }
};