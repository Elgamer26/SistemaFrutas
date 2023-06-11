<script src="https://www.paypal.com/sdk/js?client-id=AbWxXRs8-c7JuBwspT2LHP3Kel95_X25PZeTFF-gqzjyt9dmORSUCVw0XJC4y1ObCInYLG4DzjseH9OG"></script>

<style>
	/* Media query for mobile viewport */
	@media screen and (max-width: 400px) {
		#paypal-button-container {
			width: 100%;
		}
	}

	/* Media query for desktop viewport */
	@media screen and (min-width: 400px) {
		#paypal-button-container {
			width: 250px;
			display: inline-block;
		}
	}
</style>

<div class="ckeckout" style="padding: 30px;">

	<div class="container">
		<div class="ckeck-top heading">
			<h2>VERIFICAR</h2>
		</div>
		<div class="ckeckout-top">
			<div class="cart-items">
				<h3>Mi bolsa de la compra</h3>

				<div class="in-check">


					<div class="row">
						<div class="col" style="font-size: 15px;">
							<table id="tabledetalle" class="table table-hover table-bordered table-striped table-hover text-center">
								<thead style="background: black; color: white; text-align: center !important;">
									<tr>
										<th>Producto</th>
										<th>Cantidad</th>
										<th>Sale</th>
										<th>Precio</th>
										<th>Oferta</th>
										<th>Descuento</th>
										<th>Total</th>
										<th>Quitar</th>
									</tr>
								</thead>

								<tbody id="DetalleProductoCarrito">

									<?php if (!empty($detallecompra) && is_array($detallecompra)) {
										foreach ($detallecompra as $detallecompra_item) { ?>

											<tr>
												<td hidden><?= esc($detallecompra_item['producto_id']); ?></td>
												<td><?= esc($detallecompra_item["nombre"]); ?> - <?= esc($detallecompra_item["tipo"]); ?></td>
												<td><?= esc($detallecompra_item["cantidad"]); ?></td>
												<td><?= esc($detallecompra_item["sale"]); ?></td>
												<td><?= esc($detallecompra_item["precio"]); ?></td>
												<td><?= esc($detallecompra_item["promocion"]); ?></td>
												<td><?= esc($detallecompra_item["descuento_promo"]); ?></td>
												<td><?= esc($detallecompra_item["total"]); ?></td>
												<td producto_id="<?= esc($detallecompra_item['producto_id']); ?>" cliente_id="<?= esc($detallecompra_item['cliente_id']); ?>"><button class="btn btn-danger remover"><i class="fa fa-trash"></i></button></td>

											</tr>

									<?php }
									} ?>

								</tbody>
							</table>

						</div>
					</div>

					<div class="checkout-left" style="text-align: center;">
						<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">

							<div class="row" style="text-align: center;">

								<div class="col-md-4">

									<div id="procesopago" class="col-lg-12" id="btb_btn_paypa">
										<h4><b>Pagar servicio</b></h4>
										<button class="btn btn-warning" id="procesarpago"> Procesar pago <i class="fa fa-shopping-cart"></i></button>
									</div>

									<div id="btn_paypal" hidden class="col-lg-12">
										<h4><b>Pagar servicio</b></h4>
										<div class="pago_payal_ser" id="paypal-button-container_ser"></div>
									</div>
								</div>

								<div class="col-md-8">

									<div class="col-md-12">
										<div class="form-group">
											<label for="ciudad">Ciudad</label> <span id="ciudad_olbligg" style="color: red;"></span>
											<input autocomplete="off" type="text" class="form-control" id="ciudad" placeholder="Ingrese la ciudad" maxlength="150">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="direccion">Dirección</label> <span id="direccion_olbligg" style="color: red;"></span>
											<input autocomplete="off" type="text" class="form-control" id="direccion" placeholder="Ingrese dirección de envio" maxlength="150">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="referencia">Referencia</label> <span id="referencia_olbligg" style="color: red;"></span>
											<input autocomplete="off" type="text" class="form-control" id="referencia" placeholder="Ingrese referencia de envio" maxlength="150">
										</div>
									</div>

								</div>

							</div>

						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>

