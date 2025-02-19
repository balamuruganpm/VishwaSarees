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
	<title>YUGINII - T&C</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
		.ul-items {
			display: flex;
			flex-direction: column;
			gap: 10px;
		}

		.ul-items li {
			list-style-type: disc;
			margin-left: 20px;
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

	<!-- Cart include -->
	<?php include_once 'cart.php';
	?>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-40 p-t-50">
		<div class="container" style="font-family: Arial, sans-serif; line-height: 1.6;">
			<h1 style="color: #28a745;" class="text-center pb-5">Terms and Conditions</h1>
			<div class="policy-section">
				<ul style="margin-left: 20px;" class="ul-items">
					<li style="margin-bottom: 10px;">Content on this website can change without notice.</li>
					<li style="margin-bottom: 10px;">We do not guarantee the accuracy, completeness, or suitability of the information on this website. You acknowledge that errors may exist, and we are not liable for them.</li>
					<li style="margin-bottom: 10px;">Use of information or materials on this website is at your own risk. Ensure that products, services, or information meet your needs.</li>
					<li style="margin-bottom: 10px;">Material on this website is owned by or licensed to us. Reproduction is prohibited unless in accordance with the copyright notice.</li>
					<li style="margin-bottom: 10px;">Trademarks not owned by us are acknowledged on the website.</li>
					<li style="margin-bottom: 10px;">Unauthorized use of our information may result in a claim for damages or a criminal offense.</li>
					<li style="margin-bottom: 10px;">Links to other websites are provided for convenience. We are not responsible for their content.</li>
					<li style="margin-bottom: 10px;">You may not link to our website without prior written consent.</li>
					<li style="margin-bottom: 10px;">Disputes are subject to the laws of India.</li>
					<li style="margin-bottom: 10px;">We are not liable for any loss or damage arising from declined transactions due to exceeding preset limits.</li>
				</ul>
			</div>
		</div>
	</section>

	<!-- Footer -->

	<?php include_once 'footer.php'; ?>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<a href="https://wa.me/+918012111178" target="_blank" rel="noopener noreferrer">
		<img src="images/whatsapp_PNG20.png" class="right-whatsapp" width="50px" alt="YUGINII">
	</a>

	<!-- Modal -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>
				<?php include_once 'single_product_view.php'; ?>
			</div>
		</div>
	</div>


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
		$('.js-addwish-b2').on('click', function (e) {
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function () {
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function () {
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function () {
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function () {
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});



	</script>
	<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
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

</body>

</html>