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
        <div id="login-form">
            <center>
                <img src="./images/icons/logo1.png" alt="logo" width="150">
            </center>
            <br>
            <h2 class="text-center pb-4">Login Now</h2>
            <form id="loginForm" novalidate method="post" action="logined.php">
                <div class="form-group">
                    <label for="login-phone">Phone Number</label>
                    <input type="tel" class="form-control" id="login-phone" name="phone" pattern="\d{10}" placeholder="Enter phone number" required>
                    <div class="invalid-feedback">Please enter a valid 10-digit phone number (without +91).</div>
                </div>
                <div class="form-group password-toggle">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Enter password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('login-password')">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/visible.png" alt="Toggle Password Visibility">
                    </span>
                </div>
                <button type="submit" class="btn btn-custom btn-block">Login</button>
                <span class="toggle-link" onclick="toggleForms()">Create a new account</span>
            </form>
        </div>

        <!-- Registration Form -->
        <div id="register-form" class="d-none">
            <center>
                <img src="./images/icons/logo1.png" alt="logo" width="150">
            </center>
            <br>
            <h2 class="text-center">Register</h2>
            <form id="registerForm" novalidate method="post" action="register.php">
                <div class="form-group">
                    <label for="register-name">Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Enter your name" required>
                    <div class="invalid-feedback">Name is required.</div>
                </div>
                <div class="form-group">
                    <label for="register-phone">Phone Number</label>
                    <input type="tel" class="form-control" id="register-phone" name="phone" pattern="\d{10}" placeholder="Enter phone number" required>
                    <div class="invalid-feedback">Please enter a valid 10-digit phone number (without +91).</div>
                </div>
                <div class="form-group password-toggle">
                    <label for="register-password">Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Enter password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('register-password')">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/visible.png" alt="Toggle Password Visibility">
                    </span>
                </div>
                <button type="submit" class="btn btn-custom btn-block">Register</button>
                <span class="toggle-link" onclick="toggleForms()">Already have an account? Login</span>
            </form>
        </div>

        <!-- Success and Error Messages -->
        <div id="successMessage" class="alert alert-success d-none"></div>
        <div id="errorMessage" class="alert alert-danger d-none"></div>
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
