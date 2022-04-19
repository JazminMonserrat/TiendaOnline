document.addEventListener("DOMContentLoaded", function () {
  $("#boton-guardar").click(function (evento) {
    evento.preventDefault();
    $("#form-duda").submit();
  });
  $("#form-duda").validate({
    rules: {
      enviar: {
        required: true,
      },
    },
    messages: {
      enviar: "Por favor ingrese la duda",
    },
    errorPlacement: function (error, element) {
      $(element).closest(".form-group").find(".help-block").html(error.html());
    },
    highlight: function (element) {
      $(element)
        .closest(".form-group")
        .removeClass("has-success")
        .addClass("has-error");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element)
        .closest(".form-group")
        .removeClass("has-error")
        .addClass("has-success");
      $(element).closest(".form-group").find(".help-block").html("");
    },
    submitHandler: function (form) {
      var formData = new FormData(document.getElementById("form-duda"));
      $.ajax({
        url: form.action,
        method: "POST",
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,
      })
        .done(function (res) {
          alert("Duda registrada exitosamente");
          location.reload();
        })
        .fail(function (res) {});
    },
  });

  $(".respuesta").click(function (evento) {
    boton = $(this);
    $("#form-respuesta-" + boton.attr("id-duda")).removeClass("tag-hidden");
    boton.addClass("tag-hidden");
    $("#contenedor-respuesta-" + boton.attr("id-duda")+ " .help-block").html("");
    $("#form-respuesta-" + boton.attr("id-duda")).removeClass("has-error");
  });

  $(".btn-guardar").click(function (evento) {
    evento.preventDefault();
    boton = $(this);
    if ($("#text-respuesta-" + boton.attr("id-duda")).val().trim() != "") {
      var formData = new FormData(
        document.getElementById("form-respuesta-" + boton.attr("id-duda"))
      );
      $.ajax({
        url: "../controlador/registrarDuda.php",
        method: "POST",
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,
      })
        .done(function (res) {
          $("#form-respuesta-" + boton.attr("id-duda")).remove();
          $("#nombre-" + res.id_duda).removeClass("tag-hidden");
          $("#respuesta-" + res.id_duda).html(res.respuesta);
          $("#respuesta-" + res.id_duda).removeClass("tag-hidden");
        })
        .fail(function (res) {

        });
    } else {
      $("#contenedor-respuesta-" + boton.attr("id-duda")+ " .help-block").html("Ingresa tu respuesta");
      $("#form-respuesta-" + boton.attr("id-duda")).addClass("has-error");
    }
  });
});
