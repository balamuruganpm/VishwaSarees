<?php
session_start(); // Start session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded credentials
    $valid_username = "yuginii";
    $valid_password = "1234";

    if ($username === $valid_username && $password === $valid_password) {
        // Set session variable
        $_SESSION['login'] = "Success";
        // Redirect to dashboard.php
        header("Location: dashboard.php");
        exit();
    } else {
        // Set error message
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #121212;
            background: url('../images/1.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Montserrat', sans-serif;
            color: #fff;
            display: flex; /* Use flexbox for centering */
            justify-content: center; /* Horizontally center */
            align-items: center; /* Vertically center */
            min-height: 100vh; /* Ensure the body takes up the full viewport height */
            margin: 0; /* Remove default body margin */
        }

        .container {
            justify-content: center;
            align-items: center;
            max-width: 400px;
            margin-top: 100px;
        }

        .login-form {
            background-color: #1f1f1fbf;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .login-form .form-control {
            background-color: #343a40;
            color: #fff;
            border: none;
            margin-bottom: 15px;
        }

        .login-form .form-control:focus {
            background-color: #495057;
            color: #fff;
            border: none;
            box-shadow: none;
        }

        .login-form .form-label {
            color: #fff;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        .alert {
            display: none;
            margin-top: 15px;
        }

        .alert.show {
            display: block;
        }

        .alert-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .alert-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-form">
            <h2 class="text-center">Admin Login</h2>

            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger show">
                    <strong>Error!</strong> <?= $error_message; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>