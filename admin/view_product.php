<?php
// Include the database connection file
include('connection.php');
session_start(); // Start session

// Check if the user is authenticated
if (!isset($_SESSION['login']) || $_SESSION['login'] !== "Success") {
    // Redirect to login page with an error message
    $_SESSION['error_message'] = "Please log in to access this page.";
    header("Location: login.php");
    exit();
}
// Fetch all products initially
$product_query = "SELECT Product_id, Name, Availability, Price, discount_p, Img_filename1, Img_filename2, Img_filename3, Category FROM product";
$product_result = mysqli_query($conn, $product_query);

// Filter by category if selected
$filter = "";
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    $product_query = "SELECT Product_id, Name, Availability, Price, discount_p, Img_filename1, Img_filename2	, Img_filename3, Category FROM product WHERE Category = '$filter'";
    $product_result = mysqli_query($conn, $product_query);
}

// Handle status update via AJAX
if (isset($_POST['update_status'])) {
    $product_id = $_POST['product_id'];
    $new_status = $_POST['new_status'];
    $update_query = "UPDATE product SET Availability = '$new_status' WHERE Product_id = '$product_id'";
    mysqli_query($conn, $update_query);

    echo json_encode(['product_id' => $product_id, 'status' => $new_status]);
    exit;
}

