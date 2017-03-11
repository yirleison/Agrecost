$(document).ready(function() {
/* En el change del campo file, cambiamos el val del campo ficticio por el del verdadero */
$('#archivo').change(function(){
$('#url-archivo').val($(this).val());
});
});