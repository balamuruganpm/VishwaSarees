<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
            background: #3498db;
            border: none;
            color: #fff;
            padding: 10px;
            border-radius: 25px;
            transition: background 0.3s;
        }

        .btn-custom:hover {
            background: #2980b9;
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

        .message {
            margin-top: 15px;
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

        .password-toggle {
            position: relative;
        }

        .password-toggle .toggle-password {
            position: absolute;
            top: 70%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .password-toggle .toggle-password img {
            width: 20px;
            height: 20px;
            filter: grayscale(100%) contrast(1.5) brightness(0.8);
        }

        .password-toggle .toggle-password:hover {
            background-color: #e1e1e1;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container animate__animated animate__fadeIn">
        <!-- Login Form -->
        <div id="login-form">
            <h2 class="text-center">Login</h2>
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
                    <div class="invalid-feedback">Password is required.</div>
                </div>
                <button type="submit" class="btn btn-custom btn-block">Login</button>
                <span class="toggle-link" onclick="toggleForms()">Create a new account</span>
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>

        <!-- Registration Form -->
        <div id="register-form" class="d-none">
            <h2 class="text-center">Register</h2>
            <form id="registerForm" novalidate>
                <div class="form-group">
                    <label for="register-name">Name</label>
                    <input type="text" class="form-control" id="register-name" placeholder="Enter your name" required>
                    <div class="invalid-feedback">Name is required.</div>
                </div>
                <div class="form-group">
                    <label for="register-phone">Phone Number</label>
                    <input type="tel" class="form-control" id="register-phone" pattern="\d{10}" placeholder="Enter phone number" required>
                    <div class="invalid-feedback">Please enter a valid 10-digit phone number (without +91).</div>
                </div>
                <div id="recaptcha-container"></div>
                <button type="button" class="btn btn-custom btn-block" onclick="sendVerificationCode()">Send Verification Code</button>
                <div class="form-group d-none" id="verification-code-group">
                    <label for="verification-code">Verification Code</label>
                    <input type="text" class="form-control" id="verification-code" placeholder="Enter verification code" required>
                    <div class="invalid-feedback">Please enter the verification code.</div>
                    <button type="button" class="btn btn-custom btn-block" onclick="verifyCode()">Verify Code</button>
                </div>
                <div class="form-group password-toggle">
                    <label for="register-password">Password</label>
                    <input type="password" class="form-control" id="register-password" placeholder="Enter password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('register-password')">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/visible.png" alt="Toggle Password Visibility">
                    </span>
                    <div class="invalid-feedback">Password is required.</div>
                </div>
                <div class="form-group password-toggle">
                    <label for="register-confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" placeholder="Confirm password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('register-confirm-password')">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/visible.png" alt="Toggle Password Visibility">
                    </span>
                    <div class="invalid-feedback">Please confirm your password.</div>
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
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-auth-compat.js"></script>
    
    <script>
        // Firebase configuration
        const firebaseConfig = {
  apiKey: "AIzaSyC8JfURlEBrJA9B-b9SfgQ651oeVIiqST4",
  authDomain: "yuginiistores.firebaseapp.com",
  projectId: "yuginiistores",
  storageBucket: "yuginiistores.appspot.com",
  messagingSenderId: "755890552344",
  appId: "1:755890552344:web:d0656415aa690677e44d6d",
  measurementId: "G-KP1WENXFTD"
};

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        let recaptchaVerifier;
        let isOtpVerified = false;

        window.onload = function() {
            recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'invisible',
                'callback': function(response) {
                    // reCAPTCHA solved - will proceed with submit function
                    sendVerificationCode();
                },
                'expired-callback': function() {
                    // Handle expired reCAPTCHA
                    grecaptcha.reset(window.recaptchaWidgetId);
                }
            });

            recaptchaVerifier.render().then(function(widgetId) {
                window.recaptchaWidgetId = widgetId;
            });
        };

        function sendVerificationCode() {
            const phoneNumber = "+91" + document.getElementById('register-phone').value;
            const appVerifier = recaptchaVerifier;

            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then(function(confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    document.getElementById('verification-code-group').classList.remove('d-none');
                }).catch(function(error) {
                    showMessage("errorMessage", "Error sending verification code. Please try again.");
                });
        }

        function verifyCode() {
            const code = document.getElementById('verification-code').value;

            confirmationResult.confirm(code).then(function(result) {
                const user = result.user;
                isOtpVerified = true;
                showMessage("successMessage", "Phone number verified successfully!");
                document.getElementById('verification-code-group').classList.add('d-none');
            }).catch(function(error) {
                showMessage("errorMessage", "Invalid verification code. Please try again.");
            });
        }

        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = passwordInput.nextElementSibling.querySelector('img');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.src = "https://img.icons8.com/ios-glyphs/30/000000/invisible.png";
            } else {
                passwordInput.type = "password";
                passwordIcon.src = "https://img.icons8.com/ios-glyphs/30/000000/visible.png";
            }
        }

        function toggleForms() {
            document.getElementById('login-form').classList.toggle('d-none');
            document.getElementById('register-form').classList.toggle('d-none');
        }

        function showMessage(id, message) {
            const messageElement = document.getElementById(id);
            messageElement.textContent = message;
            messageElement.classList.remove('d-none');
            setTimeout(function() {
                messageElement.classList.add('d-none');
            }, 5000);
        }

        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            if (this.checkValidity()) {
                this.submit();
            } else {
                this.classList.add('was-validated');
            }
        });

        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();
            if (this.checkValidity() && isOtpVerified) {
        await storeRegistrationData();
                showMessage("successMessage", "Registration successful!");
            } else {

                this.classList.add('was-validated');
                if (!isOtpVerified) {
                    showMessage("errorMessage", "Please verify your phone number first.");
                }
            }
        });

        async function storeRegistrationData() {
    const name = document.getElementById('register-name').value;
    const phone = document.getElementById('register-phone').value;
    const password = document.getElementById('register-password').value;

    try {
        const response = await fetch('register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: name,
                phone: phone,
                password: password
            })
        });

        const result = await response.json();
        if (result.success) {
            showSuccessMessage("Registration successful!");
            toggleForms();
        } else {
            showErrorMessage("Registration failed: " + result.message);
        }
    } catch (error) {
        showErrorMessage("An error occurred: " + error.message);
    }
}
    </script>
</body>
</html>
