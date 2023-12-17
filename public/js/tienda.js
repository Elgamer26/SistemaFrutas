$(document).on("keyup", "#buscar_producto", function () {
  let valor = $(this).val();
  if (valor != "") {
    paginartienda(1, valor);
  } else {
    paginartienda(1);
  }
});

function paginartienda(partida, valor) {
  $.ajax({
    url: BaseUrl + "tienda/paginartienda",
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

//////////// PAGINADOR DE OFERTAS

$(document).on("keyup", "#buscar_producto_oferta", function () {
  let valor = $(this).val();
  if (valor != "") {
    paginartiendaofertas(1, valor);
  } else {
    paginartiendaofertas(1);
  }
});

function paginartiendaofertas(partida, valor) {
  $.ajax({
    url: BaseUrl + "tienda/paginartiendaofertas",
    type: "POST",
    data: {
      partida: partida,
      valor: valor,
    },
  }).done(function (response) {
    var array = eval(response);
    if (array[0]) {
      $("#unir_listado_ofertas_tienda").html(array[0]);
      $("#unir_paguinador_oferta").html(array[1]);
    } else {
      $("#unir_listado_ofertas_tienda")
        .html(`<div class="col-12" style="text-align: center; justify-content: center; align-items: center"><br>
              <label style="font-size: 20px;"></i>.:No se encontro producto:.<label>
          </div>`);
      $("#unir_paguinador_oferta").html("");
    }
  });
}

////// REGISTRAR CALIFICACION DE OFERTA

function RegistraCalificacionOferta() {
  let id = document.getElementById("idproducto").value;
  let comentario_oferta = document.getElementById("comentario_oferta").value;

  if (comentario_oferta.trim() == "" || comentario_oferta == "") {
    return alert("Ingrese un comentario para continuar");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "tienda/RegistraCalificacionOferta",
    data: {
      id: id,
      comentario_oferta: comentario_oferta,
    },
    success: function (response) {
      if (response == "nouser") {
        document.getElementById("comentario_oferta").value = "";
        return alert("Debe iniciar sesión para comentar");
      }
      if (response == 1) {
        document.getElementById("comentario_oferta").value = "";
        return Swal.fire({
          title: "Comentario enviado con exito",
          icon: "success",
          showCancelButton: false,
          showConfirmButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "OK!",
        }).then((result) => {
          if (result.value) {
            location.reload();
          }
        });
      }
    },
  });
}

///////// REGISTRAR CALIFICACION DE PRODUCTO NORMAL

function RegistraCalificacion() {
  let id = document.getElementById("idproducto").value;
  let comentario_oferta = document.getElementById("comentario").value;

  if (comentario_oferta.trim() == "" || comentario_oferta == "") {
    return alert("Ingrese un comentario para continuar");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "tienda/RegistraCalificacion",
    data: {
      id: id,
      comentario_oferta: comentario_oferta,
    },
    success: function (response) {
      if (response == "nouser") {
        document.getElementById("comentario").value = "";
        return alert("Debe iniciar sesión para comentar");
      }
      if (response == 1) {
        document.getElementById("comentario").value = "";
        return Swal.fire({
          title: "Comentario enviado con exito",
          icon: "success",
          showCancelButton: false,
          showConfirmButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "OK!",
        }).then((result) => {
          if (result.value) {
            location.reload();
          }
        });
      }
      console.log(response);
    },
  });
}

//////AGREGAR PRODUCTO A LA TIENDA
function AgregarCarritoNormal(id, precio) {
  Swal.fire({
    title: "<strong>Ingrese cantidad de producto</strong>",
    html: `
    <div class="col-sm-12">
      <input type="number" value="1" min="1" max="20" class="form-control" id="cantidadnomral" placeholder="Ingrese cantidad">
    </div>`,
    showConfirmButton: true,
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      '<button style="color: white; background: #7066e0; border: 0;" onclick="IngresarProductoCarrito(' +
      id +
      "," +
      precio +
      ');"><i class="fa fa-download"></i> Ingresar!</button>',
  });
}

function IngresarProductoCarrito(id, precio) {
  var cantidad = $("#cantidadnomral").val();

  if (cantidad.length == 0 || cantidad == "" || cantidad <= 0) {
    return alert("Ingrese cantidad de producto!");
  }

  $.ajax({
    url: BaseUrl + "tienda/IngresarProductoCarritoNormal",
    type: "POST",
    data: {
      id: id,
      precio: precio,
      cantidad: cantidad,
    },
  }).done(function (response) {

    // console.log(response);

    if (response == "100") {
      return Swal.fire(
        "Inicie sesión",
        "Para poder agregar el producto al carrito debe inicar sesion :(",
        "error"
      );
    } else if (response == "1") {
      ContarCantidadCarrito();
      return Swal.fire(
        "El producto se agrego al carrito",
        "El producto se agrego al carrito con exito",
        "success"
      );
    } else if (response == "2") {
      return Swal.fire(
        "El producto se agrego al carrito",
        "El producto ya esta registrado en el carrito, SE AUMENTO LA CANTIDAD",
        "success"
      );
    } else if (response == "3" || response == "0") {
      return Swal.fire(
        "No se pudo agregar el producto",
        "No se pudo agregar el producto al carrito, FALLO EN LA MATRIX :(",
        "error"
      );
    } else {
      return Swal.fire(
        "No hay stock suficiente",
        "No hay stock suficiente para la cantidad ingresada",
        "warning"
      );
    }
  });
}

//////AGREGAR OFERTA PRODUCTO A LA TIENDA
function AgregarCarritoOferta(id, precio) {
  Swal.fire({
    title: "<strong>Ingrese cantidad de producto</strong>",
    html: `
    <div class="col-sm-12">
      <input type="number" value="1" min="1" max="20" class="form-control" id="cantidadpferta" placeholder="Ingrese cantidad">
    </div>`,
    showConfirmButton: true,
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      '<button style="color: white; background: #7066e0; border: 0;" onclick="IngresarProductoCarritoOferta(' +
      id +
      "," +
      precio +
      ');"><i class="fa fa-download"></i> Ingresar!</button>',
  });
}

function IngresarProductoCarritoOferta(id, precio) {
  var cantidad = $("#cantidadpferta").val();

  if (cantidad.length == 0 || cantidad == "" || cantidad <= 0) {
    return alert("Ingrese cantidad de producto!");
  }

  $.ajax({
    url: BaseUrl + "tienda/IngresarProductoCarritoOferta",
    type: "POST",
    data: {
      id: id,
      precio: precio,
      cantidad: cantidad,
    },
  }).done(function (response) {
    if (response == "100") {
      return Swal.fire(
        "Inicie sesión",
        "Para poder agregar el producto al carrito debe inicar sesion :(",
        "error"
      );
    } else if (response == "1") {
      ContarCantidadCarrito();
      return Swal.fire(
        "El producto se agrego al carrito",
        "El producto se agrego al carrito con exito",
        "success"
      );
    } else if (response == "2") {
      return Swal.fire(
        "El producto se agrego al carrito",
        "El producto ya esta registrado en el carrito, SE AUMENTO LA CANTIDAD",
        "success"
      );
    } else if (response == "3" || response == "0") {
      return Swal.fire(
        "No se pudo agregar el producto",
        "No se pudo agregar el producto al carrito, FALLO EN LA MATRIX :(",
        "error"
      );
    } else {
      return Swal.fire(
        "No hay stock suficiente",
        "No hay stock suficiente para la cantidad ingresada",
        "warning"
      );
    }
  });
}

/// TRAER CANTIDAD DE PRODUCTOS EN CARRITO
function ContarCantidadCarrito() {
  $.ajax({
    type: "GET",
    url: BaseUrl + "tienda/ContarCantidadCarrito",
    success: function (response) {
      // console.log(response);
      if (response == 0) {
        $("#totalproducto").html("");
      } else {
        let data = JSON.parse(response);
        $("#totalproducto").html(data[0]);
      }
    },
  });
}

//ELIMINAR PRODUCTO DEL DETALLE CARRITO
$("#DetalleProductoCarrito").on("click", ".remover", function () {
  var id_pro = this.parentNode.parentNode.children[0].textContent;
  // var td = this.parentNode;
  // var tr = td.parentNode;
  // var table = tr.parentNode;

  Swal.fire({
    title: "Eliminar el producto?",
    text: "El producto se eliminará del detalle!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "tienda/EliminarProductoDetalle",
        data: { id_pro: id_pro },
        success: function (response) {
          if (response == 1) {
            // table.removeChild(tr);
            return Swal.fire({
              title: "Producto eliminado del detalle",
              text: "",
              icon: "success",
              showCancelButton: false,
              allowOutsideClick: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ok",
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              } else {
                location.reload();
              }
            });
          } else {
            return alert("Error al eliminar el producto" + response);
          }
        },
      });
    }
  });
});

