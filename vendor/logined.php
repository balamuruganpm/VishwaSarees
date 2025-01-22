<?php
// Start session to store user's session data
session_start();
include_once 'connection.php'; // Assuming connection.php contains the database connection code

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input data
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Prepare and execute query to fetch user from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, fetch user ID and cart data
            $userId = $row['id'];
            $_SESSION['phone'] = $phone;
            $_SESSION['user_id'] = $userId;

            // Fetch cart data from cart table
            $cartStmt = $conn->prepare("SELECT cart_data FROM cart WHERE user_id = ?");
            $cartStmt->bind_param("i", $userId);
            $cartStmt->execute();
            $cartResult = $cartStmt->get_result();
            
            if ($cartResult && $cartResult->num_rows === 1) {
                $cartRow = $cartResult->fetch_assoc();
                $cartDataFromDB = json_decode($cartRow['cart_data'], true);
            } else {
                $cartDataFromDB = [];
            }

            // Echo JavaScript to fetch cart data from localStorage and merge with database data
            echo "
                <script>
                    // Fetch cart data from localStorage
                    const localCartData = JSON.parse(localStorage.getItem('cart')) || [];

                    // Determine if merging is needed
                    const mergedCartData = localCartData.length === 0 
                        ? mergeCartData(localCartData, " . json_encode($cartDataFromDB) . ")
                        : localCartData;

                    // Update localStorage with merged cart data
                    localStorage.setItem('cart', JSON.stringify(mergedCartData));

                    // Send merged cart data to server to update the database
                    fetch('update-cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ cart_data: mergedCartData })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = 'shoping-cart.php'; // Redirect to shopping cart page
                        } else {
                            alert('Failed to update cart');
                        }
                    });

                    // Function to merge cart data
                    function mergeCartData(localCart, dbCart) {
                        const mergedCart = [...localCart];

                        dbCart.forEach(dbItem => {
                            const existingItemIndex = mergedCart.findIndex(item => item.id === dbItem.id);
                            if (existingItemIndex >= 0) {
                                mergedCart[existingItemIndex].quantity += dbItem.quantity;
                            } else {
                                mergedCart.push(dbItem);
                            }
                        });

                        return mergedCart;
                    }
                </script>
            ";
            exit();
        } else {
            // Password is incorrect
            $_SESSION['error'] = 'Invalid password';
            header("Location: login.php");
            exit();
        }
    } else {
        // User not found
        $_SESSION['error'] = 'User not found';
        header("Location: login.php");
        exit();
    }
} else {
    // Redirect to login page if accessed directly
    header("Location: login.php");
    exit();
}
?>