<script>
	var count = 0;
	let arrego_total = new Array();
	$("#tabledetalle tbody#DetalleProductoCarrito tr").each(function() {
		arrego_total.push($(this).find("td").eq(7).text());
		count++;
	});

	let grantotal = arrego_total.toString();

	$("#procesarpago").click(function() {
		let ciudad = $("#ciudad").val();
		let direccion = $("#direccion").val();
		let referencia = $("#referencia").val();

		// var arrego_id = new Array();
		// var arreglo_cantidad = new Array();
		// var arreglo_sale = new Array();
		// var arreglo_precio = new Array();
		// var arreglo_oferta = new Array();
		// var arreglo_descuento = new Array();
		// var arreglo_total = new Array();

		// let cpara = grantotal.split(",")
		// let totals = 0;
		// for (let i = 0; i < cpara.length; i++) {
		// 	totals += parseFloat(cpara[i]);
		// }

		// $("#tabledetalle tbody#DetalleProductoCarrito tr").each(function() {
		// 	arrego_id.push($(this).find("td").eq(0).text());
		// 	arreglo_cantidad.push($(this).find("td").eq(2).text());
		// 	arreglo_sale.push($(this).find("td").eq(3).text());
		// 	arreglo_precio.push($(this).find("td").eq(4).text());
		// 	arreglo_oferta.push($(this).find("td").eq(5).text());
		// 	arreglo_descuento.push($(this).find("td").eq(6).text());
		// 	arreglo_total.push($(this).find("td").eq(7).text());
		// });

		// //aqui combierto el arreglo a un string
		// var id = arrego_id.toString();
		// var cantidad = arreglo_cantidad.toString();
		// var sale = arreglo_sale.toString();
		// var precio = arreglo_precio.toString();
		// var oferta = arreglo_oferta.toString();
		// var descuento = arreglo_descuento.toString();
		// var totalsub = arreglo_total.toString();

		// $.ajax({
		// 	url: BaseUrl + "Tienda/RegistrarVentaCarrito",
		// 	type: "POST",
		// 	data: {
		// 		id: id,
		// 		cantidad: cantidad,
		// 		sale: sale,
		// 		precio: precio,
		// 		oferta: oferta,
		// 		descuento: descuento,
		// 		totalsub: totalsub,

		// 		ciudad: ciudad,
		// 		direccion: direccion,
		// 		referencia: referencia,
		// 		sub: totals.toFixed(2),
		// 		impuesto: (totals * 0.12).toFixed(2),
		// 		totals: (totals + (totals * 0.12)).toFixed(2),
		// 	},
		// }).done(function(resp) {
		// 	console.log(resp);
		// });

		if (count == 0) {
			return swal.fire("No hay productos", "No tiene productos ingresados en el detalle", "error");
		}

		if (direccion.length == 0 || direccion.trim() == "" ||
			ciudad.length == 0 || ciudad.trim() == "" ||
			referencia.length == 0 || referencia.trim() == "") {
			return swal.fire("No hay datos de envio", "Ingrese los datos de envio para continuar", "warning");
		}

		$("#btn_paypal").removeAttr("hidden", "hidden");
		$("#procesopago").attr("hidden", "hidden");
	});

	paypal.Buttons({
		style: {
			shape: 'pill',
			label: 'pay'
		},
		createOrder: function(data, actions) {

			let cpara = grantotal.split(",")
			let totals = 0;
			for (let i = 0; i < cpara.length; i++) {
				totals += parseFloat(cpara[i]);
			}

			return actions.order.create({
				purchase_units: [{
					amount: {
						value: (totals + (totals * 0.12)).toFixed(2)
					}
				}]
			});
		},

		onApprove: function(data, actions) {
			actions.order.capture().then(function(orderData) {
				if (orderData.status == "COMPLETED") {
					// console.log(orderData);

					let ciudad = $("#ciudad").val();
					let direccion = $("#direccion").val();
					let referencia = $("#referencia").val();

					var arrego_id = new Array();
					var arreglo_cantidad = new Array();
					var arreglo_sale = new Array();
					var arreglo_precio = new Array();
					var arreglo_oferta = new Array();
					var arreglo_descuento = new Array();
					var arreglo_total = new Array();

					let cpara = grantotal.split(",")
					let totals = 0;
					for (let i = 0; i < cpara.length; i++) {
						totals += parseFloat(cpara[i]);
					}

					$("#tabledetalle tbody#DetalleProductoCarrito tr").each(function() {
						arrego_id.push($(this).find("td").eq(0).text());
						arreglo_cantidad.push($(this).find("td").eq(2).text());
						arreglo_sale.push($(this).find("td").eq(3).text());
						arreglo_precio.push($(this).find("td").eq(4).text());
						arreglo_oferta.push($(this).find("td").eq(5).text());
						arreglo_descuento.push($(this).find("td").eq(6).text());
						arreglo_total.push($(this).find("td").eq(7).text());
					});

					//aqui combierto el arreglo a un string
					var id = arrego_id.toString();
					var cantidad = arreglo_cantidad.toString();
					var sale = arreglo_sale.toString();
					var precio = arreglo_precio.toString();
					var oferta = arreglo_oferta.toString();
					var descuento = arreglo_descuento.toString();
					var totalsub = arreglo_total.toString();

					$.LoadingOverlay("show", {
						text: "Procesando compra...",
					});

					$.ajax({
						url: BaseUrl + "Tienda/RegistrarVentaCarrito",
						type: "POST",
						data: {
							id: id,
							cantidad: cantidad,
							sale: sale,
							precio: precio,
							oferta: oferta,
							descuento: descuento,
							totalsub: totalsub,

							ciudad: ciudad,
							direccion: direccion,
							referencia: referencia,
							sub: totals.toFixed(2),
							impuesto: (totals * 0.12).toFixed(2),
							totals: (totals + (totals * 0.12)).toFixed(2),
						},
					}).done(function(resp) {
						$.LoadingOverlay("hide");
						if (resp > 0) {

							EnviarCorreoWeb(parseInt(resp));

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
										BaseUrl + "Reporte/ReporteVentaWeb/" + parseInt(resp),
										"#zoom=100%",
										"Factura de venta producto",
										"scrollbards=No"
									);
									location.reload();
								} else {
									location.reload();
								}
							});

						} else {
							return swal.fire(
								"Error al procesar la compra de producto",
								"Error al procesar su compra de producto" + resp,
								"error");
						}
					});
				} else {
					return alert("Ocurrio un error en el proceso de pago");
				}
			});
		},

		onCancel: function(data) {
			return alert("La compra se canceló, no se compró el o los productos");
		}
	}).render('#paypal-button-container_ser');

	async function EnviarCorreoWeb(id) {
		let result = await $.ajax({
			url: BaseUrl + "Reporte/ReporteVentaWebEnvioCorreo",
			type: "POST",
			data: {
				id: id
			}
		});
		console.log(result);
	}
</script>