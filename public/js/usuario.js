$(document).on("click", "#btn_aceptar", function () {
  var usuario = $("#username").val();
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

    funcion = "logeo";
    $.ajax({
      url: BaseUrl + "usuario/Credenciales",
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
            url: BaseUrl + "usuario/CraerToken",
            type: "POST",
            data: {
              id_usu: data[0],
            },
          }).done(function (res) {
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
                  location.reload();
                }
              });
            }
          });
        }
      }
    });
  }
});

function ModalDatoUsuario() {
  TraerDatosUsuario();
  $("#ModalDataUsuario").modal("show");
}

//////MODULOS DE ROLES

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

////////// MODULOS DE USUARIO

function RegistraUsuario() {
  var nombres = $("#nombres").val();
  var apellidos = $("#apellidos").val();
  var correo = $("#correo").val();
  var cedula = $("#cedula").val();
  var tipo_rol = $("#tipo_rol").val();
  var usuario = $("#usuario").val();
  var password = $("#password").val();
  var password_c = $("#confirm_password").val();
  /// foto
  var foto = $("#foto").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    cedula.length == 0 ||
    cedula.trim() == "" ||
    tipo_rol.length == 0 ||
    tipo_rol == 0 ||
    usuario.length == 0 ||
    usuario.trim() == "" ||
    password.length == 0 ||
    password.trim() == "" ||
    password_c.length == 0 ||
    password_c.trim() == ""
  ) {
    ValidarRegistroUsuario(
      nombres,
      apellidos,
      correo,
      cedula,
      tipo_rol,
      usuario,
      password,
      password_c
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
    $("#rol_olbligg").html("");
    $("#usuario_olbligg").html("");
    $("#password_olbligg").html("");
    $("#confirm_password_olbligg").html("");
  }

  if (password != password_c) {
    $("#password_olbligg").html(" - Confime password");
    $("#confirm_password_olbligg").html(" - Confime password");
    return swal.fire(
      "Password no coinciden",
      "Los password ingresados no coinciden",
      "warning"
    );
  } else {
    $("#password_olbligg").html("");
    $("#confirm_password_olbligg").html("");
  }

  if (!cedula_v) {
    return swal.fire(
      "Cedula no validad",
      "Ingrese una cedula valida",
      "warning"
    );
  }

  if (!correo_usus) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  //para scar la fecha para la foto
  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = foto.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "IMG" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  var formdata = new FormData();
  var foto = $("#foto")[0].files[0];
  //est valores son como los que van en la data del ajax

  formdata.append("nombres", nombres);
  formdata.append("apellidos", apellidos);
  formdata.append("correo", correo);
  formdata.append("cedula", cedula);
  formdata.append("tipo_rol", tipo_rol);
  formdata.append("usuario", usuario.trim());
  formdata.append("password", password.trim());

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "usuario/RegistrarUsuario",
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
            text: "El usuario se registro con exito",
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
                BaseUrl + "admin/UsuariosAccion/create"
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

function ValidarRegistroUsuario(
  nombres,
  apellidos,
  correo,
  cedula,
  tipo_rol,
  usuario,
  password,
  password_c
) {
  if (nombres.length == 0 || nombres.trim() == "") {
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

  if (tipo_rol.length == 0 || tipo_rol == 0) {
    $("#rol_olbligg").html(" - Ingrese el rol");
  } else {
    $("#rol_olbligg").html("");
  }

  if (usuario.length == 0 || usuario.trim() == "") {
    $("#usuario_olbligg").html(" - Ingrese el usuario");
  } else {
    $("#usuario_olbligg").html("");
  }

  if (password.length == 0 || password.trim() == "") {
    $("#password_olbligg").html(" - Ingrese el password");
  } else {
    $("#password_olbligg").html("");
  }

  if (password_c.length == 0 || password_c.trim() == "") {
    $("#confirm_password_olbligg").html(" - Confirme el password");
  } else {
    $("#confirm_password_olbligg").html("");
  }
}

function EstadoUsuario(id, estado) {
  var res = "";
  if (estado == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del Usuario se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "usuario/EstadoUsuario",
        data: { id: id, estado: estado },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/UsuariosAccion/list"
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

function EditarUsuario() {
  var ID = $("#usuaruiID").val();
  var nombres = $("#nombres").val();
  var apellidos = $("#apellidos").val();
  var correo = $("#correo").val();
  var cedula = $("#cedula").val();
  var tipo_rol = $("#tipo_rol").val();
  var usuario = $("#usuario").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    cedula.length == 0 ||
    cedula.trim() == "" ||
    tipo_rol.length == 0 ||
    tipo_rol == 0 ||
    usuario.length == 0 ||
    usuario.trim() == ""
  ) {
    ValidarUsuarioEdit(nombres, apellidos, correo, cedula, tipo_rol, usuario);

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
    $("#rol_olbligg").html("");
    $("#usuario_olbligg").html("");
  }

  if (!cedula_v) {
    return swal.fire(
      "Cedula no validad",
      "Ingrese una cedula valida",
      "warning"
    );
  }

  if (!correo_usus) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  var formdata = new FormData();
  //est valores son como los que van en la data del ajax

  formdata.append("id", ID);
  formdata.append("nombres", nombres);
  formdata.append("apellidos", apellidos);
  formdata.append("correo", correo);
  formdata.append("cedula", cedula);
  formdata.append("tipo_rol", tipo_rol);
  formdata.append("usuario", usuario.trim());

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "usuario/EditarUsuario",
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
            text: "El usuario se edito con exito",
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
                BaseUrl + "admin/UsuariosAccion/list"
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

function ValidarUsuarioEdit(
  nombres,
  apellidos,
  correo,
  cedula,
  tipo_rol,
  usuario
) {
  if (nombres.length == 0 || nombres.trim() == "") {
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

  if (tipo_rol.length == 0 || tipo_rol == 0) {
    $("#rol_olbligg").html(" - Ingrese el rol");
  } else {
    $("#rol_olbligg").html("");
  }

  if (usuario.length == 0 || usuario.trim() == "") {
    $("#usuario_olbligg").html(" - Ingrese el usuario");
  } else {
    $("#usuario_olbligg").html("");
  }
}

function VerImagenUsuario(id, foto) {
  $("#foto_producto").attr("src", BaseUrl + "public/img/usuario/" + foto);
  $("#id_foto_producto").val(id);
  $("#foto_actu").val(foto);
  $("#modal_editar_photo").modal("show");
}

function EditarFotoUsuario() {
  var id = document.getElementById("usuaruiID").value;
  var foto = document.getElementById("foto").value;
  var ruta_actual = document.getElementById("foto_actu").value;

  if (foto == "" || ruta_actual.length == 0 || ruta_actual == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese una imagen para actualizar",
      "warning"
    );
  }

  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = foto.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "IMG" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  var formdata = new FormData();
  var foto = $("#foto")[0].files[0];

  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  $(".modal-content").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "usuario/EditarFotoUsuario",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".modal-content").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          Swal.fire({
            title: "",
            text: "Foto de usuario editado con exito",
            icon: "success",
            showCancelButton: true,
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ok",
          }).then((result) => {
            if (result.isConfirmed) {
              $("#modal_editar_photo").modal("hide");
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/UsuariosAccion/list"
              );
            }
          });
        }
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

///////// Datos del usuario logeado

function GuardarDatoPerfilUser() {
  var nombres = $("#nombresData").val();
  var apellidos = $("#apellidosData").val();
  var correo = $("#correoData").val();
  var usuario = $("#usuarioData").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    usuario.length == 0 ||
    usuario.trim() == ""
  ) {
    ValidarRegistroUsuarioLogeado(nombres, apellidos, correo, usuario);
    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombresData_olbligg").html("");
    $("#apellidosData_olbligg").html("");
    $("#correoData_olbligg").html("");
    $("#usuarioData_olbligg").html("");
  }

  if (!correo_usuData) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  var formdata = new FormData();
  formdata.append("nombres", nombres);
  formdata.append("apellidos", apellidos);
  formdata.append("correo", correo);
  formdata.append("usuario", usuario.trim());

  $(".modal-content").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "usuario/GuardarDatoPerfilUser",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".modal-content").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          TraerDatosUsuario();
          return swal.fire(
            "Datos editados",
            "Los datos se editaron con exito",
            "success"
          );
        } else if (resp == 2) {
          return swal.fire(
            "Usuario ya existe",
            "El usuario ingresada " + usuario + " ya existe",
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

function ValidarRegistroUsuarioLogeado(nombres, apellidos, correo, usuario) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombresData_olbligg").html(" - Ingrese los nombres");
  } else {
    $("#nombresData_olbligg").html("");
  }

  if (apellidos.length == 0 || apellidos.trim() == "") {
    $("#apellidosData_olbligg").html(" - Ingrese los apellidos");
  } else {
    $("#apellidosData_olbligg").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correoData_olbligg").html(" - Ingrese el correo");
  } else {
    $("#correoData_olbligg").html("");
  }

  if (usuario.length == 0 || usuario.trim() == "") {
    $("#usuarioData_olbligg").html(" - Ingrese el usuario");
  } else {
    $("#usuarioData_olbligg").html("");
  }
}