function VerFacturaVentaWeb(id) {
  Swal.fire({
    title: "Imprimir venta de producto",
    text: "Desea imprimir la venta??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Imprimir!!",
  }).then((result) => {
    if (result.value) {
      window.open(
        BaseUrl + "Reporte/ReporteVentaWeb/" + parseInt(id),
        "#zoom=100%",
        "Factura de venta producto",
        "scrollbards=No"
      );
    }
  });
}

function AnularFacturaVentaWeb(id) {
  Swal.fire({
    title: "Anular la venta del producto",
    text: "Desea anular la venta??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, anular!!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "tienda/AnularFacturaVentaWeb",
        data: { id: id },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/ventas/web/0"
              );
              return Swal.fire(
                "Estado",
                "La venta fue anulada con exito",
                "success"
              );
            }
          } else {
            return Swal.fire(
              "Venta anulada",
              "No se pudo anular la venta, error en la matrix" + response,
              "error"
            );
          }
        },
      });
    }
  });
}

//// CALIFICACION DEL PRODUCTO
function CalificarProducto(estado, idproducto) {
  $.ajax({
    type: "POST",
    url: BaseUrl + "tienda/CalificarProducto",
    data: {
      estado: estado,
      idproducto: idproducto,
    },
    success: function (resp) {
      if (resp == 1) {
        TraerCalificaionCliente();
        return Swal.fire({
          title: "Gracias por su calificación",
          width: 600,
          padding: "3em",
          color: "#716add",
          background: "#fff url(https://i.gifer.com/H5z.gif)",
          backdrop: `
              rgba(0,0,123,0.4)
              url("/images/nyan-cat.gif")
              left top
              no-repeat
            `,
        });
      } else if (resp == 0) {
        return Swal.fire(
          "Inicie sesión",
          "Para poder calificar el producto",
          "warning"
        );
      } else {
        return Swal.fire(
          "Error",
          "Ocurrio un error en la matrix" + resp,
          "error"
        );
      }
    },
  });
}

