<?php
include_once 'connection.php';
$sql = "SELECT * FROM product WHERE Availability = 'Instock' OR Availability = 'Available'";
$result = mysqli_query($conn, $sql);
?>

<section class="categories">
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <div class="category-grid">
            <?php
            $categories_result = mysqli_query($conn, "SELECT DISTINCT Category FROM product LIMIT 6");
            if ($categories_result) {
                while ($category_row = mysqli_fetch_assoc($categories_result)) {
                    $category = $category_row['Category'];
                    ?>
                    <a href="category.php?category=<?php echo urlencode($category); ?>" class="category-card">
                        <div class="category-icon">
                            <?php
                            // You can customize icons based on category names
                            $icon_class = 'fa-tag'; // default icon
                            switch (strtolower($category)) {
                                case 'electronics':
                                    $icon_class = 'fa-laptop';
                                    break;
                                case 'clothing':
                                    $icon_class = 'fa-tshirt';
                                    break;
                                case 'books':
                                    $icon_class = 'fa-book';
                                    break;
                                case 'home':
                                    $icon_class = 'fa-home';
                                    break;
                                case 'sports':
                                    $icon_class = 'fa-futbol';
                                    break;
                                // Add more cases as needed
                            }
                            ?>
                            <i class="fas <?php echo $icon_class; ?>"></i>
                        </div>
                        <h3><?php echo htmlspecialchars($category); ?></h3>
                    </a>
                    <?php
                }
            } else {
                echo "<p>No categories found.</p>";
            }
            ?>
        </div>
    </div>
</section>