document.addEventListener("DOMContentLoaded", function () {

$(".link-cuidado").click(function (event) {
    event.preventDefault();
    formData = new FormData();
    let id = $(this).attr("data-id");
    formData.append("id_cuidado", id);
    formData.append("accion", "delete");

    $.ajax({
      url: "../controlador/eliminarCuidado.php",
      method: "POST",
      dataType: "json",
      data: formData,
      contentType: false,
      processData: false,
    })
    .done(function (res) {
        $("#cuidado-"+id).remove();
        alert("Datos borrados satisfactoriamente");
      })
      .fail(function (res) {
        alert("No se han podido borrar los datos");
      });
  });
});