function TraerCalificaionCliente() {
  let idproducto = $("#idproducto").val();
  $.ajax({
    type: "POST",
    url: BaseUrl + "tienda/TraerCalificaionCliente",
    data: { idproducto: idproducto },
    success: function (resp) {
      if (resp != "") {
        var data = JSON.parse(resp);
        if (data == "Nomegusta") {
          $("#nogusta").removeClass("boton");
          $("#nogusta").addClass("nogusta");
          $("#megusta").removeClass("nogusta");
          $("#megusta").addClass("boton");
        } else if (data == "Megusta") {
          $("#nogusta").removeClass("nogusta");
          $("#nogusta").addClass("boton");
          $("#megusta").removeClass("boton");
          $("#megusta").addClass("nogusta");
        } else {
          $("#nogusta").removeClass("nogusta");
          $("#nogusta").addClass("boton");
          $("#megusta").removeClass("nogusta");
          $("#megusta").addClass("boton");
        }
      } else if (resp == 0) {
        $("#nogusta").removeClass("nogusta");
        $("#nogusta").addClass("boton");

        $("#megusta").removeClass("nogusta");
        $("#megusta").addClass("boton");
      }
    },
  });
}

//// CALIFICACION DEL PRODUCTO
function CalificarProductoOferta(estado, idproducto) {
  $.ajax({
    type: "POST",
    url: BaseUrl + "tienda/CalificarProductoOferta",
    data: {
      estado: estado,
      idproducto: idproducto,
    },
    success: function (resp) {
      if (resp == 1) {
        TraerCalificaionClienteOferta();
        return Swal.fire({
          title: "Gracias por su calificación",
          width: 600,
          padding: "3em",
          color: "#716add",
          background: "#fff url(https://i.gifer.com/H5z.gif)",
          backdrop: `
              rgba(0,0,123,0.4)
              url("/images/nyan-cat.gif")
              left top
              no-repeat
            `,
        });
      } else if (resp == 0) {
        return Swal.fire(
          "Inicie sesión",
          "Para poder calificar el producto",
          "warning"
        );
      } else {
        return Swal.fire(
          "Error",
          "Ocurrio un error en la matrix" + resp,
          "error"
        );
      }
    },
  });
}

