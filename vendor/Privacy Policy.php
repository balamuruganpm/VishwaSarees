<?php
session_start();

if(isset($_SESSION['Logined'])){
	
}
else{
	$_SESSION['Logined']="Unsuccess";	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>YUGINII - Privacy Policy</title>
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
	<?php include_once'cart.php';
	?>

	<!-- Product -->
	<section class="bg-light py-5">
    <div class="container" style="font-family: Arial, sans-serif; line-height: 1.6;">
        <h1 class="text-success text-center mb-4">Privacy Policy</h1>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">Information We Collect</h2>
            <ul class="ul-items">
                <li>Personal identification information (Name, email, phone, etc.)</li>
                <li>Payment information (credit/debit card details)</li>
                <li>Demographic information (postal address, preferences)</li>
                <li>Other relevant information for surveys and offers</li>
            </ul>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">How We Use Your Information</h2>
            <ul class="ul-items">
                <li>To understand your needs and enhance our services:</li>
                <li>Processing orders and managing accounts</li>
                <li>Improving products and services</li>
                <li>Sending promotional emails about new products and offers</li>
                <li>Conducting market research</li>
                <li>Customizing our website to your interests</li>
            </ul>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">Security</h2>
            <p>We are dedicated to protecting your information and have implemented robust security measures to safeguard your data.</p>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">Cookies</h2>
            <ul class="ul-items">
                <li>A cookie is a small file that helps analyze web traffic or notifies you when you visit a site. Cookies enable personalized experiences on our website.</li>
                <li>We use cookies to track which pages are used and improve our site based on this data.</li>
            </ul>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">Data Retention</h2>
            <p>We will retain your personal information only as long as necessary to fulfill the purposes for which it was collected.</p>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">Your Data Protection Rights</h2>
            <ul class="ul-items">
                <li>Rectification: Request correction of inaccurate information.</li>
                <li>Erasure: Request deletion of your personal data, under certain conditions.</li>
                <li>Restrict Processing: Request restriction of processing your data.</li>
                <li>Object to Processing: Object to the processing of your personal data.</li>
                <li>Data Portability: Request transfer of your data to another organization or directly to you.</li>
            </ul>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">How We Share Your Information</h2>
            <p>We do not sell or trade your Personally Identifiable Information. We may share it with trusted partners who assist us in operating our website, provided they agree to keep this information confidential.</p>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">Third-Party Services</h2>
            <p>Our website may contain links to third-party sites. We do not control these websites and are not responsible for their privacy practices.</p>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">Children's Privacy</h2>
            <p>Our services are not intended for children under 13. We do not knowingly collect personal information from children under 13.</p>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">Changes to This Privacy Policy</h2>
            <p>We may update our Privacy Policy and will notify you of any changes by posting the new policy on this page. Please review it periodically.</p>
        </div>

        <div class="policy-section mb-4">
            <h2 class="text-dark pb-3">Contact Us</h2>
            <p>If you have any questions about this Privacy Policy, please contact us:</p>
            <p>Email: <a href="mailto:yuginiitex@gmail.com">yuginiitex@gmail.com</a></p>
            <p>Phone: 8012111178</p>
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
		$(".js-select2").each(function(){
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
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
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
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		
	
	</script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>




		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>