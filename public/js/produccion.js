$("#insumo").change(function () {$("#materialDisponible").val("");
  let data = $(this).val();
  if (data > 0) {
    $.ajax({
      type: "POST",
      url: BaseUrl + "Produccion/TraerCantidadInsumo",
      data: { id: data },
      success: function (response) {
        let dato = JSON.parse(response);
        $("#insumodisponible").val(dato[0]);
      },
    });
  } else {
    $("#insumodisponible").val("");
  }
  $("#cantidadInsumo").val("");
});

$("#material").change(function () {
  let data = $(this).val();
  if (data > 0) {
    $.ajax({
      type: "POST",
      url: BaseUrl + "Produccion/TraerCantidadMaterial",
      data: { id: data },
      success: function (response) {
        let dato = JSON.parse(response);
        $("#materialDisponible").val(dato[0]);
      },
    });
  } else {
    $("#materialDisponible").val("");
  }
  $("#cantidadMaterial").val("");
});

$(".traerCantidadProduction").change(function () {
  let data = $(this).val();
  if (data > 0) {
    $.ajax({
      type: "POST",
      url: BaseUrl + "Produccion/traerCantidadProduction",
      data: { id: data },
      success: function (response) {
        let dato = JSON.parse(response);
        $("#disponibleprod").val(dato[0]);
      },
    });
  } else {
    $("#disponibleprod").val("");
  }
});

/////DETALLE INSUMO

function AggInsumoDetalle() {
  let id = $("#insumo").val();
  let insumo = $("#insumo option:selected").text();
  let disponible = $("#insumodisponible").val();
  let cantidad = $("#cantidadInsumo").val();

  if (id == 0 || id == null || id.length == 0) {
    $("#insumo_olbligg").html(" - Seleccione el insumo");
    return swal.fire("", "Seleccione el insumo", "warning");
  } else {
    $("#insumo_olbligg").html("");
  }

  if (disponible == 0 || disponible == null || disponible.length == 0) {
    $("#insumodisponible_olbligg").html(" - Cantidad cero");
    return swal.fire(
      "",
      "No se puede agregar un insumo con cantidad en cero",
      "warning"
    );
  } else {
    $("#insumodisponible_olbligg").html("");
  }

  if (cantidad == 0 || cantidad == null || cantidad.length == 0) {
    $("#cantidadInsumo_olbligg").html(" - Cantidad cero");
    return swal.fire(
      "",
      "No se puede agregar un insumo con cantidad en cero",
      "warning"
    );
  } else {
    $("#cantidadInsumo_olbligg").html("");
  }

  if (parseInt(cantidad) > parseInt(disponible)) {
    $("#cantidadInsumo_olbligg").html("- XXX");
    $("#insumodisponible_olbligg").html("- XXX");
    return swal.fire(
      "",
      "La cantidad " + cantidad + " supera el insumo disponible " + disponible,
      "warning"
    );
  } else {
    $("#insumodisponible_olbligg").html("");
    $("#cantidadInsumo_olbligg").html("");
  }

  if (ValidarDetalleInsumo(id)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El insumo: '" + insumo + "' , ya fue agregado al detalle",
      "warning"
    );
  }

  var datos_agg = "<tr>";
  datos_agg += "<td hidden for='id'>" + id + "</td>";
  datos_agg += "<td>" + insumo + "</td>";
  datos_agg += "<td>" + cantidad + "</td>";
  datos_agg +=
    "<td> <button class='RemoverInsumo btn btn-danger'><i class='fa fa-trash'></i></button></td>";
  datos_agg += "</tr>";

  //esto me ayuda a enviar los datos a la tabla
  $("#tbody_detalleInsumo").append(datos_agg);
  $("#cantidadInsumo").val("");
}

