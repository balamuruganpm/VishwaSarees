<?php
include_once 'connection.php';
$sql = "SELECT * FROM products WHERE featured = 1 LIMIT 4"; // Adjust the query as needed
$result = mysqli_query($conn, $sql);
?>

<section class="featured-products">
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="featured-grid">
            <?php
            $featured_result = mysqli_query($conn, "SELECT * FROM products WHERE featured = 1 LIMIT 4"); // Adjust the query as needed
            while ($featured_row = mysqli_fetch_assoc($featured_result)) {
                ?>
                <div class="featured-card">
                    <img src="images/product/<?php echo htmlspecialchars($featured_row['Img_filename1']); ?>"
                        alt="<?php echo htmlspecialchars($featured_row['Name']); ?>" class="featured-image">
                    <div class="featured-details">
                        <h3><?php echo htmlspecialchars($featured_row['Name']); ?></h3>
                        <p class="featured-price">₹<?php echo number_format($featured_row['Price'], 2); ?></p>
                        <a href="single_product_view.php?product_id=<?php echo $featured_row['Product_id']; ?>"
                            class="btn-featured">
                            View Product
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>