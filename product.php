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
        /* display: flex; */
        /* align-items: baseline; */
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

    .regular-price,
    .discounted-price {
        color: green !important;
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

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 30px;
        padding: 20px 0;
    }

    .product-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .product-image-container {
        position: relative;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        overflow: hidden;
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .btn-addcart {
        background-color: #fff;
        color: #333;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 20px;
    }

    .btn-addcart:hover {
        background-color: #333;
        color: #fff;
    }

    .product-details {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-name {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-price {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }

    .discounted-price {
        font-size: 22px;
        font-weight: 700;
        color: #e74c3c;
    }

    .original-price {
        font-size: 16px;
        text-decoration: line-through;
        color: #777;
        margin-left: 10px;
    }

    .regular-price {
        font-size: 22px;
        font-weight: 700;
        color: #333;
    }

    .discount-badge {
        background-color: #e74c3c;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 4px;
        margin-left: auto;
    }

    .btn-buy-now {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: #3498db;
        color: #fff;
        text-align: center;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        margin-top: auto;
    }

    .btn-buy-now:hover {
        background-color: #2980b9;
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
    }

    /* Popup Styles */
    .popup {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .popup-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 400px;
        border-radius: 10px;
        text-align: center;
        position: relative;
    }

    .close-popup {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 15px;
    }

    .close-popup:hover,
    .close-popup:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    #popupMessage {
        font-size: 18px;
        margin-top: 10px;
    }
</style>

<!-- Product Display -->
<div class="container">
    <div class="product-grid">
        <?php while ($row = mysqli_fetch_assoc($result)) {
            $discountPercentage = $row['discount_p'];
            $originalPrice = $row['Price'];
            $discountedPrice = $originalPrice * (1 - $discountPercentage / 100);
            ?>
            <div class="product-card">
                <div class="product-image-container">
                    <img src="images/product/<?php echo htmlspecialchars($row['Img_filename1']); ?>"
                        alt="<?php echo htmlspecialchars($row['Name']); ?>" class="product-image">
                    <div class="product-overlay">
                        <div class="add-to-cart-btn-container">
                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addcart-detail">
                            <div class="icon-header-item js-add-to-cart" data-notify="+"
                                data-productid="<?php echo $row['Product_id']; ?>"
                                    data-productname="<?php echo htmlspecialchars($row['Name']); ?>">
                                    <i class="zmdi zmdi-shopping-cart" ></i>
                                    <!-- <p class="add-to-cart-btn">Add to Cart</p> -->
                                </div>  
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product-details">
                    <h3 class="product-name"><?php echo htmlspecialchars($row['Name']); ?></h3>
                    <div class="product-price">
                        <?php if ($discountPercentage > 0) { ?>
                            <span class="discounted-price">₹<?php echo number_format($discountedPrice, 2); ?></span>
                            <span class="original-price">₹<?php echo number_format($originalPrice, 2); ?></span>
                            <span class="discount-badge"><?php echo $discountPercentage; ?>% OFF</span>
                        <?php } else { ?>
                            <span class="regular-price">₹<?php echo number_format($originalPrice, 2); ?></span>
                        <?php } ?>
                    </div>
                    <a href="single_product_view.php?product_id=<?php echo $row['Product_id']; ?>" class="btn-buy-now">
                        Buy Now
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>