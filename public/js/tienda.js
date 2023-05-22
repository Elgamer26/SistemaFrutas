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
        return alert("Debe iniciar sesión para comentar");
      }
      console.log(response);
    },
  });
}
