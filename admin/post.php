<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['logged-in']))){
      header("Location:login.php?unauthorizedAccess");
      exit;
    }
 ?>

    <div class="d-flex" style="justify-content: space-between; padding: 18px">
      <h1>PRODUCTS</h1>
      <button type="button" class="btn btn-primary btn-lg">
        <a class="btn" href="add-post.php">ADD Products</a>
      </button>
    </div>
<hr>

<?php
                  include "includes/config.php"; 
                  
                  $sn = 0;

                  if($_SESSION["customer_role"] == 'admin'){
                    /* select query of post table for admin user - fetch all products */
                    $sql = "SELECT * FROM products
                            ORDER BY products.product_id DESC";

                  }elseif($_SESSION["user_role"] == 'normal'){
                    /* select query of post table for normal user - fetch all user's products */
                    $sql = "SELECT * FROM products WHERE product_author='{$_SESSION['customer_name']}'
                            ORDER BY products.product_id DESC";
                  }

                  $result = $conn->query($sql) or die("Query Failed.");
                  //means if no of rows found on the basis of query is >0 then goes inside if
                  if ($result->num_rows > 0) {
                ?>

<div class="table-cont">
<table class="table">
    <!-- tablehead html -->
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Category</th>
      <th scope="col">Date</th>
      <th scope="col">Author</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
 <!-- tablehead html end -->

 <!-- tabledata body html -->
  <tbody class="table-group-divider">
     <!-- data row1 -->
<?php
  // output data of each row
  while($row = $result->fetch_assoc()) { //this will run for every row at a time and run until row finished
  $sn = $sn+1;
?>
    <tr>
      <th scope="row"><?php echo $sn?></th>
      <td><?php echo $row["product_title"] ?></td>
      <td><?php echo $row["product_catag"] ?></td>
      <td><?php echo $row["product_date"] ?></td>
      <td><?php echo  $row["product_author"] ?></td>
      <td>
        <a class="fn_link" href="update-post.php?id=<?php echo $row["product_id"] ?>">
        <i class='fa fa-edit'></i>
        </a>
      </td>
      <td>
        <a class="fn_link" href="remove-post.php?id=<?php echo $row["product_id"] ?>">
        <i class='fa fa-trash'></i>
        </a>
      </td>
    </tr>

<?php 
  }} else { echo "0 results"; }
?>
</tbody>
<!-- tabledata body end -->

</table>
</div>

<?php $conn->close(); ?>

