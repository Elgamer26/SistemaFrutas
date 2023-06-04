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
        return alert("Comentario enviado con exito");
      }
      // console.log(response);
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
        return alert("Comentario enviado con exito");
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
        "No hay stock suficiente para la cantidad ingresada, " +
          response +
          "  :(",
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
        "No hay stock suficiente para la cantidad ingresada, " +
          response +
          "  :(",
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
