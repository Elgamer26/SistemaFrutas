///// LOGIN DE CLIENTES

$(document).on("click", "#btn_aceptar", function () {
  var usuario = $("#cedula").val();
  var password = $("#password").val();

  if (parseInt(usuario.length) <= 0 || usuario == "") {
    $("#none_pass").hide();
    $("#none_usu").hide();
    $("#none_usu").show(2000);
  } else if (parseInt(password.length) <= 0 || password == "") {
    $("#none_usu").hide();
    $("#none_pass").hide();
    $("#none_pass").show(2000);
  } else {
    $("#none_usu").hide();
    $("#none_pass").hide();

    $.ajax({
      url: BaseUrl + "cliente/CredencialesCliente",
      type: "POST",
      data: { usuario: usuario, password: password },
    }).done(function (responce) {
      if (responce == 0) {
        $("#none_usu").hide();
        $("#none_pass").hide();
        $("#error_logeo").show(2000);
        return false;
      } else {
        var data = JSON.parse(responce);
        if (data[1] == 0) {
          return Swal.fire({
            icon: "error",
            title: "Usuario inactivo",
            text: "El usuario se encuentra inactivo!",
          });
        } else {
          funcion = "session";
          $.ajax({
            url: BaseUrl + "cliente/CraerTokenCliente",
            type: "POST",
            data: {
              id_usu: data[0],
              user: data[2],
            },
          }).done(function (res) {
            RecordaPasswordUser();
            if (res == 1) {
              let timerInterval;
              Swal.fire({
                icon: "info",
                title: "Bienvenido al sistema!",
                html: "Usted sera redireccionado en <b></b> mi.",
                allowOutsideClick: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  const b = Swal.getHtmlContainer().querySelector("b");
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft();
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                },
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  location.href = BaseUrl;
                }
              });
            }
          });
        }
      }
    });
  }
});

$(document).on("click", "#btn_atras", function () {
  location.href = BaseUrl;
});

$(document).on("click", "#btn_registrase", function () {
  location.href = BaseUrl + "home/Registro";
});

$(document).on("click", "#btn_recuperarPass", function () {
  var correo = $("#email_correo").val();

  if (parseInt(correo.length) <= 0 || correo == "") {
    $("#correo_enviado").hide();
    $("#none_pass").hide();
    $("#none_usu").show(2000);
  } else {
    $("#none_usu").hide();
    $("#none_pass").hide();
    $("#correo_enviado").hide();

    $(".card").LoadingOverlay("show", {
      text: "Enviando...",
    });

    $.ajax({
      url: BaseUrl + "cliente/RecuperarPasswordCliente",
      type: "POST",
      data: { correo: correo },
    }).done(function (responce) {
      $(".card").LoadingOverlay("hide");
      if (responce == 0) {
        $("#none_usu").hide();
        $("#correo_enviado").hide();
        $("#none_pass").show(2000);
        return false;
      } else if (responce == 1) {
        $("#none_usu").hide();
        $("#none_pass").hide();
        $("#correo_enviado").show(2000);
        return false;
      } else {
        $("#none_usu").hide();
        $("#none_pass").hide();
        $("#correo_enviado").hide();
        return swal.fire(
          "Error",
          "Error en la Matrix" + responce,
          "Error de Matrix"
        );
      }
    });
  }
});

///// FORMULARIO CLIENTE

