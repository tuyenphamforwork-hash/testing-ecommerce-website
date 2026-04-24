
<?php
   include_once('./includes/headerNav.php');
   //this restriction will secure the pages path injection
   if(!(isset($_SESSION['id']))){
      header("location:index.php?UnathorizedUser");
      exit;
     }
    $sql8 ="SELECT * FROM  customer WHERE customer_id='{$_SESSION['id']}';";
    $result8 = $conn->query($sql8);
    $row8 = $result8->fetch_assoc();
    $_SESSION['customer_name'] = $row8['customer_fname'];
    $_SESSION['customer_email'] = $row8['customer_email'];
    $_SESSION['customer_phone'] = $row8['customer_phone'];
    $_SESSION['customer_address'] = $row8['customer_address'];
?>
<head>
      <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <title>Profile</title>
    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }
      .card-container{
         margin-top: 25px;
         background: #f9f9f9;
         width: 100%;
         padding: 50px;
         border-radius: 16px;
         border: 1px solid #a3a3a3;
      }
      .edit-container{
                      border:none;
                      height: 40%;
                      color:rgb(32, 69, 32);
                      display:flex;
                      /* align-items:center; */
                      justify-content:center;
                     }
      #edit{
            margin-left:5%;
            background:aliceblue;
            height:200px;
            width:25%;
            overflow: hidden;
      }
      h1{
         text-align: center;
         text-transform: uppercase;
      }
      #role{
         color: orange;
      }
      h4{
         text-decoration:underline;
         color:dark;
      }
      h4 a{
         text-alignment:center;
         color:blue
      }
      #admin{
         text-decoration:none;
         font-weight:bold;
      }
      .profile_edit{
         display:none;
      }
      .address_edit{
         display:none;
      }
      .contact_edit{
         display:none;
      }
      .show { display: block; }
      @media (max-width: 500px) {
                     .edit-container{
                      width:100%;
                      border:none;
                      color:rgb(32, 69, 32);
                      text-align:center;
                      flex-direction:column;
                     }
                     #edit{
                     height:100%;
                     margin-bottom:5%;
                     background:aliceblue;
                     width:85%;
                    }
                    marquee{
                       width:40%;
                    }
                  }


   </style>
</head>
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
<hr>
<!-- Header End====================================================================== -->
<h1>
      Hello, 
      <span id="role">
      <?php echo ( $_SESSION['customer_role']=='admin')? 'Admin': $_SESSION['customer_name'];?> 
      </span>
      welcome to your profile
 </h1>
<h1>Manage Your Account</h1>

<?php
if (isset($_GET['order_success']) && $_GET['order_success'] == '1') {
    echo '<div class="alert alert-success">Payment successful! Your order has been placed.</div>';
}
?>


