<?php
include_once 'connection.php';
$sql = "SELECT * FROM product WHERE Availability = 'Instock' OR Availability = 'Available'";
$result = mysqli_query($conn, $sql);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/home.css">
<style>
    a {
        text-decoration: none;
    }

    body {
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        /* Base font size */
    }

    .prod-product-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); */
        margin-bottom: 30px;
        width: max-content !important;
        display: flex;
        flex-direction: column;
    }

    .product_item {
  flex: 1 1 calc(45% - 30px) !important;
  max-width: 91% !important;
    }

    @media (min-width: 768px) {
        .prod-product-card {
            flex-direction: row;
        }
    }

    .prod-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 36px rgba(0, 0, 0, 0.2);
    }

    .prod-product-carousel {
        flex: 1;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .prod-product-info {
        flex: 1;
        padding: 20px;
        text-align: left;
    }

    .prod-product-title {
        font-size: calc(1.5rem + 0.5vw);
        /* Responsive font size */
        font-weight: 700;
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .prod-product-prices {
        display: flex;
        width: 100%;
        justify-content: space-evenly;
        /* margin: 15px 0; */
    }

    .prod-product-prices div {
        text-align: center;
        flex-grow: 1;
        background-color: rgba(255, 255, 255, 0.1);
        margin: 2px;
        border-radius: 5px;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid #f3f3f3;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
    }

    .prod-price {
        font-size: calc(1.05rem + 0.05vw);
        color: #e74c3c;
        font-weight: bold;
    }

    .prod-min-order {
        font-size: calc(0.675rem + 0.1vw);
        color: #7f8c8d;
    }

    .prod-product-description {
        background-color: transparent !important;
        /* padding: 20px; */
        border-radius: 12px;
        font-size: calc(1rem + 0.1vw);
        text-align: left;
        /* margin: 20px 0; */
        text-transform: capitalize;
        line-height: 1.6;
    }

    .prod-quantity {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .prod-quantity input {
        width: 70px;
        text-align: center;
        border: 1px solid #bdc3c7;
        border-radius: 5px;
        margin: 0 10px;
        padding: 10px;
        font-size: calc(1rem + 0.1vw);
        /* Responsive font size */
    }

    .prod-quantity button {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: calc(1rem + 0.1vw);
        /* Responsive font size */
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .prod-quantity button:hover {
        background-color: #2980b9;
    }

    .prod-add-to-cart {
        background-color: #27ae60;
        color: white;
        border: none;
        padding: 15px;
        font-size: calc(1rem + 0.1vw);
        /* Responsive font size */
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
        margin-top: 15px;
        transition: background-color 0.3s;
    }

    .prod-add-to-cart:hover {
        background-color: #229954;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 15px;
    }

    .carousel-indicators button {
        background-color: #3498db;
        border-radius: 50%;
        width: 12px;
        height: 12px;
    }

    .product_item {
        margin: 15px;
        width: max-content;
    }

    .prod-product-info {
        width: max-content;
        padding: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .product_item {
        flex: 1 1 calc(25% - 30px);
        max-width: 30%;
    }

    .prod-product-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 10px;
        text-transform: uppercase;
    }

    .prod-price {
        font-size: 1.25rem;
        color: #e74c3c;
        font-weight: bold;
    }

    .prod-product-description {
        background-color: #ecf0f1;
        padding: 20px;
        border-radius: 12px;
        font-size: calc(1rem + 0.1vw);
        text-align: left;
        margin: 0 0 20px;
        line-height: 1.6;
        width: 100%;
        overflow-y: auto;
        height: 200px;
    }

    /* Webkit browsers (Chrome, Safari) */
    .prod-product-description::-webkit-scrollbar {
        width: 12px;
    }

    .prod-product-description::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 12px;
    }

    .prod-product-description::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 12px;
    }

    .prod-product-description::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Firefox */
    .prod-product-description {
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
    }


    .prod-min-order {
        font-size: 0.875rem;
        color: #7f8c8d;
    }

    .prod-quantity button,
    .prod-add-to-cart {
        background-color: #6ebe70;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 12px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .prod-quantity button:hover {
        background-color: #6ebe70;
    }

    .prod-add-to-cart {
        background-color: transparent;
        border: #229954 2px solid;
        width: 100%;
        color: black;
        margin-top: 15px;
    }

    .prod-add-to-cart:hover {
        color: white;
        background-color: #229954;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 15px;
    }

    .carousel-indicators button {
        background-color: #3498db;
        border-radius: 50%;
        width: 12px;
        height: 12px;
    }

    @media (max-width: 1024px) {
        #products {
            gap: 1rem !important;
            width: 100% !important;
            padding: 0%;
            margin: 0%;
        }

        .product_item {
            flex: 1 1 calc(50% - 30px);
            max-width: 45%;
        }
    }

    @media (max-width: 990px) {
        .product_item {
            flex: 1 1 calc(50% - 30px) !important;
            max-width: 40% !important;
        }

        #products {
            gap: 0.1rem !important;
            width: 100% !important;
            padding: 0%;
            margin: 0%;
        }

        .prod-product-info {
            width: 100%;
            padding: 15px;
        }
    }

    @media (max-width:760px) {
        #products {
            gap: 0.1rem !important;
            width: 100% !important;
            padding: 0%;
            margin: 0%;
        }

        .product_item {
            flex-direction: column;
            flex: 1 1 100% !important;
            max-width: 100% !important;
        }

        .prod-product-info {
            width: 100%;
            padding: 15px;
        }
    }
