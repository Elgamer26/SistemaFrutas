//////MODULOS DE PRODUCTO
function RegistraTipoProducto() {
  var nombrerol = $("#nombreTipo").val().trim();

  if (nombrerol.trim() == "" || nombrerol.length == 0) {
    Swal.fire("Campo vacio", "Ingrese el nombre del tipo", "warning");
    return $("#TipoProducto_olbligg").html(" - Ingrese nombre del tipo");
  } else {
    $("#TipoProducto_olbligg").html("");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "producto/RegistraTipoProducto",
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
        url: BaseUrl + "producto/EstadoTipo",
        data: { id: id, estado: estado },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/tipoProducto/list/0"
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

function EditarTipoProducto() {
  var id = $("#TipoId").val().trim();
  var nombrerol = $("#nombreTipo").val().trim();

  if (nombrerol.trim() == "" || nombrerol.length == 0) {
    Swal.fire("Campo vacio", "Ingrese el nombre del tipo", "warning");
    return $("#TipoProducto_olbligg").html(" - Ingrese nombre del tipo");
  } else {
    $("#TipoProducto_olbligg").html("");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "producto/EditarTipoProducto",
    data: { nombrerol: nombrerol, id: id },
    success: function (response) {
      $(".card").LoadingOverlay("hide");
      if (response == 1) {
        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/tipoProducto/list/0"
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

////////// registro de producto

function RegistraProducto() {
  var codigo = $("#codigo").val();
  var nombres = $("#nombres").val();
  var tipo_producto = $("#tipo_producto").val();
  var precio_venta = $("#precio_venta").val();
  var descripcion = $("#descripcion").val();
  var tamaño_producto = $("#tamaño_producto").val();
  /// foto
  // var foto = $("#foto").val();

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
    ValidarRegistroProducto(
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

  let archivo = document.getElementById("file").files.length;

  var nombrearchivo = "imagen_producto";
  var formdata = new FormData();

  //este for es para obtener las imagenes del del input file[]
  for (let i = 0; i < archivo; i++) {
    var img = document.getElementById("file").files[i];
    formdata.append("img_extra[" + i + "]", img);
  }

  formdata.append("codigo", codigo);
  formdata.append("nombres", nombres);
  formdata.append("tipo_producto", tipo_producto);
  formdata.append("precio_venta", precio_venta);
  formdata.append("descripcion", descripcion);
  formdata.append("nombrearchivo", nombrearchivo);
  formdata.append("tamaño_producto", tamaño_producto);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "producto/RegistraProducto",
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
                BaseUrl + "admin/Producto/list/0"
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Código ya existe",
            "La código ingresado " + codigo + " ya existe",
            "warning"
          );
        }else{
          return swal.fire(
            "Producto ya existe",
            "El producto ingresado ya existe",
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

function EditarProducto() {
  var productoID = $("#productoID").val();
  var codigo = $("#codigo").val();
  var nombres = $("#nombres").val();
  var tipo_producto = $("#tipo_producto").val();
  var precio_venta = $("#precio_venta").val();
  var descripcion = $("#descripcion").val();
  var tamaño_producto = $("#tamaño_producto").val();

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
    ValidarRegistroProducto(
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

  formdata.append("productoID", productoID);
  formdata.append("codigo", codigo);
  formdata.append("nombres", nombres);
  formdata.append("tipo_producto", tipo_producto);
  formdata.append("precio_venta", precio_venta);
  formdata.append("descripcion", descripcion);
  formdata.append("tamaño_producto", tamaño_producto);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "producto/EditarProducto",
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
                BaseUrl + "admin/Producto/list/0"
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Código ya existe",
            "La código ingresado " + codigo + " ya existe",
            "warning"
          );
        }else{
          return swal.fire(
            "Producto ya existe",
            "El producto ingresado ya existe",
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

function ValidarRegistroProducto(
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
    $("#precio_venta_olbligg").html(" - Ingrese el precio de venta");
  } else {
    $("#precio_venta_olbligg").html("");
  }

  if (descripcion.length == 0 || descripcion.trim() == "") {
    $("#descripcion_olbligg").html(" - Ingrese la descripcion del producto");
  } else {
    $("#descripcion_olbligg").html("");
  }
}

function EstadoProducto(id, estado) {
  var res = "";
  if (estado == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del producto se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "producto/EstadoProducto",
        data: { id: id, estado: estado },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/Producto/list/0"
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

function EditarFotoProducto() {
  var id = document.getElementById("productoID").value;
  // var foto = document.getElementById("foto").value;
  // var ruta_actual = document.getElementById("foto_actu").value;

  let archivo = document.getElementById("file").files.length;

  if (archivo == 0) {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese una imagen para actualizar",
      "warning"
    );
  }

  var nombrearchivo = "imagen_producto";
  var formdata = new FormData();

  //este for es para obtener las imagenes del del input file[]
  for (let i = 0; i < archivo; i++) {
    var img = document.getElementById("file").files[i];
    formdata.append("img_extra[" + i + "]", img);
  }

  formdata.append("id", id);
  formdata.append("nombrearchivo", nombrearchivo);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "producto/EditarFotoProducto",
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
                BaseUrl + "admin/Producto/list/0"
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Mensaje de advertencia",
            "Ingrese una imagen para actualizar",
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

///////// REGISTRO DE OFERTAS
function RegistroOferta() {
  var producto = $("#producto").val();
  var fechainicio = $("#fechainicio").val();
  var fechafin = $("#fechafin").val();
  var tipooferta = $("#tipooferta").val();
  var valordescuento = $("#valordescuento").val();

  if (producto == 0 || producto.trim() == "") {
    $("#producto_olbligg").html(" - Seleccione el producto");
    return swal.fire("Campo vacio", "Selecione un producto", "warning");
  } else {
    $("#producto_olbligg").html("");
  }

  if (fechainicio == fechafin) {
    $("#fechainicio_olbligg").html(" - XXX");
    $("#fechafin_olbligg").html(" - XXX");
    return swal.fire(
      "Fechas iguales",
      "La fecha inicio y la fecha fin no pueden ser iguales",
      "warning"
    );
  } else {
    $("#fechainicio_olbligg").html("");
    $("#fechafin_olbligg").html("");
  }

  if (tipooferta == "Descuento %") {
    if (valordescuento == "0" || valordescuento.trim() == "") {
      $("#valordescuento_olbligg").html(" - Ingrese descuento");
      return swal.fire(
        "No hay descuento",
        "Ingrese el valor del descuento",
        "warning"
      );
    } else {
      $("#valordescuento_olbligg").html("");
    }
  } else {
    $("#valordescuento_olbligg").html("");
  }

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    type: "POST",
    url: BaseUrl + "producto/RegistroOferta",
    data: {
      producto: producto,
      fechainicio: fechainicio,
      fechafin: fechafin,
      tipooferta: tipooferta,
      valordescuento: valordescuento,
    },
    success: function (resp) {
      $(".card").LoadingOverlay("hide");
      if (resp == 1) {
        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/oferta/registro/0"
        );
        return swal.fire(
          "Oferta registrada",
          "La oferta se registró con exito",
          "success"
        );
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
}

/////////EDITRA OFERTA
function EditarOferta() {
  var idoferta = $("#idoferta").val();

  var fechainicio = $("#fechainicio").val();
  var fechafin = $("#fechafin").val();
  var tipooferta = $("#tipooferta").val();
  var valordescuento = $("#valordescuento").val();

  if (fechainicio == fechafin) {
    $("#fechainicio_olbligg").html(" - XXX");
    $("#fechafin_olbligg").html(" - XXX");
    return swal.fire(
      "Fechas iguales",
      "La fecha inicio y la fecha fin no pueden ser iguales",
      "warning"
    );
  } else {
    $("#fechainicio_olbligg").html("");
    $("#fechafin_olbligg").html("");
  }

  if (tipooferta == "Descuento %") {
    if (valordescuento == "0" || valordescuento.trim() == "") {
      $("#valordescuento_olbligg").html(" - Ingrese descuento");
      return swal.fire(
        "No hay descuento",
        "Ingrese el valor del descuento",
        "warning"
      );
    } else {
      $("#valordescuento_olbligg").html("");
    }
  } else {
    $("#valordescuento_olbligg").html("");
  }

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    type: "POST",
    url: BaseUrl + "producto/EditarOferta",
    data: {
      idoferta: idoferta,
      fechainicio: fechainicio,
      fechafin: fechafin,
      tipooferta: tipooferta,
      valordescuento: valordescuento,
    },
    success: function (resp) {
      $(".card").LoadingOverlay("hide");
      if (resp == 1) {
        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/oferta/list/0"
        );
        return swal.fire(
          "Oferta editada",
          "La oferta se edito con exito",
          "success"
        );
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
}

/////ELIMINAR OFERTA
function EliminarOferta(idoferta, idproducto) {
  Swal.fire({
    title: "Eliminar la oferta",
    text: "Desea eliminar la oferta de producción??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "producto/EliminarOferta",
        data: {
          idoferta: idoferta,
          idproducto: idproducto,
        },
        success: function (resp) {
          if (resp == 1) {
            cargar_contenido(
              "contenido_principal",
              BaseUrl + "admin/oferta/list/0"
            );

            return swal.fire(
              "Oferta eliminada",
              "La oferta se elimino con exito",
              "success"
            );
          } else {
            return swal.fire("Error", "Error en la Matrix" + resp, "error");
          }
        },
      });
    }
  });
}

/// PAGINADOR DE OFERTAS

$(document).on("keyup", "#buscaroferta", function () {
  let valor = $(this).val();
  if (valor != "") {
    pagination_oferta(1, valor);
  } else {
    pagination_oferta(1);
  }
});

function pagination_oferta(partida, valor) {
  $.ajax({
    url: BaseUrl + "producto/Pagination_oferta",
    type: "POST",
    data: {
      partida: partida,
      valor: valor,
    },
  }).done(function (response) {
    var array = eval(response);
    if (array[0]) {
      $("#unir_listado_ofertas_").html(array[0]);
      $("#unir_paguinador_").html(array[1]);
    } else {
      $("#unir_listado_ofertas_")
        .html(`<div class="col-12" style="text-align: center; justify-content: center; align-items: center"><br>
            <label style="font-size: 20px;"></i>.:No se encontro producto:.<label>
        </div>`);
      $("#unir_paguinador_").html("");
    }
  });
}

// ENVIAR OFERTA VIA CORREO
function EnviarCorreoMasivosOfertas(id) {
  Swal.fire({
    title: "Enviar ofertas?",
    text: "Las ofertas se enviaran por correo a los clientes!!",
    icon: "info",
    showCancelButton: true,
    showCancelButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, enviar",
  }).then((result) => {
    if (result.isConfirmed) {
      EnviarCorreoOfertas(id);
    }
  });
}

async function EnviarCorreoOfertas(id) {
  Swal.fire({
    position: "top-end",
    icon: "info",
    title: "Enviando la oferta a los clientes",
    showConfirmButton: false,
    timer: 1000,
  });

  let result = await $.ajax({
    url: BaseUrl + "Producto/EnviarCorreoOfertas",
    type: "POST",
    data: {
      id: id,
    },
  });
  console.log(result);
}

// ENVIAR OFERTA VIA WHATSAPP
async function EnviarOfertasSMS(id) {
  Swal.fire({
    title: "Enviar la oferta",
    text: "Desea enviar la oferta por whatsapp??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, enviar!!",
  }).then((result) => {
    if (result.value) {
      EnviarCorreoOfertasWhatsapp(id);
    }
  });
}

async function EnviarCorreoOfertasWhatsapp(id) {
  Swal.fire({
    position: "top-end",
    icon: "info",
    title: "Enviando la oferta a los clientes",
    showConfirmButton: false,
    timer: 1000,
  });

  let result = await $.ajax({
    url: BaseUrl + "Producto/EnviarCorreoOfertasWhatsapp",
    type: "POST",
    data: {
      id: id,
    },
  });
  console.log(result);
}

// eliminar imagen del producto
function QuitarImagenProyect(id, id_producto, foto) {
  Swal.fire({
    title: "Eliminar imagen de producto?",
    text: "La imagen del se producto se eliminará!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $(".card").LoadingOverlay("show", {
        text: "Cargando...",
      });

      $.ajax({
        type: "POST",
        url: BaseUrl + "Producto/QuitarImagenProyect",
        data: {
          id: id,
          id_producto: id_producto,
          foto: foto,
        },
        success: function (response) {
          $(".card").LoadingOverlay("hide");
          if (response == 1) {
            return Swal.fire({
              title: "Imagen eliminada",
              text: "La imagen del producto se elimino con exito",
              icon: "success",
              showCancelButton: false,
              allowOutsideClick: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ok",
            }).then((result) => {
              if (result.isConfirmed) {
                cargar_contenido(
                  "contenido_principal",
                  BaseUrl + "admin/Producto/list/0"
                );
              }
            });
          } else {
            return swal.fire(
              "Error",
              "Error al eliminar la imagen del producto",
              "error"
            );
          }
        },
      });
    }
  });
}
