
var tabla = null;

var movimiento = {
  init:function(){
    $("#tabla-detalle-venta").fadeOut("fast");
    $("#tabla-detalle-produccion").hide();
    $("#corrales").select2();
    movimiento.efectos();
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
      jornada:$("#jornada option:selected").text()
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

      if (datos.mensaje == 1) {
        new PNotify({
          title: 'Producción',
          text: 'Producción registrada con exito',
          type:'info'
        });
        $("#cantidad_produccion").val('');
        $("#corrales option:selected").text('Seleccione');
        $("#jornada option:selected").text('Seleccione jornada');
      };
      let tipo = "";
      $.each(datos[0],function(index, p) {
        if(p.Tipo_movimiento == 2){
          tipo = "Produccion";
        }
        $("#tblprod").append(
          "<tr><td>"+p.Codigo+"</td><td>"+
          tipo+"</td><td>"+
          p.Cantidad+"</td><td>"+
          p.Fecha+"</td><td><button class='btn btn-danger' title='ELiminar movimiento'><i class='fa fa-trash-o' aria-hidden='true'></i></button></td><tr>");
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
          // if(success.respuesta == 1){
          //   new PNotify({
          //     title: 'Venta',
          //     text: 'Se ha eliminado la venta con exito',
          //     type:'success'
          //   });
          //
          //   document.getElementById("tblTq").deleteRow(0);
          // }
          // else {
          //   new PNotify({
          //     title: 'Venta',
          //     text: 'No se ha podido realizar esta operacion',
          //     type:'info'
          //   });
          // }

        });
      }).on('pnotify.cancel', function() {

      });

    }
  }
