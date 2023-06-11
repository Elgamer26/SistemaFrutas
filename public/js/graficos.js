////////////////////////////////////////////////////
function TraerGraficoProductosMasVendidos() {
  var tipo_grafico = "pie";
  var nombre_grafico = "Pastel";
  $.ajax({
    url: BaseUrl + "Graficos/TraerGraficoProductosMasVendidos",
    type: "GET",
  }).done(function (response) {
    if (response != 0) {
      var nombre_pr = [];
      var cantidad = [];
      var colores = [];
      var data = JSON.parse(response);
      for (var i = 0; i < data.length; i++) {
        nombre_pr.push(data[i][0]);
        cantidad.push(data[i][2]);
        colores.push(colores_rgb());
      }
      MostrarProdcutosMasVnedidos(
        nombre_pr,
        cantidad,
        tipo_grafico,
        nombre_grafico,
        colores
      );
    } else {
      $("canvas#char_producto").remove();
    }
  });
}

function MostrarProdcutosMasVnedidos(
  nombre_pr,
  cantidad,
  tipo_grafico,
  nombre_grafico,
  colores
) {
  //esto es para desctuir el grafico porque sale un error
  $("canvas#char_producto").remove();
  $("div.chart_p").append(
    '<canvas id="char_producto" width="20" height="20""></canvas>'
  );
  ///este es el grafico

  var ctx = document.getElementById("char_producto").getContext("2d");
  var myChart = new Chart(ctx, {
    type: tipo_grafico,
    data: {
      labels: nombre_pr,
      datasets: [
        {
          label: nombre_grafico,
          data: cantidad,
          backgroundColor: colores,
          borderColor: colores,
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}

////////////////////////////////
function TraerGraficoProductosMasVendidosOferta() {
  var tipo_grafico = "doughnut";
  var nombre_grafico = "Dona";
  $.ajax({
    url: BaseUrl + "Graficos/TraerGraficoProductosMasVendidosOferta",
    type: "GET",
  }).done(function (response) {
    if (response != 0) {
      var nombre_pr = [];
      var cantidad = [];
      var colores = [];
      var data = JSON.parse(response);
      for (var i = 0; i < data.length; i++) {
        nombre_pr.push(data[i][0]);
        cantidad.push(data[i][2]);
        colores.push(colores_rgb());
      }
      MostrarProdcutosMasVnedidosOferta(
        nombre_pr,
        cantidad,
        tipo_grafico,
        nombre_grafico,
        colores
      );
    } else {
      $("canvas#char_oferta").remove();
    }
  });
}

function MostrarProdcutosMasVnedidosOferta(
  nombre_pr,
  cantidad,
  tipo_grafico,
  nombre_grafico,
  colores
) {
  //esto es para desctuir el grafico porque sale un error
  $("canvas#char_oferta").remove();
  $("div.chart_o").append(
    '<canvas id="char_oferta" width="40" height="30"></canvas>'
  );
  ///este es el grafico

  var ctx = document.getElementById("char_oferta").getContext("2d");
  var myChart = new Chart(ctx, {
    type: tipo_grafico,
    data: {
      labels: nombre_pr,
      datasets: [
        {
          label: nombre_grafico,
          data: cantidad,
          backgroundColor: colores,
          borderColor: colores,
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}

/// par los graficos
function colores_rgb() {
  var coolor =
    "(" +
    generar_numero(255) +
    "," +
    generar_numero(255) +
    "," +
    generar_numero(255) +
    ")";
  return "rgb" + coolor;
}

function generar_numero(numero) {
  return (Math.random() * numero).toFixed(0);
}
