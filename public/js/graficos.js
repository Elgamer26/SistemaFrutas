////////////////////////////////////////////////////
function TraerGraficoProductosMasVendidos() {
  var tipo_grafico = "bar";
  var nombre_grafico = "Barra";
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
      responsive: true,
      animation: {
        onComplete: function () {
          var ctx = this.chart.ctx;
          ctx.font = Chart.helpers.fontString(
            Chart.defaults.global.defaultFontFamily,
            "normal",
            Chart.defaults.global.defaultFontFamily
          );
          ctx.fillStyle = "black";
          ctx.textAlign = "center";
          ctx.textBaseline = "bottom";

          this.data.datasets.forEach(function (dataset) {
            for (var i = 0; i < dataset.data.length; i++) {
              for (var key in dataset._meta) {
                var model = dataset._meta[key].data[i]._model;
                ctx.fillText(dataset.data[i], model.x, model.y - 5);
              }
            }
          });
        },
      },
    },
  });
}

////////////////////////////////
function TraerGraficoProductosMasVendidosOferta() {
  var tipo_grafico = "line";
  var nombre_grafico = "Linea";
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
      responsive: true,
      animation: {
        onComplete: function () {
          var ctx = this.chart.ctx;
          ctx.font = Chart.helpers.fontString(
            Chart.defaults.global.defaultFontFamily,
            "normal",
            Chart.defaults.global.defaultFontFamily
          );
          ctx.fillStyle = "black";
          ctx.textAlign = "center";
          ctx.textBaseline = "bottom";

          this.data.datasets.forEach(function (dataset) {
            for (var i = 0; i < dataset.data.length; i++) {
              for (var key in dataset._meta) {
                var model = dataset._meta[key].data[i]._model;
                ctx.fillText(dataset.data[i], model.x, model.y - 5);
              }
            }
          });
        },
      },
    },
  });
}

////////////////////////////////
function TraerGraficoClientesMasCompras() {
  var tipo_grafico = "bar";
  var nombre_grafico = "Barra";
  $.ajax({
    url: BaseUrl + "Graficos/TraerGraficoClientesMasCompras",
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
      MostrarClientesMasCompras(
        nombre_pr,
        cantidad,
        tipo_grafico,
        nombre_grafico,
        colores
      );
    } else {
      $("canvas#char_clients").remove();
    }
  });
}

function MostrarClientesMasCompras(
  nombre_pr,
  cantidad,
  tipo_grafico,
  nombre_grafico,
  colores
) {
  //esto es para desctuir el grafico porque sale un error
  $("canvas#char_clients").remove();
  $("div.chart_cli").append(
    '<canvas id="char_clients" width="50" height="50"></canvas>'
  );
  ///este es el grafico

  var ctx = document.getElementById("char_clients").getContext("2d");
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
      responsive: true,
      animation: {
        onComplete: function () {
          var ctx = this.chart.ctx;
          ctx.font = Chart.helpers.fontString(
            Chart.defaults.global.defaultFontFamily,
            "normal",
            Chart.defaults.global.defaultFontFamily
          );
          ctx.fillStyle = "black";
          ctx.textAlign = "center";
          ctx.textBaseline = "bottom";

          this.data.datasets.forEach(function (dataset) {
            for (var i = 0; i < dataset.data.length; i++) {
              for (var key in dataset._meta) {
                var model = dataset._meta[key].data[i]._model;
                ctx.fillText(dataset.data[i], model.x, model.y - 5);
              }
            }
          });
        },
      },
    },
  });
}

////////////////////////////////
function TraerGraficoProductosMasComprados() {
  var tipo_grafico = "line";
  var nombre_grafico = "Linea";
  $.ajax({
    url: BaseUrl + "Graficos/TraerGraficoProductosMasComprados",
    type: "GET",
  }).done(function (response) {
    if (response != 0) {
      var nombre_pr = [];
      var cantidad = [];
      var colores = [];
      var data = JSON.parse(response);
      for (var i = 0; i < data.length; i++) {
        nombre_pr.push(data[i][0]);
        cantidad.push(data[i][1]);
        colores.push(colores_rgb());
      }
      MostraProductosMasComprados(
        nombre_pr,
        cantidad,
        tipo_grafico,
        nombre_grafico,
        colores
      );
    } else {
      $("canvas#char_comprados").remove();
    }
  });
}

function MostraProductosMasComprados(
  nombre_pr,
  cantidad,
  tipo_grafico,
  nombre_grafico,
  colores
) {
  //esto es para desctuir el grafico porque sale un error
  $("canvas#char_comprados").remove();
  $("div.chart_compra").append(
    '<canvas id="char_comprados" width="50" height="50"></canvas>'
  );
  ///este es el grafico

  var ctx = document.getElementById("char_comprados").getContext("2d");
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
      responsive: true,
      animation: {
        onComplete: function () {
          var ctx = this.chart.ctx;
          ctx.font = Chart.helpers.fontString(
            Chart.defaults.global.defaultFontFamily,
            "normal",
            Chart.defaults.global.defaultFontFamily
          );
          ctx.fillStyle = "black";
          ctx.textAlign = "center";
          ctx.textBaseline = "bottom";
        
          this.data.datasets.forEach(function (dataset) {
            for (var i = 0; i < dataset.data.length; i++) {
              for (var key in dataset._meta) {
                var model = dataset._meta[key].data[i]._model;
                ctx.fillText(dataset.data[i], model.x, model.y - 5);
              }
            }
          });
        },
      },
    },
  });
}

////////////////////////////////////
function TraerGraficoGananciasPormeses() {
  var tipo_grafico = "bar";
  var nombre_grafico = "Barra";
  $.ajax({
    url: BaseUrl + "Graficos/TraerGraficoGananciasPormeses",
    type: "GET",
  }).done(function (response) {
    if (response != 0) {
      var nombre_pr = [];
      var cantidad = [];
      var colores = [];
      var data = JSON.parse(response);

      for (var i = 0; i < data.length; i++) {
        nombre_pr.push(data[i][1]);
        cantidad.push(data[i][0]);
        colores.push(colores_rgb());
      }

      MostrarVendidosMeses(
        nombre_pr,
        cantidad,
        tipo_grafico,
        nombre_grafico,
        colores
      );
    } else {
      $("canvas#charc_meses").remove();
    }
  });
}

function MostrarVendidosMeses(
  nombre_pr,
  cantidad,
  tipo_grafico,
  nombre_grafico,
  colores
) {
  //esto es para desctuir el grafico porque sale un error
  $("canvas#charc_meses").remove();
  $("div.chard_meses").append(
    '<canvas id="charc_meses" width="20" height="20""></canvas>'
  );
  ///este es el grafico

  var ctx = document.getElementById("charc_meses").getContext("2d");
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
      responsive: true,
      animation: {
        onComplete: function () {
          var ctx = this.chart.ctx;
          ctx.font = Chart.helpers.fontString(
            Chart.defaults.global.defaultFontFamily,
            "normal",
            Chart.defaults.global.defaultFontFamily
          );
          ctx.fillStyle = "black";
          ctx.textAlign = "center";
          ctx.textBaseline = "bottom";

          this.data.datasets.forEach(function (dataset) {
            for (var i = 0; i < dataset.data.length; i++) {
              for (var key in dataset._meta) {
                var model = dataset._meta[key].data[i]._model;
                ctx.fillText(dataset.data[i], model.x, model.y - 5);
              }
            }
          });
        },
      },
    },
  });
}

//////////////////////////////////
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