function UpdatePhotoUser() {
  var foto = $("#foto_new").val();

  if (foto.trim() == "" || foto.length == 0) {
    return swal.fire("Sin foto", "Ingrese una foto para continuar", "warning");
  }

  //para scar la fecha para la foto
  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = foto.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "IMG" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  var formdata = new FormData();
  var foto = $("#foto_new")[0].files[0];
  //est valores son como los que van en la data del ajax

  formdata.append("fotoActual", fotoActual);
  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $(".modal-content").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "usuario/UpdatePhotoUser",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".modal-content").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#foto_new").val("");
          TraerDatosUsuario();
          return swal.fire(
            "Imagen correcta",
            "La foto se actualizo con exito",
            "success"
          );
        } else {
          return swal.fire("Error", "Error en la Matrix" + resp, "error");
        }
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

function CambiarPasswordUser() {
  var password_actu = $("#password_actu").val();
  var nuevo_password = $("#nuevo_password").val();

  if (
    password_actu.length == 0 ||
    password_actu.trim() == "" ||
    nuevo_password.length == 0 ||
    nuevo_password.trim() == ""
  ) {
    VerificarPasswordNuevo(password_actu, nuevo_password);
    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#password_actu_olbligg").html("");
    $("#nuevo_password_olbligg").html("");
  }

  if (password_actu != PasswordUser) {
    $("#password_actu_olbligg").html("El password actual no es correcto");
    return swal.fire(
      "Password no valido",
      "El password actual no es correcto",
      "warning"
    );
  } else {
    $("#password_actu_olbligg").html("");
  }

  var formdata = new FormData();
  formdata.append("nuevo_password", nuevo_password.trim());

  $(".modal-content").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "usuario/CambiarPasswordUser",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".modal-content").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#password_actu").val("");
          $("#nuevo_password").val("");

          TraerDatosUsuario();
          return swal.fire(
            "Password correcto",
            "El password se edito con exito",
            "success"
          );
        } else {
          return swal.fire("Error", "Error en la Matrix" + resp, "error");
        }
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

