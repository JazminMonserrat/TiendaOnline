document.addEventListener("DOMContentLoaded", function () {
  var fechaActual = new Date();

  fechaInical = convertirDateToString(fechaActual);
  var calendarEl = document.getElementById("calendario");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialDate: fechaInical,
    navLinks: true, // can click day/week names to navigate views
    businessHours: true, // display business hours
    editable: false,
    selectable: true,
    locale: "es",
    weekends: false,
    events: {
      url: "../controlador/consultarCita.php",
      method: "GET",
    },
    dateClick: function (datos) {
      if(validarFechaMayor(fechaInical,datos.dateStr)){
        if ($("#editarCita").attr("id-cita") == undefined) {
          $("#form-cita").trigger("reset");
          let fechaCita = new Date(datos.dateStr);
          if (fechaCita.getDay() < 5) {
            $("#fechainicio").val(datos.dateStr);
            $("#fechainicio").prop("disabled", true);
            $("#modalCita").modal("show");
          } else {
            mostrarMensaje(
              "Solo puede agendarse citas de lunes a viernes",
              false
            );
          }
        }else{
          mostrarMensaje(
            "Solo se puede crear una cita por usuario borre o edite la que ya existe",
            false
          );
        }
      }else{
        mostrarMensaje(
          "Solo se pueden agendar citas en la fecha actual o en las posteriores",
          false
        );
      }
      
    },
  });
  calendar.setOption("locale", "es");
  calendar.render();

  $("#btn-eliminar").click(function (event) {
    formData = new FormData();
    let folio = $("#folio").val();
    formData.append("folio", folio);
    formData.append("accion", "delete");

    $.ajax({
      url: "../controlador/eliminarCita.php",
      method: "POST",
      dataType: "json",
      data: formData,
      contentType: false,
      processData: false,
    })
      .done(function (res) {
        mostrarMensaje("Cita borrada");
        $("#form-cita").trigger("reset");
        $("#editar").modal("hide");
        $("#editarCita").removeAttr("id-cita");
        $("#editarCita").addClass("tag-hidden");

        let evento = calendar.getEventById( folio );
        if(evento){
          evento.remove();
        }
      })
      .fail(function (res) {
        mostrarMensaje("No se ha podido guardar la cita", false);
      });
  });
  $("#editarCita").click(function (event) {
    if ($("#editarCita").attr("id-cita") != undefined) {
      $.ajax({
        url:"../controlador/consultarCita.php?id=" + $("#editarCita").attr("id-cita"),
        method: "GET",
        dataType: "json",
      })
        .done(function (res) {
          $("#fecha").val(res.fecha);
          $("#folio").val(res.folio);
          $("#hora").val(res.hora);
          $("#duracion").val(res.duracion);
          $("#descripcion").val(res.descripcion);
          $("#editar").modal("show");
        })
        .fail(function (res) {
          mostrarMensaje("No se encontro la cita", false);
        });
    }
  });

  $("#enviar").click(function (datos) {
    let fecha = $("#fechainicio").val();
    let hora = $("#horainicio").val();
    let citas = obtenerCitasDelDia(fecha);
    let fechaFin = calcularHoraFin(
      $("#duracioncita").val(),
      fecha + " " + hora
    );
    if (validarHorarios(fecha + " " + hora, fechaFin, citas)) {
      $("#form-cita").submit();
    } else {
      mostrarMensaje("Ese horario ya esta ocupado", false, "#alerta-registrar");
    }
  });

  $("#btn-editar").click(function (datos) {
    let fecha = $("#fecha").val();
    let hora = $("#hora").val();
    let folio = $("#folio").val();
    let citas = obtenerCitasDelDia(fecha,folio);
    let fechaFin = calcularHoraFin(
      $("#duracion").val(),
      fecha + " " + hora
    );
    if (validarHorarios(fecha + " " + hora, fechaFin, citas)) {
      $("#form-cita-editar").submit();
    } else {
      mostrarMensaje("Ese horario ya esta ocupado", false, "#alerta-editar");
    }
  });

  $("#form-cita").validate({
    rules: {
      hora: {
        min: "14:00:00",
        max: "19:00:00",
        required: true,
        intervalo: true,
      },
      duracion: {
        required: true,
      },
      descripcion: {
        required: true,
      },
    },
    messages: {
      hora: {
        min: "El horario de atención es de 14:00 a 19:00",
        max: "El horario de atención es de 14:00 a 19:00",
        required: "Seleccione una hora dentro del horario 14:00 a 19:00 ",
      },
      duracion: {
        required: "Seleccione el tiempo que durara su cita",
      },
      descripcion: {
        required: "Ingrese una descripción del proposito de su cita",
      },
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
      if ($("#editarCita").attr("id-cita") == undefined) {
        var formData = new FormData(document.getElementById("form-cita"));
        formData.append("fecha", $("#fechainicio").val());
        formData.append("id_cliente", 1);
        $.ajax({
          url: form.action,
          method: "POST",
          dataType: "json",
          data: formData,
          contentType: false,
          processData: false,
        })
          .done(function (res) {
            mostrarMensaje("Cita guardada");
            $("#form-cita").trigger("reset");
            $("#modalCita").modal("hide");
            $("#editarCita").attr("id-cita",res.cita.id);
            $("#editarCita").removeClass("tag-hidden");
            calendar.addEvent(res.cita);
          })
          .fail(function (res) {
            mostrarMensaje("No se ha podido guardar la cita, fallo en la conexion a la base de datos", false,"#alerta-registrar");
          });
      } else {
        mostrarMensaje(
          "Solo se puede crear una cita por usuario borre o edite la que ya existe",
          false
        );
      }
    },
  });

  $("#form-cita-editar").validate({
    rules: {
      hora: {
        min: "14:00:00",
        max: "19:00:00",
        required: true,
        intervalo: true,
      },
      duracion: {
        required: true,
      },
      descripcion: {
        required: true,
      },
    },
    messages: {
      hora: {
        min: "El horario de atención es de 14:00 a 19:00",
        max: "El horario de atención es de 14:00 a 19:00",
        required: "Seleccione una hora dentro del horario 14:00 a 19:00 ",
      },
      duracion: {
        required: "Seleccione el tiempo que durara su cita",
      },
      descripcion: {
        required: "Ingrese una descripción del proposito de su cita",
      },
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
        var formData = new FormData(document.getElementById("form-cita-editar"));
        formData.append("fecha", $("#fecha").val());
        formData.append("id_cliente", 1);
        $.ajax({
          url: form.action,
          method: "POST",
          dataType: "json",
          data: formData,
          contentType: false,
          processData: false,
        })
          .done(function (res) {
            mostrarMensaje("Cita guardada");
            $("#form-cita-editar").trigger("reset");
            $("#editar").modal("hide");
            let folio = $("#folio").val();
            let evento = calendar.getEventById( folio );
            if(evento){
              evento.remove();
            }
            calendar.addEvent(res.cita);
          })
          .fail(function (res) {
            mostrarMensaje("No se ha podido guardar la cita", false);
          });
    },
  });

  $.validator.addMethod(
    "intervalo",
    function (value, element) {
      let secciones = value.split(":");
      let horas = ["00", "15", "30", "45"];
      return horas.indexOf(secciones[1]) != -1;
    },
    "Seleccione intervalos de 00, 15, 30 o 45 minutos"
  );

  function calcularHoraFin(option, fecha) {
    fecha = new Date(fecha);
    let minutos = 0;
    switch (option) {
      case "1":
        minutos = 15;
        break;
      case "2":
        minutos = 30;
        break;
      case "3":
        minutos = 45;
        break;
      case "4":
        minutos = 60;
        break;
      case "5":
        minutos = 75;
        break;
      case "6":
        minutos = 90;
        break;
      case "7":
        minutos = 105;
        break;
      case "8":
        minutos = 120;
        break;
    }

    fecha.setMinutes(fecha.getMinutes() + minutos);

    return fecha;
  }

  function mostrarMensaje(mensaje, success = true, id = "#alerta") {
    if (success) {
      $(id).removeClass("tag-hidden");
      $(id).removeClass("alert-success");
      $(id).addClass("alert-success");
    } else {
      $(id).removeClass("tag-hidden");
      $(id).removeClass("alert-success");
      $(id).addClass("alert-warning");
      $('html, body').animate({scrollTop:0}, 'slow');
    }

    $(id + " .mensaje").html(mensaje);
    window.setTimeout(function (params) {
      $(id)
        .fadeTo(1500, 0)
        .slideDown(1000, function (params) {
          $(this).addClass("tag-hidden");
          $(this).removeAttr("style");
        });
    }, 3000);
  }

  function obtenerCitasDelDia(fecha, id = null) {
    let fechasDias = [];
    let url = "";
    if(id == null){
      url = "../controlador/consultarCita.php?fecha=" + fecha;
    }else{
      url = "../controlador/consultarCita.php?fecha=" + fecha + "&id="+id;
    }
    $.ajax({
      url: url,
      method: "GET",
      async: false,
    }).done(function (datos) {
      fechasDias = datos;
    });
    return fechasDias;
  }

  function validarHorarios(fechaInicioConsulta, fechaFinConsulta, fechas) {
    let horarioDisponible = true;
    let fechaInicioComparacion = 0;
    let fechaFinComparacion = 0;
    fechaInicioConsulta = Date.parse(fechaInicioConsulta);
    fechaFinConsulta = Date.parse(fechaFinConsulta);
    for (let horario of fechas) {
      fechaInicioComparacion = Date.parse(horario.inicio);
      fechaFinComparacion = Date.parse(horario.fin);
      if (
        (fechaInicioConsulta >= fechaInicioComparacion &&
          fechaInicioConsulta < fechaFinComparacion) ||
        (fechaInicioConsulta < fechaInicioComparacion &&
          fechaFinConsulta > fechaInicioComparacion)
      ) {
        horarioDisponible = false;
        break;
      }
    }
    return horarioDisponible;
  }

  function validarFechaMayor(fechaActual,fechaSeleccionada) {
    fechaActual = Date.parse(fechaActual);
    fechaSeleccionada = Date.parse(fechaSeleccionada);
    console.log(fechaActual)
    console.log(fechaSeleccionada)
    console.log(fechaActual >= fechaSeleccionada)
    return fechaActual <= fechaSeleccionada;
  }

  function convertirDateToString(fecha, conHora = false) {
    var fechaInical = "";
    var mes = "";
    var dia = "";
    if (fecha.getMonth() < 9) {
      mes = "0" + (fecha.getMonth() + 1);
    } else {
      mes = "" + (fecha.getMonth() + 1);
    }
    if (fecha.getDate() < 10) {
      dia = "0" + fecha.getDate();
    } else {
      dia = "" + fecha.getDate();
    }
    fechaInical = fecha.getFullYear() + "-" + mes + "-" + dia;

    if (conHora) {
      fechaInical +=
        " " +
        fecha.getHours() +
        ":" +
        fecha.getMinutes +
        ":" +
        fecha.getSeconds();
    }

    return fechaInical;
  }
});
