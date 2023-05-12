//////MODULOS DE TIPO DE ISNSUMOS

function RegistraTipoInsumo() {
  var nombrerol = $("#nombreTipo").val().trim();

  if (nombrerol.trim() == "" || nombrerol.length == 0) {
    Swal.fire("Campo vacio", "Ingrese el nombre del tipo", "warning");
    return $("#TipoInsumo_olbligg").html(
      " - Ingrese nombre del tipo de insumo"
    );
  } else {
    $("#TipoInsumo_olbligg").html("");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "InsumoMaterial/RegistraTipoInsumo",
    data: { nombrerol: nombrerol },
    success: function (response) {
      $(".card").LoadingOverlay("hide");
      if (response == 1) {
        $("#nombreTipo").val("");
        return Swal.fire(
          "Tipo exitoso",
          "El tipo se creo con exito",
          "success"
        );
      } else if (response == 2) {
        return Swal.fire(
          "Tipo ya existe",
          "El tipo '" + nombrerol + "', ya esta creado",
          "warning"
        );
      } else {
        return Swal.fire(
          "Error de registro",
          "Error al crear el tipo, falla en la matrix",
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

function EstadoTipo(id, estado) {
  var res = "";
  if (estado == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "InsumoMaterial/EstadoIsnumo",
        data: { id: id, estado: estado },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/TipoInsumo/list/0"
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

function EditarTipoInsumo() {
  var id = $("#TipoId").val().trim();
  var nombrerol = $("#nombreTipo").val().trim();

  if (nombrerol.trim() == "" || nombrerol.length == 0) {
    Swal.fire("Campo vacio", "Ingrese el nombre del tipo de insumo", "warning");
    return $("#TipoInsumo_olbligg").html(" - Ingrese nombre del tipo");
  } else {
    $("#TipoInsumo_olbligg").html("");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "InsumoMaterial/EditarTipoInsumo",
    data: { nombrerol: nombrerol, id: id },
    success: function (response) {
      $(".card").LoadingOverlay("hide");
      if (response == 1) {
        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/TipoInsumo/list/0"
        );

        return Swal.fire(
          "Tipo exitoso",
          "El tipo se edito con exito",
          "success"
        );
      } else if (response == 2) {
        return Swal.fire(
          "Tipo ya existe",
          "El tipo '" + nombrerol + "', ya esta creado",
          "warning"
        );
      } else {
        return Swal.fire(
          "Error de dato",
          "Error al editar el tipo, falla en la matrix",
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

////////// registro de insumo

function RegistrarInsumo() {
  var codigo = $("#codigo").val();
  var nombres = $("#nombres").val();
  var tipo_producto = $("#tipo_insumo").val();
  var precio_venta = $("#precio_venta").val();
  var descripcion = $("#descripcion").val();
  /// foto
  var foto = $("#foto").val();

  if (
    codigo.length == 0 ||
    codigo.trim() == "" ||
    nombres.length == 0 ||
    nombres.trim() == "" ||
    tipo_producto.length == 0 ||
    tipo_producto.trim() == "" ||
    precio_venta.length == 0 ||
    precio_venta.trim() == "" ||
    descripcion.length == 0 ||
    descripcion.trim() == ""
  ) {
    ValidarRegistroInsumo(
      codigo,
      nombres,
      tipo_producto,
      precio_venta,
      descripcion
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#codigo_olbligg").html("");
    $("#nombres_olbligg").html("");
    $("#tipo_producto_olbligg").html("");
    $("#precio_venta_olbligg").html("");
    $("#descripcion_olbligg").html("");
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

  formdata.append("codigo", codigo);
  formdata.append("nombres", nombres);
  formdata.append("tipo_producto", tipo_producto);
  formdata.append("precio_venta", precio_venta);
  formdata.append("descripcion", descripcion);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "InsumoMaterial/RegistrarInsumo",
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
            text: "El producto se registro con exito",
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
                BaseUrl + "admin/Insumos/list/0"
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Código ya existe",
            "La código ingresado " + codigo + " ya existe",
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

function EditarInsumo() {
  var insumoID = $("#insumoID").val();
  var codigo = $("#codigo").val();
  var nombres = $("#nombres").val();
  var tipo_producto = $("#tipo_insumo").val();
  var precio_venta = $("#precio_venta").val();
  var descripcion = $("#descripcion").val();

  if (
    codigo.length == 0 ||
    codigo.trim() == "" ||
    nombres.length == 0 ||
    nombres.trim() == "" ||
    tipo_producto.length == 0 ||
    tipo_producto.trim() == "" ||
    precio_venta.length == 0 ||
    precio_venta.trim() == "" ||
    descripcion.length == 0 ||
    descripcion.trim() == ""
  ) {
    ValidarRegistroInsumo(
      codigo,
      nombres,
      tipo_producto,
      precio_venta,
      descripcion
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#codigo_olbligg").html("");
    $("#nombres_olbligg").html("");
    $("#tipo_producto_olbligg").html("");
    $("#precio_venta_olbligg").html("");
    $("#descripcion_olbligg").html("");
  }

  var formdata = new FormData();

  formdata.append("insumoID", insumoID);
  formdata.append("codigo", codigo);
  formdata.append("nombres", nombres);
  formdata.append("tipo_producto", tipo_producto);
  formdata.append("precio_venta", precio_venta);
  formdata.append("descripcion", descripcion);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "InsumoMaterial/EditarInsumo",
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
            text: "El producto se edito con exito",
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
                BaseUrl + "admin/Insumos/list/0"
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Código ya existe",
            "La código ingresado " + codigo + " ya existe",
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

function ValidarRegistroInsumo(
  codigo,
  nombres,
  tipo_producto,
  precio_venta,
  descripcion
) {
  if (codigo.length == 0 || codigo.trim() == "") {
    $("#codigo_olbligg").html(" - Ingrese el código");
  } else {
    $("#codigo_olbligg").html("");
  }

  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombres_olbligg").html(" - Ingrese el nombre del producto");
  } else {
    $("#nombres_olbligg").html("");
  }

  if (tipo_producto.length == 0 || tipo_producto.trim() == "") {
    $("#tipo_producto_olbligg").html(" - Ingrese el tipo");
  } else {
    $("#tipo_producto_olbligg").html("");
  }

  if (precio_venta.length == 0 || precio_venta.trim() == "") {
    $("#precio_venta_olbligg").html(" - Ingrese el precio de compra");
  } else {
    $("#precio_venta_olbligg").html("");
  }

  if (descripcion.length == 0 || descripcion.trim() == "") {
    $("#descripcion_olbligg").html(" - Ingrese la descripcion del producto");
  } else {
    $("#descripcion_olbligg").html("");
  }
}

function EstadoInsumo(id, estado) {
  var res = "";
  if (estado == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "InsumoMaterial/EstadoInsumoI",
        data: { id: id, estado: estado },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/Insumos/list/0"
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

function EditarFotoInsumo() {
  var id = document.getElementById("insumoID").value;
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

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "InsumoMaterial/EditarFotoInsumo",
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
            text: "Foto del producto se edito con exito",
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
                BaseUrl + "admin/Insumos/list/0"
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

//// TIPO DE MATERIAL

function RegistraTipoMaterial() {
  var nombrerol = $("#nombreTipo").val().trim();

  if (nombrerol.trim() == "" || nombrerol.length == 0) {
    Swal.fire("Campo vacio", "Ingrese el nombre del tipo", "warning");
    return $("#TipoInsumo_olbligg").html(
      " - Ingrese nombre del tipo de insumo"
    );
  } else {
    $("#TipoInsumo_olbligg").html("");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "InsumoMaterial/RegistraTipoMaterial",
    data: { nombrerol: nombrerol },
    success: function (response) {
      $(".card").LoadingOverlay("hide");
      if (response == 1) {
        $("#nombreTipo").val("");
        return Swal.fire(
          "Tipo exitoso",
          "El tipo se creo con exito",
          "success"
        );
      } else if (response == 2) {
        return Swal.fire(
          "Tipo ya existe",
          "El tipo '" + nombrerol + "', ya esta creado",
          "warning"
        );
      } else {
        return Swal.fire(
          "Error de registro",
          "Error al crear el tipo, falla en la matrix",
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

function EstadoTipoMaterial(id, estado) {
  var res = "";
  if (estado == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "InsumoMaterial/EstadoTipoMaterial",
        data: { id: id, estado: estado },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/TipoMaterial/list/0"
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

function EditarTipoMaterial() {
  var id = $("#TipoId").val().trim();
  var nombrerol = $("#nombreTipo").val().trim();

  if (nombrerol.trim() == "" || nombrerol.length == 0) {
    Swal.fire("Campo vacio", "Ingrese el nombre del tipo de insumo", "warning");
    return $("#TipoInsumo_olbligg").html(" - Ingrese nombre del tipo");
  } else {
    $("#TipoInsumo_olbligg").html("");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "InsumoMaterial/EditarTipoMaterial",
    data: { nombrerol: nombrerol, id: id },
    success: function (response) {
      $(".card").LoadingOverlay("hide");
      if (response == 1) {
        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/TipoMaterial/list/0"
        );

        return Swal.fire(
          "Tipo exitoso",
          "El tipo se edito con exito",
          "success"
        );
      } else if (response == 2) {
        return Swal.fire(
          "Tipo ya existe",
          "El tipo '" + nombrerol + "', ya esta creado",
          "warning"
        );
      } else {
        return Swal.fire(
          "Error de dato",
          "Error al editar el tipo, falla en la matrix" + response,
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