function VerificarPasswordNuevo(password_actu, nuevo_password) {
  if (password_actu.length == 0 || password_actu.trim() == "") {
    $("#password_actu_olbligg").html(" - Ingrese el password actual");
  } else {
    $("#password_actu_olbligg").html("");
  }

  if (nuevo_password.length == 0 || nuevo_password.trim() == "") {
    $("#nuevo_password_olbligg").html(" - Ingrese el password nuevo");
  } else {
    $("#nuevo_password_olbligg").html("");
  }
}

//////// FORMULARIO DE EMPRESA

function GuardarDatosHacienda() {
  var nombre = $("#nombre").val();
  var direccion = $("#direccion").val();
  var correo_e = $("#correo_e").val();
  var ruc = $("#ruc").val();
  var telefono = $("#telefono").val();
  var actividad = $("#actividad").val(); 

  if (
    nombre.length == 0 ||
    nombre.trim() == "" ||
    direccion.length == 0 ||
    direccion.trim() == "" ||
    correo_e.length == 0 ||
    correo_e.trim() == "" ||
    ruc.length == 0 ||
    ruc.trim() == "" ||
    telefono.length == 0 ||
    telefono == 0 ||
    actividad.length == 0 ||
    actividad.trim() == ""
  ) {
    ValidarRegistroEmpresa(
      nombre,
      direccion,
      correo_e,
      ruc,
      telefono,
      actividad
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombre_olbligg").html("");
    $("#direccion_olbligg").html("");
    $("#correo_e_olbligg").html("");
    $("#ruc_olbligg").html("");
    $("#telefono_olbligg").html("");
    $("#actividad_olbligg").html("");
  }

  if (!correo_empresa) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  var formdata = new FormData(); 
  formdata.append("nombre", nombre);
  formdata.append("direccion", direccion);
  formdata.append("correo_e", correo_e);
  formdata.append("ruc", ruc);
  formdata.append("telefono", telefono);
  formdata.append("actividad", actividad); 

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "usuario/RegistrarEmpresa",
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
            text: "Datos de la empresa correctos",
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
                BaseUrl + "admin/EmpresaView"
              );
            }
          });
        }
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