function TraerCalificaionClienteOferta() {
  let idproducto = $("#idproducto").val();
  $.ajax({
    type: "POST",
    url: BaseUrl + "tienda/TraerCalificaionClienteOferta",
    data: { idproducto: idproducto },
    success: function (resp) {
      if (resp != "") {
        var data = JSON.parse(resp);

        if (data == "Nomegusta") {
          $("#nogusta").removeClass("boton");
          $("#nogusta").addClass("nogusta");
          $("#megusta").removeClass("nogusta");
          $("#megusta").addClass("boton");
        } else if (data == "Megusta") {
          $("#nogusta").removeClass("nogusta");
          $("#nogusta").addClass("boton");
          $("#megusta").removeClass("boton");
          $("#megusta").addClass("nogusta");
        } else {
          $("#nogusta").removeClass("nogusta");
          $("#nogusta").addClass("boton");
          $("#megusta").removeClass("nogusta");
          $("#megusta").addClass("boton");
        }
      } else if (resp == 0) {
        $("#nogusta").removeClass("nogusta");
        $("#nogusta").addClass("boton");

        $("#megusta").removeClass("nogusta");
        $("#megusta").addClass("boton");
      }
    },
  });
}

///////////EDIATAR DATOS DEL CLIENTE DASHBOARD
function EditarDatoCliente() {
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
          return swal.fire(
            "Datos del perfil correctos",
            "Cliente editado con exito",
            "success"
          );
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

///////// editar password
function EditarPasswordCliente() {
  var id = $("#ClienteID").val();
  var passhidden = $("#passhidden").val();
  var passactual = $("#passactual").val();
  var passnew = $("#passnew").val();

  if (
    passactual.length == 0 ||
    passactual.trim() == "" ||
    passnew.length == 0 ||
    passnew.trim() == ""
  ) {
    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  }

  if (passactual != passhidden) {
    return swal.fire(
      "Password incorrecto",
      "El password actual ingresado no es correcto",
      "warning"
    );
  }

  var formdata = new FormData();

  formdata.append("id", id);
  formdata.append("passnew", passnew);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "Tienda/EditarPasswordCliente",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".card").LoadingOverlay("hide");
      if (resp == 1) {
        $("#passhidden").val(passnew);
        $("#passactual").val("");
        $("#passnew").val("");

        return swal.fire(
          "Password correcto",
          "El password se edito con exito",
          "success"
        );
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

/// para cargar el comprobante de servientrega
function CargarFotoServientrega(id) {
  $("#codigo_servi").val(id);
  $("#ModalSubirComprobante").modal("show");
}

async function RegistrarComprobanteServientrega() {
  var id = document.getElementById("codigo_servi").value;
  var codigo = document.getElementById("codigo").value;
  let archivo = document.getElementById("file").files.length;

  if (codigo.length == 0 || codigo.trim() == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese un código para registrar",
      "warning"
    );
  }

  if (archivo == 0) {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese una imagen para registrar",
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
  formdata.append("codigo", codigo);
  formdata.append("nombrearchivo", nombrearchivo);

  $(".modal-dialog").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "Tienda/RegistrarComprobanteServientrega",
    type: "POST",
    data: formdata,
    async: true,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".modal-dialog").LoadingOverlay("hide");
      if (resp > 0) {
        if (resp == 1) {
          $("#ModalSubirComprobante").modal("hide");
          Swal.fire({
            title: "",
            text: "Foto de servientrega se cargo con exito",
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
                BaseUrl + "admin/ventas/web/0"
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Mensaje de advertencia",
            "Ingrese una imagen para subir",
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

function DescargarArchivo(id) {
  $.ajax({
    type: "POST",
    data: { id: id },
    url: BaseUrl + "tienda/DescargarArchivo",
    success: function (resp) {
      var data = JSON.parse(resp);
      var url = BaseUrl + "public/img/servientrega/" + data;
      window.open(url, "Download");
    },
  });
}

//////////////////////

