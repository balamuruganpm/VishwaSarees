<?php
// Include connection file
include('connection.php');

// Handle Login and Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login_phone']) && isset($_POST['login_password'])) {
        // Login Process
        $phone = $_POST['login_phone'];
        $password = $_POST['login_password'];

        // Query to check user credentials
        $query = "SELECT * FROM users WHERE phone = '$phone'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // Successful login
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['phone'] = $phone;
                header("Location: profile.php"); // Redirect to profile page
                exit();
            } else {
                $loginError = "Invalid phone number or password.";
            }
        } else {
            $loginError = "User not found.";
        }
    } elseif (isset($_POST['register_name']) && isset($_POST['register_phone']) && isset($_POST['register_password'])) {
        // Registration Process
        $name = $_POST['register_name'];
        $phone = $_POST['register_phone'];
        $password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);

        // Check if phone already exists
        $checkQuery = "SELECT * FROM users WHERE phone = '$phone'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) == 0) {
            // Insert new user
            $registerQuery = "INSERT INTO users (name, phone, password) VALUES ('$name', '$phone', '$password')";
            if (mysqli_query($conn, $registerQuery)) {
                $registerSuccess = "Registration successful! You can now log in.";
            } else {
                $registerError = "Registration failed. Please try again.";
            }
        } else {
            $registerError = "Phone number already registered.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vishwa Sarees - Login & Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 110vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-custom {
            background: green !important;
            border: none;
            color: #fff;
            padding: 10px;
            border-radius: 25px;
            transition: background 0.3s;
        }

        .btn-custom:hover {
            background: darkgreen !important;
            color: white !important;
        }

        .toggle-link {
            color: #3498db;
            cursor: pointer;
            text-align: center;
            display: block;
            margin-top: 10px;
            transition: color 0.3s;
        }

        .toggle-link:hover {
            color: #2980b9;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle .toggle-password {
            position: absolute;
            top: 70%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .alert {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container animate__animated animate__fadeIn">
        <!-- Login Form -->
        <div id="login-form" class="form-section">
            <center>
                <img src="./images/icons/logo1.png" alt="logo" width="150">
            </center>
            <br>
            <h2 class="text-center pb-4">Login Now</h2>
            <form method="post" action="index.php">
                <div class="form-group">
                    <label for="login-phone">Phone Number</label>
                    <input type="tel" class="form-control" id="login-phone" name="login_phone" pattern="\d{10}" placeholder="Enter phone number" required>
                    <div class="invalid-feedback">Please enter a valid 10-digit phone number (without +91).</div>
                </div>
                <div class="form-group password-toggle">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password" name="login_password" placeholder="Enter password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('login-password')">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/visible.png" alt="Toggle Password Visibility">
                    </span>
                </div>
                <button type="submit" class="btn btn-custom btn-block">Login</button>
                <span class="toggle-link" onclick="toggleForms()">Create a new account</span>
            </form>
            <?php if (isset($loginError)) {
                echo "<div class='alert alert-danger'>$loginError</div>";
            } ?>
        </div>

        <!-- Registration Form -->
        <div id="register-form" class="form-section d-none">
            <center>
                <img src="./images/icons/logo1.png" alt="logo" width="150">
            </center>
            <br>
            <h2 class="text-center">Register</h2>
            <form method="post" action="checkout.php">
                <div class="form-group">
                    <label for="register-name">Name</label>
                    <input type="text" class="form-control" id="register-name" name="register_name"
                        placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="register-phone">Phone Number</label>
                    <input type="tel" class="form-control" id="register-phone" name="register_phone" pattern="\d{10}"
                        placeholder="Enter phone number" required>
                    <div class="invalid-feedback">Please enter a valid 10-digit phone number (without +91).</div>
                </div>
                <div class="form-group password-toggle">
                    <label for="register-password">Password</label>
                    <input type="password" class="form-control" id="register-password" name="register_password"
                        placeholder="Enter password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('register-password')">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/visible.png"
                            alt="Toggle Password Visibility">
                    </span>
                </div>
                <button type="submit" class="btn btn-custom btn-block">Register</button>
                <span class="toggle-link" onclick="toggleForms()">Already have an account? Login</span>
            </form>
            <?php if (isset($registerSuccess)) {
                echo "<div class='alert alert-success'>$registerSuccess</div>";
            } ?>
            <?php if (isset($registerError)) {
                echo "<div class='alert alert-danger'>$registerError</div>";
            } ?>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Switch between login and registration forms
        function toggleForms() {
            $('#login-form').toggleClass('d-none');
            $('#register-form').toggleClass('d-none');
        }

        // Toggle password visibility
        function togglePasswordVisibility(passwordFieldId) {
            const passwordField = document.getElementById(passwordFieldId);
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