function ValidarRegistroEmpresa(
  nombres,
  direccion,
  correo_e,
  ruc,
  telefono,
  actividad
) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombre_olbligg").html(" - Ingrese el nombre de la empresa");
  } else {
    $("#nombre_olbligg").html("");
  }

  if (direccion.length == 0 || direccion.trim() == "") {
    $("#direccion_olbligg").html(" - Ingrese la direccion");
  } else {
    $("#direccion_olbligg").html("");
  }

  if (correo_e.length == 0 || correo_e.trim() == "") {
    $("#correo_e_olbligg").html(" - Ingrese el correo");
  } else {
    $("#correo_e_olbligg").html("");
  }

  if (ruc.length == 0 || ruc.trim() == "") {
    $("#ruc_olbligg").html(" - Ingrese el rúc");
  } else {
    $("#ruc_olbligg").html("");
  }

  if (telefono.length == 0 || telefono == 0) {
    $("#telefono_olbligg").html(" - Ingrese el telefono");
  } else {
    $("#telefono_olbligg").html("");
  }

  if (actividad.length == 0 || actividad.trim() == "") {
    $("#actividad_olbligg").html(" - Ingrese la actividad de la empresa");
  } else {
    $("#actividad_olbligg").html("");
  }
}

function UpdateImageEmpresa() {
  var foto = $("#fotoe").val();
  var fotoActual = $("#foto_actual").val();

  if (foto.trim() == "" || foto.length == 0) {
    return swal.fire("Sin foto", "Ingrese una foto para continuar", "warning");
  }

  //para scar la fecha para la foto
  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = foto.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "IMG" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  var formdata = new FormData();
  var foto = $("#fotoe")[0].files[0];
  //est valores son como los que van en la data del ajax

  formdata.append("fotoActual", fotoActual);
  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "usuario/UpdateImageEmpresa",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".card").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          
          cargar_contenido(
            "contenido_principal",
            BaseUrl + "admin/EmpresaView");

          return swal.fire(
            "Imagen correcta",
            "La foto se actualizo con exito",
            "success"
          );
        } else {
          return swal.fire("Error", "Error en la Matrix" + resp, "error");
        }
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}