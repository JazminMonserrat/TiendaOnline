document.addEventListener("DOMContentLoaded", function () {

    $("#eliminar-producto").click(function (event) {
        event.preventDefault();
        let conf = confirm('Estas Seguro que quieres borrar este Producto?');
        if (conf){
            formData = new FormData();
            let id = $(this).attr("data-id");
            formData.append("id_producto", id);
            formData.append("accion", "delete");
        
            $.ajax({
            url: "../Controllers/eliminarProducto.php",
            method: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            })
            .done(function (res) {
                alert("Datos borrados satisfactoriamente");
                window.location = "/app/Views/mostrarProductos.php";
            })
            .fail(function (res) {
                alert("No se han podido borrar los datos");
            });
        }
        
      });
    });