function ValidarDetalleInsumo(id) {
  let idverificar = document.querySelectorAll(
    "#tbody_detalleInsumo td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

$("#tbody_detalleInsumo").on("click", ".RemoverInsumo", function () {
  var td = this.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
});

//// DETALLE MATERIAL

function AggMaterialDetalle() {
  let id = $("#material").val();
  let material = $("#material option:selected").text();
  let disponible = $("#materialDisponible").val();
  let cantidad = $("#cantidadMaterial").val();

  if (id == 0 || id == null || id.length == 0) {
    $("#material_olbligg").html(" - Seleccione el material");
    return swal.fire("", "Seleccione el material", "warning");
  } else {
    $("#material_olbligg").html("");
  }

  if (disponible == 0 || disponible == null || disponible.length == 0) {
    $("#materialDisponible_olbligg").html(" - Cantidad cero");
    return swal.fire(
      "",
      "No se puede agregar un material con cantidad en cero",
      "warning"
    );
  } else {
    $("#materialDisponible_olbligg").html("");
  }

  if (cantidad == 0 || cantidad == null || cantidad.length == 0) {
    $("#cantidadMaterial_olbligg").html(" - Cantidad cero");
    return swal.fire(
      "",
      "No se puede agregar un material con cantidad en cero",
      "warning"
    );
  } else {
    $("#cantidadMaterial_olbligg").html("");
  }

  if (parseInt(cantidad) > parseInt(disponible)) {
    $("#materialDisponible_olbligg").html("- XXX");
    $("#cantidadMaterial_olbligg").html("- XXX");
    return swal.fire(
      "",
      "La cantidad " +
        cantidad +
        " supera el material disponible " +
        disponible,
      "warning"
    );
  } else {
    $("#cantidadMaterial_olbligg").html("");
    $("#materialDisponible_olbligg").html("");
  }

  if (ValidarDetalleMaterial(id)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El material: '" + material + "' , ya fue agregado al detalle",
      "warning"
    );
  }

  var datos_agg = "<tr>";
  datos_agg += "<td hidden for='id'>" + id + "</td>";
  datos_agg += "<td>" + material + "</td>";
  datos_agg += "<td>" + cantidad + "</td>";
  datos_agg +=
    "<td> <button class='RemoverMaterial btn btn-danger'><i class='fa fa-trash'></i></button></td>";
  datos_agg += "</tr>";

  //esto me ayuda a enviar los datos a la tabla
  $("#tbody_detalleMaterial").append(datos_agg);
  $("#cantidadMaterial").val("");
}

function ValidarDetalleMaterial(id) {
  let idverificar = document.querySelectorAll(
    "#tbody_detalleMaterial td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

$("#tbody_detalleMaterial").on("click", ".RemoverMaterial", function () {
  var td = this.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
});

//////// REGISTRO DE PRODUCCION

function RegistrarProduccionPlantas() {
  let nombreproduccion = $("#nombreproduccion").val();
  let fechainicio = $("#fechainicio").val();
  let fechaFin = $("#fechaFin").val();
  let diasproduccion = $("#diasproduccion").val();
  let producto = $("#producto").val();
  let cantidadprod = $("#cantidadprod").val();

  let CountInsumo = 0;
  let CountMaterial = 0;

  if (
    nombreproduccion.length == 0 ||
    nombreproduccion.trim() == "" ||
    diasproduccion == "0" ||
    diasproduccion.trim() == "" ||
    producto == "0" ||
    producto.trim() == "" ||
    cantidadprod == "0" ||
    cantidadprod.trim() == ""
  ) {
    ValidarRegistroProduccion(
      nombreproduccion,
      diasproduccion,
      producto,
      cantidadprod
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombree_olbligg").html("");
    $("#dias_olbligg").html("");
    $("#producto_olbligg").html("");
    $("#cantidadprod_olbligg").html("");
  }

  $("#detalleInsumo tbody#tbody_detalleInsumo tr").each(function () {
    CountInsumo++;
  });

  if (CountInsumo == 0) {
    return swal.fire(
      "Detalle vacío",
      "No hay insumo en el detalle de producción",
      "warning"
    );
  }

  $("#detalleMaterial tbody#tbody_detalleMaterial tr").each(function () {
    CountMaterial++;
  });

  if (CountMaterial == 0) {
    return swal.fire(
      "Detalle vacío",
      "No hay material en el detalle de producción",
      "warning"
    );
  }

  var formdata = new FormData();
  formdata.append("nombreproduccion", nombreproduccion);
  formdata.append("fechainicio", fechainicio);
  formdata.append("fechaFin", fechaFin);
  formdata.append("diasproduccion", diasproduccion);
  formdata.append("producto", producto);

  formdata.append("cantidadprod", cantidadprod);

  $(".Formulario").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "Produccion/RegistrarProduccionPlantas",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        RegistrarDetalleInsumoProduccion(parseInt(resp));
      } else {
        $(".Formulario").LoadingOverlay("hide");
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

function RegistrarDetalleInsumoProduccion(id) {
  var count = 0;
  var arrego_insumo = new Array();
  var arreglo_cantidad = new Array();

  $("#detalleInsumo tbody#tbody_detalleInsumo tr").each(function () {
    arrego_insumo.push($(this).find("td").eq(0).text());
    arreglo_cantidad.push($(this).find("td").eq(2).text());
    count++;
  });

  //aqui combierto el arreglo a un string
  var idinsumo = arrego_insumo.toString();
  var cantidad = arreglo_cantidad.toString();

  if (count == 0) {
    return false;
  }

  $.ajax({
    url: BaseUrl + "Produccion/RegistrarDetalleInsumoProduccion",
    type: "POST",
    data: {
      id: id,
      idinsumo: idinsumo,
      cantidad: cantidad,
    },
  }).done(function (resp) {
    if (resp == 1) {
      RegistrarDetalleMaterialProduccion(parseInt(id));
    } else {
      $(".Formulario").LoadingOverlay("hide");
      return Swal.fire(
        "Error",
        "No se pudo crear el detalle de insumo, falla en la matrix" + resp,
        "error"
      );
    }
  });
}

function RegistrarDetalleMaterialProduccion(id) {
  var count = 0;
  var arrego_material = new Array();
  var arreglo_cantidad = new Array();

  $("#detalleMaterial tbody#tbody_detalleMaterial tr").each(function () {
    arrego_material.push($(this).find("td").eq(0).text());
    arreglo_cantidad.push($(this).find("td").eq(2).text());
    count++;
  });

  //aqui combierto el arreglo a un string
  var idmaterial = arrego_material.toString();
  var cantidad = arreglo_cantidad.toString();

  if (count == 0) {
    return false;
  }

  $.ajax({
    url: BaseUrl + "Produccion/RegistrarDetalleMaterialProduccion",
    type: "POST",
    data: {
      id: id,
      idmaterial: idmaterial,
      cantidad: cantidad,
    },
  }).done(function (resp) {
    $(".Formulario").LoadingOverlay("hide");
    if (resp == 1) {
      Swal.fire({
        title: "La producción se registro con exito",
        text: "Registro con exito",
        icon: "success",
        showCancelButton: false, 
        allowOutsideClick: false,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "OK",
      }).then((result) => {
        if (result.isConfirmed) {
          cargar_contenido(
            "contenido_principal",
            BaseUrl + "admin/produccion/list/0"
          );
        }
        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/produccion/list/0"
        );
      });
    } else {
      return Swal.fire(
        "Error",
        "No se pudo crear el detalle de material, falla en la matrix" + resp,
        "error"
      );
    }
  });
}

function ValidarRegistroProduccion(
  nombreproduccion,
  diasproduccion,
  producto,
  cantidadprod
) {
  if (nombreproduccion.length == 0 || nombreproduccion.trim() == "") {
    $("#nombree_olbligg").html(" - Ingrese el nombre de la producción");
  } else {
    $("#nombree_olbligg").html("");
  }

  if (diasproduccion == "0" || diasproduccion.trim() == "") {
    $("#dias_olbligg").html(" - Ingrese los dias");
  } else {
    $("#dias_olbligg").html("");
  }

  if (producto == "0" || producto.trim() == "") {
    $("#producto_olbligg").html(" - Seleccione el producto");
  } else {
    $("#producto_olbligg").html("");
  }

  if (cantidadprod == "0" || cantidadprod.trim() == "") {
    $("#cantidadprod_olbligg").html(" - Ingrese la cantidad");
  } else {
    $("#cantidadprod_olbligg").html("");
  }
}

/// PAGINADOR DE PRODUCCION

$(document).on("keyup", "#buscarproduccion", function () {
  let valor = $(this).val();
  if (valor != "") {
    pagination(1, valor);
  } else {
    pagination(1);
  }
});

function pagination(partida, valor) {
  $.ajax({
    url: BaseUrl + "Produccion/PaginadorProduccion",
    type: "POST",
    data: {
      partida: partida,
      valor: valor,
    },
  }).done(function (response) {
    var array = eval(response);
    if (array[0]) {
      $("#unir_listado_ofertas").html(array[0]);
      $("#unir_paguinador").html(array[1]);
    } else {
      $("#unir_listado_ofertas")
        .html(`<div class="col-12" style="text-align: center; justify-content: center; align-items: center"><br>
            <label style="font-size: 20px;"></i>.:No se encontro producto:.<label>
         </div>`);
      $("#unir_paguinador").html("");
    }
  });
}

///REGISTRO DE PERDIDA

function RegistroPerdidaProduccion() {
  let produccion = $("#produccion").val();
  let cantidadperdida = $("#cantidadperdida").val();
  let detalleperdida = $("#detalleperdida").val();
  let fechaperdida = $("#fechaperdida").val();

  let disponibleprod = $("#disponibleprod").val();

  if (
    produccion == "0" ||
    produccion.trim() == "" ||
    cantidadperdida.length == 0 ||
    cantidadperdida.trim() == "" ||
    cantidadperdida == "0" ||
    detalleperdida.length == 0 ||
    detalleperdida.trim() == ""
  ) {
    ValidarRegistroPerdida(produccion, cantidadperdida, detalleperdida);

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#produccion_olbligg").html("");
    $("#cantidadperdida_olbligg").html("");
    $("#detalleperdida_olbligg").html("");
  }

  if (parseInt(disponibleprod) == 0) {
    $("#disponibleprod_olbligg").html("No hay producción");
    return swal.fire(
      "Producción en cero",
      "No hay cantidad en producción",
      "warning"
    );
  } else {
    $("#disponibleprod_olbligg").html("");
  }

  if (parseInt(cantidadperdida) > parseInt(disponibleprod)) {
    $("#cantidadperdida_olbligg").html("Cantidad mayor");
    $("#disponibleprod_olbligg").html("Cantidad menor");
    return swal.fire(
      "Cantidad de perdida mayor",
      "La cantidad de perdida es mayor a la cantidad de producción",
      "warning"
    );
  } else {
    $("#cantidadperdida_olbligg").html("");
    $("#disponibleprod_olbligg").html("");
  }

  var formdata = new FormData();
  formdata.append("produccion", produccion);
  formdata.append("cantidadperdida", cantidadperdida);
  formdata.append("detalleperdida", detalleperdida);
  formdata.append("fechaperdida", fechaperdida);

  $(".card").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "Produccion/RegistroPerdidaProduccion",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".card").LoadingOverlay("hide");
      if (resp == 1) {
        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/produccion/perdida/0"
        );

        return swal.fire(
          "Perdida registrada",
          "Se registro la perdida con exito",
          "success"
        );
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

function ValidarRegistroPerdida(produccion, cantidadperdida, detalleperdida) {
  if (produccion == "0" || produccion.trim() == "") {
    $("#produccion_olbligg").html(" - Seleccione la producción");
  } else {
    $("#produccion_olbligg").html("");
  }

  if (
    cantidadperdida.length == 0 ||
    cantidadperdida == "0" ||
    cantidadperdida.trim() == ""
  ) {
    $("#cantidadperdida_olbligg").html(" - Ingrese la cantidad");
  } else {
    $("#cantidadperdida_olbligg").html("");
  }

  if (detalleperdida.length == 0 || detalleperdida.trim() == "") {
    $("#detalleperdida_olbligg").html(" - Ingrese el detalle de perdida");
  } else {
    $("#detalleperdida_olbligg").html("");
  }
}

//////////ELIMINAR PERDIDA

function EliminarLaPerdida(id, cantidad, idprod) {
  Swal.fire({
    title: "Eliminar la perdida",
    text: "Desea eliminar la perdida??",
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
        url: BaseUrl + "Produccion/EliminarLaPerdida",
        data: {
          id: id,
          cantidad: cantidad,
          idprod: idprod,
        },
        success: function (response) {
          if (response == 1) {
            cargar_contenido(
              "contenido_principal",
              BaseUrl + "admin/produccion/perdida/0"
            );
            return swal.fire(
              "Perdida eliminada",
              "La perdida se eliminó con exito",
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

///////// VER FASE DE PRODUCCION EN LOTES

function VerFaseProduccion(id) {
  $.ajax({
    type: "POST",
    url: BaseUrl + "Produccion/TraerDetalleFaseProduccion",
    data: { id: id },
    success: function (resp) {
      let dato = JSON.parse(resp);
      let html = "";
      dato.forEach((row) => {
        html += `<tr>
                    <td>${row[5]}</td>
                    <td>${row[2]}</td>
                    <td>${row[3]}</td>
                    <td>${row[4]}</td>
                  </tr>`;
      });
      $("#tbody_TableFase").html(html);
    },
  });

  $("#ModalFaseProduccion").modal("show");
}

///////// VER PERDIDA DE PRODUCCION EN LOTES

function VerPerdidaProduccion(id) {
  $.ajax({
    type: "POST",
    url: BaseUrl + "Produccion/VerPerdidaProduccion",
    data: { id: id },
    success: function (resp) {
      let dato = JSON.parse(resp);
      let html = "";
      let count = 0;
      dato.forEach((row) => {
        count = count + parseInt(row[1]);
        html += `<tr>
                    <td>${row[4]}</td>
                    <td>${row[3]}</td>
                    <td>${row[2]}</td>
                    <td>${row[1]}</td>
                  </tr>`;
      });

      html += `<tr>
                <td></td>
                <td></td>
                <td><b>Cantidad de perdida:</b></td>
                <td>${count}</td>
              </tr>`;

      $("#tbody_TablaPerdida").html(html);
    },
  });

  $("#ModalPerdidaProduccion").modal("show");
}

/// REGISTRA FASE EN PRODUCCION
$("#produccion").change(function () {
  let id = $(this).val();
  TraerNumeroFase(id);
  TraerDetalleFaseProduccion(id);
});

function RegistrarFaseProduccion() {
  let produccion = $("#produccion").val();
  let fecharegistro = $("#fecharegistro").val();
  let diasproduccion = $("#diasproduccion").val();
  let detallefase = $("#detallefase").val();

  if (
    produccion == "0" ||
    produccion.trim() == "" ||
    diasproduccion == "0" ||
    diasproduccion.trim() == "" ||
    detallefase.length == 0 ||
    detallefase.trim() == ""
  ) {
    ValidarRegistroFaseProduccion(produccion, diasproduccion, detallefase);

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#produccion_olbligg").html("");
    $("#dias_olbligg").html("");
    $("#detallefase_olbligg").html("");
  }

  var formdata = new FormData();
  formdata.append("produccion", produccion);
  formdata.append("fecharegistro", fecharegistro);
  formdata.append("diasproduccion", diasproduccion);
  formdata.append("detallefase", detallefase);

  $(".Formulario").LoadingOverlay("show", {
    text: "Cargando...",
  });

  $.ajax({
    url: BaseUrl + "Produccion/RegistrarFaseProduccion",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      $(".Formulario").LoadingOverlay("hide");
      if (resp == 1) {
        $("#detallefase").val("");
        TraerNumeroFase(parseInt($("#produccion").val()));
        TraerDetalleFaseProduccion(parseInt($("#produccion").val()));
        return swal.fire(
          "Fase de producción",
          "Se registro la fase de producción con exito",
          "success"
        );
      } else {
        return swal.fire("Error", "Error en la Matrix" + resp, "error");
      }
    },
  });
  return false;
}

function ValidarRegistroFaseProduccion(
  produccion,
  diasproduccion,
  detallefase
) {
  if (produccion == "0" || produccion.trim() == "") {
    $("#produccion_olbligg").html(" - Seleccione la producción");
  } else {
    $("#produccion_olbligg").html("");
  }

  if (diasproduccion == "0" || diasproduccion.trim() == "") {
    $("#dias_olbligg").html(" - No hay fase");
  } else {
    $("#dias_olbligg").html("");
  }

  if (detallefase.length == 0 || detallefase.trim() == "") {
    $("#detallefase_olbligg").html(" - Ingrese el detalle de fase");
  } else {
    $("#detallefase_olbligg").html("");
  }
}

function TraerNumeroFase(id) {
  if (id != 0) {
    $("#diasproduccion").LoadingOverlay("show");
    $.ajax({
      type: "POST",
      url: BaseUrl + "Produccion/TraerNumeroFaseProduccion",
      data: { id: id },
      success: function (resp) {
        let dato = JSON.parse(resp);
        $("#diasproduccion").LoadingOverlay("hide");
        if (dato[0] == 0) {
          $("#diasproduccion").val("1");
        } else {
          $("#diasproduccion").val(dato[0] + parseInt(1));

          if (parseInt(dato[0] + parseInt(1)) == 11) {
            cargar_contenido(
              "contenido_principal",
              BaseUrl + "admin/produccion/registerFase/0"
            );
          }
        }
      },
    });
  } else {
    $("#diasproduccion").val("");
  }
}

function TraerDetalleFaseProduccion(id) {
  if (id != 0) {
    $.ajax({
      type: "POST",
      url: BaseUrl + "Produccion/TraerDetalleFaseProduccion",
      data: { id: id },
      success: function (resp) {
        let dato = JSON.parse(resp);
        var n = dato.length;
        let html = "";
        var boton = "";

        dato.forEach((row) => {
          if (parseInt(n) == parseInt(row[5])) {
            boton = `<button class="btn btn-danger" onclick="EliminarFaseProduccion('${row[5]}', '${row[1]}');"><i class="fa fa-trash"></i></button>`;
          } else {
            boton = `<button class='btn btn-default'> <i class='fa fa-check'></i></button>`;
          }
          html += `<tr>
                    <td>${row[5]}</td>
                    <td>${row[2]}</td>
                    <td>${row[3]}</td>
                    <td>${row[4]}</td>
                    <td>${boton}</td>
                  </tr>`;
        });
        $("#tbody_detalleInsumo").html(html);
      },
    });
  } else {
    $("#tbody_detalleInsumo").empty();
  }
}

function EliminarFaseProduccion(id_fase, id_produccion) {
  Swal.fire({
    title: "Eliminar la fase",
    text: "Desea eliminar la fase de producción??",
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
        url: BaseUrl + "Produccion/EliminarFaseProduccion",
        data: {
          id_fase: id_fase,
          id_produccion: id_produccion,
        },
        success: function (resp) {
          if (resp == 1) {
            TraerNumeroFase(id_produccion);
            TraerDetalleFaseProduccion(id_produccion);
            return swal.fire(
              "Fase eliminada",
              "La fase se elimino con exito",
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

/////// PRODUCCION FINALIZADA LISTADO

$(document).on("keyup", "#buscarproduccionFIN", function () {
  let valor = $(this).val();
  if (valor != "") {
    paginationFinalizado(1, valor);
  } else {
    paginationFinalizado(1);
  }
});

function paginationFinalizado(partida, valor) {
  $.ajax({
    url: BaseUrl + "Produccion/paginationFinalizado",
    type: "POST",
    data: {
      partida: partida,
      valor: valor,
    },
  }).done(function (response) {
    var array = eval(response);
    if (array[0]) {
      $("#unir_listado_ofertas").html(array[0]);
      $("#unir_paguinador").html(array[1]);
    } else {
      $("#unir_listado_ofertas")
        .html(`<div class="col-12" style="text-align: center; justify-content: center; align-items: center"><br>
            <label style="font-size: 20px;"></i>.:No se encontro producto:.<label>
         </div>`);
      $("#unir_paguinador").html("");
    }
  });
}

/// EDITAR TIPOS DE FASE
function EditarFaseTipo() {
  let id = $("#idfase").val();
  let nombre = $("#nombrefalse").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    return swal.fire("Campo vacio", "El campo no debe quedar vacio", "warning");
  }

  $.ajax({
    type: "POST",
    url: BaseUrl + "Produccion/EditarFaseTipo",
    data: { id: id, nombre: nombre },
    success: function (response) {
      if (response == 1) {
        $("#ModalEditFase").modal("hide");

        cargar_contenido(
          "contenido_principal",
          BaseUrl + "admin/produccion/fases/0"
        );

        return swal.fire(
          "Fase eliminada",
          "La fase se elimino con exito",
          "success"
        );
      } else {
        return swal.fire("Error", "Error en la Matrix" + response, "error");
      }
    },
  });
}

///////ELIMINAR LA PRODUCCION
function EliminarProduccion(id, productoid, cantidad) {

  // console.log(id);
  // console.log(productoid);
  // console.log(cantidad);
  // return false;

  Swal.fire({
    title: "Eliminar la producción",
    text: "Desea eliminar la producción??",
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
        url: BaseUrl + "Produccion/EliminarProduccion",
        data: {
          id: id,
          productoid: productoid,
          cantidad: cantidad
        },
        success: function (response) {

          // console.log(response);
          
          if (response == 1) {
            pagination(1);
            return swal.fire(
              "Producción eliminada",
              "La producción se eliminó con exito",
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

////// VER PDF DE PRODUCCION INICIADA

function VerReporteproduccionActiva(id) {
  Swal.fire({
    title: "Imprimir reporte de producción",
    text: "Desea imprimir el reporte??",
    icon: "warning",
    html: `<form hidden>
            <div>
              <input
                type="checkbox"
                id="fasecheck" />
              <label for="fasecheck">Fase de producción</label>
            </div>
            
            <div>
              <input
                type="checkbox"
                id="perdidacheck" />
              <label for="perdidacheck">Perdida de producción</label>
            </div>

          </form>`,
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Imprimir!!",
  }).then((result) => {
    if (result.value) {
      let fase = document.getElementById("fasecheck").checked;
      let perdida = document.getElementById("perdidacheck").checked;

      window.open(
        BaseUrl +
          "Reporte/ReporteProduccionActivas/" +
          id +
          "/" +
          fase +
          "/" +
          perdida,
        "#zoom=100%",
        "Reporte de producción activa",
        "scrollbards=No"
      );
    }
  });
}

/// VER PDF DE PRODUCCION FINALIZADA

function VerReporteproduccionFinalizada(id) {
  Swal.fire({
    title: "Imprimir reporte de producción finalizada",
    text: "Desea imprimir el reporte??",
    icon: "warning",
    html: `<form>
            <div>
              <input
                type="checkbox"
                id="fasecheck" />
              <label for="fasecheck">Fase de producción</label>
            </div>
            
            <div>
              <input
                type="checkbox"
                id="perdidacheck" />
              <label for="perdidacheck">Perdida de producción</label>
            </div>

          </form>`,
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Imprimir!!",
  }).then((result) => {
    if (result.value) {
      let fase = document.getElementById("fasecheck").checked;
      let perdida = document.getElementById("perdidacheck").checked;

      window.open(
        BaseUrl +
          "Reporte/ReporteProduccionFinaloizado/" +
          id +
          "/" +
          fase +
          "/" +
          perdida,
        "#zoom=100%",
        "Reporte de producción finalizado",
        "scrollbards=No"
      );
    }
  });
}
