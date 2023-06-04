function RegistrarProveedor() {
  var ruc = $("#ruc").val();
  var razon_social = $("#razon_social").val();
  var correo = $("#correo").val();
  var direccion = $("#direccion").val();
  var telefono = $("#telefono").val();
  var encargado = $("#encargado").val();
  var descripcion = $("#descripcion").val();

  if (
    ruc.length == 0 ||
    ruc.trim() == "" ||
    razon_social.length == 0 ||
    razon_social.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    direccion.length == 0 ||
    direccion.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == "" ||
    encargado.length == 0 ||
    encargado.trim() == "" ||
    descripcion.length == 0 ||
    descripcion.trim() == ""
  ) {
    ValidarRegistroProveedor(
      ruc,
      razon_social,
      correo,
      direccion,
      telefono,
      encargado,
      descripcion
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#ruc_olbligg").html("");
    $("#razon_social_olbligg").html("");
    $("#correo_olbligg").html("");
    $("#direccion_olbligg").html("");
    $("#telefono_olbligg").html("");
    $("#encargado_olbligg").html("");
    $("#descripcion_olbligg").html("");
  }

  if (!correo_proveedor) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  var formdata = new FormData();

  formdata.append("ruc", ruc);
  formdata.append("razon_social", razon_social);
  formdata.append("correo", correo);
  formdata.append("direccion", direccion);
  formdata.append("telefono", telefono);
  formdata.append("encargado", encargado);
  formdata.append("descripcion", descripcion);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "compra/RegistrarProveedor",
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
            text: "El proveedor se registro con exito",
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
                BaseUrl + "admin/proveedor/list/0"
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Rúc ya existe",
            "El rúc ingresado " + ruc + " ya existe",
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

function EditarProveedor() {
  var id = $("#proveedorID").val();
  var ruc = $("#ruc").val();
  var razon_social = $("#razon_social").val();
  var correo = $("#correo").val();
  var direccion = $("#direccion").val();
  var telefono = $("#telefono").val();
  var encargado = $("#encargado").val();
  var descripcion = $("#descripcion").val();

  if (
    ruc.length == 0 ||
    ruc.trim() == "" ||
    razon_social.length == 0 ||
    razon_social.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    direccion.length == 0 ||
    direccion.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == "" ||
    encargado.length == 0 ||
    encargado.trim() == "" ||
    descripcion.length == 0 ||
    descripcion.trim() == ""
  ) {
    ValidarRegistroProveedor(
      ruc,
      razon_social,
      correo,
      direccion,
      telefono,
      encargado,
      descripcion
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#ruc_olbligg").html("");
    $("#razon_social_olbligg").html("");
    $("#correo_olbligg").html("");
    $("#direccion_olbligg").html("");
    $("#telefono_olbligg").html("");
    $("#encargado_olbligg").html("");
    $("#descripcion_olbligg").html("");
  }

  if (!correo_proveedor) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  var formdata = new FormData();

  formdata.append("id", id);
  formdata.append("ruc", ruc);
  formdata.append("razon_social", razon_social);
  formdata.append("correo", correo);
  formdata.append("direccion", direccion);
  formdata.append("telefono", telefono);
  formdata.append("encargado", encargado);
  formdata.append("descripcion", descripcion);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "compra/EditarProveedor",
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
            text: "El proveedor se edito con exito",
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
                BaseUrl + "admin/proveedor/list/0"
              );
            }
          });
        } else if (resp == 2) {
          return swal.fire(
            "Rúc ya existe",
            "El rúc ingresado " + ruc + " ya existe",
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

function ValidarRegistroProveedor(
  ruc,
  razon_social,
  correo,
  direccion,
  telefono,
  encargado,
  descripcion
) {
  if (ruc.length == 0 || ruc.trim() == "") {
    $("#ruc_olbligg").html(" - Ingrese el rúc");
  } else {
    $("#ruc_olbligg").html("");
  }

  if (razon_social.length == 0 || razon_social.trim() == "") {
    $("#razon_social_olbligg").html(" - Ingrese la razon social");
  } else {
    $("#razon_social_olbligg").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_olbligg").html(" - Ingrese el correo");
  } else {
    $("#correo_olbligg").html("");
  }

  if (direccion.length == 0 || direccion.trim() == "") {
    $("#direccion_olbligg").html(" - Ingrese la dirección");
  } else {
    $("#direccion_olbligg").html("");
  }

  if (telefono.length == 0 || telefono.trim() == "") {
    $("#telefono_olbligg").html(" - Ingrese el telefono");
  } else {
    $("#telefono_olbligg").html("");
  }

  if (encargado.length == 0 || encargado.trim() == "") {
    $("#encargado_olbligg").html(" - Ingrese el encargado");
  } else {
    $("#encargado_olbligg").html("");
  }

  if (descripcion.length == 0 || descripcion.trim() == "") {
    $("#descripcion_olbligg").html(" - Ingrese la descripción");
  } else {
    $("#descripcion_olbligg").html("");
  }
}

function EstadoProveedor(id, estado) {
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
        url: BaseUrl + "Compra/EstadoProveedor",
        data: { id: id, estado: estado },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/proveedor/list/0"
              );
              return Swal.fire(
                "Estado",
                "EL estado se " + res + " con exito",
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

//////////////COMPRA INSUMOS

function RegistrarCompraInsumos() {
  Swal.fire({
    title: "Guardar compra de insumo?",
    text: "La compra se guardará en el sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, guardar!",
  }).then((result) => {
    if (result.isConfirmed) {
      guardar_compra_insumo();
    }
  });
}

function guardar_compra_insumo() {
  var proveedor = $("#proveedor").val();
  var fecha_c = $("#fechacompra").val();
  var numero_compra = $("#numerocompra").val();
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
    validar_registro_compra_insumo(proveedor, numero_compra, iva);
    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#proveedor_olbligg").html("");
    $("#numerocompra_olbligg").html("");
    $("#iva_olbligg").html("");
  }

  $("#detalle_compra_insumo tbody#tbody_detalle_compra_insumo tr").each(
    function () {
      count++;
    }
  );

  if (count == 0) {
    return swal.fire(
      "Detalle vacío",
      "No hay insumo en el detalle de compra",
      "warning"
    );
  }

  var formdata = new FormData();
  formdata.append("proveedor", proveedor);
  formdata.append("fecha_c", fecha_c);
  formdata.append("numero_compra", numero_compra);
  formdata.append("tipo_comprobante", tipo_comprobante);
  formdata.append("iva", iva);
  formdata.append("subtotal", subtotal);
  formdata.append("impuesto_sub", impuesto_sub);
  formdata.append("total_pagar", total_pagar);

  $.ajax({
    url: BaseUrl + "Compra/GuardarCompraInsumo",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        guardar_detalle_compra_insumo(parseInt(resp));
      } else {
        $(".carro").LoadingOverlay("hide");
        return Swal.fire(
          "Error",
          "No se pudo crear la compra, falla en la matrix" + resp,
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

function guardar_detalle_compra_insumo(id) {
  var count = 0;
  var arrego_alimento = new Array();
  var arreglo_precio = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_descuento = new Array();
  var arreglo_subtotal = new Array();

  $("#detalle_compra_insumo tbody#tbody_detalle_compra_insumo tr").each(
    function () {
      arrego_alimento.push($(this).find("td").eq(0).text());
      arreglo_precio.push($(this).find("td").eq(3).text());
      arreglo_cantidad.push($(this).find("#cantida_a").val());
      arreglo_descuento.push($(this).find("#descuento_a").val());
      arreglo_subtotal.push($(this).find("td").eq(5).text());
      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var ida = arrego_alimento.toString();
  var precio = arreglo_precio.toString();
  var cantidad = arreglo_cantidad.toString();
  var descuento = arreglo_descuento.toString();
  var total = arreglo_subtotal.toString();

  if (count == 0) {
    return false;
  }

  $.ajax({
    url: BaseUrl + "Compra/DetalleCompraInsumo",
    type: "POST",
    data: {
      id: id,
      ida: ida,
      precio: precio,
      cantidad: cantidad,
      descuento: descuento,
      total: total,
    },
  }).done(function (resp) {
    $(".carro").LoadingOverlay("hide");
    if (resp > 0) {
      if (resp == 1) {
        Swal.fire({
          title: "Campra realizada con exito",
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
              BaseUrl + "Reporte/ReporteCompraInsumo/" + id,
              "#zoom=100%",
              "Reporte de compra insumo",
              "scrollbards=No"
            );

            cargar_contenido(
              "contenido_principal",
              BaseUrl + "admin/CompraInsumos/list/0"
            );
          }
        });

        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/CompraInsumos/list/0"
        );
      }
    } else {
      return Swal.fire(
        "Error",
        "No se pudo crear el detalle de compra, falla en la matrix" + resp,
        "error"
      );
    }
  });
}

function validar_registro_compra_insumo(proveedor, numero_compra, iva) {
  if (proveedor == "0") {
    $("#proveedor_olbligg").html("Seleccione el proveedor");
  } else {
    $("#proveedor_olbligg").html("");
  }

  if (numero_compra.length == 0 || numero_compra.trim() == "") {
    $("#numerocompra_olbligg").html("Ingrese número compra");
  } else {
    $("#numerocompra_olbligg").html("");
  }

  if (iva.length == 0 || iva.trim() == "") {
    $("#iva_olbligg").html("Ingrese el iva");
  } else {
    $("#iva_olbligg").html("");
  }
}

function VerFacturaCompraInsumo(id) {
  Swal.fire({
    title: "Imprimir compra de insumo",
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
        BaseUrl + "Reporte/ReporteCompraInsumo/" + id,
        "#zoom=100%",
        "Reporte de compra insumo",
        "scrollbards=No"
      );
    }
  });
}

function AnularFactura(id) {
  Swal.fire({
    title: "Anular la compra del insumo",
    text: "Desea anular la compra??",
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
        url: BaseUrl + "Compra/AnularFactura",
        data: { id: id },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/CompraInsumos/list/0"
              );
              return Swal.fire(
                "Estado",
                "La compra fue anulada con exito",
                "success"
              );
            }
          } else {
            return Swal.fire(
              "Compra anulada",
              "No se pudo anular la compra, error en la matrix" + response,
              "error"
            );
          }
        },
      });
    }
  });
}

