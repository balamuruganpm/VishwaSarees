<!-- php data update -->

<?php
// Include the database connection file
include('connection.php');
session_start(); // Start session

// Check if the user is authenticated
if (!isset($_SESSION['login']) || $_SESSION['login'] !== "Success") {
    $_SESSION['error_message'] = "Please log in to access this page.";
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate required fields
    if (empty($_POST['name']) || empty($_POST['price']) || empty($_POST['category'])) {
        echo "<script>alert('Name, Price, and Category are required fields.');</script>";
        exit();
    }

    // Sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $discount_percentage = floatval($_POST['discount_percentage']);

    // Process descriptions
    $description_array = [];
    if (isset($_POST['description_title'])) {
        foreach ($_POST['description_title'] as $index => $title) {
            $value = $_POST['description_value'][$index];
            if (!empty($title) || !empty($value)) {
                $description_array[$title] = $value;
            }
        }
    }
    $description_json = json_encode($description_array);

    // Calculate the new discount price
    $discount_price = $price - ($price * $discount_percentage / 100);

    // Create product directory path
    $directory = "../images/product/" . $category . "/" . $name;
    $directory1 = $category . "/" . $name;

    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }

    // Handle image uploads with error handling
    $uploaded_images = [];
    for ($i = 1; $i <= 6; $i++) {
        $img_name = "img{$i}";
        $img_path = "$directory/$i.png";
        $db_path = "$directory1/$i.png";

        if (isset($_FILES[$img_name]) && $_FILES[$img_name]['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $img_path)) {
                $uploaded_images[] = $db_path;
            } else {
                echo "<script>alert('Failed to upload image $i');</script>";
                exit();
            }
        } else {
            $uploaded_images[] = ''; // Store empty path if no image uploaded
        }
    }

    // Insert data into the database using a prepared statement
    $insert_query = "INSERT INTO product 
        (Name, Description, Price, Img_filename1, Img_filename2, Img_filename3, Img_filename4, Img_filename5, Img_filename6, 
         Category, discount_p, Availability) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Available')";

    $stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($stmt, 'ssdssssssss', 
        $name, $description_json, $price, 
        $uploaded_images[0], $uploaded_images[1], $uploaded_images[2], 
        $uploaded_images[3], $uploaded_images[4], $uploaded_images[5], 
        $category, $discount_percentage
    );

    if (mysqli_stmt_execute($stmt)) {
     // Get product details (name and image path)
     $product_name = $name;
     $product_image = $uploaded_images[0];  // Assuming img1 is the primary product image
     
     echo "
     <script>
         document.addEventListener('DOMContentLoaded', function () {
             showSuccessModal('$product_name', '$product_image');
         });
     </script>
     ";
 } else {
     echo "<script>alert('Error creating product: " . mysqli_error($conn) . "');</script>";
 }
 
    mysqli_stmt_close($stmt); // Close statement
    mysqli_close($conn); // Close connection  
}
?>




<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techzaa.in/larkon/admin/product-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 12 Oct 2024 23:50:40 GMT -->
<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>Create Product | Larkon - Responsive Admin Dashboard Template</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="A fully responsive premium admin dashboard template" />
     <meta name="author" content="Techzaa" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <!-- App favicon -->
     <link rel="shortcut icon" href="assets/images/favicon.ico">

     <!-- Vendor css (Require in all Page) -->
     <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
     
     <!-- style link -->
                    <link rel="stylesheet" href="./cssadmin/create_product.css">k
     <!-- Theme Config js (Require in all Page) -->
     <script src="assets/js/config.js"></script>
     ] <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .marg{
          /* background-color: #ff6600; */
          border: 10px solid black;
          display: flex;
          width: 100%;


     }
     .upload-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around; /* Distribute space evenly */
        }
        .file-upload-wrapper {
            border: 2px dashed orangered;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            position: relative;
            margin: 10px;
            width: 200px; /* Set a fixed width for the upload area */
        }
        .file-upload-text {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .file-upload-input {
            display: none; /* Hide the default file input */
        }
        .preview-image {
            width: 100%;
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
        .remove-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 0.8rem;
            cursor: pointer;
            margin-top: 10px;
            display: none; /* Initially hidden */
        }
        .description-group{
          display: flex;
          margin: 1rem 0;
          gap: 1rem;
        }
        #description_container{
          display: flex;
          flex-direction: column !important;
        }
        .discount-container{
          width: 23rem;
          margin-left: 10rem;
        }
        .description-group{
flex-wrap: nowrap;

        }
     .form-range::-moz-range-track{
          background-color:#6d6562;
     }
     #add_description{
          float: right !important;
     }
     #price-container{
          display: flex;
          align-items: center;
          justify-content: center;

     }
     .of{
          width: 50%;
     }
     .select-input{
          width: 100%;
     }
     .modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: transparent;
    z-index: 1000;
    /* border: 2px solid white; */
    width: 30rem;
    max-width: 90%;
    height: max-content;
}
.modal-content{
     border: 2px solid gray;
}
.modal-dialog {
    padding: 20px;
  
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    padding-top: 10px;
}
.btn-y{
     background-color: white;
     color: gray;
}
.modal .btn-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

    </style>

