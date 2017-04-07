

$("#btn_r_venta").click(function(event) {
  if ($("#cantidad").val() == "" || $("#valor").val() == "") {
    new PNotify({
      title: 'Campos vacios',
      text: 'Por favor completa los campos',
      type:'error'
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
      type:'error'
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
      type:'error'
    });
    $("#valor").parent().addClass('has-success').removeClass('has-error');
    return false;
  }else {
    return true;
  }
});
$("#cantidad").keyup(function(event) {
  var tex = $("#cantidad").val();

  if (!(/^[0-9-.]+$/).test(tex)) {
    new PNotify({
      title: 'Cantidad',
      text: 'Por favor Ingresa solo numeros',
      type:'error'
    });
  $("#cantidad").val("");
    return false;
  }else {
    return true;
  }
});
$("#valor").keyup(function(event) {
  var tex = $("#valor").val();

  if (!(/^[0-9-.]+$/).test(tex)) {
    new PNotify({
      title: 'Cantidad',
      text: 'Por favor Ingresa solo numeros',
      type:'error'
    });
  $("#valor").val("");
    return false;
  }else {
    return true;
  }
});
$("#cantidad_produccion").keyup(function(event) {
  var tex = $("#cantidad_produccion").val();

  if (!(/^[0-9-.]+$/).test(tex)) {
    new PNotify({
      title: 'Cantidad',
      text: 'Por favor Ingresa solo numeros',
      type:'danger'
    });
  $("#cantidad_produccion").val("");
    return false;
  }else {
    return true;
  }
});
$("#btn-produccion").click(function(event) {
  if($("#corrales option:selected").text()=="Seleccione"
  || $("#jornada option:selected").text()== "Seleccione Jornada"
  || $("#cantidad_produccion").val() == ""){
    new PNotify({
      title: 'Campos invalidos',
      text: 'Por favor Llenar los campos',
      type:'danger'
    });
    return false;
  }else {
    return true;
  }
  if (!isNaN($("#cantidad_produccion").val())) {
    return false;
  }
  else {
    return true;
  }

});
