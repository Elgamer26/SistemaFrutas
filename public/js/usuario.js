function RegistraRol() {
  var nombrerol = $("#nombrerol").val().trim();

  if (nombrerol.trim() == "" || nombrerol.length == 0) {
    Swal.fire("Campo vacio", "Ingrese el nombre del rol", "warning");
    return $("#rol_olbligg").html(" - Ingrese nombre del rol");
  } else {
    $("#rol_olbligg").html("");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "usuario/CreateRol",
    data: { nombrerol: nombrerol },
    success: function (response) {
      $(".card").LoadingOverlay("hide");
      if (response == 1) {
        $("#nombrerol").val("");
        return Swal.fire("Rol exitoso", "El rol se creo con exito", "success");
      } else if (response == 2) {
        return Swal.fire(
          "Rol ya existe",
          "El rol '" + nombrerol + "', ya esta creado",
          "warning"
        );
      } else {
        return Swal.fire(
          "Error de registro",
          "Error al crear el rol, falla en la matrix",
          "error"
        );
      }
    },

    beforeSend: function () {
      $(".card").LoadingOverlay("show", {
        text: "Cargando...",
      });
    },
  });
}

function ModificarRol(id) {
  var nombrerol = $("#nombrerol").val().trim();

  if (nombrerol.trim() == "" || nombrerol.length == 0) {
    Swal.fire("Campo vacio", "Ingrese el nombre del rol", "warning");
    return $("#rol_olbligg").html(" - Ingrese nombre del rol");
  } else {
    $("#rol_olbligg").html("");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "usuario/ModificarRol",
    data: { nombrerol: nombrerol, id: id },
    success: function (response) {
      $(".card").LoadingOverlay("hide");
      if (response == 1) {

        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/rolesuser/list"
        );

        return Swal.fire("Rol exitoso", "El rol se edito con exito", "success");
      } else if (response == 2) {
        return Swal.fire(
          "Rol ya existe",
          "El rol '" + nombrerol + "', ya esta creado",
          "warning"
        );
      } else {
        return Swal.fire(
          "Error de editar",
          "Error al editar el rol, falla en la matrix",
          "error"
        );
      }
    },

    beforeSend: function () {
      $(".card").LoadingOverlay("show", {
        text: "Cargando...",
      });
    },
  });
}

function EstadoRol(id, estado) {
  var res = "";
  if (estado == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del rol se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "usuario/EstadoRol",
        data: { id: id, estado: estado },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/rolesuser/list"
              );
              return Swal.fire(
                "Estado",
                "EL estado se " + res + " con extio",
                "success"
              );
            }
          } else {
            return Swal.fire(
              "Estado",
              "No se pudo cambiar el estado, error en la matrix",
              "error"
            );
          }
        },
      });
    }
  });
}