</style>

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


    <div class="container-fluid container-lg my-5">
        <div class="row justify-content-center ws-products gap-4" id="productss">
            <?php while ($row = mysqli_fetch_assoc($result)) {
                $discountPercentage = $row['discount_p'];
                $originalPrice = $row['Price'];
                $discountedPrice = $originalPrice * (1 - $discountPercentage / 100);
                $productDescription = $row['Description'];
                $productDataJson = $row['w_data']; // JSON data for prices and ranges
                ?>
                <div class="prod-product-card product_item <?php echo $row['Category']; ?> d-flex flex-column flex-lg-row mb-4">
    <div class="prod-product-info d-flex flex-lg-row">
        <img src="images/product/<?php echo $row['Img_filename1']; ?>" alt="IMG-PRODUCT" class="img-fluid product-image">
        <div class="product-details d-flex flex-column">
            <h2 class="prod-product-title js-modal-name-detail"><?php echo $row['Name']; ?></h2>
            <div class="prod-product-description" id="description-<?php echo $row['Product_id']; ?>"></div>
            <div class="prod-product-prices" id="prices-<?php echo $row['Product_id']; ?>"></div>
            <div class="prod-quantity d-flex">
                <button class="prod-quantity-btn minus" aria-label="Decrease quantity">-</button>
                <input type="number" class="js-modal-quantity<?php echo $row['Product_id']; ?>" value="1" min="1" id="quantity-<?php echo $row['Product_id']; ?>">
                <button class="prod-quantity-btn plus" aria-label="Increase quantity">+</button>
            </div>
            <button class="prod-add-to-cart js-addcart-whole-detail" data-productid="<?php echo $row['Product_id']; ?>" data-name="<?php echo $row['Name']; ?>">
                ADD TO CART <i class="zmdi zmdi-shopping-cart"></i>
            </button>
        </div>
    </div>
</div>


                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var descriptionData = <?php echo json_encode($productDescription); ?>;
                        var formattedDescription = '';

                        try {
                            var parsedData = JSON.parse(descriptionData);
                            for (var key in parsedData) {
                                if (parsedData.hasOwnProperty(key)) {
                                    formattedDescription += `<strong>${key}:</strong> ${parsedData[key]}<br>`;
                                }
                            }
                        } catch (e) {
                            console.error('Error parsing JSON description:', e);
                            formattedDescription = 'Invalid description format';
                        }
                        document.getElementById('description-<?php echo $row['Product_id']; ?>').innerHTML = formattedDescription;

                        var productData = <?php echo json_encode($productDataJson); ?>;
                        var priceHtml = '';
                        try {
                            var priceData = JSON.parse(productData);
                            priceHtml += `<div><p class="prod-price">₹${priceData.min_price}</p><p class="prod-min-order">MOQ: ${priceData.min_product} sets</p></div>`;
                            document.getElementById('quantity-<?php echo $row['Product_id']; ?>').value = priceData.min_product;
                            document.getElementById('quantity-<?php echo $row['Product_id']; ?>').min = priceData.min_product;
                            priceData.price_ranges.forEach(range => {
                                priceHtml += `<div><p class="prod-price">₹${range.price}</p><p class="prod-min-order">${range.range_start}-${range.range_end} sets</p></div>`;
                            });
                            priceHtml += `<div><p class="prod-price">₹${priceData.max_price}</p><p class="prod-min-order">≥${priceData.price_ranges[priceData.price_ranges.length - 1].range_end + 1} sets</p></div>`;
                        } catch (e) {
                            console.error('Error parsing JSON data:', e);
                            priceHtml = 'Invalid price data format';
                        }

                        document.getElementById('prices-<?php echo $row['Product_id']; ?>').innerHTML = priceHtml;
                    });
                </script>
            <?php } ?>
        </div>
    </div>


</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Quantity Control Logic
    document.querySelectorAll('.prod-quantity-btn').forEach(button => {
        button.addEventListener('click', function () {
            // Get the ID of the quantity input field
            const inputId = this.parentNode.querySelector('input[type="number"]').id;
            // Fetch the minimum quantity from the HTML attribute
            const min_quantity = parseInt(document.getElementById(inputId).getAttribute('min'), 10);
            const input = this.parentNode.querySelector('input[type="number"]');
            const currentValue = parseInt(input.value, 10);

            if (this.classList.contains('minus')) {
                // Decrease the quantity but ensure it does not go below the minimum
                input.value = currentValue > min_quantity ? currentValue - 1 : min_quantity;
            } else {
                // Increase the quantity
                input.value = currentValue + 1;
            }
        });
    });

</script>