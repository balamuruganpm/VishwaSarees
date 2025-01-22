<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vishwa Saree - About US</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="images/icons/logo.jpg"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
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
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
<!--===============================================================================================-->

</head>
<body class="animsition">
	
<?php include_once 'header.php'; ?>

	<!-- Cart -->
	<?php include_once'cart.php';
	?>

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: radial-gradient(circle, rgba(255, 255, 255, 0.57), rgba(255, 255, 255, 0.62)), url('https://singhanias.in/cdn/shop/collections/e925ca5d14eb8518956368f4233d57c1.jpg?v=1687192265');">
        <h1>Welcome to Vishwa Sarees!</h1>
        <p>Learn more about us!</p>
        <a href="#about-us" class="btn-primary">Learn More</a>
	</section>	
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
    <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04" style="font-size: 1.1em;">
        Home
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <span class="stext-109 cl4" style="font-size: 1.1em;">
        About us
    </span>
</div>

<style>
 .bg-img1 h1 {
    font-size: 4rem;
	font-weight: 700;
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
	padding-bottom: 10px;
	color: rgb(103, 4, 133);
	text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.bg-img1 p {
	font-size: 1.5rem;
	font-weight: 500;
	padding-bottom: 10px;
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
	color:rgb(33, 24, 36);
}

.hero {
	background: radial-gradient(circle, rgba(255, 255, 255, 0.57), rgba(255, 255, 255, 0.62)), url('https://wallpapercave.com/wp/wp8336331.jpg');
    background-size: cover;
    background-position: center;
    height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: black;
	padding: 1%;
	margin: 2% 10%;
	border-radius: 2%;
}

</style>

<section class="hero" id="about-us">
    <div class="hero-content">
        <h1>About Us</h1>
        <p>KK EthnoSaree is a brand of Ethno Silk Sarees, founded by a team of passionate individuals dedicated to showcasing the richness of Indian culture through sarees...!</p>
        <a href="retails_shop.php" class="btn-primary">Explore Our Collection</a>
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
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
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