function RegistraCliente() {
  var nombre = $("#nombres").val();
  var apellidos = $("#apellidos").val();
  var correo = $("#correo").val();
  var cedula = $("#cedula").val();
  var sexo = $("#sexo").val();
  var direccion = $("#direccion").val();
  var telefono = $("#telefono").val();

  if (
    nombre.length == 0 ||
    nombre.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    cedula.length == 0 ||
    cedula.trim() == "" ||
    sexo.length == 0 ||
    sexo == 0 ||
    direccion.length == 0 ||
    direccion.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == ""
  ) {
    ValidarRegistroClientes(
      nombre,
      apellidos,
      correo,
      cedula,
      sexo,
      direccion,
      telefono
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombres_olbligg").html("");
    $("#apellidos_olbligg").html("");
    $("#correo_olbligg").html("");
    $("#cedula_olbligg").html("");
    $("#sexo_olbligg").html("");
    $("#direccion_olbligg").html("");
    $("#telefono_olbligg").html("");
  }

  if (!correo_cliente) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  if (!cedula_cliente) {
    return swal.fire(
      "Cedula incorrecto",
      "Ingrese una cedula correcta",
      "warning"
    );
  }

  var formdata = new FormData();
  formdata.append("nombre", nombre);
  formdata.append("apellidos", apellidos);
  formdata.append("correo", correo);
  formdata.append("cedula", cedula);
  formdata.append("sexo", sexo);
  formdata.append("direccion", direccion);
  formdata.append("telefono", telefono);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "cliente/RegistraCliente",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".card").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          Swal.fire({
            title: "El cliente se registro con exito",
            text: "Se envio el password al correo ingresado",
            icon: "success",
            showCancelButton: true,
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ok",
          }).then((result) => {
            if (result.isConfirmed) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/cliente/new/0/valor"
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Cedula ya existe",
            "La cedula ingresada " + cedula + " ya existe",
            "warning"
          );
        } else if (resp == 3) {
          return swal.fire(
            "Correo ya existe",
            "El correo ingresado " + correo + " ya existe",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

///// REGISTRO DEL CLIENTE DESDE LA TIENDA
function RegistraClienteTienda() {
  var nombre = $("#nombres").val();
  var apellidos = $("#apellidos").val();
  var correo = $("#correo").val();
  var cedula = $("#cedula").val();
  var sexo = $("#sexo").val();
  var direccion = $("#direccion").val();
  var telefono = $("#telefono").val();

  if (
    nombre.length == 0 ||
    nombre.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    cedula.length == 0 ||
    cedula.trim() == "" ||
    sexo.length == 0 ||
    sexo == 0 ||
    direccion.length == 0 ||
    direccion.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == ""
  ) {
    ValidarRegistroClientes(
      nombre,
      apellidos,
      correo,
      cedula,
      sexo,
      direccion,
      telefono
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombres_olbligg").html("");
    $("#apellidos_olbligg").html("");
    $("#correo_olbligg").html("");
    $("#cedula_olbligg").html("");
    $("#sexo_olbligg").html("");
    $("#direccion_olbligg").html("");
    $("#telefono_olbligg").html("");
  }

  if (!correo_cliente) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  if (!cedula_cliente) {
    return swal.fire(
      "Cedula incorrecto",
      "Ingrese una cedula correcta",
      "warning"
    );
  }

  var formdata = new FormData();
  formdata.append("nombre", nombre);
  formdata.append("apellidos", apellidos);
  formdata.append("correo", correo);
  formdata.append("cedula", cedula);
  formdata.append("sexo", sexo);
  formdata.append("direccion", direccion);
  formdata.append("telefono", telefono);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "cliente/RegistraClienteTienda",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {

      // console.log(resp);

      $(".card").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          Swal.fire({
            title: "El cliente se registro con exito",
            text: "Se envio el password a su correo ingresado",
            icon: "success",
            showCancelButton: true,
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ok",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Cedula ya existe",
            "La cedula ingresada " + cedula + " ya existe",
            "warning"
          );
        } else if (resp == 3) {
          return swal.fire(
            "Correo ya existe",
            "El correo ingresado " + correo + " ya existe",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

function EditarCliente() {
  var id = $("#ClienteID").val();
  var nombre = $("#nombres").val();
  var apellidos = $("#apellidos").val();
  var correo = $("#correo").val();
  var cedula = $("#cedula").val();
  var sexo = $("#sexo").val();
  var direccion = $("#direccion").val();
  var telefono = $("#telefono").val();

  let estado = $("#estaddoListado").val();

  if (
    nombre.length == 0 ||
    nombre.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    cedula.length == 0 ||
    cedula.trim() == "" ||
    sexo.length == 0 ||
    sexo == 0 ||
    direccion.length == 0 ||
    direccion.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == ""
  ) {
    ValidarRegistroClientes(
      nombre,
      apellidos,
      correo,
      cedula,
      sexo,
      direccion,
      telefono
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombres_olbligg").html("");
    $("#apellidos_olbligg").html("");
    $("#correo_olbligg").html("");
    $("#cedula_olbligg").html("");
    $("#sexo_olbligg").html("");
    $("#direccion_olbligg").html("");
    $("#telefono_olbligg").html("");
  }

  if (!correo_cliente) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  if (!cedula_cliente) {
    return swal.fire(
      "Cedula incorrecto",
      "Ingrese una cedula correcta",
      "warning"
    );
  }

  var formdata = new FormData();

  formdata.append("id", id);
  formdata.append("nombre", nombre);
  formdata.append("apellidos", apellidos);
  formdata.append("correo", correo);
  formdata.append("cedula", cedula);
  formdata.append("sexo", sexo);
  formdata.append("direccion", direccion);
  formdata.append("telefono", telefono);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "cliente/EditarCliente",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".card").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          Swal.fire({
            title: "",
            text: "El cliente se edito con exito",
            icon: "success",
            showCancelButton: true,
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ok",
          }).then((result) => {
            if (result.isConfirmed) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/ListadoCliente/" + estado
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Cedula ya existe",
            "La cedula ingresada " + cedula + " ya existe",
            "warning"
          );
        } else if (resp == 3) {
          return swal.fire(
            "Correo ya existe",
            "El correo ingresado " + correo + " ya existe",
            "warning"
          );
        }
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

function ValidarRegistroClientes(
  nombre,
  apellidos,
  correo,
  cedula,
  sexo,
  direccion,
  telefono
) {
  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombres_olbligg").html(" - Ingrese los nombres");
  } else {
    $("#nombres_olbligg").html("");
  }

  if (apellidos.length == 0 || apellidos.trim() == "") {
    $("#apellidos_olbligg").html(" - Ingrese los apellidos");
  } else {
    $("#apellidos_olbligg").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_olbligg").html(" - Ingrese el correo");
  } else {
    $("#correo_olbligg").html("");
  }

  if (cedula.length == 0 || cedula.trim() == "") {
    $("#cedula_olbligg").html(" - Ingrese la cedula");
  } else {
    $("#cedula_olbligg").html("");
  }

  if (sexo.length == 0 || sexo == 0) {
    $("#sexo_olbligg").html(" - Ingrese el sexo");
  } else {
    $("#sexo_olbligg").html("");
  }

  if (direccion.length == 0 || direccion.trim() == "") {
    $("#direccion_olbligg").html(" - Ingrese la direccion");
  } else {
    $("#direccion_olbligg").html("");
  }

  if (telefono.length == 0 || telefono.trim() == "") {
    $("#telefono_olbligg").html(" - Ingrese el telefono");
  } else {
    $("#telefono_olbligg").html("");
  }
}

function EstadoCliente(id, estado, valor) {
  var res = "";
  if (estado == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del cliente se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "cliente/EstadoCliente",
        data: { id: id, estado: estado },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/ListadoCliente/" + valor
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