</head>


<body>

     <!-- START Wrapper -->
     <div class="wrapper">

          <!-- ========== Topbar Start ========== -->
          <header class="topbar">
               <div class="container-fluid">
                    <div class="navbar-header">
                         <div class="d-flex align-items-center">
                              <!-- Menu Toggle Button -->
                              <div class="topbar-item">
                                   <button type="button" class="button-toggle-menu me-2">
                                        <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                                   </button>
                              </div>

                              <!-- Menu Toggle Button -->
                              <div class="topbar-item">
                                   <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">product create</h4>
                              </div>
                         </div>

                         <div class="d-flex align-items-center gap-1">

                              <!-- Theme Color (Light/Dark) -->
                              <div class="topbar-item">
                                   <button type="button" class="topbar-button" id="light-dark-mode">
                                        <iconify-icon icon="solar:moon-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                                   </button>
                              </div>
                                  <!-- Notification -->
                    <div id="notification" class="notification">
                         <i class="fas fa-check-circle"></i> <span id="notificationText"></span>
                    </div>


                              <!-- User -->
                              <div class="dropdown topbar-item">
                                   <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="d-flex align-items-center">
                                             <img class="rounded-circle" width="32" src="../images/icons/3.png" alt="avatar-3">
                                        </span>
                                   </a>
                                   <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <h6 class="dropdown-header">Welcome Admin!</h6>

                                        <a class="dropdown-item " style="background-color: black; color:red;" href="./logout.php">
                                             <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Logout</span>
                                        </a>
                                   </div>
                              </div>

                              <!-- App Search-->
                              <form class="app-search d-none d-md-block ms-2">
                                   <div class="position-relative">
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </header>

          <!-- ========== App Menu Start ========== -->
          <div class="main-nav">
               <!-- Sidebar Logo -->
               <div class="logo-box">
                    <a href="./dashboard.php" class="logo-dark">
                         <img src="../images/icons/logo.jpg" class="logo-sm" alt="logo sm">
                         <img src="../images/icons/LOGOIMG.png"  class="logo-lg" alt="logo dark">
                    </a>

                    <a href="./dashboard.php" class="logo-light">
                         <img src="../images/icons/logo.jpg" class="logo-sm" alt="logo sm">
                         <img src="../images/icons/LOGOIMG.png" class="logo-lg" alt="logo light">
                    </a>
               </div>

               <!-- Menu Toggle Button (sm-hover) -->
               <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                    <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
               </button>

               <div class="scrollbar" data-simplebar>
                    <ul class="navbar-nav" id="navbar-nav">

                         <li class="menu-title">General</li>

                         <li class="nav-item">
                              <a class="nav-link" href="./dashboard.php">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Dashboard </span>
                              </a>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Products </span>
                              </a>
                              <div class="collapse" id="sidebarProducts">
                                   <ul class="nav sub-navbar-nav">
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link" href="./view_product.php">View</a>
                                        </li>
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link" href="create_product.php">Create</a>
                                        </li>
                                   </ul>
                              </div>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link menu-arrow" href="#sidebarCategory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCategory">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Category </span>
                              </a>
                              <div class="collapse" id="sidebarCategory">
                                   <ul class="nav sub-navbar-nav">
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link" href="./getdata.php">Get Statement</a>
                                        </li>                         
                                   </ul>
                              </div>
                 
                       </ul>
               </div>
          </div>

<div id="successModal" class="modal" tabindex="-1" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Created Successfully!</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <p id="productMessage"></p>
                <img id="productImage" src="" alt="Product Image" style="width: 100%; height: auto;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-y" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-primary" onclick="viewModal()">View</button>
            </div>
        </div>
    </div>
