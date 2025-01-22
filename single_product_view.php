<!-- Include jQuery (already in your code) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Slick Slider CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" />
<script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
<title>Vishwa Sarees - Product</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="images/icons/logo.jpg" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Add your styles for related products -->
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap'); */
    @import url('https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap');

    body {
        /* font-family: "Lato", serif; */
        font-family: "K2D", sans-serif;
        font-family: 'Lora', serif;

    }

    /* Container Styling */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Column Layout for Desktop and Mobile */
    .col-lg-6,
    .col-md-12 {
        flex: 1;
    }

    @media (max-width: 768px) {
        .col-lg-6 {
            flex-basis: 100%;
        }
    }

    /* Product Gallery Styles */
    .product-gallery {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .main-image {
        width: 70% !important;
        height: auto;
        border: 1px solid #ddd;
    }

    .main-image img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .thumbnail-gallery {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .thumbnail {
        width: 60px;
        height: 60px;
        border: 1px solid #ddd;
        cursor: pointer;
        object-fit: cover;
    }

    .thumbnail:hover {
        border-color: #333;
    }

    /* Product Information Styling */
    .productss {
        /* border: 1px solid green; */
        /* margin: 10px; */
        border-radius: 5px;
        /* padding: 30px 0px; */
        height: fit-content;
    }

    .product-info {
        padding: 10px 0;
    }

    .product-name {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .product-rating {
        font-size: 14px;
        color: #ff9800;
    }

    .js-modal-quantity {
        /* margin-top: 10px !important; */
        width: 90px !important;
    }

    .price-section {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 10px 0;
    }

    .current-price {
        font-size: 20px;
        font-weight: bold;
        color: #e53935;
    }

    .original-price {
        font-size: 16px;
        color: #757575;
        text-decoration: line-through;
        display: none;
    }

    .discount-percentage {
        font-size: 16px;
        color: #4caf50;
        display: none;
    }

    .cap-text {
        text-transform: capitalize;
    }

    /* Quantity Selection */
    .quantity-selection {
        margin: 20px 0;
    }

    .quantity-selection h4 {
        font-size: 14px;
        margin-bottom: 5px;
    }

    .quantity-selection input {
        width: 60px;
        padding: 5px;
        font-size: 14px;
        cursor: pointer;
    }

    /* Add to Cart Button */
    .add-to-cart-btn {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px 40px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 20px;
        transition: background-color 0.3s ease;
    }

    /* Product Description Styling */
    .product-description {
        margin-top: 20px;
        font-size: 14px;
        color: #555;
    }

    /* Slick Slider Custom Styles */
    .wrap-slick3 {
        position: relative;
    }

    .slick3-dots {
        position: absolute;
        bottom: 15px;
        width: 100%;
        text-align: center;
    }

    .slick3-dots li button:before {
        font-size: 12px;
        color: #999;
    }

    .slick3-dots li.slick-active button:before {
        color: #333;
    }

    /* Optional Discount Section Visibility */
    .discount-section {
        display: none;
    }

    /* Product Gallery Styles */
    .product-gallery {
        display: flex;
        flex-direction: row;
        gap: 10px;
        justify-content: space-evenly;
        align-items: center;
    }

    .main-image {
        width: 80% !important;
        /* Adjust the percentage to make the image smaller */
        height: auto;
        border: 1px solid #ddd;
        max-width: 400px;
        /* Limit the maximum width */
    }

    .main-image img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .thumbnail-gallery {
        display: flex;
        flex-direction: column;
        gap: 10px;
        justify-content: center;
    }

    .thumbnail {
        width: 50px;
        /* Make the thumbnails smaller */
        height: 50px;
        border: 1px solid #ddd;
        cursor: pointer;
        object-fit: cover;
    }

    .thumbnail:hover {
        border-color: #333;
    }

    /* Container */
    .product-container {
        width: 80%;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        overflow: hidden;
    }

    /* Product images */
    .product-images {
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .product-images img {
        width: 150px;
        height: auto;
        border-radius: 5px;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-images img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Main product image */
    .main-product-image {
        width: 300px;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        margin-bottom: 20px;
    }

    /* Product details */
    .product-details {
        text-align: left;
        padding: 20px;
    }

    .product-details h1 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #444;
    }

    .product-details .price {
        font-size: 22px;
        color: #e74c3c;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .product-details .original-price {
        text-decoration: line-through;
        font-size: 16px;
        color: #888;
    }

    .product-details .discount-percentage {
        font-size: 14px;
        color: #27ae60;
        margin-left: 10px;
    }

    /* Description */
    .product-description {
        margin-top: 20px;
        font-size: 16px;
        line-height: 1.6;
    }

    /* Add to cart button */
    .add-to-cart-button {
        background-color: #27ae60;
        color: #fff;
        border: none;
        padding: 12px 24px;
        font-size: 16px;
        border-radius: 30px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 20px;
    }

    .add-to-cart-button:hover {
        background-color: #219150;
    }

    /* Responsive adjustments */
    @media only screen and (max-width: 768px) {
        .product-container {
            width: 95%;
            padding: 15px;
        }

        .product-images {
            flex-direction: column;
        }

        .main-product-image {
            width: 100%;
        }

        .related-products {
            display: flex;
            flex-wrap: wrap;
            /* width: 90% !important; */
            /* Allow items to wrap to the next line */
            justify-content: space-evenly !important;
            /* Distribute space evenly */
            /* margin: 0 -10px; */
            /* To handle the margins on items */
        }
    }

    .quantity-input {
        display: flex;
        align-items: center;
        text-align: center;
    }

    .quantity-input input {
        width: 60px;
        /* Adjust width as needed */
        padding: 5px;
        font-size: 14px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        /* Add some border radius for aesthetics */
        margin: 0 5px;
        /* Spacing between icons and input */
    }

    .btn-num-product-down,
    .btn-num-product-up {
        /* background-color: #f0f0f0; */
        /* Light background for buttons */
        border: 1px solid #ddd;
        /* Border around buttons */
        padding: 8px;
        /* Padding inside buttons */
        border-radius: 4px;
        /* Rounded corners */
        cursor: pointer;
        /* Change cursor on hover */
        transition: background-color 0.3s;
        /* Smooth background change */
    }

    .btn-num-product-down:hover,
    .btn-num-product-up:hover {
        background-color: #ddd;
    }

    .btns-cb {
        gap: 20px;
        flex-wrap: wrap;
    }

    .btns-cb .add-to-cart-btn {
        background-color: transparent;
        color: black;
        border: 1px solid #ddd;
    }

    .btns-cb .add-to-cart-btn:hover {
        background-color: #ddd;
    }

    .btns-cb .add-to-buy-btn {
        background-color: #28a745;
        color: white;
        border: 1px solid #ddd;
        padding: 10px 45px;
    }

    .btns-cb .add-to-buy-btn:hover {
        background-color: #58a345;
        color: white;
    }
</style>

<style>
    .breadcrumb {
        background-color: #f9f9f9;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .breadcrumb ul {
        list-style: none;
        padding: 0;
        display: flex;
    }

    .breadcrumb li {
        margin-right: 10px;
    }

    .breadcrumb li a {
        text-decoration: none;
        color: #007bff;
    }

    .breadcrumb li a:hover {
        text-decoration: underline;
    }

    .breadcrumb li h2 {
        margin: 0;
        font-size: 1.25em;
        color: #333;
    }

    .success-message {
        color: green;
        margin-top: 10px;
        font-weight: bold;
    }

    .related-products {
        display: flex;
        flex-wrap: wrap;
        /* Allow items to wrap to the next line */
        justify-content: flex-start;
        /* Distribute space evenly */
        /* margin: 0 -10px; */
        /* To handle the margins on items */
    }

    .related-product-item {
        flex: 1 1 120px;
        /* Grow, shrink, and set the base width */
        max-width: 120px;
        /* Maximum width for the product card */
        margin: 10px;
        /* Margin around each card */
        text-align: center;
        /* Center-align text */
        overflow: hidden;
        /* Hide overflow */
    }

    .related-product-item img {
        max-width: 100%;
        /* Ensure images fit within the card */
        height: auto;
        /* Maintain aspect ratio */
        display: block;
        /* Ensure block display for images */
        margin: 0 auto;
        /* Center images */
    }

    .related-product-item h5 {
        font-size: 14px;
        /* Smaller font size for product name */
        margin: 5px 0;
        /* Space around the name */
    }

    .related-product-item .price {
        font-size: 12px;
        /* Smaller font size for price */
        color: #333;
        /* Price color */
    }

    /* Responsive adjustments */
    @media (min-width: 480px) {
        .related-product-item {
            flex: 1 1 150px;
            /* Adjust for larger screens */
            max-width: 150px;
        }

        .product-detail-container,
        .product-detail-containers {
            padding: 0%;
            margin: 0%;
        }

    }

    .main-image {
        position: relative;
        /* width: 300px; */
        /* Adjust width as needed */
        /* overflow: hidden; */
        z-index: 22;
    }

    .main-image img {
        width: 100%;
        transition: opacity 0.2s ease;
    }

    #zoomedImage {
        position: absolute;
        top: 0;
        left: 95%;
        /* Position this element as needed */
        width: 500px;
        height: 400px;
        overflow: visible;
        border-radius: 12px;
        background-repeat: no-repeat;
        background-size: 500px;
        /* Adjust this to control zoom level */
        display: none;
        /* Hide by default */
        border: 1px solid #ddd;
    }

    @media (max-width: 760px) {

        #zoomedImage {
            position: absolute;
            top: 95%;
            left: 10%;
            /* Position this element as needed */
            width: 250px;
            height: 250px;
            overflow: visible;
            border-radius: 12px;
            background-repeat: no-repeat;
            background-size: 500px;
            /* Adjust this to control zoom level */
            /* display: none; */
            /* Hide by default */
            border: 1px solid #ddd;
        }

    }

    @media (min-width: 768px) {
        .related-product-item {
            flex: 1 1 180px;
            /* Adjust for tablets and larger screens */
            max-width: 180px;
        }

        .productss {
            width: 100% !important;
        }

        .related-products {
            display: flex;
            flex-wrap: wrap;
            /* Allow items to wrap to the next line */
            justify-content: center;
            /* Distribute space evenly */
            /* margin: 0 -10px; */
            /* To handle the margins on items */
        }

    }

    @media (min-width: 1024px) {
        .related-product-item {
            flex: 1 1 200px;
            /* Adjust for desktops */
            max-width: 200px;
        }

        .product-detail-container {
            flex-direction: column;
        }
    }

    @media (max-width: 560px) {
        .product-gallery {
            flex-direction: column-reverse;
        }

        .thumbnail-gallery {
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .main-image {
            width: 100% !important;
        }

        .productss:first-child {
            padding-bottom: 20px;
        }
    }
</style>
<!-- Header -->
<?php include_once 'header.php'; ?>

<!-- Cart include -->
<?php include_once 'cart.php'; ?>
<!-- Updated HTML Structure -->

<div class="breadcrumb pt-4 pb-4">
    <ul>
        <li>Home /</li>
        <li>
            <h2 class="product-name js-modal-name-detail cap-text">Product Name</h2>
        </li>
    </ul>
</div>

<div class="product-detail-container px-5 py-5">
    <div class="row justify-content-evenly align-items-center-md product-detail-containers">
        <!-- Image Gallery Section -->
        <div class="col-lg-6 col-md-12 col-12 productss">
            <div class="product-gallery zoom-container">
                <div class="thumbnail-gallery">
                    <img class="thumbnail js-modal-main1" src="images/product-placeholder.jpg"
                        onclick="changeImage('images/product-placeholder.jpg')" alt="Thumbnail 1">
                    <img class="thumbnail js-modal-main2" src="images/product-placeholder.jpg"
                        onclick="changeImage('images/product-placeholder.jpg')" alt="Thumbnail 2">
                    <img class="thumbnail js-modal-main3" src="images/product-placeholder.jpg"
                        onclick="changeImage('images/product-placeholder.jpg')" alt="Thumbnail 3">
                    <img class="thumbnail js-modal-main4" src="images/product-placeholder.jpg"
                        onclick="changeImage('images/product-placeholder.jpg')" alt="Thumbnail 3">
                    <img class="thumbnail js-modal-main5" src="images/product-placeholder.jpg"
                        onclick="changeImage('images/product-placeholder.jpg')" alt="Thumbnail 3">
                    <img class="thumbnail js-modal-main6" src="images/product-placeholder.jpg"
                        onclick="changeImage('images/product-placeholder.jpg')" alt="Thumbnail 3">
                </div>
                <div class="main-image">
                    <img id="mainImage" class="js-modal-main1" src="images/product-placeholder.jpg" alt="Product Image">
                    <div id="zoomedImage"></div>

                </div>
            </div>

        </div>

        <!-- Product Information Section -->
        <div class="col-lg-6 col-md-12 col-12 productss">
            <div class="product-info">
                <h2 class="product-name js-modal-name-detail cap-text">Product Name</h2>
                <div class="product-rating"></div>
                <div class="price-section">
                    <span class="current-price js-modal-price cap-text">Rp 0.00</span>
                    <span class="original-price js-modal-mrp-price cap-text">Rp 0.00</span>
                </div>
                <p>Discount: <span class="discount-percentage js-modal-discount-percentage cap-text">0% OFF</span></p>

                <!-- Quantity Selection -->
                <div class="quantity-selection">
                    <h4>Quantity:</h4>
                    <div class="quantity-input">
                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 bi bi-dash"></i>
                        </div>
                        <input type="number" class="js-modal-quantity" value="1" min="1" />
                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 bi bi-plus"></i>
                        </div>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <div class="d-flex btns-cb justify-content-evenly align-items-center">
                    <div class="add-to-cart-btn-container add-to-cart-btn">
                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addcart-detail">
                            <div class="icon-header-item js-add-to-cart" style="display: flex; flex-wrap: nowrap; justify-content: center; align-items: center; gap: 0.5rem; padding: 0.3rem 0;" data-notify="+"
                                data-productid="<?php echo $row['Product_id']; ?>"
                                data-productname="<?php echo htmlspecialchars($row['Name']); ?>">
                                <i class="zmdi zmdi-shopping-cart" style="font-size: 1rem;"></i>
                                <p class="" style="font-size: 1rem;">Add to Cart</p>
                            </div>
                        </a>
                    </div>
                    <button class="add-to-cart-btn add-to-buy-btn js-show-cart" data-productid="">Buy Now</button>
                </div>

                <!-- Product Description -->
                <div class="product-description cap-text js-modal-description">
                    <p class="cap-text">Description will be loaded here...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="success-message"
    style="display: none; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); background-color: #4caf50; color: white; padding: 10px; border-radius: 5px; z-index: 1000;">
    Added to cart successfully!
</div>

<div class="container">
    <h3 class="related-products-heading">Related Products</h3>
    <div class="horizontal-scrollables pb-3">
        <div class="related-products" id="style-5">
            <!-- Related product items will be added here dynamically via JavaScript -->
        </div>
    </div>
</div>

<!-- Alert Modal -->
<div class="alert-modal" id="alertModal" role="alert" aria-live="assertive">
    <div class="alert-modal-content">
        <span class="close-alert" id="closeAlert">&times;</span>
        <p class="alert-message"></p>
    </div>
</div>

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

<!-- JavaScript Libraries -->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/animsition/js/animsition.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="js/map-custom.js"></script>
<script src="js/main.js"></script>

<style>
    /* Alert Modal Styles */
    .alert-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px);
    transition: opacity 0.3s ease;
}

.alert-modal-content {
    background-color: rgba(255, 255, 255, 0.51);
    margin: 15% auto;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    width: 90%;
    max-width: 500px;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.close-alert {
    cursor: pointer;
    float: right;
    font-size: 24px;
    color: #ff5b5b;
    transition: color 0.2s;
}

.close-alert:hover {
    color: #ff1a1a;
}

.alert-message {
    font-family: 'Arial', sans-serif;
    font-size: 16px;
    color: #333;
    text-align: center;
}

.related-products-heading {
    margin-bottom: 15px;
    text-align: center;
    font-size: 2rem;
    color: #27ae60;
    font-weight: bold;
}

.js-modal1 {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6);
    padding: 60px;
}

.js-modal1.show-modal1 {
    display: block;
}

.js-modal-content {
    background-color: rgba(255, 255, 255, 0.9);
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 12px;
}

.js-modal-name-detail {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

.js-modal-price,
.js-modal-mrp-price,
.js-modal-discount-price {
    font-size: 20px;
    color: #333;
}

.js-modal-description {
    margin-top: 10px;
    line-height: 1.5;
}

.product-description p {
    line-height: 2px !important;
}

.success-message {
    display: none;
    padding: 10px;
    margin-top: 20px;
    border-radius: 5px;
    color: white;
}

.horizontal-scrollable {
    padding-bottom: 40px;
}

.related-products {
    display: flex;
}

.related-product-item {
    flex: 0 0 auto;
    width: 150px;
    margin-right: 15px;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.8);
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    transition: box-shadow 0.3s;
}

.related-product-item:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.related-product-image {
    width: 100%;
    height: 100%;
    border-radius: 8px;
}

.btn-num-product-up,
.btn-num-product-down {
    cursor: pointer;
    padding: 7px;
    color: black;
    border: 1px solid #ddd;
    border-radius: 5px;
    height: 100%;
}

.btn-num-product-up:hover,
.btn-num-product-down:hover {
    background-color: #45a049;
}
</style>

<!-- /* Related Products Styles */ -->
<style>
.horizontal-scrollable {
    padding-bottom: 40px;
}

.related-products {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    justify-content: flex-start;
    overflow-x: auto; /* Enable horizontal scrolling */
    scrollbar-width: thin; /* For Firefox */
}

/* ===== Scrollbar CSS ===== */
/* Firefox */
.related-products {
    scrollbar-color:rgb(255, 255, 255) #ffffff;
}

/* Chrome, Edge, and Safari */
.related-products::-webkit-scrollbar {
    width: 19px;
    border-radius: 22px;
}

.related-products::-webkit-scrollbar-track {
    background: #ffffff;
}

.related-products::-webkit-scrollbar-thumb {
    background-color:rgb(255, 255, 255);
    border-radius: 11px;
    border: 3px ridge #ffffff;
}

.related-product-item {
    flex: 0 0 auto;
    max-width: 250px;
    width: 100%;
    margin-right: 20px;
    text-align: center;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 12px; /* Rounded corners with a larger radius */
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Subtle shadow for modern look */
    transition: all 0.3s ease-in-out;
    overflow: hidden; /* Prevents overflow of child elements */
}

.related-product-item:hover {
    transform: translateY(-5px); /* Lift effect on hover */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Enhanced shadow on hover */
}

.related-product-image {
    width: 100%;
    height: auto;
    border-radius: 10px; /* Rounded corners for the image */
    transition: transform 0.3s ease; /* Image zoom effect */
}

.related-product-item:hover .related-product-image {
    transform: scale(1.05); /* Slight zoom effect on hover */
}

.related-product-item h4 {
    font-size: 1.2rem;
    color: #333;
    margin: 10px 0 5px;
    font-weight: 600;
}

.related-product-item p {
    font-size: 1rem;
    color: #666;
    margin: 0 0 15px;
}

.related-product-item button {
    background-color: #007bff; /* Modern blue color */
    color: white;
    font-size: 1rem;
    padding: 10px 20px;
    border: none;
    border-radius: 30px; /* Rounded button */
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.related-product-item button:hover {
    background-color: #0056b3; /* Darker blue on hover */
    transform: scale(1.05); /* Slight grow effect on hover */
}

</style>

<!-- // Sample product data -->
<script>
const relatedProductsContainer = document.getElementById('style-5');

// Sample product data
const products = [
    { name: 'Product 1', price: '$10.00', image: 'image1.jpg' },
    { name: 'Product 2', price: '$15.00', image: 'image2.jpg' },
    // Add more products as needed
];

// Populate the related products
products.forEach(product => {
    const productItem = document.createElement('div');
    productItem.className = 'related-product-item';

    productItem.innerHTML = `
        <img src="${product.image}" alt="${product.name}" class="related-product-image">
        <h4>${product.name}</h4>
        <p>${product.price}</p>
        <button aria-label="Add ${product.name} to cart">Add to Cart</button>
    `;
    
    relatedProductsContainer.appendChild(productItem);
});


// Fast auto-scroll function
function autoScroll() {
    relatedProductsContainer.scrollBy({
        left: 250, // Scrolls 250 pixels to move one product
        behavior: 'smooth' // Smooth scrolling
    });

    // Reset scroll position if we reach the end
    if (relatedProductsContainer.scrollLeft + relatedProductsContainer.clientWidth >= relatedProductsContainer.scrollWidth) {
        relatedProductsContainer.scrollLeft = 0; // Reset to start
    }
}

// Set the interval for auto-scrolling
setInterval(autoScroll, 1000); // Adjust to scroll one product every second
</script>

<script>
    const mainImage = document.getElementById("mainImage");
    const zoomedImage = document.getElementById("zoomedImage");

    mainImage.addEventListener("mousemove", function (e) {
        zoomedImage.style.display = "block";

        const rect = mainImage.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        // Calculate zoomed position
        const zoomX = (x / rect.width) * 100;
        const zoomY = (y / rect.height) * 100;

        zoomedImage.style.backgroundImage = `url(${mainImage.src})`;
        zoomedImage.style.backgroundPosition = `${zoomX}% ${zoomY}%`;
    });

    mainImage.addEventListener("mouseleave", function () {
        zoomedImage.style.display = "none";
    });

</script>

<script>
    $(document).on('click', '.js-check-btn', function (e) {
        e.preventDefault();
        var total_amount_v = parseInt($('.js-total').text().replace("Total: ₹", ""));
        if (total_amount_v > 500) {
            window.location.replace("shoping-cart.php");
        }
        else {
            alert("The total amount must exceed ₹500.");
        }
    });
</script>

<script>
    (function () {
        // Change the main image when a thumbnail is clicked
        function changeImage(src) {
            $('#mainImage').attr('src', src);
        }

        // Function to handle adding the product to the cart
        function addToCart(productId, productName) {
            const quantity = parseInt($('.js-modal-quantity').val());

            if (isNaN(quantity) || quantity <= 0) {
                showAlert('Please enter a valid quantity.', 'error');
                return;
            }

            const product = { id: productId, quantity };
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existingProductIndex = cart.findIndex(item => item.id === product.id);

            if (existingProductIndex > -1) {
                cart[existingProductIndex].quantity += product.quantity;
            } else {
                cart.push(product);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            showAlert(`Added ${quantity} of ${productName} to the cart successfully.`);
        }

        // Function to show alert modal
        function showAlert(message) {
            const alertModal = $('#alertModal');
            $('.alert-message').text(message);
            alertModal.show();

            // Close alert modal when user clicks on <span> (x) or outside the modal
            $('#closeAlert, #alertModal').on('click', function (event) {
                if (event.target === alertModal[0] || event.target === $('#closeAlert')[0]) {
                    alertModal.hide();
                }
            });
        }

        $(document).ready(function () {
            // When a thumbnail is clicked, update the main image source
            $('.thumbnail').on('click', function () {
                changeImage($(this).attr('src'));
            });

            // Update quantity
            $('.btn-num-product-down').on('click', function () {
                const quantityInput = $(this).siblings('.js-modal-quantity');
                const currentValue = parseInt(quantityInput.val());
                if (currentValue > 1) {
                    quantityInput.val(currentValue - 1);
                }
            });

            $('.btn-num-product-up').on('click', function () {
                const quantityInput = $(this).siblings('.js-modal-quantity');
                const currentValue = parseInt(quantityInput.val()) || 0;
                quantityInput.val(currentValue + 1);
            });

            // Function to fetch product details
            function fetchProductDetails(productId) {
                $.ajax({
                    url: 'get_product_details.php',
                    type: 'POST',
                    data: { product_id: productId },
                    success: function (response) {
                        const product = JSON.parse(response);
                        $('.js-modal-name-detail').text(product.Name);
                        $('.js-modal-price').text('₹ ' + product.Price + '/pcs');
                        $('.js-addcart-detail').data('productid', productId);

                        let descriptionData = JSON.parse(product.Description);
                        let formattedDescription = Object.entries(descriptionData)
                            .map(([key, value]) => `<strong>${key}:</strong> ${value}<br>`).join('');

                        $('.js-modal-description').html(formattedDescription);

                        // Handle discounts
                        if (product.discount_p > 0) {
                            const discountPrice = product.Price - (product.Price * (product.discount_p / 100));
                            $('.js-modal-price').text('₹ ' + discountPrice.toFixed(2) + '/pcs');
                            $('.js-modal-mrp-price').text('₹ ' + product.Price).show();
                            $('.js-modal-discount-percentage').text(`${product.discount_p}% off`).show();
                        } else {
                            $('.js-modal-mrp-price, .js-modal-discount-percentage').hide();
                        }

                        // Update image sources
                        for (let i = 1; i <= 6; i++) {
                            $(`.js-modal-main${i}`).attr('src', `images/product/${product[`Img_filename${i}`]}`);
                        }

                        // Fetch related products
                        fetchRelatedProducts(product.Category);
                    },
                    error: function (error) {
                        console.error('Error fetching product details:', error);
                        showAlert('Error fetching product details. Please try again.');
                    }
                });
            }

            // Function to fetch related products
            function fetchRelatedProducts(category) {
                $.ajax({
                    url: 'get_related_products.php',
                    method: 'GET',
                    data: { category },
                    dataType: 'json',
                    success: function (response) {
                        $('.related-products').empty(); // Clear previous products

                        response.forEach(function (product) {
                            const relatedProductItem = `
                                <div class="related-product-item">
                                    <a href="?product_id=${product.Product_id}">
                                        <img src="images/product/${product.img_filename1}" alt="${product.name}" class="related-product-image" onclick="changeImage('images/product/${product.img_filename1}')">
                                        <h5>${product.name}</h5>
                                        <p class="price">Price: ₹${product.price}</p>
                                    </a>
                                </div>
                            `;
                            $('.related-products').append(relatedProductItem);
                        });
                    },
                    error: function (err) {
                        console.error('AJAX error:', err);
                        showAlert('Error fetching related products. Please try again.');
                    }
                });
            }

            // Get product ID from URL
            function getUrlParameter(name) {
                const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
                const results = regex.exec(window.location.href);
                return results ? decodeURIComponent(results[2].replace(/\+/g, ' ')) : null;
            }

            const productId = getUrlParameter('product_id');
            if (!productId) {
                console.error('Product ID not found in the URL');
                return;
            }

            fetchProductDetails(productId); // Fetch the product details on page load

            // Add event listener for adding the product to the cart
            $('.js-addcart-detail').on('click', function () {
                const productId = $(this).data('productid');
                const productName = $('.js-modal-name-detail').text();
                addToCart(productId, productName);
            });
        });
    })();
</script>