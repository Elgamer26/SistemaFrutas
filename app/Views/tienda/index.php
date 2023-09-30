<div class="bnr" id="home">
	<div id="top" class="callbacks_container">
		<ul class="rslides" id="slider4">
			<li>
				<img style="width: 100%;
				height: 380px;
				object-fit: cover;" src="<?php echo base_url(); ?>public/img/tienda/tienda1.jpg" alt="Imagen de tienda" />
			</li>
			<li>
				<img style="width: 100%;
				height: 380px;
				object-fit: cover;" src="<?php echo base_url(); ?>public/img/tienda/tienda2.jpg" alt="Imagen de tienda" />
			</li>
			<li>
				<img style="width: 100%;
				height: 380px;
				object-fit: cover;" src="<?php echo base_url(); ?>public/img/tienda/tienda3.jpg" alt="Imagen de tienda" />
			</li>
		</ul>
	</div>
	<div class="clearfix"> </div>
</div>
<script src="<?php echo base_url(); ?>public/tienda/js/responsiveslides.min.js"></script>
<script>
	$(function() {
		// Slideshow 4
		$("#slider4").responsiveSlides({
			auto: true,
			pager: true,
			nav: true,
			speed: 500,
			namespace: "callbacks",
			before: function() {
				$('.events').append("<li>before event fired.</li>");
			},
			after: function() {
				$('.events').append("<li>after event fired.</li>");
			}
		});
	});
</script>

<br>
<br>
<br>

<div class="container">
	<div class="about-top grid-1">
		<div class="col-md-4 about-left">
			<div class="search-bar">
				<input type="text" placeholder="Buscar..." id="buscar_producto">
				<input type="submit" value="">
			</div>
		</div>
	</div>
</div>

<br>

<div class="product" style="padding: 0px;">
	<div class="container">
		<div class="product-top">
			<div class="product-one" id="unir_listado_ofertas_">

			</div>
			<!-- <div class="product-one">
					<div class="col-md-3 product-left">
						<div class="product-main simpleCart_shelfItem">
							<a href="single.html" class="mask"><img class="img-responsive zoom-img" src="<?php echo base_url(); ?>public/tienda/images/p-5.png" alt="" /></a>
							<div class="product-bottom">
							<h3>Smart Watches</h3>
							<p>Explore Now</p>
							<h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
						</div>
						<div class="srch">
							<span>-50%</span>
						</div>
					</div>
				</div> -->
		</div>
	</div>
</div>

<div class="container">
	<nav aria-label="...">
		<ul class="pagination" style="position: relative; left: 15px;" id="unir_paguinador_">
		</ul>
	</nav>
</div>

<script src="<?php echo base_url(); ?>public/js/tienda.js"></script>

<script>
	// var BaseUrl;
	// BaseUrl = "<?php echo base_url(); ?>";
	$(document).ready(function() {
		paginartienda(1);
		// console.log(BaseUrl + "Producto/listartipoprodNEW");

		// // Realizar una solicitud HTTP al servicio web
		// var xhr = new XMLHttpRequest();
		// xhr.open("GET", BaseUrl + "Producto/listartipoprodNEW", true);
		// xhr.onreadystatechange = function() {
		// 	if (xhr.readyState === 4 && xhr.status === 200) {
		// 		var responseData = JSON.parse(xhr.responseText);
		// 		console.log(responseData[0]["tipo"])
		// 	}
		// };
		// xhr.send();
		// var xhr = new XMLHttpRequest();
		// xhr.open("GET", "http://localhost:8080/SistemaFrutal/Producto/listartipoprodNEW", true);
		// xhr.onreadystatechange = function() {
		// 	if (xhr.readyState === 4 && xhr.status === 200) {
		// 		var responseData = JSON.parse(xhr.responseText);
		// 		console.log(responseData[0]["tipo"]);
		// 	}
		// };
		// xhr.send();
	});
</script>