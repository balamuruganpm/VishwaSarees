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
	<title>Vishwa Sarees</title>
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
		@import url('https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
		@import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap');

		body {
			/* font-family: "Lato", serif; */
			font-family: "K2D", sans-serif;
			font-family: 'Lora', serif;

		}

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

		.sec-banner h3 {
			font-size: 2rem;
			padding: 0 0 30px;
			font-weight: bold;
			color: #007bff;
		}

		.circle-block {
			display: flex;
			justify-content: space-evenly;
			align-items: center;
			gap: 10px;
		}

		.circle-blocks {
			display: flex;
			flex-direction: column;
			color: black;
			justify-content: center;
			gap: 10px;
			align-items: center;
			font-size: 1.2rem;
		}

		.circle-blocks img {
			filter: drop-shadow(0px 0px 2px orange);
		}

		.circle-blocks:hover {
			transform: scale(1.1);
			filter: drop-shadow(1px 1px 10px #ddd);
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

		.circle-block {
			gap: 30px;
			padding: 20px;
		}

		.circle-blocks img {
			width: 150px;
			filter: drop-shadow(0px 0px 2px orange);
		}

		/* Testimonials Styles */
		.testimonials {
			background-color: #f8f9fa;
			padding: 4rem 0;
			text-align: center;
		}

		.testimonials h2 {
			margin-bottom: 1rem;
		}

		.testimonial {
			margin-bottom: 2rem;
		}

		.testimonial p {
			font-style: italic;
		}

		.testimonial .customer-name {
			font-weight: bold;
			margin-top: 1rem;
		}
	</style>
</head>

<body class="animsition">

	<!-- Header -->
	<?php include_once 'header.php'; ?>

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
							<li data-target="#mycarousel" data-slide-to="3"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
								<img src="images/slides-1.png" class="d-block w-100" alt="First Image">
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
								<img src="images/slides-3.png" class="d-block w-100" alt="Second Image">
								<div class="centered-caption">
									<a href="retails_shop.php">
										<button class="btn btn-slider">Shop Now</button>
									</a>
								</div>
							</div>
							<div class="carousel-item">
								<img src="images/slides-4.png" class="d-block w-100" alt="Second Image">
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

	<!-- Product -->
	<section class="bg0 p-t-20 p-b-10" id="productview">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5 typeofpro">
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

	<style>
		/* Hero Section Styles */
		.hero {
			background: radial-gradient(circle, rgba(255, 255, 255, 0.57), rgba(255, 255, 255, 0.62)), url('https://mallurepost.com/upload/2022/05/06/Tamil-actress-Ammu-Abhirami-beautiful-and-glamours-photos-in-saree-beautiful-and-glamours-picture--58309.jpg');
			background-size: cover;
			background-position: center;
			height: 500px;
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			color: black;
			padding: 10px;
		}

		.hero-content {
			max-width: 600px;
		}

		.hero h1 {
			font-size: 4rem;
			font-weight: 700;
			font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
			color: #007bff;
		}

		.hero p {
			font-size: 1.3rem;
			margin-bottom: 2rem;
		}

		.btn-primary {
			display: inline-block;
			background-color: #007bff;
			color: #fff;
			padding: 0.8rem 2rem;
			text-decoration: none;
			border-radius: 5px;
			transition: background-color 0.3s ease;
		}

		.btn-primary:hover {
			background-color: #0056b3;
		}

		/* Newsletter Styles */
		.newsletter {
			background-color: #f8f9fa;
			padding: 4rem 0;
			text-align: center;
		}

		.newsletter h2 {
			margin-bottom: 1rem;
		}

		.newsletter p {
			margin-bottom: 2rem;
		}

		.newsletter-form {
			display: flex;
			justify-content: center;
			max-width: 500px;
			margin: 0 auto;
		}

		.newsletter-form input[type="email"] {
			flex-grow: 1;
			padding: 0.8rem;
			border: 1px solid #ced4da;
			border-radius: 5px 0 0 5px;
		}

		.btn-subscribe {
			background-color: #007bff;
			color: #fff;
			border: none;
			padding: 0.8rem 1.5rem;
			border-radius: 0 5px 5px 0;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		.btn-subscribe:hover {
			background-color: #0056b3;
		}

		/* Testimonials Styles */
		.testimonials {
			background-color: #f8f9fa;
			padding: 4rem 0;
			text-align: center;
		}

		.testimonials h2 {
			margin-bottom: 1rem;
		}

		.testimonial {
			margin-bottom: 2rem;
		}

		.testimonial p {
			font-style: italic;
		}

		.testimonial .customer-name {
			font-weight: bold;
			margin-top: 1rem;
		}
	</style>

	<section class="hero">
		<div class="hero-content">
			<h1>Welcome to Vishwa Sarees</h1>
			<p>Explore our exquisite collection of sarees at unbeatable prices!</p>
			<a href="retails_shop.php" class="btn-primary">Explore Now</a>
		</div>
	</section>

	<section class="newsletter">
		<div class="container">
			<h2>Subscribe to Our Newsletter</h2>
			<p>Stay updated with our latest products and offers!</p>
			<form action="subscribe.php" method="POST" class="newsletter-form">
				<input type="email" name="email" placeholder="Enter your email" required>
				<button type="submit" class="btn-subscribe">Subscribe</button>
			</form>
		</div>
	</section>

	<!-- Testimonials Section -->
	<section class="testimonials">
		<div class="container">
			<h2>Customer Testimonials</h2>
			<div class="testimonial">
				<p>"I absolutely love the sarees from Vishwa Sarees! The quality is top-notch and the designs are beautiful."</p>
				<div class="customer-name">- Priya S.</div>
			</div>
			<div class="testimonial">
				<p>"Great collection and excellent customer service. I highly recommend Vishwa Sarees to everyone."</p>
				<div class="customer-name">- Anjali K.</div>
			</div>
			<div class="testimonial">
				<p>"The prices are unbeatable and the sarees are just stunning. I will definitely be shopping here again."</p>
				<div class="customer-name">- Meera R.</div>
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

	<a href="https://wa.me/+919994079949" target="_blank" rel="noopener noreferrer">
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
	<script src="./js/main.js"></script>
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
		$(document).ready(function () {
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

<script>
    if (typeof jQuery == 'undefined') {
        console.error("jQuery is not loaded!");
    } else {
        console.log("jQuery is loaded successfully.");
    }
</script>
<script>
    $(document).ready(function () {
        setTimeout(() => {
            if (typeof updateCartDisplay === "function") {
                console.log("Calling updateCartDisplay...");
                updateCartDisplay();
            } else {
                console.log("updateCartDisplay function not found!");
            }
        }, 100); // Small delay to ensure elements exist
    });
</script>
  <!-- Include jQuery if you haven't already -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
$(document).ready(function () {
    // Function to retrieve the cart data from localStorage
    function getCartFromLocalStorage() {
        let cart = [];

        for (let i = 0; i < localStorage.length; i++) {
            try {
                let value = JSON.parse(localStorage.getItem(localStorage.key(i)));
                if (Array.isArray(value)) {
                    cart = value;
                    break;
                }
            } catch (e) {
                console.warn("Skipping invalid JSON:", localStorage.key(i));
            }
        }

        return cart;
    }

    // Function to update the cart contents
    function updateCart() {
        let cart = getCartFromLocalStorage();

        $.ajax({
            url: 'get-cart.php',  // Backend URL to fetch the cart data
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ cart: cart }),  // Send cart data to backend
            dataType: 'json',
            success: function (data) {
                console.log("Cart Data Received:", data);  // Debugging

                let cartContainer = $('#cart-items');
                cartContainer.empty();  // Clear old cart data

                if (data.items && data.items.length > 0) {
                    let cartHtml = data.items.map(item => `
                        <li class="cart-item">
                            <img src="${item.image}" alt="${item.name}" onerror="this.onerror=null; this.src='fallback.jpg';">
                            <div class="cart-item-info">
                                <span class="cart-item-name">${item.name}</span>
                                <span class="cart-item-quantity">${item.quantity} x ₹${item.price.toFixed(2)}</span>
                            </div>
                        </li>
                    `).join('');

                    console.log("Generated HTML:", cartHtml);  // Debugging

                    cartContainer.html(cartHtml);  // Update the cart container with new items
                    $('#cart-total').text('Total: ₹' + data.total.toFixed(2));  // Update total
                } else {
                    cartContainer.html('<p>Your cart is empty.</p>');  // Display empty message if no items
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching cart data:", error);
                console.error("Status:", status);
                console.error("Response:", xhr.responseText);
            }
        });
    }
    // Trigger cart update when an element with class `.zmdi-shopping-cart` is clicked
    $('.zmdi-shopping-cart').click(function () {
        updateCart();  // Execute the updateCart function on click
    });
    // Initial cart update when page loads
    updateCart();

    // Allow external call to update the cart display (useful for adding items)
    window.updateCartDisplay = updateCart;
});
</script>

</body>

</html>