
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>E-Tournament Central</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="ground booking website" name="keywords">
        <meta content="" name="description">s
  <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Bootstrap CSS -->
</head>
<body>
<div class="col-md-3 mb-3">
                        <div class="availability">
                            <a href="javascript:void(0)" class="btn btn-success buynow"><i class="fas fa-shopping-cart me-2 text-primary"></i></a>
                        </div>
                    </div>





  <!-- Optional: Add your creative design elements here -->
    <!-- JavaScript Libraries -->
    <!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- Template Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$(".buynow").click(function(e){
    console.log("works");

    var options = {
        "key": "rzp_test_8qkbYQuLI1liek",
        "amount": 1 * 100,
        "name": "E-Tournament Central",
        "description": "Test Transaction",
        "image": "url(img/logo.png)",
        "handler": function (responses){
            var paymentid = responses.razorpay_payment_id;

            console.log(paymentid);
        },
        "theme": {
            "color": "#3399cc"
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
});
</script>
</body>
</html>