<!-- profile setup -->
    <div class="container text-center card-container">
      <div class="row" style="gap: 25px">
        <div class="col d-flex justify-content-center">
          <!-- Card Start -->
          <div class="card" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title">PROFILE</h5>

              <!-- user edit button -->
              <div style="float: left" class="col">
                  <a class="btn btn-primary" href="#/profile/edit" id="edit_link1">Edit</a>
              </div>
              <br>
              <br>
              <!-- user edit -->
              <div class="profile_edit">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
                <br />
                <br />
                <div class="row mb-3">
                  <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label> -->
                  <div class="col-sm-12">
                    <input
                      type="text" 
                      name="name" 
                      id=""
                      class="form-control"
                      placeholder="New Name..."
                    />
                  </div>
                </div>
                <div class="row mb-3">
                  <!-- <label for="inputPassword3" class="col-sm-2 col-form-label"
          >Password</label
        > -->
                  <div class="col-sm-12">
                    <input
                      type="email" 
                      name="email" 
                      id=""
                      class="form-control"
                      placeholder="New Eamil..."
                    />
                  </div>

                  <!-- Save button -->
                  <br />
                  <br />
                  <div 
                  style="float: left" 
                  class="col">
                    <button 
                    type="submit" 
                    name="save" 
                    class="btn btn-primary">
                      Save
                    </button>
                  </div>
                </div>
              </form>
              </div>
              <!-- end user edit -->

              <p class="card-text">
                <?php echo $_SESSION['customer_name']." "."(".$_SESSION['customer_role'].")"  ?>
              </p>
              <p class="card-text">
                <?php echo $_SESSION['customer_email']  ?>
              </p>
    <?php 
        if($_SESSION['customer_role'] =='admin') {      
    ?>            
              <a 
              id='admin' 
              href='admin/login.php' 
              class="btn btn-primary">
                Visit Admin Panel
              </a>

    <?php }     ?>
            </div>
          </div>
          <!-- Card End -->
        </div>

        <!-- New Col -->
        <div class="col d-flex justify-content-center">
          <!-- Card Start -->
          <div class="card" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title">Address Book</h5>
              <a 
              href="#/address/edit" 
              id="edit_link2" 
              class="btn btn-primary">
                Edit
              </a>

              <!-- adress book form -->
              <!-- user edit -->
               <div class="address_edit ">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
                <br />
                <br />
                <div class="row mb-3">
                  <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label> -->
                  <div class="col-sm-12">
                    <input
                      type="text" 
                      name="address" 
                      id=""
                      class="form-control"
                      placeholder="New Address..."
                    />
                  </div>
                </div>
                <div class="row mb-3">
                  <!-- Save button -->
                  <br />
                  <br />
                  <div style="float: left" class="col">
                    <button 
                    type="submit" 
                    name="save" 
                    class="btn btn-primary">
                      Save
                    </button>
                  </div>
                </div>
              </form>
        </div>
              <!-- end of address book form -->
              <p class="card-text">
                <?php echo $_SESSION['customer_address']  ?>
              </p>
            </div>
          </div>
          <!-- Card End -->
        </div>

        <!-- New Col -->
        <div class="col d-flex justify-content-center">
          <!-- Card Start -->
          <div class="card" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title">Contact Book</h5>
              <a 
              href="#/contact/edit" 
              id="edit_link3"
              class="btn btn-primary">
                Edit
              </a>

              <!-- adress book form -->
              <!-- user edit -->
 <div class="contact_edit ">

              <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
                <br />
                <br />
                <div class="row mb-3">
                  <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label> -->
                  <div class="col-sm-12">
                    <input
                      type="number" 
                      name="number" 
                      id=""
                      class="form-control"
                      placeholder="New Number..."
                    />
                  </div>
                </div>
                <div class="row mb-3">
                  <!-- Save button -->
                  <br />
                  <br />
                  <div style="float: left" class="col">
                    <button 
                    type="submit" 
                    name="save" 
                    class="btn btn-primary">
                      Save
                    </button>
                  </div>
                </div>
              </form>
        </div>

              <!-- end of address book form -->
              <p class="card-text">
                <?php echo $_SESSION['customer_phone']  ?>
              </p>
            </div>
          <!-- Card End -->
        </div>
        <!-- Col End -->

      </div>
    </div>

    <!-- Order History Section -->
    <div class="container text-center card-container" style="margin-top: 50px;">
      <h2>Order History</h2>
      <?php
      include "includes/config.php";
      $customer_id = $_SESSION['id'];
      $sql_orders = "SELECT * FROM orders WHERE customer_id = ? ORDER BY created_at DESC";
      $stmt_orders = $conn->prepare($sql_orders);
      $stmt_orders->bind_param('i', $customer_id);
      $stmt_orders->execute();
      $result_orders = $stmt_orders->get_result();

      if ($result_orders->num_rows > 0) {
          echo '<table class="table table-striped">';
          echo '<thead><tr><th>No.</th><th>Total</th><th>Status</th><th>Date</th><th>Details</th></tr></thead><tbody>';
          $order_no = 1;
          while ($order = $result_orders->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . $order_no++ . '</td>';
              echo '<td>$' . number_format($order['total'], 2) . '</td>';
              echo '<td>' . ucfirst($order['status']) . '</td>';
              echo '<td>' . date('Y-m-d H:i', strtotime($order['created_at'])) . '</td>';
              echo '<td><button class="btn btn-info btn-sm" onclick="showOrderDetails(' . $order['id'] . ')">View Details</button></td>';
              echo '</tr>';
          }
          echo '</tbody></table>';
      } else {
          echo '<p>No orders found.</p>';
      }
      $stmt_orders->close();
      ?>
    </div>

    <!-- Modal for Order Details -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="orderDetailsLabel">Order Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="orderDetailsBody">
            <!-- Details will be loaded here -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <?php
//for edit backend users data php and mysql
      if(isset($_POST['save'])){
         
        if(!empty($_POST['name']) AND !empty($_POST['email'])){
         include "includes/config.php";
         $sql6 = "UPDATE customer 
                  SET  customer_fname= '{$_POST['name']}' ,
                       customer_email= '{$_POST['email']}' 
                  WHERE customer_id= '{$_SESSION['id']}' ";
         $conn->query($sql6);   
         echo "success";
         
        }
        if(!empty($_POST['address'])){
         include "includes/config.php";
         $sql6 = "UPDATE customer 
                  SET  customer_address= '{$_POST['address']}'
                  WHERE customer_id= '{$_SESSION['id']}' ";
         $conn->query($sql6);   
         
         echo "success";
         
        }
        if(!empty($_POST['number'])){
         include "includes/config.php";
         $sql6 = "UPDATE customer 
                  SET  customer_phone= '{$_POST['number']}'
                  WHERE customer_id= '{$_SESSION['id']}' ";
         $conn->query($sql6);   
         
         echo "success";
         
        }
      }
   ?>




<!-- Footer====================================================================== -->
<?php
   include_once('./includes/footer.php')
?>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="./js/jquery.js" type="text/javascript"></script>
<script src="./js/bootstrap.min.js" type="text/javascript"></script>
<script src="./js/edit.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script>
function showOrderDetails(orderId) {
    $.ajax({
        url: 'order_details.php',
        type: 'GET',
        data: { order_id: orderId },
        success: function(data) {
            $('#orderDetailsBody').html(data);
            var modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
            modal.show();
        },
        error: function() {
            alert('Error loading order details.');
        }
    });
}
</script>
