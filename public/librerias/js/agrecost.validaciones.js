
var validaciones = {

  validarTanque:function () {
    $(document).ready(function(){
      jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
      });
      $('#registrar-tanque').validate({
        rules:{
          capacidad:{
            required: true,
            capacidad: true,
            maxlength: 4,
            minlength:2
          }
        },
        submitHandler: function (form) {
          form.submit();
        },

        highlight: function (element) {
          $(element).parent().removeClass('has-success').addClass('has-error');
        },

        success: function (element) {
          $(element).parent().removeClass('has-error').addClass('has-success');
        },
        messages:{
          capacidad:{
            required: "Este campo es requerido",
            maxlength: "maximo 4 digitos",
            minlength:"minimo 2 digitos"
          }
        },
      });
      jQuery.validator.addMethod("capacidad", function (value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
      }, 'Solo se admiten números');
    });
  },

  validar_actualizar_tanque:function () {
    $(document).ready(function(){
      jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
      });
      $('#tanque-actualizar').validate({
        rules:{
          cantidad: {
            required: true,
            maxlength: 4,
            minlength:1
          },
          capacidad:{
            required: true,
            capacidad: true,
            maxlength: 4,
            minlength:1
          }
        },
        submitHandler: function (form) {
          tanque.actualizar();
        },

        highlight: function (element) {
          $(element).parent().removeClass('has-success').addClass('has-error');
        },

        success: function (element) {
          $(element).parent().removeClass('has-error').addClass('has-success');
        },
        messages:{
          capacidad:{
            required: "Este campo es requerido",
            maxlength: "maximo 4 digitos",
            minlength:"minimo 1 digitos"
          },
          cantidad:{
            required: "Este campo es requerido",
            maxlength: "maximo 4 digitos",
            minlength:"minimo 1 digitos"
          }
        },

      });

      jQuery.validator.addMethod("capacidad", function (value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
      }, 'Solo se admiten números');

      jQuery.validator.addMethod("cantidad", function (value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
      }, 'Solo se admiten números');
    });
  }
};

var validacion_corral = {

  validar_registro_corral:function () {

    $(document).ready(function(){
      jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
      });
      $('#registrar-corral').validate({
        rules:{
          capacidad:{
            required: true,
            capacidad: true,
            maxlength: 4,
            minlength:2
          }
        },
        submitHandler: function (form) {
          form.submit();
        },

        highlight: function (element) {
          $(element).parent().removeClass('has-success').addClass('has-error');
        },

        success: function (element) {
          $(element).parent().removeClass('has-error').addClass('has-success');
        },
        messages:{
          capacidad:{
            required: "Este campo es requerido",
            maxlength: "maximo 4 digitos",
            minlength:"minimo 2 digitos"
          }
        },
      });
      jQuery.validator.addMethod("capacidad", function (value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
      }, 'Solo se admiten números');
    });
  },

  validar_actualizar_corral:function () {
    $(document).ready(function(){
      jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
      });
      $('#corral-actualizar').validate({
        rules:{
          cantidad: {
            required: true,
            maxlength: 4,
            minlength:1
          },
          capaci:{
            required: true,
            capaci: true,
            maxlength: 4,
            minlength:1
          }
        },
        submitHandler: function (form) {
          corral.actualizar_corral();
        },

        highlight: function (element) {
          $(element).parent().removeClass('has-success').addClass('has-error');
        },

        success: function (element) {
          $(element).parent().removeClass('has-error').addClass('has-success');
        },
        messages:{
          capaci:{
            required: "Este campo es requerido",
            maxlength: "maximo 4 digitos",
            minlength:"minimo 1 digitos"
          },
          cantidad:{
            required: "Este campo es requerido",
            maxlength: "maximo 4 digitos",
            minlength:"minimo 1 digitos"
          }
        },

      });

      jQuery.validator.addMethod("capaci", function (value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
      }, 'Solo se admiten números');

      jQuery.validator.addMethod("cantidad", function (value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
      }, 'Solo se admiten números');
    });
  }

}
