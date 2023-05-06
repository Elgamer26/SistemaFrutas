<!DOCTYPE html>
<html>

<head>
	<title>Tienda Online</title>
	<link href="<?php echo base_url(); ?>public/tienda/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

	<script src="<?php echo base_url(); ?>public/tienda/js/jquery-1.11.0.min.js"></script>

	<link href="<?php echo base_url(); ?>public/tienda/css/style.css" rel="stylesheet" type="text/css" media="all" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/tienda.jpg" type="image/x-icon">

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/fontawesome-free/css/all.min.css">
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<script src="<?php echo base_url(); ?>public/tienda/js/simpleCart.min.js"> </script>
	<link href="<?php echo base_url(); ?>public/tienda/css/memenu.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="<?php echo base_url(); ?>public/tienda/js/memenu.js"></script>
	<script>
		$(document).ready(function() {
			$(".memenu").memenu();
		});
	</script>
	<script src="<?php echo base_url(); ?>public/tienda/js/jquery.easydropdown.js"></script>
</head>

<body>
	<div class="top-header">
		<div class="container">
			<div class="top-header-main">

				<div class="col-md-6 top-header-left">
					<div class="drop">

						<?php if ($token == "NOTOKEN") { ?>
							<a href="<?php echo base_url(); ?>home/login"><span style="color: white;">Iniciar sesión </span> <i style="color: white;" class="fa fa-user"></i></a>
						<?php } else { ?>
							<span style="color: white;"><i style="color: white;" class="fa fa-user"></i> <?php echo $token; ?> </span> <a href="<?php echo base_url(); ?>cliente/CerraSesionCliente" class="btn btn-danger">Cerra sesion</a>
						<?php } ?>

						<div class="clearfix"></div>
					</div>
				</div>

				<div class="col-md-6 top-header-left">
					<div class="cart box_1">
						<a href="checkout.html">
							<div class="total">
								<span class="simpleCart_total"></span>
							</div>
							<img src="<?php echo base_url(); ?>public/tienda/images/cart-1.png" alt="" />
						</a>
						<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
						<div class="clearfix"> </div>
					</div>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="logo">
		<a href="<?php echo base_url(); ?>">
			<h1>Tienda Online</h1>
		</a>
	</div>
	<div class="header-bottom">
		<div class="container">
			<div class="header">
				<div class="col-md-9 header-left">
					<div class="top-nav">
						<ul class="memenu skyblue">
							<li class="active"><a href="<?php echo base_url(); ?>">Inicio</a></li>
							<li class="grid"><a href="#">Men</a>
								<div class="mepanel">
									<div class="row">
										<div class="col1 me-one">
											<h4>Shop</h4>
											<ul>
												<li><a href="products.html">New Arrivals</a></li>
												<li><a href="products.html">Blazers</a></li>
												<li><a href="products.html">Swem Wear</a></li>
												<li><a href="products.html">Accessories</a></li>
												<li><a href="products.html">Handbags</a></li>
												<li><a href="products.html">T-Shirts</a></li>
												<li><a href="products.html">Watches</a></li>
												<li><a href="products.html">My Shopping Bag</a></li>
											</ul>
										</div>
										<div class="col1 me-one">
											<h4>Style Zone</h4>
											<ul>
												<li><a href="products.html">Shoes</a></li>
												<li><a href="products.html">Watches</a></li>
												<li><a href="products.html">Brands</a></li>
												<li><a href="products.html">Coats</a></li>
												<li><a href="products.html">Accessories</a></li>
												<li><a href="products.html">Trousers</a></li>
											</ul>
										</div>
										<div class="col1 me-one">
											<h4>Popular Brands</h4>
											<ul>
												<li><a href="products.html">499 Store</a></li>
												<li><a href="products.html">Fastrack</a></li>
												<li><a href="products.html">Casio</a></li>
												<li><a href="products.html">Fossil</a></li>
												<li><a href="products.html">Maxima</a></li>
												<li><a href="products.html">Timex</a></li>
												<li><a href="products.html">TomTom</a></li>
												<li><a href="products.html">Titan</a></li>
											</ul>
										</div>
									</div>
								</div>
							</li>
							<li class="grid"><a href="#">Women</a>
								<div class="mepanel">
									<div class="row">
										<div class="col1 me-one">
											<h4>Shop</h4>
											<ul>
												<li><a href="products.html">New Arrivals</a></li>
												<li><a href="products.html">Blazers</a></li>
												<li><a href="products.html">Swem Wear</a></li>
												<li><a href="products.html">Accessories</a></li>
												<li><a href="products.html">Handbags</a></li>
												<li><a href="products.html">T-Shirts</a></li>
												<li><a href="products.html">Watches</a></li>
												<li><a href="products.html">My Shopping Bag</a></li>
											</ul>
										</div>
										<div class="col1 me-one">
											<h4>Style Zone</h4>
											<ul>
												<li><a href="products.html">Shoes</a></li>
												<li><a href="products.html">Watches</a></li>
												<li><a href="products.html">Brands</a></li>
												<li><a href="products.html">Coats</a></li>
												<li><a href="products.html">Accessories</a></li>
												<li><a href="products.html">Trousers</a></li>
											</ul>
										</div>
										<div class="col1 me-one">
											<h4>Popular Brands</h4>
											<ul>
												<li><a href="products.html">499 Store</a></li>
												<li><a href="products.html">Fastrack</a></li>
												<li><a href="products.html">Casio</a></li>
												<li><a href="products.html">Fossil</a></li>
												<li><a href="products.html">Maxima</a></li>
												<li><a href="products.html">Timex</a></li>
												<li><a href="products.html">TomTom</a></li>
												<li><a href="products.html">Titan</a></li>
											</ul>
										</div>
									</div>
								</div>
							</li>
							<li class="grid"><a href="#">Kids</a>
								<div class="mepanel">
									<div class="row">
										<div class="col1 me-one">
											<h4>Shop</h4>
											<ul>
												<li><a href="products.html">New Arrivals</a></li>
												<li><a href="products.html">Blazers</a></li>
												<li><a href="products.html">Swem Wear</a></li>
												<li><a href="products.html">Accessories</a></li>
												<li><a href="products.html">Handbags</a></li>
												<li><a href="products.html">T-Shirts</a></li>
												<li><a href="products.html">Watches</a></li>
												<li><a href="products.html">My Shopping Bag</a></li>
											</ul>
										</div>
										<div class="col1 me-one">
											<h4>Style Zone</h4>
											<ul>
												<li><a href="products.html">Shoes</a></li>
												<li><a href="products.html">Watches</a></li>
												<li><a href="products.html">Brands</a></li>
												<li><a href="products.html">Coats</a></li>
												<li><a href="products.html">Accessories</a></li>
												<li><a href="products.html">Trousers</a></li>
											</ul>
										</div>
										<div class="col1 me-one">
											<h4>Popular Brands</h4>
											<ul>
												<li><a href="products.html">499 Store</a></li>
												<li><a href="products.html">Fastrack</a></li>
												<li><a href="products.html">Casio</a></li>
												<li><a href="products.html">Fossil</a></li>
												<li><a href="products.html">Maxima</a></li>
												<li><a href="products.html">Timex</a></li>
												<li><a href="products.html">TomTom</a></li>
												<li><a href="products.html">Titan</a></li>
											</ul>
										</div>
									</div>
								</div>
							</li>
							<li class="grid"><a href="typo.html">Blog</a>
							</li>
							<li class="grid"><a href="contact.html">Contact</a>
							</li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>

				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<div class="bnr" id="home">
		<div id="top" class="callbacks_container">
			<ul class="rslides" id="slider4">
				<li>
					<img src="<?php echo base_url(); ?>public/tienda/images/bnr-1.jpg" alt="" />
				</li>
				<li>
					<img src="<?php echo base_url(); ?>public/tienda/images/bnr-2.jpg" alt="" />
				</li>
				<li>
					<img src="<?php echo base_url(); ?>public/tienda/images/bnr-3.jpg" alt="" />
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
				<div class="product-one">
					<div class="col-md-3 product-left">
						<div class="product-main simpleCart_shelfItem">
							<a href="single.html" class="mask"><img class="img-responsive zoom-img" src="<?php echo base_url(); ?>public/tienda/images/p-1.png" alt="" /></a>
							<div class="product-bottom">
								<h3>Smart Watches</h3>
								<p>Explore Now</p>
								<h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
							</div>
							<div class="srch">
								<span>-50%</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 product-left">
						<div class="product-main simpleCart_shelfItem">
							<a href="single.html" class="mask"><img class="img-responsive zoom-img" src="<?php echo base_url(); ?>public/tienda/images/p-2.png" alt="" /></a>
							<div class="product-bottom">
								<h3>Smart Watches</h3>
								<p>Explore Now</p>
								<h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
							</div>
							<div class="srch">
								<span>-50%</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 product-left">
						<div class="product-main simpleCart_shelfItem">
							<a href="single.html" class="mask"><img class="img-responsive zoom-img" src="<?php echo base_url(); ?>public/tienda/images/p-3.png" alt="" /></a>
							<div class="product-bottom">
								<h3>Smart Watches</h3>
								<p>Explore Now</p>
								<h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
							</div>
							<div class="srch">
								<span>-50%</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 product-left">
						<div class="product-main simpleCart_shelfItem">
							<a href="single.html" class="mask"><img class="img-responsive zoom-img" src="<?php echo base_url(); ?>public/tienda/images/p-4.png" alt="" /></a>
							<div class="product-bottom">
								<h3>Smart Watches</h3>
								<p>Explore Now</p>
								<h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
							</div>
							<div class="srch">
								<span>-50%</span>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="product-one">
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
					</div>
					<div class="col-md-3 product-left">
						<div class="product-main simpleCart_shelfItem">
							<a href="single.html" class="mask"><img class="img-responsive zoom-img" src="<?php echo base_url(); ?>public/tienda/images/p-6.png" alt="" /></a>
							<div class="product-bottom">
								<h3>Smart Watches</h3>
								<p>Explore Now</p>
								<h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
							</div>
							<div class="srch">
								<span>-50%</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 product-left">
						<div class="product-main simpleCart_shelfItem">
							<a href="single.html" class="mask"><img class="img-responsive zoom-img" src="<?php echo base_url(); ?>public/tienda/images/p-7.png" alt="" /></a>
							<div class="product-bottom">
								<h3>Smart Watches</h3>
								<p>Explore Now</p>
								<h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
							</div>
							<div class="srch">
								<span>-50%</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 product-left">
						<div class="product-main simpleCart_shelfItem">
							<a href="single.html" class="mask"><img class="img-responsive zoom-img" src="<?php echo base_url(); ?>public/tienda/images/p-8.png" alt="" /></a>
							<div class="product-bottom">
								<h3>Smart Watches</h3>
								<p>Explore Now</p>
								<h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ 329</span></h4>
							</div>
							<div class="srch">
								<span>-50%</span>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<nav aria-label="...">
			<ul class="pagination" style="position: relative; left: 15px;">
				<li class="page-item disabled">
					<span class="page-link">Previous</span>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item active">
					<span class="page-link">
						2
						<span class="sr-only">(current)</span>
					</span>
				</li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#">Next</a>
				</li>
			</ul>
		</nav>
	</div>
	<div class="information">
		<div class="container">
			<div class="infor-top">
				<div class="col-md-3 infor-left">
					<h3>Follow Us</h3>
					<ul>
						<li><a href="#"><span class="fb"></span>
								<h6>Facebook</h6>
							</a></li>
						<li><a href="#"><span class="twit"></span>
								<h6>Twitter</h6>
							</a></li>
						<li><a href="#"><span class="google"></span>
								<h6>Google+</h6>
							</a></li>
					</ul>
				</div>
				<div class="col-md-3 infor-left">
					<h3>Information</h3>
					<ul>
						<li><a href="#">
								<p>Specials</p>
							</a></li>
						<li><a href="#">
								<p>New Products</p>
							</a></li>
						<li><a href="#">
								<p>Our Stores</p>
							</a></li>
						<li><a href="contact.html">
								<p>Contact Us</p>
							</a></li>
						<li><a href="#">
								<p>Top Sellers</p>
							</a></li>
					</ul>
				</div>
				<div class="col-md-3 infor-left">
					<h3>My Account</h3>
					<ul>
						<li><a href="account.html">
								<p>My Account</p>
							</a></li>
						<li><a href="#">
								<p>My Credit slips</p>
							</a></li>
						<li><a href="#">
								<p>My Merchandise returns</p>
							</a></li>
						<li><a href="#">
								<p>My Personal info</p>
							</a></li>
						<li><a href="#">
								<p>My Addresses</p>
							</a></li>
					</ul>
				</div>
				<div class="col-md-3 infor-left">
					<h3>Store Information</h3>
					<h4>The company name,
						<span>Lorem ipsum dolor,</span>
						Glasglow Dr 40 Fe 72.
					</h4>
					<h5>+955 123 4567</h5>
					<p><a href="mailto:example@email.com">contact@example.com</a></p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="container">
			<div class="footer-top">
				<div class="col-md-6 footer-left">
					<form>
						<input type="text" value="Enter Your Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Your Email';}">
						<input type="submit" value="Subscribe">
					</form>
				</div>
				<div class="col-md-6 footer-right">
					<p>© 2015 Luxury Watches. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</body>

</html>