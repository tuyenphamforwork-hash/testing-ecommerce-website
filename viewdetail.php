<!--  -->
<?php include_once('./includes/headerNav.php'); ?>
<?php require_once './includes/topheadactions.php'; ?>
<?php require_once './includes/mobilenav.php'; ?>

<?php $loggedIn = isset($_SESSION['id']); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">




<!-- get tables data from db -->

<header>
  <!-- top head action, search etc in php -->
  <!-- inc/topheadactions.php -->
  <?php require_once './includes/topheadactions.php'; ?>
  <!-- desktop navigation -->
  <!-- inc/desktopnav.php -->
  <?php require_once './includes/desktopnav.php' ?>
  <!-- mobile nav in php -->
  <!-- inc/mobilenav.php -->
  <?php require_once './includes/mobilenav.php'; ?>

</header>

<!-- check for table and then get specific data from table -->
<?php
// get values from url
$product_ID = $_GET['id'];
$product_category = $_GET['category'];

$product_name = '';
$product_price = '';



if($product_category == "deal_of_day"){
  $item = get_deal_of_day_by_id($product_ID);

} else{
  // get specfic item from table
  $item = get_product($product_ID);
}
// get user reviews
// $user_reviews = get_user_reviews();
?>



<div class="overlay" data-overlay></div>

<!-- CATEGORY SIDE BAR MOBILE MENU -->

