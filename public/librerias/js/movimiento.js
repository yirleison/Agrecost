


var tabla = null;
var iid_mv = 0;

var movimiento = {

  init:function(){
    $("#tabla-detalle-venta").fadeOut("fast");
    $("#tabla-detalle-produccion").hide();
    $("#corrales").select2();
    $("#pro_mov").hide();
    $("#cont_tbl_vent").hide();
    $("#cont_tbl_prod").hide();

    movimiento.efectos();

    movimiento.cons_mov();


    $("#tbl_d_movi").dataTable({
      "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":    "Último",
          "sNext":    "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });

     $("#tbl_dtv").dataTable({
      "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":    "Último",
          "sNext":    "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });

     $("#cantidad").keyup(function(event) {
      if ($("#cantidad").val() > $("#capacidad").val()) {
        new PNotify({
          title:"Cantidad",
          text: "La cantidad no puede ser mayor a la capacidad",
          type: "info"
        });
        $("#cantidad").val("");
      }
     });
  },
  efectos:function () {

    $("#ocultar-produccion").change(function() {
      var valor = $("#ocultar-produccion option:selected").text();
      if (valor == "Seleccione"){
        $(".venta").hide();
        $("#tabla-detalle-venta").hide();
        $("#tabla-detalle-produccion").hide();
        $(".Produccion").hide();
      }
      if (valor == "Venta") {
        $(".Produccion").hide();
        $("#tabla-detalle-produccion").hide();
        $(".venta").fadeIn("fast");
      }
      if(valor == "Produccion") {
        $(".venta").hide();
        $("#tabla-detalle-venta").hide();
        $("#tabla-detalle-produccion").hide();
        $(".Produccion").fadeIn("fast");
      }
    });
  },

  registar_venta(){

    var datos = {
      movimiento:$("#ocultar-produccion").val(),
      cantidad:$("#cantidad").val(),
      valor_venta: parseFloat(($("#valor").val()*$("#cantidad").val()))
    };
    console.log(datos);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/venta/registro',
      type: 'POST',
      dataType: 'json',
      data: datos
    })
    .done(function(success) {
      console.log(success);

      if (success.mensaje == 1) {
        new PNotify({
          title: 'Venta',
          text: 'Venta exitosa',
          type:'info'
        });
        $.each(success[0], function(index, el) {
          let tipo;
          if (el.Tipo_movimiento == 1) {
            tipo = "Venta";
          }
          $("#tblTq").empty();
          $("#cantidad").val('');
          $("#valor").val('');
          $("#total").text('');
          $("#tblTq").append("<tr><td>"+el.Codigo+"</td><td>"+el.Cantidad+"</td><td>"+el.Fecha+"</td><td>"+el.Valor+"</td><td>"+tipo+"</td><td><button class='btn btn-danger' onclick='movimiento.eliminar_venta("+el.Codigo+")' title='Eliminar venta'><i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>");
        });
        $("#tabla-detalle-venta").show();
      }
      if (success[0].mensaje == 3) {
        new PNotify({
          title: 'Venta',
          text: 'La cantidad ingresada es superior a la cantidad que hay en los tanques',
          type:'danger'
        });
      }
    });
  },

  registrar_produccion:function () {
    var datos = {
      movimiento:$("#ocultar-produccion").val(),
      cantidad:$("#cantidad_produccion").val(),
      corral:$("#corrales").val(),
      jornada:$("#jornada_p option:selected").text()
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/movimiento/registro/produccion',
      type: 'post',
      dataType: 'json',
      data: datos
    })
    .done(function(datos) {
      console.log(datos);

      if (datos.mensaje == 5) {
         new PNotify({
          title: 'Producción',
          text: 'la cantidad ingresada supera la capacidad total de los tanques',
          type:'warning'
        });
      }

      if (datos.mensaje == 1) {
        new PNotify({
          title: 'Producción',
          text: 'Producción registrada con exito',
          type:'info'
        });
        $("#cantidad_produccion").val('');
        $("#corrales option:selected").text('Seleccione');
        $("#jornada_p option:selected").text('Seleccione jornada');
      };
      let tipo = "";
      $.each(datos[0],function(index, p) {

        if(p.Tipo_movimiento == 2){
          tipo = "Produccion";
        }
        $("#tblprod").empty();
        $("#cantidad_produccion").val("");
        $("#jornada_p").val("");
        $("#tblprod").append(
          "<tr><td>"+p.Codigo+"</td><td>"+
          tipo+"</td><td>"+
          p.Cantidad+"</td><td>"+
          p.Fecha+"</td><td><button class='btn btn-danger' onclick='movimiento.eliminar_produccion("+p.Codigo+")' title='ELiminar movimiento'><i class='fa fa-trash-o' aria-hidden='true'></i></button></td><tr>");
      });
      $("#tabla-detalle-produccion").show();
    });
  },

  eliminar_venta:function (id) {
    (new PNotify({
      title: 'Eliminar la venta',
      text: 'Desea eliminar venta?',
      icon: 'glyphicon glyphicon-question-sign',
      type:'info',
      hide: false,
      confirm: {
        confirm: true
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    })).get().on('pnotify.confirm', function() {
      $.ajax({
        url: '/movimiento/eliminar/venta',
        type: 'POST',
        dataType: 'json',
        data: {id: id}
      })
      .done(function(success) {
        console.log(success);
        if(success.respuesta == 1){
          new PNotify({
            title: 'Venta',
            text: 'Se ha eliminado la venta con exito',
            type:'success'
          });

          document.getElementById("tblTq").deleteRow(0);
        }
        else {
          new PNotify({
            title: 'Venta',
            text: 'No se ha podido realizar esta operacion',
            type:'info'
          });
        }

      });
    }).on('pnotify.cancel', function() {

    });
  },

  eliminar_produccion:function (id) {
    (new PNotify({
      title: 'Eliminar la produccion',
      text: 'Desea eliminar esta producción ?',
      icon: 'glyphicon glyphicon-question-sign',
      type:'info',
      hide: false,
      confirm: {
        confirm: true
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    })).get().on('pnotify.confirm', function() {
      $.ajax({
        url: '/movimiento/eliminar/produccion',
        type: 'POST',
        dataType: 'json',
        data: {id: id}
      })
      .done(function(success) {
        console.log(success);
        if(success.respuesta == 1){
          new PNotify({
            title: 'Producción',
            text: 'produccion eliminada con exito',
            type:'success'
          });

          document.getElementById("tblprod").deleteRow(0);
        }
        else {
          new PNotify({
            title: 'Producción',
            text: 'No se ha podido realizar esta operacion',
            type:'info'
          });
        }

      });
    }).on('pnotify.cancel', function() {

    });

  },

  cons_mov:function(){

    var valor = $("#cons_mov option:selected").text();
    var d  = $("#cons_mov option:selected").val();

    $("#cons_mov").change(function() {

      var valor = $("#cons_mov option:selected").text();
      var d  = $("#cons_mov option:selected").val();

      if (valor == "Venta"){

       $("#pro_mov").hide();
       $("#cont_tbl_vent").show();
       $("#cont_tbl_prod").hide();

       $.ajax({
         url: '/traer/movimiento/'+d,
         type: 'get',
         dataType: 'json',
       })
       .done(function(datos) {
         console.log(datos);

         $("#tb_mv").empty();
         $.each(datos,function(i, p) {

          let tipo;
          if(p.Tipo_movimiento == 1){
            tipo = "Venta";
          }

          $("#tb_mv").append(
            "<tr><td>"+p.Codigo+"</td><td>"+
            p.Cantidad+"</td><td>"+
            p.Fecha+"</td><td>"+p.Valor+"</td><td>"+tipo+"</td><td><a href='/traer/detalle/venta/"+p.Codigo+"' class='btn btn-info fa fa-eye' title='Ver detalle'></a></td><tr>");

        });
      movimiento.exp_mv(iid_mv);
       })
     }

     else if (valor == "Produccion") {
      $("#pro_mov").show();
      $("#cont_tbl_vent").hide();
    }

    else{
      $("#pro_mov").hide();
      $("#cont_tbl_vent").hide();
      $("#cont_tbl_prod").hide();
    }

  });

    $("#jornada_con").change(function() {

      var j = $("#jornada_con option:selected").text();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      if(j == "Mañana" || j == "Tarde") {
       $.ajax({
         url: '/traer/movimiento/jornada',
         type: 'post',
         dataType: 'json',
         data:{jornada:j}
       })
       .done(function(datos) {
         console.log(datos);
         $("#cont_tbl_prod").show();
          $("#tb_mv_p").empty();

         $.each(datos,function(i, p) {

          let tipo;
          if(p.Tipo_movimiento == 2){
            tipo = "Produccion";
          }

          $("#tb_mv_p").append(
            "<tr><td>"+p.Codigo+"</td><td>"+
            p.Cantidad+"</td><td>"+
            p.Fecha+"</td><td>"+tipo+"</td><td><a href='/traer/detalle/produccion/"+p.Codigo+"' class='btn btn-info fa fa-eye' title='Ver detalle'></a></td><tr>");
        });

       });

     }
      $("#jornada_con").val("");
   });
  }

}
