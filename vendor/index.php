<?php
session_start();

if (isset($_SESSION['Logined'])) {

} else {
	$_SESSION['Logined'] = "Unsuccess";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Yuginii</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/logo.jpg">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<!--===============================================================================================-->
	<style>
		/* slider start */
		/* Centered caption for the fourth slide */
		.carousel-item .centered-caption {
			position: absolute;
			top: 80%;
			left: 50%;
			transform: translate(-50%, -50%);
			text-align: center;
			padding: 20px;

			color: rgba(76, 19, 151, 0.511);
		}

		.carousel-item {
			perspective: 1000px;
		}

		.carousel-item img {
			transition: transform 0.6s;
			transform-style: preserve-3d;
		}

		.carousel-item.active img {
			transform: rotateY(0);
		}

		.carousel-item-next img {
			transform: rotateY(20deg);
		}

		.carousel-item-prev img {
			transform: rotateY(-20deg);
		}

		.carousel-caption {
			bottom: 20px;
			background: rgba(0, 0, 0, 0.5);
			padding: 10px;
			border-radius: 10px;
		}

		.btn-slider {
			margin-top: 10px;
			background-color: rgba(240, 237, 244, 0.51);
			border: none;
			color: white;
			padding: 10px 20px;
			text-transform: uppercase;
			transition: background-color 0.3s ease-in-out;
			font-weight: bold;
		}

		.btn-slider:hover {
			background-color: rgba(240, 237, 244, 0.51);
			color: white;
		}

		.carousel-indicators li {
			background-color: #737373;
		}

		.carousel-control-prev-icon,
		.carousel-control-next-icon {
			background-color: #737373;
			border-radius: 50%;
			padding: 10px;
		}

		.carousel {
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);

			overflow: hidden;
		}

		/* 3D flip effect for first slide */
		@keyframes flipIn {
			0% {
				transform: rotateY(-90deg);
				opacity: 0;
			}

			100% {
				transform: rotateY(0);
				opacity: 1;
			}
		}

		.flip-in {
			animation: flipIn 0.9s ease-in-out forwards;
		}

		/* slider end */

		.centered-caption {
			position: absolute;
			top: 53%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.btn-slider {
			/* Customize button styling */
		}

		/* Media queries for responsive behavior */
		@media (max-width: 991.98px) {

			/* Mobile styles */
			.section-slide {
				display: none;
			}

			.mobile-banner {
				display: block;
			}
		}
	</style>
</head>

<body class="animsition">

	<!-- Header -->
	<header>
		<div class="marquee">
			<p>
				<img src="./images/ordernow.png" title="Yuginii" alt="ordernow" class="ordernow" />
				Welcome to our online store. We are open for business. Place your
				order now!
			</p>
		</div>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop" style="background: rgba(255, 255, 255, 0.69); top: 0px; position:relative;">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="#" class="logo1">
						<img src="images/icons/logo1.png" class="logo" alt="JUGINII">
					</a>
					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="index.php" class="active" aria-current="page">Home</a>
							</li>

							<li>
								<a href="retails_shop.php">Retail Shop</a>
							</li>

							<li>
								<a href="whole_shop.php">Wholesale Shop</a>
							</li>

							<li>
								<a href="about.php">About US</a>
							</li>

							<li>
								<a href="contact.php">Contact Us</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">

						<a href="https://wa.me/+918012111178"
							class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 ">
							<i class="fab fa-whatsapp"></i>
						</a>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
							data-notify="0">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<a href="#productview" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<img src="./images/rb_5045.png" alt="sale" width="80">
						</a>

					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<img src="images/icons/logo.png" width="100px" height="100px" alt="JUGINII">
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">

				<a href="https://wa.me/+918012111178"
					class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10" data-notify="0">
					<i class="fab fa-whatsapp"></i>
				</a>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
					data-notify="0">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>


			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">

			<ul class="main-menu-m">
				<li>
					<a href="index.php">Home</a>
				</li>

				<li>
					<a href="retails_shop.php">Retail Shop</a>
				</li>

				<li>
					<a href="whole_shop.php">Wholesale Shop</a>
				</li>

				<li>
					<a href="about.php">About</a>
				</li>

				<li>
					<a href="contact.php">Contact</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>

	<!-- popups -->
	<!-- <div id="successModal" class="model" style="display: block;z-index: 99999999;">
	<div class="modal-content">
		<div class="d-flex justify-content-center flex-column align-items-end">
			<span class="close" onclick="closeSuccessModal()">&times;</span>
			<img src="./images/popup.png" alt="img" style="border-radius: 12px;" class="img-fluid">
		</div>
	</div>
</div> -->

	<!-- Cart include -->
	<?php include_once 'cart.php';
	?>
	<!-- Slider -->
	<!-- Desktop Slider - visible only on larger screens -->
	<section class="section-slide d-block d-lg-block">
		<div class="wrap-slick1">
			<div class="slick1">
				<section class="pb">
					<div id="mycarousel" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#mycarousel" data-slide-to="0" class="active"></li>
							<li data-target="#mycarousel" data-slide-to="1"></li>
							<li data-target="#mycarousel" data-slide-to="2"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
								<img src="images/slides-3.png" class="d-block w-100" alt="First Image">
								<div class="centered-caption">
									<a href="retails_shop.php">
										<button class="btn btn-slider">Shop Now</button>
									</a>
								</div>
							</div>
							<div class="carousel-item">
								<img src="images/slides-2.png" class="d-block w-100" alt="Second Image">
								<div class="centered-caption">
									<a href="retails_shop.php">
										<button class="btn btn-slider">Buy Now</button>
									</a>
								</div>
							</div>
							<div class="carousel-item">
								<img src="images/slides-1.png" class="d-block w-100" alt="Second Image">
								<div class="centered-caption">
									<a href="retails_shop.php">
										<button class="btn btn-slider">Shop Now</button>
									</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</section>

	<!-- Mobile Banner - visible only on smaller screens -->
	<!-- <section class="mobile-banner d-none d-lg-none">
		<a href="retails_shop.php"><img src="images/mb-slide2.png" class="img-fluid mob-ban-img"
				alt="Impressive Mobile Banner" style="height:368px;"></a>
	</section> -->

	<!-- Banner -->
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="flex-container">

				<a href="retails_shop.php" class="">
					<div class="circle-block-women">
						<img src="images/banner--new-06.png" alt="Women Banner">
						<a href="retails_shop.php" class="circle-text-women">
							<!-- <span class="circle-name-women">Towels</span> -->
							<!-- <span class="circle-info-women">Coming Soon</span> -->
							<!-- <div class="circle-link-women">Shop Now</div> -->
						</a>
					</div>
				</a>
				<a href="retails_shop.php" class="">
					<div class="circle-block-women">
						<img src="images/banner--new-03.png" alt="Women Banner">
						<a href="retails_shop.php" class="circle-text-women">
							<!-- <span class="circle-name-women">Women</span> -->
							<!-- <span class="circle-info-women">Coming Soon</span> -->
							<!-- <div class="circle-link-women">Shop Now</div> -->
						</a>
					</div>
				</a>


				<a href="retails_shop.php" class="">
					<div class="circle-block-kids">
						<img src="images/banner--new-05.png" alt="Kids Banner">
						<a href="retails_shop.php" class="circle-text-kids">
							<!-- <span class="circle-name-kids">Kids</span> -->
							<!-- <span class="circle-info-kids">New Trend</span> -->
							<!-- <div class="circle-link-kids">Shop Now</div> -->
						</a>
					</div>
				</a>

				<a href="retails_shop.php" class="">
					<div class="circle-block-men">
						<img src="images/banner--new-04.png" alt="Men Banner">
						<a href="retails_shop.php" class="circle-text-men">
							<!-- <span class="circle-name-men">Men</span> -->
							<!-- <span class="circle-info-men">Coming Soon</span> -->
							<!-- <div class="circle-link-men">Shop Now</div> -->
						</a>
					</div>
				</a>

			</div>
		</div>
	</div>

	<!-- Product -->
	<section class="bg0 p-t-20 p-b-10" id="productview">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Product Overview
				</h3>
			</div>
			<?php
			include_once 'product.php';
			?>

		</div>
		<!-- <div class="alert alert-success" role="alert">
			<center>More Coming Soon.!!!</center>
		</div> -->
	</section>

	<center>
		<img src="images/contact_h.png" class="img-fluid w-75 pb-3" alt="Responsive Background Image">
	</center>

	<!-- Footer -->
	<footer class="footer-section">
		<div class="container">
			<div class="footer-content pt-5 pb-5">
				<div class="flex-container">
					<div class="footer-widget">
						<div class="footer-logo">
							<a href="index.php"><img src="images/icons/logo1.png" class="img-fluid" alt="logo"></a>
						</div>
						<div class="footer-text">
							<p>Welcome to Yuginii, your trusted source for premium towels and home textiles. We are
								dedicated to providing high-quality products that combine comfort and style, perfect for
								your everyday needs.</p>
						</div>
						<div class="footer-social-icon">
							<span>Follow us</span>
							<a href="https://www.facebook.com/yuguniitex?mibextid=ZbWKwL" target="_blank"
								class="fs-18 cl7 hov-cl1 trans-04 m-r-16" aria-label="Facebook">
								<i class="fa fa-facebook"></i>
							</a>
							<a href="https://www.instagram.com/yuginiiboutique/?igsh=MjJ5YWIycmFibHAx" target="_blank"
								class="fs-18 cl7 hov-cl1 trans-04 m-r-16" aria-label="Instagram">
								<i class="fa fa-instagram"></i>
							</a>
							<a href="https://www.youtube.com/@yuginiitowels" target="_blank"
								class="fs-18 cl7 hov-cl1 trans-04 m-r-16" aria-label="YouTube">
								<i class="fa fa-youtube"></i>
							</a>
						</div>
					</div>
					<div class="footer-widget">
						<div class="footer-widget-heading">
							<h3>Useful Links</h3>
						</div>
						<ul>
							<li class="p-b-10"><a href="retails_shop.php"
									class="stext-107 cl7 hov-cl1 trans-04">Towels</a></li>
							<li class="p-b-10"><a href="retails_shop.php"
									class="stext-107 cl7 hov-cl1 trans-04">Women</a></li>
							<li class="p-b-10"><a href="retails_shop.php" class="stext-107 cl7 hov-cl1 trans-04">Men</a>
							</li>
							<li class="p-b-10"><a href="retails_shop.php"
									class="stext-107 cl7 hov-cl1 trans-04">Kids</a></li>
							<li class="p-b-10"><a href="admin/index.php" class="stext-107 cl7 hov-cl1 trans-04">Admin
									login</a></li>
							<li class="p-b-10"><a href="Cancellation and Refund.php"
									class="stext-107 cl7 hov-cl1 trans-04">Cancellation and Refund</a></li>
							<li class="p-b-10"><a href="Shipping and Delivery.php"
									class="stext-107 cl7 hov-cl1 trans-04">Shipping and Delivery</a></li>
						</ul>
					</div>
					<div class="footer-widget">

						<div class="footer-cta pt-5 pb-5">
							<div class="single-cta">
								<i class="fas fa-map-marker-alt"></i>
								<div class="cta-text">
									<h4>Find us</h4>
									<span>9/55 Sakthi Nagar, Gurusamipalayam, Rasipuram (TK), Namakkal (DT)</span>
								</div>
							</div>
							<div class="single-cta">
								<i class="fas fa-phone"></i>
								<div class="cta-text">
									<h4>Call us</h4>
									<span>8012111178</span>
								</div>
							</div>
							<div class="single-cta">
								<i class="far fa-envelope-open"></i>
								<div class="cta-text">
									<h4>Mail us</h4>
									<span>saraswathitex55@gmail.com</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright-area">
			<div class="container">
				<div class="flex-container">
					<div class="copyright-text">
						<p>Copyright &copy; 2024, All Right Reserved.</p>
					</div>
					<div class="footer-menu">
						<ul>
							<li class="p-b-10"><a href="terms&condition.php"
									class="stext-107 cl7 hov-cl1 trans-04">Terms and Conditions</a></li>
							<li class="p-b-10"><a href="Privacy Policy.php"
									class="stext-107 cl7 hov-cl1 trans-04">Privacy Policy</a></li>
							<li class="p-b-10"><a href="tel:+918012111178"
									class="stext-107 cl7 hov-cl1 trans-04">FAQs</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<a href="https://wa.me/+918012111178" target="_blank" rel="noopener noreferrer">
		<img src="images/whatsapp_PNG20.png" class="right-whatsapp" width="50px" alt="YUGINII">
	</a>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function () {
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
		$('.parallax100').parallax100();
	</script>
	<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>

		// Call the function to update the notification on page load

	</script>

	<script>
		$('.gallery-lb').each(function () { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a', // the selector for gallery item
				type: 'image',
				gallery: {
					enabled: true
				},
				mainClass: 'mfp-fade'
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
    $(document).ready(function() {
        // Event delegation for adding to wishlist
        $(document).on('click', '.js-addwish-b2', function (e) {
            e.preventDefault();
            var nameProduct = $(this).closest('.add-to-cart-btn-container').find('.product-name').text();

            swal(nameProduct, "is added to wishlist!", "success");
            $(this).addClass('js-addedwish-b2');
            $(this).off('click'); // Disable further clicks
        });

        $(document).on('click', '.js-addwish-detail', function () {
            var nameProduct = $(this).closest('.product-details').find('.product-name').text();

            swal(nameProduct, "is added to wishlist!", "success");
            $(this).addClass('js-addedwish-detail');
            $(this).off('click'); // Disable further clicks
        });
    });
</script>

	<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Add flip-in class to first carousel item on load
			setTimeout(function () {
				document.querySelector('.carousel-item.active img').classList.add('flip-in');
			}, 100); // Adjust delay as necessary
		});
	</script>
	<script>
		$(document).ready(function () {
			$('#home_logos').owlCarousel({
				loop: true,
				margin: 25,
				nav: false,
				dots: false,
				autoplay: true,
				slideTransition: 'linear',
				autoplayTimeout: 1000,
				autoplaySpeed: 1000,
				responsive: {
					0: {
						items: 4
					},
					767: {
						items: 6
					},
					1000: {
						items: 8
					}
				}
			});
		});
	</script>

	<script>




		$('.js-pscroll').each(function () {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function () {
				ps.update();
			})
		});
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script>
		// Function to update the product grid
		function updateProductGrid(products) {
			var productGrid = $('#products'); // Select the Bootstrap row container
			productGrid.empty(); // Clear the current grid items

			products.forEach(function (product) {
				var discountPercentage = product.discount_p;
				var originalPrice = product.Price;
				var discountedPrice = originalPrice * (1 - discountPercentage / 100);

				var productHtml = `
				<div class="col-sm-6 col-md-4 col-lg-3 mb-4 items">
					<!-- Block2 -->
					<div class="block2" style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
						<div class="block2-pic hov-img0" style="position: relative;">
							<img src="images/product/${product.Img_filename1}" alt="IMG-PRODUCT" style="width: 100%; height: auto;">
							
							${discountPercentage > 0 ? `
							<div class="discount-badge">Limited time deal</div>
							<div class="discount-percentage">${discountPercentage}%</div>
							` : ''}
							
							<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-productid="${product.Product_id}">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14 p-l-15 p-r-15 p-b-10" style="background:white;">
							<div class="block2-txt-child1 flex-col-l">
								<a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-detail p-b-6 js-show-modal1" data-productid="${product.Product_id}">
									${product.Name}
								</a>

								<div class="price-section">
									${discountPercentage > 0 ? `
									<span class="discounted-price">₹ ${discountedPrice.toFixed(2)}</span>
									<span class="original-price">M.R.P: ₹ ${originalPrice}</span>
									` : `
									<span class="regular-price">₹ ${originalPrice}</span>
									`}
								</div>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addcart-detail">
									<div class="icon-header-item cl4 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-add-to-cart" data-notify="+" data-productid="${product.Product_id}" data-productname="${product.Name}">
										<i class="zmdi zmdi-shopping-cart"></i>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>`;

				productGrid.append(productHtml); // Add the product HTML to the grid
			});

			// If you are using any plugins like Slick, initialize them here
		}
	</script>

</body>

</html>