////// COMPRA MATERIAL

function RegistrarCompraMaterial() {
  Swal.fire({
    title: "Guardar compra de material?",
    text: "La compra se guardará en el sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, guardar!",
  }).then((result) => {
    if (result.isConfirmed) {
      guardar_compra_material();
    }
  });
}

function guardar_compra_material() {
  var proveedor = $("#proveedor").val();
  var fecha_c = $("#fechacompra").val();
  var numero_compra = $("#numerocompra").val();
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
    validar_registro_compra_material(proveedor, numero_compra, iva);
    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#proveedor_olbligg").html("");
    $("#numerocompra_olbligg").html("");
    $("#iva_olbligg").html("");
  }

  $("#detalle_compra_material tbody#tbody_detalle_compra_material tr").each(
    function () {
      count++;
    }
  );

  if (count == 0) {
    return swal.fire(
      "Detalle vacío",
      "No hay material en el detalle de compra",
      "warning"
    );
  }

  var formdata = new FormData();
  formdata.append("proveedor", proveedor);
  formdata.append("fecha_c", fecha_c);
  formdata.append("numero_compra", numero_compra);
  formdata.append("tipo_comprobante", tipo_comprobante);
  formdata.append("iva", iva);
  formdata.append("subtotal", subtotal);
  formdata.append("impuesto_sub", impuesto_sub);
  formdata.append("total_pagar", total_pagar);

  $.ajax({
    url: BaseUrl + "Compra/GuardarCompraMaterial",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        guardar_detalle_compra_material(parseInt(resp));
      } else {
        $(".carro").LoadingOverlay("hide");
        return Swal.fire(
          "Error",
          "No se pudo crear la compra, falla en la matrix" + resp,
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

function guardar_detalle_compra_material(id) {
  var count = 0;
  var arrego_alimento = new Array();
  var arreglo_precio = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_descuento = new Array();
  var arreglo_subtotal = new Array();

  $("#detalle_compra_material tbody#tbody_detalle_compra_material tr").each(
    function () {
      arrego_alimento.push($(this).find("td").eq(0).text());
      arreglo_precio.push($(this).find("td").eq(3).text());
      arreglo_cantidad.push($(this).find("#cantida_a").val());
      arreglo_descuento.push($(this).find("#descuento_a").val());
      arreglo_subtotal.push($(this).find("td").eq(5).text());
      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var ida = arrego_alimento.toString();
  var precio = arreglo_precio.toString();
  var cantidad = arreglo_cantidad.toString();
  var descuento = arreglo_descuento.toString();
  var total = arreglo_subtotal.toString();

  if (count == 0) {
    return false;
  }

  $.ajax({
    url: BaseUrl + "Compra/DetalleCompraMaterial",
    type: "POST",
    data: {
      id: id,
      ida: ida,
      precio: precio,
      cantidad: cantidad,
      descuento: descuento,
      total: total,
    },
  }).done(function (resp) {
    $(".carro").LoadingOverlay("hide");
    if (resp > 0) {
      if (resp == 1) {
        Swal.fire({
          title: "Campra realizada con exito",
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
              BaseUrl + "Reporte/ReporteCompraMaterial/" + id,
              "#zoom=100%",
              "Reporte de compra material",
              "scrollbards=No"
            );

            cargar_contenido(
              "contenido_principal",
              BaseUrl + "admin/CompraMaterial/list/0"
            );
          }
        });

        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/CompraMaterial/list/0"
        );
      }
    } else {
      return Swal.fire(
        "Error",
        "No se pudo crear el detalle de compra, falla en la matrix" + resp,
        "error"
      );
    }
  });
}

function validar_registro_compra_material(proveedor, numero_compra, iva) {
  if (proveedor == "0") {
    $("#proveedor_olbligg").html("Seleccione el proveedor");
  } else {
    $("#proveedor_olbligg").html("");
  }

  if (numero_compra.length == 0 || numero_compra.trim() == "") {
    $("#numerocompra_olbligg").html("Ingrese número compra");
  } else {
    $("#numerocompra_olbligg").html("");
  }

  if (iva.length == 0 || iva.trim() == "") {
    $("#iva_olbligg").html("Ingrese el iva");
  } else {
    $("#iva_olbligg").html("");
  }
}

function AnularFacturaMaterial(id) {
  Swal.fire({
    title: "Anular la compra del material",
    text: "Desea anular la compra??",
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
        url: BaseUrl + "Compra/AnularFacturaMaterial",
        data: { id: id },
        success: function (response) {
          if (response > 0) {
            if (response == 1) {
              cargar_contenido(
                "contenido_principal",
                BaseUrl + "admin/CompraMaterial/list/0"
              );
              return Swal.fire(
                "Estado",
                "La compra fue anulada con exito",
                "success"
              );
            }
          } else {
            return Swal.fire(
              "Compra anulada",
              "No se pudo anular la compra, error en la matrix" + response,
              "error"
            );
          }
        },
      });
    }
  });
}

function VerFacturaCompraMaterial(id) {
  Swal.fire({
    title: "Imprimir compra de material",
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
        BaseUrl + "Reporte/ReporteCompraMaterial/" + id,
        "#zoom=100%",
        "Reporte de compra material",
        "scrollbards=No"
      );
    }
  });
}