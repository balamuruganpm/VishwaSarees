(function ($) {
  "use strict";
  // Function to get cart item count from local storage
  function getCartItemCount() {
    let cart = JSON.parse(localStorage.getItem("cart"));
    if (cart) {
      return cart.length;
    }
    return 0;
  }
  // Function to update the data-notify attribute
  function updateCartNotification() {
    const cartItemCount = getCartItemCount();
    document
      .querySelector(".js-show-cart")
      .setAttribute("data-notify", cartItemCount);
  }
  updateCartNotification();

  /*[ Load page ]
        ===========================================================*/
  $(".animsition").animsition({
    inClass: "fade-in",
    outClass: "fade-out",
    inDuration: 1500,
    outDuration: 800,
    linkElement: ".animsition-link",
    loading: true,
    loadingParentElement: "html",
    loadingClass: "animsition-loading-1",
    loadingInner: '<div class="loader05"></div>',
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: ["animation-duration", "-webkit-animation-duration"],
    overlay: false,
    overlayClass: "animsition-overlay-slide",
    overlayParentElement: "html",
    transition: function (url) {
      window.location.href = url;
    },
  });

  /*[ Back to top ]
        ===========================================================*/
  var windowH = $(window).height() / 2;

  $(window).on("scroll", function () {
    if ($(this).scrollTop() > windowH) {
      $("#myBtn").css("display", "flex");
    } else {
      $("#myBtn").css("display", "none");
    }
  });

  $("#myBtn").on("click", function () {
    $("html, body").animate({ scrollTop: 0 }, 300);
  });

  /*==================================================================
        [ Fixed Header ]*/
  var headerDesktop = $(".container-menu-desktop");
  var wrapMenu = $(".wrap-menu-desktop");

  if ($(".top-bar").length > 0) {
    var posWrapHeader = $(".top-bar").height();
  } else {
    var posWrapHeader = 0;
  }

  if ($(window).scrollTop() > posWrapHeader) {
    $(headerDesktop).addClass("fix-menu-desktop");
    $(wrapMenu).css("top", 0);
  } else {
    $(headerDesktop).removeClass("fix-menu-desktop");
    $(wrapMenu).css("top", posWrapHeader - $(this).scrollTop());
  }

  $(window).on("scroll", function () {
    if ($(this).scrollTop() > posWrapHeader) {
      $(headerDesktop).addClass("fix-menu-desktop");
      $(wrapMenu).css("top", 0);
    } else {
      $(headerDesktop).removeClass("fix-menu-desktop");
      $(wrapMenu).css("top", posWrapHeader - $(this).scrollTop());
    }
  });

  /*==================================================================
        [ Menu mobile ]*/
  $(".btn-show-menu-mobile").on("click", function () {
    $(this).toggleClass("is-active");
    $(".menu-mobile").slideToggle();
  });

  var arrowMainMenu = $(".arrow-main-menu-m");

  for (var i = 0; i < arrowMainMenu.length; i++) {
    $(arrowMainMenu[i]).on("click", function () {
      $(this).parent().find(".sub-menu-m").slideToggle();
      $(this).toggleClass("turn-arrow-main-menu-m");
    });
  }

  $(window).resize(function () {
    if ($(window).width() >= 992) {
      if ($(".menu-mobile").css("display") == "block") {
        $(".menu-mobile").css("display", "none");
        $(".btn-show-menu-mobile").toggleClass("is-active");
      }

      $(".sub-menu-m").each(function () {
        if ($(this).css("display") == "block") {
          console.log("hello");
          $(this).css("display", "none");
          $(arrowMainMenu).removeClass("turn-arrow-main-menu-m");
        }
      });
    }
  });

  /*==================================================================
        [ Show / hide modal search ]*/
  $(".js-show-modal-search").on("click", function () {
    $(".modal-search-header").addClass("show-modal-search");
    $(this).css("opacity", "0");
  });

  $(".js-hide-modal-search").on("click", function () {
    $(".modal-search-header").removeClass("show-modal-search");
    $(".js-show-modal-search").css("opacity", "1");
  });

  $(".container-search-header").on("click", function (e) {
    e.stopPropagation();
  });

  /*==================================================================
    [ Show / hide modal ]*/
  $(document).ready(function () {
    $(".filter-tope-group button").on("click", function () {
      var filterValue = $(this).attr("data-filter");
      console.log(filterValue);
      if (filterValue == "*") {
        $(".product_item").show(); // Show all items
      } else {
        $(".product_item").hide(); // Hide all items
        $("." + filterValue).show(); // Show items that match the filter
      }

      // Update active button state
      $(".filter-tope-group button").removeClass("how-active1");
      $(this).addClass("how-active1");
    });
  });

  /*==================================================================
        [ Filter / Search product ]*/

  /*==================================================================
        [ single product view]*/
  // Event listener for showing the modal
  $(document).on("click", ".js-show-modal1", function (e) {
    e.preventDefault(); 

    $(".js-modal1").addClass("show-modal1");
    $(".js-modal1").removeClass("show-modal1");
    $(".js-modal1").addClass("show-modal1");

    var productid = $(this).attr("data-productid");
    $.ajax({
      url: "get_product_details.php",
      type: "POST",
      data: { product_id: productid },
      success: function (response) {
        var product = JSON.parse(response);

        // Update modal content
        $(".js-modal-name-detail").text(product.Name);
        $(".js-modal-price").text("₹ " + product.Price + "/pcs");

        // Format and update the description
        var descriptionData = JSON.parse(product.Description);
        var formattedDescription = "";

        for (var key in descriptionData) {
          if (descriptionData.hasOwnProperty(key)) {
            if (descriptionData[key] !== null && descriptionData[key] !== "") {
              // Check if the value is not empty
              formattedDescription += `<strong>${key}:</strong> ${descriptionData[key]}<br>`;
            } else {
              formattedDescription += `<br><span style="font-size: 12px;">${key}${descriptionData[key]}</span><br>`;
            }
          }
        }

        $(".js-modal-description").html(formattedDescription);

        // Calculate Discount and Update
        if (product.discount_p > 0) {
          var discountPrice =
            product.Price - product.Price * (product.discount_p / 100);
          $(".js-modal-discount-percentage").text(product.discount_p);
          $(".js-modal-mrp-price").text("₹ " + product.Price);
          $(".js-modal-discount-price").text(
            "₹ " + discountPrice.toFixed(2) + "/pcs"
          );
          $(".discount-section").show(); // Show discount section
          $(".js-modal-price").hide(); // Hide the original price
        } else {
          $(".discount-section").hide(); // Hide discount section if no discount
          $(".js-modal-price").show(); // Show the original price
        }

        // Update image sources and thumbnails
        $(".js-modal-main1").attr(
          "src",
          "images/product/" + product.Img_filename1
        );
        $(".js-modal-main2").attr(
          "src",
          "images/product/" + product.Img_filename2
        );
        $(".js-modal-main3").attr(
          "src",
          "images/product/" + product.Img_filename3
        );
        $(".js-modal-main4").attr(
          "src",
          "images/product/" + product.Img_filename4
        );
        $(".js-modal-main5").attr(
          "src",
          "images/product/" + product.Img_filename5
        );
        $(".js-modal-main6").attr(
          "src",
          "images/product/" + product.Img_filename6
        );
        $(".js-modal-corner1").attr(
          "data-thumb",
          "images/product/" + product.Img_filename1
        );
        $(".js-modal-corner2").attr(
          "data-thumb",
          "images/product/" + product.Img_filename2
        );
        $(".js-modal-corner3").attr(
          "data-thumb",
          "images/product/" + product.Img_filename3
        );
        $(".js-modal-corner4").attr(
          "data-thumb",
          "images/product/" + product.Img_filename4
        );
        $(".js-modal-corner5").attr(
          "data-thumb",
          "images/product/" + product.Img_filename5
        );
        $(".js-modal-corner6").attr(
          "data-thumb",
          "images/product/" + product.Img_filename6
        );
        $(".js-modal-expand1").attr(
          "href",
          "images/product/" + product.Img_filename1
        );
        $(".js-modal-expand2").attr(
          "href",
          "images/product/" + product.Img_filename2
        );
        $(".js-modal-expand3").attr(
          "href",
          "images/product/" + product.Img_filename3
        );
        $(".js-modal-expand4").attr(
          "href",
          "images/product/" + product.Img_filename4
        );
        $(".js-modal-expand5").attr(
          "href",
          "images/product/" + product.Img_filename5
        );
        $(".js-modal-expand6").attr(
          "href",
          "images/product/" + product.Img_filename6
        );

        $(".js-addcart-detail").attr("data-productid", productid);
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let existingProduct = cart.find((item) => item.id === productid);
        if (existingProduct) {
          // If the product is already in the cart, set the quantity
          $(".js-modal-quantity").val(existingProduct.quantity);
        } else {
          $(".js-modal-quantity").val(1);
        }

        // Destroy and reinitialize Slick slider
        $(".wrap-slick3").each(function () {
          var $slickElement = $(this).find(".slick3");
          if ($slickElement.hasClass("slick-initialized")) {
            $slickElement.slick("unslick");
          }
          $slickElement.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 6000,

            arrows: true,
            appendArrows: $(this).find(".wrap-slick3-arrows"),
            prevArrow:
              '<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
            nextArrow:
              '<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

            dots: true,
            appendDots: $(this).find(".side"),
            dotsClass: "slick3-dots",
            customPaging: function (slick, index) {
              var $slide = $(slick.$slides[index]);
              var portrait = $slide.attr("data-thumb");
              return (
                '<img src="' +
                portrait +
                '"/><div class="slick3-dot-overlay"></div>'
              );
            },
          });
        });
        fetchRelatedProducts(product.Category);
      },
      error: function (error) {
        console.log("Error:", error);
      },
    });
  });

  // Event listener for hiding the modal
  $(".js-hide-modal1").on("click", function () {
    $(".js-modal1").removeClass("show-modal1");
    location.reload();
  });

  /*==================================================================
        [ Cart view]*/

  // Function to calculate the price based on quantity and whole price data
  // Function to calculate the price based on quantity and whole price data
  function Calculate_price(quantity, w_data_string, retail_price, discount_p) {
    // Parse the whole price data string into an object
    const w_data = JSON.parse(w_data_string);
    const minProduct = w_data.min_product;
    const minPrice = w_data.min_price;
    const maxPrice = w_data.max_price;
    const priceRanges = w_data.price_ranges;

    if (quantity < minProduct) {
      // Calculate the discount price
      return retail_price - (retail_price * discount_p) / 100;
    }

    for (let i = 0; i < priceRanges.length; i++) {
      const range = priceRanges[i];
      if (quantity >= range.range_start && quantity <= range.range_end) {
        return range.price;
      }
    }

    if (quantity > priceRanges[priceRanges.length - 1].range_end) {
      return maxPrice;
    }

    return minPrice;
  }

  function loadCart() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let totalAmount = 0;
    $(".header-cart-wrapitem").empty(); // Clear the cart list
    if (cart.length === 0) {
        $(".header-cart-wrapitem").html(
            '<li class="header-cart-item flex-w flex-t m-b-12">Your cart is empty</li>'
        );
        $(".header-cart-total").text("Total: ₹0");
        return;
    }

    // Create an array to hold all AJAX promises
    let ajaxPromises = [];

    cart.forEach(function (item) {
        let ajaxPromise = $.ajax({
            url: "get_product_details.php",
            type: "POST",
            data: { product_id: item.id },
            success: function (response) {
                let product = JSON.parse(response);

                // Calculate the price using the Calculate_price function
                let price = Calculate_price(
                    item.quantity,
                    product.w_data,
                    product.Price,
                    product.discount_p
                );

                // Calculate total price for the item
                let itemTotal = price * item.quantity;
                totalAmount += itemTotal;

                // Append the item to the cart list
                $(".header-cart-wrapitem").append(`
                    <li class="header-cart-item flex-w flex-t m-b-12 js-cart-item" data-productid="${item.id}">
                        <div class="header-cart-item-img js-remove-item">
                            <img src="images/product/${product.Img_filename1}" alt="IMG" class="">
                        </div>
                        <div class="header-cart-item-txt p-t-8">
                            <button class="header-cart-item-name m-b-18 hov-cl1 trans-04 js-show-modal2" style="text-align:left" data-productid="${item.id}">
                                ${product.Name}
                            </button>
                            <span class="header-cart-item-info">
                                ${item.quantity} x ₹${price.toFixed(2)}
                            </span>
                        </div>
                    </li>
                `);

                // Attach click event listener for removing the item
                $(".js-remove-item")
                    .last()
                    .on("click", function () {
                        let productId = $(this).closest(".js-cart-item").data("productid");
                        removeItemFromCart(productId);
                    });
            },
            error: function (error) {
                console.error("Error fetching product details:", error);
            }
        });

        // Push each AJAX promise to the array
        ajaxPromises.push(ajaxPromise);
    });

    // Wait for all AJAX requests to finish
    Promise.all(ajaxPromises)
        .then(function () {
            // Update the total amount after all requests are completed
            $(".header-cart-total").text("Total: ₹" + totalAmount.toFixed(2));
        })
        .catch(function (error) {
            console.error("Error with AJAX requests:", error);
        });
}

  function loadCart2() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let totalAmount = 0;
    $(".header-cart-wrapitem").empty(); // Clear the cart list
    if (cart.length === 0) {
      $(".header-cart-wrapitem").html(
        '<li class="header-cart-item flex-w flex-t m-b-12">Your cart is empty</li>'
      );
      $(".header-cart-total").text("Total: ₹0");
      return;
    }
    cart.forEach(function (item) {
      $.ajax({
        url: "get_product_details.php",
        type: "POST",
        data: { product_id: item.id },
        success: function (response) {
          let product = JSON.parse(response);

          // Calculate total price for the item
          let itemTotal = product.Price * item.quantity;
          totalAmount += itemTotal;

          // Append the item to the cart list
          $(".header-cart-wrapitem").append(`
                            <li class="header-cart-item flex-w flex-t m-b-12 js-cart-item" data-productid="${item.id}">
                                <div class="header-cart-item-img js-remove-item">
                                    <img src="images/product/${product.Img_filename1}" alt="IMG" class="">
                                </div>
                                <div class="header-cart-item-txt p-t-8">
                                    <button class="header-cart-item-name m-b-18 hov-cl1 trans-04 js-show-modal2" style="text-align:left" data-productid="${item.id}">
                                        ${product.Name}
                                    </button>
                                    <span class="header-cart-item-info">
                                        ${item.quantity} x ₹${product.Price}
                                    </span>
                                </div>
                            </li>
                        `);

          // Update the total amount
          $(".header-cart-total").text("Total: ₹" + totalAmount);

          // Attach click event listener for removing the item
          $(".js-remove-item")
            .last()
            .on("click", function () {
              console.log("hi");
              let productId = $(this)
                .closest(".js-cart-item")
                .data("productid");
              removeItemFromCart(productId);
            });
        },
        error: function (error) {
          console.error("Error fetching product details:", error);
        },
      });
    });
  }

  function removeItemFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    // Ensure that productId is a string for comparison if item.id is a string
    productId = productId.toString();

    cart = cart.filter((item) => item.id.toString() !== productId);
    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
    updateCartNotification();
  }

  // Load cart when the cart panel is shown
  $(".js-show-cart").on("click", function () {
    $(".js-panel-cart").addClass("show-header-cart");
    loadCart();
  });

  // Hide cart
  $(".js-hide-cart").on("click", function () {
    $(".js-panel-cart").removeClass("show-header-cart");
  });

  /*==================================================================
        [ Cart ]*/
  $(".js-show-sidebar").on("click", function () {
    $(".js-sidebar").addClass("show-sidebar");
  });

  $(".js-hide-sidebar").on("click", function () {
    $(".js-sidebar").removeClass("show-sidebar");
  });

  /*==================================================================
        [ +/- num product ]*/
  $(".btn-num-product-down").on("click", function () {
    var numProduct = Number($(this).next().val());
    if (numProduct > 0)
      $(this)
        .next()
        .val(numProduct - 1);
  });

  $(".btn-num-product-up").on("click", function () {
    var numProduct = Number($(this).prev().val());
    $(this)
      .prev()
      .val(numProduct + 1);
  });

  /*==================================================================
        [ Rating ]*/
  $(".wrap-rating").each(function () {
    var item = $(this).find(".item-rating");
    var rated = -1;
    var input = $(this).find("input");
    $(input).val(0);

    $(item).on("mouseenter", function () {
      var index = item.index(this);
      var i = 0;
      for (i = 0; i <= index; i++) {
        $(item[i]).removeClass("zmdi-star-outline");
        $(item[i]).addClass("zmdi-star");
      }

      for (var j = i; j < item.length; j++) {
        $(item[j]).addClass("zmdi-star-outline");
        $(item[j]).removeClass("zmdi-star");
      }
    });

    $(item).on("click", function () {
      var index = item.index(this);
      rated = index;
      $(input).val(index + 1);
    });

    $(this).on("mouseleave", function () {
      var i = 0;
      for (i = 0; i <= rated; i++) {
        $(item[i]).removeClass("zmdi-star-outline");
        $(item[i]).addClass("zmdi-star");
      }

      for (var j = i; j < item.length; j++) {
        $(item[j]).addClass("zmdi-star-outline");
        $(item[j]).removeClass("zmdi-star");
      }
    });
  });
  /*----------- Cart add start---------------*/

  $(".js-addcart-detail").each(function () {
    $(this).on("click", function (e) {
      e.preventDefault();

      // Get product details from the modal
      var m_nameProduct = $(".js-modal-name-detail").text();
      var m_productID = $(this).attr("data-productid");
      var m_productQuantity = $(".js-modal-quantity").val();

      // Check if elements are found correctly
      if (!m_productID || !m_productQuantity) {
        console.error(
          "One or more product details are missing. Check the selectors and HTML structure."
        );
        return;
      }

      // Create a product object
      let product = {
        id: m_productID,
        quantity: parseInt(m_productQuantity),
      };

      // Add the product to the cart
      addToCart(product);

      // Display a success message
      swal(m_nameProduct, "is added to cart! Buy Now Fast!", "success");
    });
  });

  $(".js-addcart-whole-detail").each(function () {
    $(this).on("click", function (e) {
      e.preventDefault();

      // Get product details from the modal
      var m_nameProduct = $(this).attr("data-name");
      var m_productID = $(this).attr("data-productid");
      var m_productQuantity = $(".js-modal-quantity" + m_productID).val();

      // Check if elements are found correctly
      if (!m_productID || !m_productQuantity) {
        console.error(
          "One or more product details are missing. Check the selectors and HTML structure."
        );
        return;
      }

      // Create a product object
      let product = {
        id: m_productID,
        quantity: parseInt(m_productQuantity),
      };

      // Add the product to the cart
      addToCart(product);

      // Display a success message
      swal(m_nameProduct, "is added to cart! Buy Now Fast!", "success");
    });
  });
  // Function to add a product to the cart
  function addToCart(product) {
    // Get the existing cart from local storage or initialize an empty array
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Check if the product is already in the cart
    let existingProduct = cart.find((item) => item.id === product.id);
    if (existingProduct) {
      // If the product is already in the cart, increase the quantity
      existingProduct.quantity = product.quantity;
    } else {
      // If the product is not in the cart, add it
      cart.push(product);
    }

    // Save the updated cart to local storage
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartNotification();
  }

  /*----------- Cart add end---------------*/
  $(".js-show-search").on("click", function () {
    if ($(this).hasClass("show-search")) {
      $(this).removeClass("show-search");
      $(".panel-search").slideUp(400);
      window.location.reload();
    } else {
      $(this).addClass("show-search");
      $(".panel-search").slideDown(400);
    }
  });

  // Handle search input
  $("#search-product").on("input", function () {
    var searchQuery = $(this).val();
    $.ajax({
      url: "get_products.php",
      type: "POST",
      data: { search: searchQuery },
      success: function (response) {
        var products = JSON.parse(response);
        updateProductGrid(products);
      },
      error: function (error) {
        console.error("Error fetching products:", error);
      },
    });
  });

  $(document).on("click", ".js-add-to-cart", function (e) {
    e.preventDefault(); // Prevent default anchor behavior if needed
  
    // Get product details from the clicked element
    var m2_nameProduct = $(this).attr("data-productname");
    var m2_productID = $(this).attr("data-productid");
    var m2_productQuantity = 1; // Hardcoded quantity
  
    // Log the product details for debugging
    console.log("Product Name:", m2_nameProduct);
    console.log("Product ID:", m2_productID);
  
    // Check if elements are found correctly
    if (!m2_productID || !m2_nameProduct) {
      console.error("One or more product details are missing. Check the selectors and HTML structure.");
      return;
    }
  
    // Create a product object
    let product = {
      id: m2_productID,
      quantity: m2_productQuantity,
    };  
  
    // Add the product to the cart
    addToCart(product);
  
    // Display a success message
    swal(m2_nameProduct, "is added to cart! Buy Now Fast!", "success");
  });
  
  
})(jQuery);

// new income