<br>
<div class="about" style="padding: 0 0 0 0;">
	<div class="container">
		<div class="about-top grid-1">
			<div class="col-md-4 about-left">
			</div>
			<div class="col-md-4 about-left" style="text-align: center; font-weight: bold;">
				<h4 style="font-weight: bold;">OFERTAS DISPONIBLES</h4>
			</div>
			<div class="col-md-4 about-left">
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<br>

<div class="container">
	<div class="about-top grid-1">
		<div class="col-md-4 about-left">
			<div class="search-bar">
				<input type="text" placeholder="Buscar..." id="buscar_producto_oferta">
				<input type="submit" value="">
			</div>
		</div>
	</div>
</div>

<br>

<div class="product" style="padding: 0px;">
	<div class="container">
		<div class="product-top">
			<div class="product-one" id="unir_listado_ofertas_tienda">

			</div>
		</div>
	</div>
</div>

<div class="container" style="text-align: center;">
	<nav aria-label="...">
		<ul class="pagination" style="position: relative; left: 15px;" id="unir_paguinador_oferta">
		</ul>
	</nav>
</div>

<!-- <script src="<?php echo base_url(); ?>public/js/tienda.js"></script> -->

<script>
	// var BaseUrl;
	// BaseUrl = "<?php echo base_url(); ?>";

	$(document).ready(function() {
		paginartiendaofertas(1);
	});
</script>