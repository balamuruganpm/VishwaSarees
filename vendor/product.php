<?php
include_once 'connection.php';
$sql = "SELECT * FROM product WHERE Availability = 'Instock' OR Availability = 'Available'";
$result = mysqli_query($conn, $sql);
?>
<style>
    .block2-pic {
        position: relative;
        /* background-color: #f9f9f9; */
    }

    .discount-badge {
        background-color: #e60026;
        color: white;
        padding: 4px 8px;
        position: absolute;
        top: 10px;
        left: 10px;
        border-radius: 3px;
        z-index: 2;
        font-size: 12px;
        font-weight: bold;
    }

    .discount-percentage {
        color: #e60026;
        font-weight: bold;
        font-size: 12PX;
        position: absolute;
        top: 40px;
        left: 10px;
        z-index: 2;
        font-size: 15px;
    }

    .price-section {
        display: flex;
        align-items: baseline;
    }

    .discounted-price {
        color: #000;
        font-weight: bold;
        font-size: 15px;
        margin-right: 10px;
    }

    .original-price {
        color: #888;
        text-decoration: line-through;
    }

    .regular-price {
        color: #000;
        font-weight: bold;
        font-size: 20px;
    }

    .block2-btn {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        border-radius: 20px;
        padding: 8px 16px;
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .block2:hover .block2-btn {
        opacity: 1;
    }

    .product-item {
        display: none;
    }

    .product-item.active {
        display: block;
    }

    .notice-bar {
        width: 100%;
        /* background-color: #00796b; */
        color: black;
        padding: 15px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .notice-icon {
        font-size: 24px;
        margin: 0 15px;
        color: #ffeb3b;
        animation: pulse 1.5s infinite;
    }

    .notice-text {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }

    .price-highlight {
        color: #ffeb3b;
        font-size: 20px;
        font-weight: bold;
    }

    /* new design */



    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .notice-bar {
            padding: 10px;
            flex-direction: column;
            text-align: center;
        }

        .notice-icon {
            font-size: 12px;
            margin: 10px 0;
        }

        .notice-text {
            font-size: 10px;
        }

        .price-highlight {
            font-size: 10px;
        }
    }

    /* Ensure two .block2 containers in the same row on mobile */
    @media (max-width: 768px) {
        .discount-percentage {
            font-size: 12px;
        }

        .icon-header-item {
            font-size: 20px;
        }

        .discount-badge {
            font-weight: bold;
            font-size: 9px;
            padding: 2px 4px;
        }

        .price-section {
            width: 150px;
            padding-top: 8px;
        }

        .block2 {
            width: calc(100% - 20px);
            /* Full width minus left/right space */
            margin-left: 10px;
            /* Space on the left */
            margin-right: 10px;
            /* Space on the right */
            margin-bottom: 15px;
        }

        /* Responsive font size for mobile */
        .block2-txt {
            padding: 10px;
            font-size: 14px;
        }

        .block2-txt-child1 .stext-104 {
            font-size: 12px;
        }

        .price-section .discounted-price,
        .price-section .original-price,
        .price-section .regular-price {
            font-size: 10px;
        }

        .block2-pic img {
            width: 100%;
            height: auto;
        }
    }

    /* Optional: adjust the font size for larger screens as well for better readability */
    @media (min-width: 768px) and (max-width: 1024px) {
        .block2-txt {
            font-size: 10px;
        }


        .block2-txt-child1 .stext-104 {
            font-size: 10px;
        }

        .price-section .discounted-price,
        .price-section .original-price,
        .price-section .regular-price {
            font-size: 16px;
        }
    }

    @media (min-width: 1024px) {
        .stext-104 {
            font-size: 20px;
        }

        .block2 {
            margin-bottom: 40px;
        }
    }
</style>
<!-- Product Display -->
<div class="flex-w flex-sb-m p-b-52">
    <div class="flex-w flex-l-m filter-tope-group m-tb-10">
        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
            All Products
        </button>
        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="Towels">
            Towels
        </button>
        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="Kids">
            Kids
        </button>
        <!-- Other buttons here -->
        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="Mens">
            Mens
        </button>
        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="Womens">
            Womens
        </button>
    </div>
    <div class="flex-w flex-c-m m-tb-10">
        <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
            <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
            <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
            Search
        </div>
    </div>

    <!-- Search product -->
    <div class="dis-none panel-search w-full  p-b-15">
        <div class="bor8 dis-flex p-l-15">
            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                <i class="zmdi zmdi-search"></i>
            </button>
            <input id="search-product" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
                placeholder="Search">
        </div>
    </div>
</div>
<!-- <div class="notice-bar">
        <i class="fas fa-info-circle notice-icon"></i>
        <p class="notice-text">Minimum price to place order is <span class="price-highlight">500</span></p>
        <i class="fas fa-exclamation-triangle notice-icon"></i>
    </div>

<div class="marquee" style="background:transparent; color:black;">
    <p>Minimum price to place order is 500</p>
</div> -->

<style>
    .product-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .product-card {
        display: flex;
        width: calc(33.33% - 20px);
        /* 3 products per row with spacing */
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        transition: all 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: scale(1.05);
    }

    .product-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
    }

    .product-details {
        flex: 1;
        margin-left: 15px;
    }

    .product-name {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .price-section {
        margin-bottom: 10px;
        justify-content: center;
    }

    .discounted-price {
        color: #e60026;
        font-weight: bold;
        margin-right: 10px;
    }

    .original-price {
        color: #888;
        text-decoration: line-through;
    }

    .buy-now-btn {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .buy-now-btn:hover {
        background-color: #218838;
    }

    /* Responsive for tablet */
    @media (max-width: 1024px) {

        .product-row {
            padding: 20px;
            justify-content: space-evenly;
        }

        .product-card {
            text-align: center;
            width: calc(50% - 20px);
            /* 2 products per row */
        }

        .product-image {
            width: 120px;
            height: 120px;
        }
    }

    /* Responsive for mobile */
    @media (max-width: 768px) {
        .product-row {
            padding: 20px;
            justify-content: space-evenly;
            align-items: center;
        }

        .product-card {
            width: 45%;
            /* 1 product per row */
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .product-image {
            width: 100%;
            height: auto;
        }

        .product-details {
            margin-left: 0;
            margin-top: 15px;
            text-align: center;
        }
    }

    .add-to-cart-btn-container {
        margin-top: 10px;
        /* Adjust as needed for spacing */
    }

    .add-to-cart-btn {
        display: inline-block;
        /* background-color: #28a745; */
        color: black;
        border: 1px solid black;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 1rem;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .add-to-cart-btn:hover {
        background-color: #218838;
        color: white;
        border: none;
        transform: translateY(-3px);
    }

    .add-to-cart-btn:active {
        transform: translateY(0);
        background-color: #1e7e34;
    }

    .text-decoration-none {
        text-decoration: none;
        color: #000;
        text-transform: capitalize;
    }

    .text-decoration-none:hover {
        text-decoration: none;
        color: #000;
        text-transform: capitalize;
    }

    @media (max-width: 960px) {
        .price-section span {
            text-align: center !important;
        }
    }
</style>

<!-- Product Display -->
<div class="row product-row">
    <?php while ($row = mysqli_fetch_assoc($result)) {
        $discountPercentage = $row['discount_p'];
        $originalPrice = $row['Price'];
        $discountedPrice = $originalPrice * (1 - $discountPercentage / 100);
        ?>
        <a href="single_product_view.php?product_id=<?php echo $row['Product_id']; ?>"
            class="text-decoration-none block2-link <?php echo htmlspecialchars($row['Category']); ?>">

            <div class="product-card">

                <img src="images/product/<?php echo htmlspecialchars($row['Img_filename1']); ?>"
                    alt="<?php echo htmlspecialchars($row['Name']); ?>" class="product-image">

                <div class="product-details">
                    <div class="product-name"><?php echo htmlspecialchars($row['Name']); ?></div>
                    <div class="price-section">
                        <?php if ($discountPercentage > 0) { ?>
                            <span class="discounted-price">₹<?php echo number_format($discountedPrice, 2); ?></span>
                            <span class="original-price">₹<?php echo number_format($originalPrice, 2); ?></span>
                        <?php } else { ?>
                            <span class="regular-price">₹<?php echo number_format($originalPrice, 2); ?></span>
                        <?php } ?>
                    </div>

                    <div class="add-to-cart-btn-container">
                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addcart-detail">
                            <div class="js-add-to-cart"
                                data-notify="+" data-productid="<?php echo $row['Product_id']; ?>"
                                data-productname="<?php echo htmlspecialchars($row['Name']); ?>">
                                <!-- <i class="zmdi zmdi-shopping-cart"></i> -->
                                <p class="add-to-cart-btn">Add to Cart</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </a>
    <?php } ?>
</div>