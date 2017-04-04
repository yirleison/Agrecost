
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

    $("#valor").blur(function() {
      if ($("#cantidad").val()=="" || $("#valor").val()=="") {
        $("#success-alert").fadeTo(1000, 500).slideUp(1000, function(){
          $("#success-alert").slideUp(500);
        });
      }else{
        $("#total").text(parseFloat($("#cantidad").val()*$("#valor").val()));
      }
    });
  },

  registar_venta(){

    var datos = {
      movimiento:$("#ocultar-produccion").val(),
      cantidad:$("#cantidad").val(),
      valor_venta: parseFloat($("#total").text())
    };
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
          $("#tblTq").append("<tr><td>"+el.Codigo+"</td><td>"+el.Cantidad+"</td><td>"+el.Fecha+"</td><td>"+el.Valor+"</td><td>"+tipo+"</td></tr>");
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
          p.Fecha+"</td><tr>");
        });
        $("#tabla-detalle-produccion").show();
      });
  }
}
