
$(function(){
  $("#btn_r_venta").click(function(event) {
  if ($("#cantidad").val() == "" || $("#valor").val() == "") {
    new PNotify({
      title: 'Campos vacios',
      text: 'Por favor completa los campos',
      type:'danger'
    });
      $("#cantidad").parent().removeClass('has-success').addClass('has-error');
      $("#valor").parent().parent().removeClass('has-success').addClass('has-error');

    return false;
  }else {
    $("#cantidad").parent().addClass('has-success').removeClass('has-error');
    $("#valor").parent().parent().addClass('has-success').removeClass('has-error');
    return true;
  }
  if (!isNaN($("#cantidad").val())) {
    new PNotify({
      title: 'Cantidad',
      text: 'Por favor Ingresa solo numeros',
      type:'danger'
    });
    $("#cantidad").parent().addClass('has-success').removeClass('has-error');
    return false;
  }else {
    return true;
  }
  if (!isNaN($("#valor").val())) {
    new PNotify({
      title: 'Cantidad',
      text: 'Por favor Ingresa solo numeros',
      type:'danger'
    });
    $("#valor").parent().addClass('has-success').removeClass('has-error');
    return false;
  }else {
    return true;
  }
  });

  $("#btn-produccion").click(function(event) {
      if($("#corrales option:selected").text()=="Seleccione"
      && $("#jornada option:selected").text()== "Seleccione Jornada"
      && $("#cantidad_produccion").val() == ""){
        new PNotify({
            title: 'Campos invalidos',
            text: 'Por favor Llenar los campos',
            type:'danger'
          });
          return false;
      }

  });
});