</div>

           <div class="form-container" style="margin-left: auto;">
    <form action="create_product.php" method="POST" enctype="multipart/form-data">
        <div class="page-content">
            <div class="container-xxl">
                <div class="upload-container">
                    <!-- Image Upload Section -->
                    <?php for ($i = 1; $i <= 6; $i++): ?>
                        <div class="file-upload-wrapper" onclick="document.getElementById('imageUpload<?= $i ?>').click();"
                             ondragover="event.preventDefault();"
                             ondrop="dropHandler(event, 'imageUpload<?= $i ?>')">
                            <div class="file-upload-text">
                                <i class="fas fa-cloud-upload-alt"></i> Upload Image <?= $i ?>
                            </div>
                            <input type="file" id="imageUpload<?= $i ?>" name="img<?= $i ?>" 
                                   class="file-upload-input" accept="image/*"
                                   onchange="previewImage(event, 'imagePreview<?= $i ?>', 'removeBtn<?= $i ?>')" required>
                            <img id="imagePreview<?= $i ?>" class="preview-image" alt="Image Preview" style="display:none;">
                            <button id="removeBtn<?= $i ?>" class="remove-btn" 
                                    onclick="removeImage(event, 'imageUpload<?= $i ?>', 'imagePreview<?= $i ?>', 'removeBtn<?= $i ?>')">
                                Remove Image
                            </button>
                        </div>
                    <?php endfor; ?>
                </div>

                <!-- Product Details -->
                <div class="mb-3 container">
                    <div class="col-lg-6 my-2">
                        <label for="category" class="form-label">Product Categories</label>
                        <select class="form-control form-select" id="category" name="category" required>
                            <option value="">Choose a category</option>
                            <option value="Kids">Kids</option>
                            <option value="Women">Women</option>
                            <option value="Men">Men</option>
                            <option value="Towels">Towels</option>
                        </select>
                    </div>

                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>

                    <label for="price" class="form-label my-2">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>

                    <label for="discount_percentage" class="form-label my-2">Discount Percentage</label>
                    <input type="range" class="form-range" id="discount_percentage" name="discount_percentage" 
                           min="0" max="100" onchange="updateDiscountPrice()">
                    <span id="percentage_display"></span>
                    <span id="discount_price"></span>
                </div>

                <!-- Dynamic Descriptions Section -->
                <div id="description_container" class="container mb-3" style="display: flex; flex-direction: column;">
                    <div class="row mb-2 align-items-center">
                        <div class="col-5">
                            <select class="form-control select-input" name="description_title[]">
                                <?php
                                $options = ["Brand", "Colour", "Size", "Weight", "Usage/Application ", "Material", 
                                            "Design Pattern", "Shape", "Country of Origin", 
                                            "Comfort and Usage", "Wash Care", "Description"];
                                foreach ($options as $option) {
                                    echo "<option value=\"$option\">$option</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control select-input" name="description_value[]" 
                                   placeholder="Enter value">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-delete btn-danger" onclick="removeDescription(this)">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" id="add_description" class="btn btn-primary mx-5" onclick="addDescription()">
                    <i class="fas fa-plus"></i> Add Description
                </button>

                <button type="submit" class="btn btn-primary w-50 mx-10" style="margin-top: 3rem; margin-left: 10rem;">
                    Create Product
                </button>
            </div>
        </div>
    </form>
</div>
          <!-- ==================================================== -->
          <!-- End Page Content -->
          <!-- ==================================================== -->


     </div>
     <!-- END Wrapper -->

     <!-- Vendor Javascript (Require in all Page) -->
     <script src="assets/js/vendor.js"></script>
<!-- ----------c++--------------- -->
     <!-- App Javascript (Require in all Page) -->
     <script src="assets/js/app.js"></script>

     <script>
    // Add a new description row
    function addDescription() {
        const container = document.getElementById('description_container');
        const row = document.createElement('div');
        row.className = 'row mb-2 align-items-center';
        row.innerHTML = `
            <div class="col-5">
                <select class="form-control select-input" name="description_title[]">
                    <option value="Brand">Brand</option>
                    <option value="Color">Color</option>
                    <option value="Size">Size</option>
                    <option value="Weight">Weight</option>
                    <option value="Usage/Application">Usage/Application</option>
                    <option value="Material">Material</option>
                    <option value="Design/Pattern">Design/Pattern</option>
                    <option value="Shape">Shape</option>
                    <option value="Country of Origin">Country of Origin</option>
                    <option value="COMFORT AND USAGE">COMFORT AND USAGE</option>
                    <option value="Wash Care">Wash Care</option>
                    <option value="Description">Description</option>
                </select>
            </div>
            <div class="col-4">
                <input type="text" class="form-control select-input" name="description_value[]" placeholder="Enter value">
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-delete btn-danger" onclick="removeDescription(this)">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
        `;
        container.appendChild(row);
    }

    // Remove a description row
    function removeDescription(button) {
        button.closest('.row').remove();
    }
</script> 
     <script>
    
    const descriptionContainer = document.getElementById('description_container');
    const addDescriptionButton = document.getElementById('add_description');


    // Function to handle delete buttons
    function attachDeleteEvent(deleteButton) {
        deleteButton.addEventListener('click', (event) => {
            event.target.closest('.description-group').remove();
        });
    }
                         document.getElementById('description_container').addEventListener('click', function (e) {
                              if (e.target.classList.contains('btn-delete') || e.target.closest('.btn-delete')) {
                                   e.target.closest('.description-group').remove();
                              }
                         });

                         function updateDiscountPrice() {
                              var price = parseFloat(document.getElementById('price').value);
                              var discountPercentage = parseFloat(document.getElementById('discount_percentage').value);
                              var discountPrice = price - (price * discountPercentage / 100);
                              
                              document.getElementById('percentage_display').textContent = discountPercentage + '%';
                              document.getElementById('discount_price').textContent = 'Discount price: ₹' + discountPrice.toFixed(2);
                         }
</script>


  <script>
          //     image upload section javascript 
         
          function dropHandler(event, inputId) {
        event.preventDefault();
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            const fileInput = document.getElementById(inputId);
            fileInput.files = files; // Assign dropped files to the input
            previewImage({ target: fileInput }, inputId); // Trigger image preview
        }
    }

    function previewImage(event, previewId, removeBtnId) {
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);
        const removeBtn = document.getElementById(removeBtnId);

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result; // Set the preview image source
                preview.style.display = 'block'; // Show the image
                removeBtn.style.display = 'inline-block'; // Show remove button
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage(event, inputId, previewId, removeBtnId) {
        event.stopPropagation(); // Prevent triggering the click event on the wrapper
        const fileInput = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const removeBtn = document.getElementById(removeBtnId);

        fileInput.value = ''; // Clear the file input
        preview.src = ''; // Clear the preview image source
        preview.style.display = 'none'; // Hide the image
        removeBtn.style.display = 'none'; // Hide the remove button
    }

    function showSuccessModal(productName, productImage) {
    // Set the product name and image in the modal
    document.getElementById('productMessage').textContent = `Product "${productName}" was created successfully!`;
    document.getElementById('productImage').src = "../images/product/" + productImage;

    // Show the modal
    document.getElementById('successModal').style.display = 'block';
}
function resetForm() {
    // Reset all input fields
    document.querySelector('form').reset();

    // Clear image previews and hide remove buttons
    for (let i = 1; i <= 6; i++) {
        const imagePreview = document.getElementById(`imagePreview${i}`);
        const removeBtn = document.getElementById(`removeBtn${i}`);

        imagePreview.style.display = 'none';
        imagePreview.src = ''; // Clear the image source
        removeBtn.style.display = 'none';
    }

    // Clear discount and percentage display
    document.getElementById('discount_percentage').value = 0;
    document.getElementById('percentage_display').textContent = '';
    document.getElementById('discount_price').textContent = '';

    // Clear dynamically added descriptions
    const descriptionContainer = document.getElementById('description_container');
    descriptionContainer.innerHTML = ''; // Remove all dynamic rows
}

// Optionally, call this function after form submission
document.querySelector('form').addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent form submission for testing
    resetForm(); // Reset form after submission (remove this if you don't want automatic reset)
    alert('Form has been reset!');
});

function viewModal() {
    // Hide the modal
    document.getElementById('successModal').style.display = 'none';
    window.location.href = "view_product.php";  // Change to your desired page
    resetForm();

}
function closeModal() {
    // Hide the modal
    document.getElementById('successModal').style.display = 'none';
    // Optionally, redirect to another page or refresh
    resetForm();
}


</script>




</body>


<!-- Mirrored from techzaa.in/larkon/admin/product-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 12 Oct 2024 23:50:40 GMT -->
</html>