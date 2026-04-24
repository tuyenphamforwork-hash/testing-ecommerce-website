<?php include_once('./includes/headerNav.php'); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="overlay" data-overlay></div>
<!--
    - HEADER
  -->

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

<!-- style -->
    <style>
      :root{
         --main-maroon: #CE5959;
        --deep-maroon: #89375F;
      }
      td,th{
        text-align:center;
      }
      td img{
        margin-left:auto;
        margin-right:auto;
      }
      .delete-icon{
        color:var(--bittersweet);     
        cursor: pointer; 
      }
  .child-register-btn {
    margin-top:20px;
    width:85%;
    margin-left:auto;
    margin-right:auto;
}
.child-register-btn p {
  width: 350px;
  height: 60px;
  background-color: var( --main-maroon);
  box-shadow: 0px 0px 4px #615f5f;
  line-height: 60px;
  color: #FFFFFF;
  margin-left: auto;
  border-radius: 8px;
  text-align: center;
  cursor: pointer;
  font-size: 19px;
  font-weight: 600;
}
@media screen and (max-width: 794px) {
 
  .child-register-btn {
    margin-top:30px;
  
}
 .child-register-btn p {
   width: 100%;
 }
}

    </style>
</header>





<!--
    - MAIN
  -->

<main>

    <div class="product-container">
        <div class="container">
            <!--
                - SIDEBAR
           -->


           <table class="table table-striped table-hover" style="margin-top: 20px;">
  <thead class="table-dark">
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require_once './functions/functions.php';

  if(isset($_SESSION['id'])) {
    $cart_items = get_cart_items($_SESSION['id']);
    if($cart_items->num_rows > 0) {
      while($item = $cart_items->fetch_assoc()) {
  ?>
    <tr>
      <td>
      <img class="cart-product-image" src="./admin/upload/<?php echo $item['product_img'] ?>"  alt="" style="width: 80px; height: 80px; object-fit: cover;">
      </td>
      <td><?php echo $item['product_title']; ?></td>
      <td><?php echo "$" . ($item['discounted_price'] > 0 ? $item['discounted_price'] : $item['product_price']); ?></td>
      <td>
        <div class="quantity-controls" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
          <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(<?php echo $item['product_id']; ?>, -1)">-</button>
          <input type="number" class="form-control form-control-sm" style="width: 60px; text-align: center;" value="<?php echo $item['quantity']; ?>" readonly>
          <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(<?php echo $item['product_id']; ?>, 1)">+</button>
        </div>
      </td>
      <td>
        <button type="button" class="btn btn-sm btn-danger" onclick="removeFromCart(<?php echo $item['product_id']; ?>)">
          <i class="fa fa-trash"></i> Remove
        </button>
      </td>
    </tr>
    <?php
      }
    } else {
    ?>
        <tr>
      <td colspan='5'>No item available in cart</td>
    </tr>
    <?php
    }
  } else {
    ?>
        <tr>
      <td colspan='5'>Please login to view cart</td>
    </tr>
    <?php
  }
    ?>

  </tbody>
</table>


     
     </div>

           
        </div>
    </div>

    <?php
if(isset($_SESSION['id']) && get_cart_count($_SESSION['id']) > 0) {
?>
    <div class="child-register-btn">
        <p> <a href="checkout.php" style="color:#FFFFFF">Proceed To CheckOut</a></p>
    </div>
<?php
}
?>
</main>

<script>
function updateQuantity(productId, change) {
    // Send AJAX request to update quantity
    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=update_quantity&product_id=' + productId + '&change=' + change
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Reload page to show updated cart
        } else {
            alert('Error updating quantity');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating quantity');
    });
}

function removeFromCart(productId) {
    if (confirm('Are you sure you want to remove this item from cart?')) {
        fetch('update_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=remove&product_id=' + productId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Reload page to show updated cart
            } else {
                alert('Error removing item');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing item');
        });
    }
}
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once './includes/footer.php'; ?>