<!-- Category side bar  -->
<div class="product-container category-side-bar-container">
  <div class="container">

    <!-- TODO: hide and display a php tag on differnet screen size -->
    <?php require_once 'includes/categorysidebar.php' ?>


    <!-- TODO: work on this display it when screen size is 1024px -->


    <!-- ############################# -->


    <?php
        // Get product data
        $row = mysqli_fetch_assoc($item);
        
         ?>

  <!-- adding to cart -->
  

















      <!-- product card   -->
      <div class="content">
      <form action="manage_cart.php" method="post" class='view-form'>
        <!-- product details container -->
        <div class="product_deatail_container">

          <!-- <div class="product_image_box" style="background-image: url('./admin/upload/<?php //echo $row['product_img'] ?>')"></div> -->

          <!-- image is kept hidden for submission -->
          <input type="hidden" name = "product_img" value=<?php echo $row['product_img'] ?>> 

          <!-- getting image from here with magnify functionality -->
        <?php include_once './product.php'; ?>

          <div class="product_detail_box">
            <h3 class="product-detail-title">
              <!-- convert to upper  -->
              <?php echo strtoupper($row['product_title']) ?>
            </h3>
     
            <div class="prouduct_information">
            
              <div class="product_description">
                <div class="product_title"><strong>Name:</strong></div>
                <div class="product_detail">
                  <!-- convert to sentence case -->
                

                  <?php 
                    $product_name = $row['product_title'];
                    $product_price = $row['discounted_price'];
                  
                  
                  
                  echo ucfirst($product_name) ?>
                    <input type="hidden" name='product_name' id='product_name' value = "<?php echo $product_name; ?>">
                </div>
              </div>

              <div class="product_description">
                <div class="product_title"><strong>Price:</strong></div>
                <div class="product_detail">
                  <div class="price-box">
                    <p class="price">$<?php echo $product_price; ?></p>
                    <input type="hidden" name="product_price" value = "<?php echo $product_price; ?>">
                    <input type="hidden" id="product_identity" name="product_id" value ="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_category" value ="<?php echo $product_category; ?>">

                    <del>$<?php echo $row['product_price']; ?></del>
                  </div>
                </div>
              </div>
              <div class="product_description">
                <div class="product_title"><strong>Description:</strong></div>
                <div class="product_detail">
                  <?php echo nl2br(htmlspecialchars($row['product_desc'])) ?>
                </div>
              </div>

              <div class="product_description">
                <div class="product_title"><strong>Rating:</strong></div>
                <div class="product_detail">
                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>
                </div>
              </div>
            </div>
         
            <div class="product_counter_box">


              <!-- 
              -
              -
              form send detail to cart page
              -
              -
             -->

                <!-- product counter buttons -->
                <div class="product_counter_btn_box">
                  <button type="button" class="btn_product_increment">+</button>

                  <input class="input_product_quantity" type="number" style="width: 50px" max="7" min="1" value="1" name="product_qty"  id="p_qty"/>

                  <input type="hidden" name="product_id"  value="<?php echo $row['product_id']; ?> "  />
                  <button type="button" class="btn_product_decrement">-</button>
                  
                </div>
                <!-- submit -->
                <div class="buy-and-cart-btn">
                    <?php if ($loggedIn): ?>
                        <button type="submit" name="add_to_cart" class="btn_product_cart">
                          Add to Cart
                        </button>
                        <button type="submit" name="buy_now" class="btn_but_product">
                          Buy
                        </button>
                    <?php else: ?>
                        <a href="login.php" class="btn_product_cart" style="display:inline-flex; justify-content:center; align-items:center; text-decoration:none; color:#FFFFFF; width: 110px; height: 40px; background: var(--main-maroon); border-radius: 5px;">
                          Login to Add
                        </a>
                        <a href="login.php" class="btn_but_product" style="display:inline-flex; justify-content:center; align-items:center; text-decoration:none; color:#FFFFFF; width: 110px; height: 40px;">
                          Login to Buy
                        </a>
                    <?php endif; ?>

         
          



                </div>
          


              <!-- 
              form ends
             -->


            </div>
            
          </div>
        </div>

    

        <!-- reviews -->
        <div class="reviews-section" style="margin-top: 30px; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
          <h4>Customer Reviews</h4>
          <div class="review-item" style="margin-bottom: 15px; padding: 10px; background: #f9f9f9; border-radius: 5px;">
            <div class="review-rating">
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
            </div>
            <p><strong>John Doe</strong> - Great product! Highly recommended.</p>
            <small>Posted on: 2024-01-15</small>
          </div>
          <div class="review-item" style="margin-bottom: 15px; padding: 10px; background: #f9f9f9; border-radius: 5px;">
            <div class="review-rating">
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
            </div>
            <p><strong>Jane Smith</strong> - Excellent quality and fast delivery.</p>
            <small>Posted on: 2024-01-10</small>
          </div>
        </div>

        <!-- related products -->
        <div class="related-products" style="margin-top: 30px;">
          <h4>Related Products</h4>
          <div class="related-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 15px;">
            <?php
            // Get related products from same category
            $related_sql = "SELECT * FROM products WHERE product_catag = ? AND product_id != ? LIMIT 4";
            $stmt_related = $conn->prepare($related_sql);
            $stmt_related->bind_param('si', $row['product_catag'], $row['product_id']);
            $stmt_related->execute();
            $related_result = $stmt_related->get_result();

            while ($related_row = $related_result->fetch_assoc()) {
            ?>
              <div class="related-item" style="border: 1px solid #ddd; border-radius: 8px; padding: 10px; text-align: center;">
                <img src="./admin/upload/<?php echo $related_row['product_img'] ?>" alt="<?php echo $related_row['product_title'] ?>" style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px;">
                <h5 style="margin: 10px 0;"><?php echo $related_row['product_title'] ?></h5>
                <p style="color: #e74c3c; font-weight: bold;">$<?php echo $related_row['discounted_price'] ?></p>
                <a href="viewdetail.php?id=<?php echo $related_row['product_id'] ?>&category=<?php echo $related_row['product_catag'] ?>" class="btn btn-primary btn-sm">View Details</a>
              </div>
            <?php
            }
            $stmt_related->close();
            ?>
          </div>
        </div>
        <!-- reviews -->
        

 
      
      </div>



<script>
  let btn_product_decrement = document.querySelector('.btn_product_decrement');
  let btn_product_increment = document.querySelector('.btn_product_increment');
  let change_qty = document.getElementById('p_qty');

  btn_product_decrement.addEventListener('click',function()
  {
    if( change_qty.value == 1)
    {
      change_qty.value = 1;
    }
    else{
      change_qty.value = (change_qty.value)-1 ;

    }
  });
  btn_product_increment.addEventListener('click',function()
  {
    change_qty.value = parseInt(change_qty.value)+1;
   

  });

</script>


</div>

<!--  -->

<!--  -->




<?php require_once './includes/footer.php'; ?>