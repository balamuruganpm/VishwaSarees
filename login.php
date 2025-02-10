<?php
session_start(); // Start session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded credentials
    $valid_username = "kksaree";
    $valid_password = "1234";

    if ($username === $valid_username && $password === $valid_password) {
        // Set session variable
        $_SESSION['login'] = "Success";
        // Redirect to dashboard.php
        header("Location: index.php");
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
    <title>User Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #3b8d99, #6b7c93);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
            overflow: hidden;
            animation: fadeIn 1s ease-out;
        }

        /* Keyframe for background animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .container {
            max-width: 450px;
            animation: slideIn 1.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-form {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            text-align: center;
            animation: fadeUp 0.7s ease-out;
        }

        /* Keyframe for form fade-in animation */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-form h2 {
            font-weight: 600;
            margin-bottom: 30px;
            color: #fff;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Adding transition effect for form control */
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);
            border: none;
        }

        .btn-primary {
            background-color: #f6a400;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease, transform 0.2s ease;
        }

        /* Hover effect for button */
        .btn-primary:hover {
            background-color: #e68900;
            transform: translateY(-5px) scale(1.05);
        }

        .alert {
            margin-top: 15px;
            font-size: 14px;
            animation: slideInAlert 0.6s ease-out;
        }

        /* Keyframe for alert sliding animation */
        @keyframes slideInAlert {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        label {
            color: #e0e0e0;
            font-weight: 500;
        }

        .form-label {
            text-align: left;
            font-size: 14px;
        }

        .login-form .alert {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-form">
            <h2>User Login</h2>

            <!-- Display Error Message if Any -->
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger show">
                    <strong>Error!</strong> <?= $error_message; ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="login.php" method="POST">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required
                    placeholder="Enter your username">

                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                    placeholder="Enter your password">

                <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>