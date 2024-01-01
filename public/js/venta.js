// registro de venta de productos
function RegistraVentaproducto() {
  Swal.fire({
    title: "Guardar venta de producto?",
    text: "La venta se guardará en el sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, guardar!",
  }).then((result) => {
    if (result.isConfirmed) {
      guardarventaproducto();
    }
  });
}

function guardarventaproducto() {
  var proveedor = $("#cliente").val();
  var fecha_c = $("#fechacompra").val();
  var numero_compra = $("#numeroventa").val();
  var tipo_comprobante = $("#tipo_comprobante").val();
  var iva = $("#iva").val();

  var subtotal = $("#subtotal").val();
  var impuesto_sub = $("#impuesto_sub").val();
  var total_pagar = $("#total_pagar").val();
  var count = 0;

  if (
    proveedor == "0" ||
    numero_compra.length == 0 ||
    numero_compra.trim() == "" ||
    iva.length == 0 ||
    iva.trim() == ""
  ) {
    validarventaproducto(proveedor, numero_compra, iva);
    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#cliente_olbligg").html("");
    $("#numeroventa_olbligg").html("");
    $("#iva_olbligg").html("");
  }

  $("#detalle_venta_producto tbody#tbody_detalle_venta_producto tr").each(
    function () {
      count++;
    }
  );

  if (count == 0) {
    return swal.fire(
      "Detalle vacío",
      "No hay producto en el detalle de venta",
      "warning"
    );
  }

  var validarcantidad = false
  $("#detalle_venta_producto tbody#tbody_detalle_venta_producto tr").each(
    function () {
      if (parseInt($(this).find("td").eq(3).text()) > parseInt($(this).find("td").eq(11).text()))
      {
        validarcantidad = true
      }
    }
  );
  
  if (validarcantidad == true){
    return swal.fire(
      "Cantidad no disponible",
      "Se ha detectado una cantidad ingresado que supera lo disponible del lote",
      "warning"
    );
  }

  var formdata = new FormData();
  formdata.append("cliente", proveedor);
  formdata.append("fecha_c", fecha_c);
  formdata.append("numero_compra", numero_compra);
  formdata.append("tipo_comprobante", tipo_comprobante);
  formdata.append("iva", iva);
  formdata.append("subtotal", subtotal);
  formdata.append("impuesto_sub", impuesto_sub);
  formdata.append("total_pagar", total_pagar);

  $.ajax({
    url: BaseUrl + "Venta/RegistrarVentaCarrito",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        guardardetalleventa(parseInt(resp));
      } else {
        $(".carro").LoadingOverlay("hide");
        return Swal.fire(
          "Error",
          "No se pudo crear la venta, falla en la matrix" + resp,
          "error"
        );
      }
    },

    beforeSend: function () {
      $(".carro").LoadingOverlay("show", {
        text: "Cargando...",
      });
    },
  });
  return false;
}

function guardardetalleventa(id) {
  var count = 0;
  var arrego_producto = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_sale = new Array();
  var arreglo_precio = new Array();
  var arreglo_desc_dolar = new Array();
  var arreglo_oferta = new Array();
  var arreglo_desc_oferta = new Array();
  var arreglo_subtotal = new Array();
  var arreglo_cod_lote = new Array();

  $("#detalle_venta_producto tbody#tbody_detalle_venta_producto tr").each(
    function () {
      arrego_producto.push($(this).find("td").eq(0).text());
      arreglo_cantidad.push($(this).find("#cantida_a").val());
      arreglo_sale.push($(this).find("td").eq(3).text());
      arreglo_precio.push($(this).find("#precio_a").val());
      arreglo_desc_dolar.push($(this).find("#descuento_a").val());
      arreglo_oferta.push($(this).find("td").eq(6).text());
      arreglo_desc_oferta.push($(this).find("td").eq(7).text());
      arreglo_subtotal.push($(this).find("td").eq(8).text());
      arreglo_cod_lote.push($(this).find("td").eq(10).text());
      count++;
    }
  );

  if (count == 0) {
    return false;
  }

  //aqui combierto el arreglo a un string
  var idp = arrego_producto.toString();
  var cantidad = arreglo_cantidad.toString();
  var sale = arreglo_sale.toString();
  var precio = arreglo_precio.toString();
  var desc_dolar = arreglo_desc_dolar.toString();
  var oferta = arreglo_oferta.toString();
  var desc_oferta = arreglo_desc_oferta.toString();
  var subtotals = arreglo_subtotal.toString();
  var cod_lote = arreglo_cod_lote.toString();
  $.ajax({
    url: BaseUrl + "Venta/DetalleCompraMaterial",
    type: "POST",
    data: {
      id: id,
      idp: idp,
      cantidad: cantidad,
      sale: sale,
      precio: precio,
      desc_dolar: desc_dolar,
      oferta: oferta,
      desc_oferta: desc_oferta,
      subtotals: subtotals,
      cod_lote: cod_lote
    },
  }).done(function (resp) {
    $(".carro").LoadingOverlay("hide");
    if (resp > 0) {
      if (resp == 1) {
        EnviarCorreVenta(parseInt(id));
        Swal.fire({
          title: "Compra realizada con exito",
          text: "Desea imprimir la compra??",
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
              BaseUrl + "Reporte/ReporteVenta/" + id,
              "#zoom=100%",
              "Reporte de venta producto",
              "scrollbards=No"
            );

            cargar_contenido(
              "contenido_principal",
              BaseUrl + "admin/ventas/list/0"
            );
          }
        });

        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/ventas/list/0"
        );
      }
    } else {
      return Swal.fire(
        "Error",
        "No se pudo crear el detalle de venta, falla en la matrix" + resp,
        "error"
      );
    }
  });
}

async function EnviarCorreVenta(id) {
  let result = await $.ajax({
    url: BaseUrl + "Reporte/EnviarCorreVenta",
    type: "POST",
    data: {
      id: id,
    },
  });
  console.log(result);
}

function validarventaproducto(proveedor, numero_compra, iva) {
  if (proveedor == "0") {
    $("#cliente_olbligg").html("Seleccione el cliente");
  } else {
    $("#cliente_olbligg").html("");
  }

  if (numero_compra.length == 0 || numero_compra.trim() == "") {
    $("#numeroventa_olbligg").html("Ingrese número venta");
  } else {
    $("#numeroventa_olbligg").html("");
  }

  if (iva.length == 0 || iva.trim() == "") {
    $("#iva_olbligg").html("Ingrese el iva");
  } else {
    $("#iva_olbligg").html("");
  }
}

function VerFacturaVenta(id) {
  Swal.fire({
    title: "Imprimir venta",
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
        BaseUrl + "Reporte/ReporteVenta/" + id,
        "#zoom=100%",
        "Reporte de venta",
        "scrollbards=No"
      );
    }
  });
}

function AnularVnetaProducto(id) {
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
                BaseUrl + "admin/ventas/list/0"
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

//////////////
function RealizarEntrega(id) {
  Swal.fire({
    title: "Entrega de producto",
    text: "Finalizar entrega de producto??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, finalizar!!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "Venta/RealizarEntrega",
        data: { id: id },
        success: function (response) {

          // console.log(response);

          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/Estado/pedidos/0"
              );
              return Swal.fire(
                "Pedido entregado",
                "El pedido fue entregado con exito",
                "success"
              );
            }
          } else {
            return Swal.fire(
              "Pedido error",
              "No se pudo realizar el pedido, error en la matrix" + response,
              "error"
            );
          }
        },
      });
    }
  });
}
