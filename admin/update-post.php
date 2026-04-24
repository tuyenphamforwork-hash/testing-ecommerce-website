<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    include "includes/config.php";
    
    // HANDLE UPDATE FIRST - before any output
    if(isset($_POST['update'])){
        // Escape POST variables to prevent SQL injection
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $catag = mysqli_real_escape_string($conn, $_POST['catag']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $discount = mysqli_real_escape_string($conn, $_POST['discount']);
        $desc = mysqli_real_escape_string($conn, $_POST['desc']);
        $noofitem = mysqli_real_escape_string($conn, $_POST['noofitem']);
        
        // Handle image - use new image if uploaded, otherwise keep old image
        if(!empty($_FILES['newimg']['name'])){
            $file_name = $_FILES['newimg']['name'];
            $file_tmp = $_FILES['newimg']['tmp_name'];
            move_uploaded_file($file_tmp, "upload/".$file_name);
        } else {
            // Keep the previous image if no new image uploaded
            // Use POST value if available, otherwise use SESSION value
            $file_name = isset($_POST['previous_img_val']) ? mysqli_real_escape_string($conn, $_POST['previous_img_val']) : mysqli_real_escape_string($conn, $_SESSION['previous_img']);
        }
        
        $sql1 = "UPDATE products
                 SET  product_title= '{$title}' ,
                      product_catag= '{$catag}' ,
                      product_price= '{$price}' ,
                      discounted_price= '{$discount}',
                      product_desc= '{$desc}',
                      product_img= '{$file_name}',
                      product_left= '{$noofitem}' 
                 WHERE product_id={$_GET['id']} ";
        $conn->query($sql1);   
        header("Location: post.php?succesfullyUpdated");
        exit;
    }

    //this will provide previous user value before updating 
    $sql = "SELECT * FROM products where product_id={$_GET['id']}";
    $result = $conn->query($sql);
    // output data of each row
    $row = $result->fetch_assoc();
    $_SESSION['previous_title'] = $row['product_title'];
    $_SESSION['previous_desc'] = $row['product_desc'];
    $_SESSION['previous_catag'] = $row['product_catag'];
    $_SESSION['previous_price'] = $row['product_price'];
    $_SESSION['previous_discount'] = $row['discounted_price'];
    $_SESSION['previous_no'] = $row['product_left'];
    $_SESSION['previous_img'] = $row['product_img'];
    $conn->close();
 ?>
 <head>
     <style>
        .content-box-post {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
         .update{
            border: 1px solid black;
            width: 80%;
            padding: 25px;
            border-radius: 16px;
            background-color: #f1f1f1;
         }
     </style>
 </head>
<div class="content-box-post">


 <div class="update">
     <h5>Edit post here</h5>
     <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data" class="row g-3">
      <input type="hidden" name="previous_img_val" value="<?php echo isset($_SESSION['previous_img']) ? $_SESSION['previous_img'] : ''; ?>" />
      <div class="col-12">
        <label for="inputAddress" class="form-label">Title</label>
        <input
          class="form-control"
          type="text"
          name="title"
          value="<?php echo $_SESSION['previous_title'] ?>"
        />
      </div>
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Price</label>
        <input
          class="form-control"
          type="number"
          name="price"
          value="<?php echo $_SESSION['previous_price'] ?>"
        />
      </div>
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Discount</label>
        <input
          class="form-control"
          type="number"
          name="discount"
          value="<?php echo $_SESSION['previous_discount'] ?>"
        />
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label"
          >Description</label
        >
        <textarea class="form-control" rows="3" name="desc">
        <?php echo $_SESSION['previous_desc'] ?>
      </textarea
        >
      </div>
      <div class="col-md-6">
        <label for="inputCity" class="form-label">No. of Items</label>
        <input
          class="form-control"
          type="number"
          name="noofitem"
          value="<?php echo $_SESSION['previous_no'] ?>"
        />
      </div>
      <div class="col-md-6">
        <label for="inputState" class="form-label">Category</label>
        <select
          name="catag"
          class="form-select"
        >
          <optgroup label="Clothes">
            <option value="Shirt" <?php echo ($_SESSION['previous_catag'] == 'Shirt') ? 'selected' : ''; ?>>Shirt</option>
            <option value="shorts & jeans" <?php echo ($_SESSION['previous_catag'] == 'shorts & jeans') ? 'selected' : ''; ?>>Shorts & Jeans</option>
            <option value="jacket" <?php echo ($_SESSION['previous_catag'] == 'jacket') ? 'selected' : ''; ?>>Jacket</option>
            <option value="dress & frock" <?php echo ($_SESSION['previous_catag'] == 'dress & frock') ? 'selected' : ''; ?>>Dress & Frock</option>
          </optgroup>
          <optgroup label="Footwear">
            <option value="Sports" <?php echo ($_SESSION['previous_catag'] == 'Sports') ? 'selected' : ''; ?>>Sports</option>
            <option value="Formal" <?php echo ($_SESSION['previous_catag'] == 'Formal') ? 'selected' : ''; ?>>Formal</option>
            <option value="Casual" <?php echo ($_SESSION['previous_catag'] == 'Casual') ? 'selected' : ''; ?>>Casual</option>
            <option value="Safety Shoes" <?php echo ($_SESSION['previous_catag'] == 'Safety Shoes') ? 'selected' : ''; ?>>Safety Shoes</option>
          </optgroup>
          <optgroup label="Jewelry">
            <option value="Earrings" <?php echo ($_SESSION['previous_catag'] == 'Earrings') ? 'selected' : ''; ?>>Earrings</option>
            <option value="Couple Rings" <?php echo ($_SESSION['previous_catag'] == 'Couple Rings') ? 'selected' : ''; ?>>Couple Rings</option>
            <option value="Necklace" <?php echo ($_SESSION['previous_catag'] == 'Necklace') ? 'selected' : ''; ?>>Necklace</option>
          </optgroup>
          <optgroup label="Perfume">
            <option value="Clothes Perfume" <?php echo ($_SESSION['previous_catag'] == 'Clothes Perfume') ? 'selected' : ''; ?>>Clothes Perfume</option>
            <option value="Deodorant" <?php echo ($_SESSION['previous_catag'] == 'Deodorant') ? 'selected' : ''; ?>>Deodorant</option>
            <option value="jacket" <?php echo ($_SESSION['previous_catag'] == 'jacket') ? 'selected' : ''; ?>>Jacket</option>
            <option value="dress & frock" <?php echo ($_SESSION['previous_catag'] == 'dress & frock') ? 'selected' : ''; ?>>Dress & Frock</option>
          </optgroup>
          <optgroup label="Cosmetics">
            <option value="Shampoo" <?php echo ($_SESSION['previous_catag'] == 'Shampoo') ? 'selected' : ''; ?>>Shampoo</option>
            <option value="Sunscreen" <?php echo ($_SESSION['previous_catag'] == 'Sunscreen') ? 'selected' : ''; ?>>Sunscreen</option>
            <option value="Body Wash" <?php echo ($_SESSION['previous_catag'] == 'Body Wash') ? 'selected' : ''; ?>>Body Wash</option>
            <option value="Makeup Kit" <?php echo ($_SESSION['previous_catag'] == 'Makeup Kit') ? 'selected' : ''; ?>>Makeup Kit</option>
          </optgroup>
          <optgroup label="Glasses">
            <option value="Sunglasses" <?php echo ($_SESSION['previous_catag'] == 'Sunglasses') ? 'selected' : ''; ?>>Sunglasses</option>
            <option value="Lenses" <?php echo ($_SESSION['previous_catag'] == 'Lenses') ? 'selected' : ''; ?>>Lenses</option>
          </optgroup>
          <optgroup label="Bags">
            <option value="Shopping Bag" <?php echo ($_SESSION['previous_catag'] == 'Shopping Bag') ? 'selected' : ''; ?>>Shopping Bag</option>
            <option value="Purse" <?php echo ($_SESSION['previous_catag'] == 'Purse') ? 'selected' : ''; ?>>Purse</option>
            <option value="Wallet" <?php echo ($_SESSION['previous_catag'] == 'Wallet') ? 'selected' : ''; ?>>Wallet</option>
          </optgroup>
          <option value="electronics" <?php echo ($_SESSION['previous_catag'] == 'electronics') ? 'selected' : ''; ?>>Electronics</option>
        </select>
      </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Image</label>
        <input
          type="file"
          name="newimg"
          class="form-control"
        />
        <small class="text-muted">Leave empty to keep current image: <?php echo $_SESSION['previous_img']; ?></small>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          name="available"
          id="availableCheckbox"
          <?php echo ($_SESSION['previous_catag'] != 'all') ? 'checked' : ''; ?>
        />
        <label class="form-check-label" for="availableCheckbox">
          Available
        </label>
      </div>
      <div class="col-12">
        <button type="submit" name="update" class="btn btn-primary">
          Update
        </button>
      </div>
    </form>
 </div>

</div>