// Handle product deletion via AJAX
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    $delete_query = "DELETE FROM product WHERE Product_id = '$product_id'";
    mysqli_query($conn, $delete_query);
    echo json_encode(['success' => true]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techzaa.in/larkon/admin/product-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 12 Oct 2024 23:50:39 GMT -->
<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <!-- <title>Product Grid | Larkon - Responsive Admin Dashboard Template</title> -->
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="A fully responsive premium admin dashboard template" />
     <meta name="author" content="deva" />
     <title>Vishwa Sarees - Product</title>
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   
     <!-- App favicon -->
     <link rel="shortcut icon" href="assets/images/favicon.ico">

     <!-- Vendor css (Require in all Page) -->
     <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

     <!-- Theme Config js (Require in all Page) -->
     <script src="assets/js/config.js"></script>
         <link href="./cssadmin/all.css" rel="stylesheet" type="text/css" />

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
                            <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">Products View</h4>
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
                            <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle" width="32" src="../images/icons/3.jpg" alt="avatar-3">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome Admin!</h6>
        
                                <a class="dropdown-item text-danger" href="./logout.php">
                                    <i class="bx bx-log-out fs-18 align-middle me-1"></i><span
                                        class="align-middle">Logout</span>
                                </a>
                            </div>
                        </div>
        
                        <!-- App Search-->
                        <form class="app-search d-none d-md-block ms-2">
                            <div class="position-relative">
                                <!-- <input type="search" class="form-control" placeholder="Search..." autocomplete="off" value="">
                                                <iconify-icon icon="solar:magnifer-linear" class="search-widget-icon"></iconify-icon> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Activity Timeline -->
        <div>
            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-activity-offcanvas"
                style="max-width: 450px; width: 100%;">
                <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                    <h5 class="text-white m-0 fw-semibold">Activity Stream</h5>
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
        
                <div class="offcanvas-body p-0">
                    <div data-simplebar class="h-100 p-4">
                        <div class="position-relative ms-2">
                            <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-danger d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><iconify-icon
                                            icon="iconamoon:folder-check-duotone"></iconify-icon></span>
                                    <div class="ms-2">
                                        <h5 class="mb-1 text-dark fw-semibold fs-15 lh-base">Report-Fix / Update </h5>
                                        <p class="d-flex align-items-center">Add 3 files to <span
                                                class=" d-flex align-items-center text-primary ms-1"><iconify-icon
                                                    icon="iconamoon:file-light"></iconify-icon> Tasks</span></p>
                                        <div class="bg-light bg-opacity-50 rounded-2 p-2">
                                            <div class="row">
                                                <div class="col-lg-6 border-end border-light">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="bx bxl-figma fs-20 text-red"></i>
                                                        <a href="#!" class="text-dark fw-medium">Concept.fig</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="bx bxl-file-doc fs-20 text-success"></i>
                                                        <a href="#!" class="text-dark fw-medium">larkon.docs</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="mt-2 text-muted">Monday , 4:24 PM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-success d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><iconify-icon
                                            icon="iconamoon:check-circle-1-duotone"></iconify-icon></span>
                                    <div class="ms-2">
                                        <h5 class="mb-1 text-dark fw-semibold fs-15 lh-base">Project Status
                                        </h5>
                                        <p class="d-flex align-items-center mb-0">Marked<span
                                                class=" d-flex align-items-center text-primary mx-1"><iconify-icon
                                                    icon="iconamoon:file-light"></iconify-icon> Design </span> as <span
                                                class="badge bg-success-subtle text-success px-2 py-1 ms-1"> Completed</span>
                                        </p>
                                        <div class="d-flex align-items-center gap-3 mt-1 bg-light bg-opacity-50 p-2 rounded-2">
                                            <a href="#!" class="fw-medium text-dark">UI/UX Figma Design</a>
                                            <div class="ms-auto">
                                                <a href="#!" class="fw-medium text-primary fs-18" data-bs-toggle="tooltip"
                                                    data-bs-title="Download" data-bs-placement="bottom"><iconify-icon
                                                        icon="iconamoon:cloud-download-duotone"></iconify-icon></a>
                                            </div>
                                        </div>
                                        <h6 class="mt-3 text-muted">Monday , 3:00 PM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-primary d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-16">UI</span>
                                    <div class="ms-2">
                                        <h5 class="mb-1 text-dark fw-semibold fs-15">Larkon Application UI v2.0.0 <span
                                                class="badge bg-primary-subtle text-primary px-2 py-1 ms-1"> Latest</span>
                                        </h5>
                                        <p>Get access to over 20+ pages including a dashboard layout, charts, kanban board,
                                            calendar, and pre-order E-commerce & Marketing pages.</p>
                                        <div class="mt-2">
                                            <a href="#!" class="btn btn-light btn-sm">Download Zip</a>
                                        </div>
                                        <h6 class="mt-3 text-muted">Monday , 2:10 PM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 translate-middle-x bg-success bg-gradient d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><img
                                            src="assets/images/users/avatar-7.jpg" alt="avatar-5"
                                            class="avatar-sm rounded-circle"></span>
                                    <div class="ms-2">
                                        <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Alex Smith Attached Photos
                                        </h5>
                                        <div class="row g-2 mt-2">
                                            <div class="col-lg-4">
                                                <a href="#!">
                                                    <img src="assets/images/small/img-6.jpg" alt="" class="img-fluid rounded">
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                <a href="#!">
                                                    <img src="assets/images/small/img-3.jpg" alt="" class="img-fluid rounded">
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                <a href="#!">
                                                    <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <h6 class="mt-3 text-muted">Monday 1:00 PM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 translate-middle-x bg-success bg-gradient d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><img
                                            src="assets/images/users/avatar-6.jpg" alt="avatar-5"
                                            class="avatar-sm rounded-circle"></span>
                                    <div class="ms-2">
                                        <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Rebecca J. added a new team member
                                        </h5>
                                        <p class="d-flex align-items-center gap-1"><iconify-icon
                                                icon="iconamoon:check-circle-1-duotone" class="text-success"></iconify-icon>
                                            Added a new member to Front Dashboard</p>
                                        <h6 class="mt-3 text-muted">Monday 10:00 AM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-warning d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><iconify-icon
                                            icon="iconamoon:certificate-badge-duotone"></iconify-icon></span>
                                    <div class="ms-2">
                                        <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Achievements
                                        </h5>
                                        <p class="d-flex align-items-center gap-1 mt-1">Earned a <iconify-icon
                                                icon="iconamoon:certificate-badge-duotone"
                                                class="text-danger fs-20"></iconify-icon>" Best Product Award"</p>
                                        <h6 class="mt-3 text-muted">Monday 9:30 AM</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#!" class="btn btn-outline-dark w-100">View All</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar (Theme Settings) -->
        <div>
            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
                <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                    <h5 class="text-white m-0">Theme Settings</h5>
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
        
                <div class="offcanvas-body p-0">
                    <div data-simplebar class="h-100">
                        <div class="p-3 settings-bar">
        
                            <div>
                                <h5 class="mb-3 font-16 fw-semibold">Color Scheme</h5>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-light"
                                        value="light">
                                    <label class="form-check-label" for="layout-color-light">Light</label>
                                </div>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-dark"
                                        value="dark">
                                    <label class="form-check-label" for="layout-color-dark">Dark</label>
                                </div>
                            </div>
        
                            <div>
                                <h5 class="my-3 font-16 fw-semibold">Topbar Color</h5>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-topbar-color"
                                        id="topbar-color-light" value="light">
                                    <label class="form-check-label" for="topbar-color-light">Light</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-dark"
                                        value="dark">
                                    <label class="form-check-label" for="topbar-color-dark">Dark</label>
                                </div>
                            </div>
        
        
                            <div>
                                <h5 class="my-3 font-16 fw-semibold">Menu Color</h5>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-light"
                                        value="light">
                                    <label class="form-check-label" for="leftbar-color-light">
                                        Light
                                    </label>
                                </div>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-dark"
                                        value="dark">
                                    <label class="form-check-label" for="leftbar-color-dark">
                                        Dark
                                    </label>
                                </div>
                            </div>
        
                            <div>
                                <h5 class="my-3 font-16 fw-semibold">Sidebar Size</h5>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-default"
                                        value="default">
                                    <label class="form-check-label" for="leftbar-size-default">
                                        Default
                                    </label>
                                </div>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small"
                                        value="condensed">
                                    <label class="form-check-label" for="leftbar-size-small">
                                        Condensed
                                    </label>
                                </div>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-hidden"
                                        value="hidden">
                                    <label class="form-check-label" for="leftbar-hidden">
                                        Hidden
                                    </label>
                                </div>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-small-hover-active" value="sm-hover-active">
                                    <label class="form-check-label" for="leftbar-size-small-hover-active">
                                        Small Hover Active
                                    </label>
                                </div>
        
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-small-hover" value="sm-hover">
                                    <label class="form-check-label" for="leftbar-size-small-hover">
                                        Small Hover
                                    </label>
                                </div>
                            </div>
        
                        </div>
                    </div>
                </div>
                <div class="offcanvas-footer border-top p-3 text-center">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" id="reset-layout">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->
        
        <!-- ========== App Menu Start ========== -->
        <div class="main-nav">
            <!-- Sidebar Logo -->
            <div class="logo-box">
                <a href="./dashboard.php" class="logo-dark">
                    <img src="../images/icons/logo11.png" class="logo-sm" alt="logo sm">
                    <img src="../images/icons/logo11.png" class="logo-lg" alt="logo dark">
                </a>
        
                <a href="./dashboard.php" class="logo-light">
                    <img src="../images/icons/logo11.png" class="logo-sm" alt="logo sm">
                    <img src="../images/icons/logo11.png" class="logo-lg" alt="logo light">
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
                        <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarProducts">
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
                        <a class="nav-link menu-arrow" href="#sidebarCategory" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarCategory">
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
          <!-- ==================================================== -->
          <!-- Start right Content here -->
          <!-- ==================================================== -->
          <div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row">
                        
                         <div class="col-lg-12">
                              <div class="card bg-light-subtle">
                                   <div class="card-header border-0">
                                        <div class="row justify-content-between align-items-center">
                                             <div class="col-lg-6">
                                         
                                             </div>
                                             <div class="col-lg-6">
                                                  <div class="text-md-end mt-3 mt-md-0 w-100  d-end  d-flex">
                                                        <!-- Filter Dropdown -->
                                                               <div class="filter-dropdown "><div class=". "></div>
                                                                         <form action="" method="GET">
                                                                           <select class="form-select" name="filter" onchange="this.form.submit()">
                                                                                 <option value=""><?php echo $filter ? $filter : 'Select Category'; ?></option>
                                                                                 <option value="Kids">Kids</option>
                                                                                 <option value="Towels">Towels</option>
                                                                                 <option value="Men">Men</option>
                                                                                 <option value="Women">Women</option>
                                                                    </select>
                                                                         </form>
                                                                           </div>

                                                       <a href="./create_product.php" class="btn btn-success me-1 mx-2"><i class="bx bx-plus"></i> New Product</a>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                              <?php if (mysqli_num_rows($product_result) > 0): ?>
        <div class="row">
            <?php while ($product = mysqli_fetch_assoc($product_result)): ?>
                    <?php
                    // Get discount percentage and original price
                    $discountPercentage = $product['discount_p'];
                    $originalPrice = $product['Price'];

                    // Calculate discounted price
                    $discountedPrice = $originalPrice * (1 - $discountPercentage / 100);
                    ?>
                     <div class="col-sm-6 col-md-3 col-lg-3 col-xxl-2 ">
                        <div class="card">
                            <div id="carouselExampleControls_<?php echo $product['Product_id']; ?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-bs-interval="2000">
                                        <img class="d-block w-100" src="../images/product/<?php echo $product['Img_filename1']; ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                                    </div>
                                    <?php if (!empty($product['Img_filename2'])): ?>
                                            <div class="carousel-item" data-bs-interval="2000">
                                                <img class="d-block w-100" src="../images/product/<?php echo $product['Img_filename2']; ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                                            </div>
                                    <?php endif; ?>
                                    <?php if (!empty($product['Img_filename3'])): ?>
                                            <div class="carousel-item" data-bs-interval="2000">
                                                <img class="d-block w-100" src="../images/product/<?php echo $product['Img_filename3']; ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                                            </div>
                                    <?php endif; ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_<?php echo $product['Product_id']; ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_<?php echo $product['Product_id']; ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>

                            <div class="card-body bg-light-subtle rounded-bottom">
                                <a class="text-dark fw-medium fs-16">ID: <?php echo htmlspecialchars($product['Product_id']); ?></a><br>
                                <a class="text-dark fw-medium fs-16" style="text-transform: capitalize;"><?php echo htmlspecialchars($product['Name']); ?></a>
                                <h4 class="fw-semibold text-dark mt-2 d-flex align-items-center gap-2">
                                    <span class="text-muted text-decoration-line-through">₹<?php echo number_format($originalPrice, 2); ?></span>
                                    ₹<?php echo number_format($discountedPrice, 2); ?>
                                </h4>
                                <div class="d-flex gap-2 w-100 justify-content-around align-items-center">
                                        <div class="dropdown">
                                        <a class="text-dark fw-medium fs-16"><small class="text-muted"> (<?php echo $discountPercentage; ?>% Off)</small></a>

                         
                                        </div>
                                        <div class="dropdown">
                                  
                                                <a class="sub-nav-link" class="btn btn-soft-primary border border-primary-subtle"
                                                style="border: 2px solid rgb(255, 106, 0); padding:0.4rem 0.8rem; border-radius:5px; color:  rgb(255, 106, 0);"  href="edit_product.php?id=<?php echo $product['Product_id']; ?>">Edit</a>

               
                                        </div>
                                    </div>
                                <div class="mt-3">
                                    <div class="d-flex gap-2">
                               
                                        <select class="form-select form-status status-dropdown"
                                                data-product-id="<?php echo $product['Product_id']; ?>">
                                            <option value="Available" <?php if ($product['Availability'] == 'Available')
                                                echo 'selected'; ?>>Available</option>
                                            <option value="Out of stock" <?php if ($product['Availability'] == 'Out of stock')
                                                echo 'selected'; ?>>Out of stock</option>
                                        </select>
                               
                                    </div>
                                </div>
                            </div>
                            <span class="position-absolute top-0 end-0 p-3">
                                 <!-- prooduct  delete btn  -->
                                 <button type="button" class="delete-btn btn btn-soft-danger avatar-sm d-inline-flex align-items-center justify-content-center fs-20 rounded-circle" 
                data-product-id="<?php echo $product['Product_id']; ?>"
                data-product-name="<?php echo htmlspecialchars($product['Name']); ?>" 
                data-product-image="<?php echo htmlspecialchars($product['Img_filename1']); ?>"> <!-- Use the first image as example -->
            <iconify-icon icon="ic:baseline-delete-forever"></iconify-icon>
        </button>

                            </span>
                        </div>
                    </div>
            <?php endwhile; ?>
        </div>
<?php else: ?>
        <div class="no-product-row">
            <p>No products available</p>
        </div>
<?php endif; ?>

                               
                                 

                              </div>
                              <!-- Notification Element -->
<div class="notification" id="notification"></div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="productImage" src="" alt="Product Image" class="img-fluid mb-3" style="max-height: 200px; max-width: 100%;">
                <p>Are you sure you want to delete the product <strong id="productName"></strong> (ID: <span id="productId"></span>)? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>


                         

                         </div>
                    </div>

               </div>
               <!-- End Container Fluid -->

               <!-- ========== Footer Start ========== -->
               <!-- ========== Footer End ========== -->

          </div>


     </div>
     <!-- Notification Element -->
<div class="notification" id="notification"></div>
     <!-- END Wrapper -->
     <style>
    /* Style for available options */
    .available {
        border-color: green !important;
        color: green !important;
    }

    /* Style for out of stock options */
    .out-of-stock {
        border-color: red !important;
        color: red !important;
    }

    
</style>
     <!-- Vendor Javascript (Require in all Page) -->
     <script src="assets/js/vendor.js"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="assets/js/app.js"></script>

     <script src="assets/js/pages/product-grid.js"></script>
    <script>
   
       console.log("loaded");
        $(document).ready(function () {
          console.log("loaded");
           

          let productIdToDelete = null;
let productNameToDelete = ""; 
let productImageToDelete = ""; // Variable to hold the product image URL

$('.delete-btn').on('click', function () {
    productIdToDelete = $(this).data('product-id');
    productNameToDelete = $(this).data('product-name');
    productImageToDelete = $(this).data('product-image'); // Add data attribute for image
 // Debugging output to check image URL
 console.log('Image URL:', productImageToDelete);
    // Update the modal content with product info
    $('#productName').text(productNameToDelete);
    $('#productId').text(productIdToDelete);
    $('#productImage').attr('src', '../images/product/'+ productImageToDelete); // Set image source

    $('#deleteModal').modal('show');
});

// Handle delete confirmation
$('#confirmDeleteBtn').on('click', function () {
    if (productIdToDelete) {
        $.ajax({
            url: 'view_product.php',
            type: 'POST',
            data: {
                delete_product: true,
                product_id: productIdToDelete
            },
            success: function (response) {
                const data = JSON.parse(response);
                if (data.success) {
                    $('#deleteModal').modal('hide');
                    location.reload(); // Reload the page
                }
            }
        });
    }
});



            // Handle status dropdown change
            $('.status-dropdown').change(function () {
                const productId = $(this).data('product-id');
                const newStatus = $(this).val();
                $.ajax({
                    url: 'view_product.php',
                    type: 'POST',
                    data: {
                        update_status: true,
                        product_id: productId,
                        new_status: newStatus
                    },
                    success: function (response) {
                        const data = JSON.parse(response);
                        $('#notification').text('Product status updated successfully').fadeIn().delay(2000).fadeOut();
                    }
                });

                // Update styles based on selection
                updateStyles($(this));
            });

            // Function to update styles based on selected options
            function updateStyles(dropdown) {
                const selectedOptions = Array.from(dropdown[0].selectedOptions).map(option => option.value);

                // Reset styles
                dropdown.removeClass('available out-of-stock');

                // Check for availability status
                if (selectedOptions.includes('Available')) {
                    dropdown.addClass('available');
                }
                if (selectedOptions.includes('Out of stock')) {
                    dropdown.addClass('out-of-stock');
                }
            }

            // Initial style update for all dropdowns
            $('.status-dropdown').each(function () {
                updateStyles($(this));
            });
        });
    </script>
<!-- --------------------------------------- -->

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery (for AJAX requests) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
<!-- Mirrored from techzaa.in/larkon/admin/product-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 12 Oct 2024 23:50:39 GMT -->
</html>