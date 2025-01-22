$(document).ready(() => {
  // Function to update the cart badge
  function updateCartBadge() {
    $.ajax({
      url: "get-cart-count.php",
      type: "GET",
      dataType: "json",
      success: (response) => {
        $("#cart-badge").text(response.count);
      },
    });
  }

  // Function to add item to cart
  $(".add-to-cart").on("click", function (e) {
    e.preventDefault();
    var productId = $(this).data("product-id");

    $.ajax({
      url: "add-to-cart.php",
      type: "POST",
      data: { product_id: productId },
      dataType: "json",
      success: (response) => {
        if (response.success) {
          updateCartBadge();
          alert("Product added to cart successfully!");
        } else {
          alert("Failed to add product to cart. Please try again.");
        }
      },
      error: () => {
        alert("An error occurred. Please try again.");
      },
    });
  });

  // Initial call to update cart badge
  updateCartBadge();
});
