<?php 
    include_once('./includes/restriction.php');
    include "includes/config.php";

    // Validate user ID
    if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <= 0) {
        header("Location: users.php?error=invalid_user_id");
        exit;
    }

    $user_id = intval($_GET['id']);

    if(isset($_POST['update'])){
        $sql1 = "UPDATE customer 
                 SET  customer_fname= '{$_POST['name']}' ,
                      customer_phone= '{$_POST['phone']}' ,
                      customer_address= '{$_POST['address']}' ,
                      customer_role= '{$_POST['role']}' 
                 WHERE customer_id={$user_id} ";
        $conn->query($sql1);
        $conn->close();
        header("Location: users.php?updated=success");
        exit;
    }

    include_once('./includes/headerNav.php');

    //this will provide previous user value before updating 
    $sql = "SELECT * FROM customer where customer_id={$user_id}";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 0) {
        header("Location: users.php?error=user_not_found");
        exit;
    }
    
    // output data of each row
    $row = $result->fetch_assoc();
    $_SESSION['previous_name'] = $row['customer_fname'];
    $_SESSION['previous_phone'] = $row['customer_phone'];
    $_SESSION['previous_address'] = $row['customer_address'];
    $_SESSION['previous_role'] = $row['customer_role'];
 ?>
 <head>
     <style>
        .content-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
         .update{
            border: 1px solid black;
            width: 60%;
            padding: 25px;
            border-radius: 16px;
            background-color: #f1f1f1;
         }
         
     </style>
 </head>

 <div class="content-box">
    <div class="update">
<h1>Update User Details</h1>
    <form class="row g-3" action="" method="POST">
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Name</label>
        <input
          name="name"
          type="text"
          class="form-control"
          value="<?php echo $_SESSION['previous_name']?>"
        />
      </div>
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Phone</label>
        <input
          type="number"
          name="phone"
          class="form-control"
          value="<?php echo $_SESSION['previous_phone'] ?>"
        />
      </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Address</label>
        <input
          type="text"
          name="address"
          class="form-control"
          placeholder="1234 Main St"
          value="<?php echo $_SESSION['previous_address'] ?>"
        />
      </div>
      <div class="col-md-4">
        <label for="inputState" class="form-label">Role</label>
        <select id="role_update" name="role" class="form-select">
          <?php 
       if($_SESSION['previous_role']=='admin'){
           ?>
          <option value="admin" selected>Admin</option>
          <option value="normal">Normal</option>
          <?php  } else{?>
          <option value="admin">Admin</option>
          <option value="normal" selected>Normal</option>
          <?php } ?>
        </select>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary" name="update">
          Update
        </button>
      </div>
    </form>
 </div>

 </div>



<?php
   if(isset($_POST['update'])){
    //below sql will update user details inside sql table when update is clicked
    $sql1 = "UPDATE customer 
             SET  customer_fname= '{$_POST['name']}' ,
                  customer_phone= '{$_POST['phone']}' ,
                  customer_address= '{$_POST['address']}' ,
                  customer_role= '{$_POST['role']}' 
             WHERE customer_id={$_GET['id']} ";
    $conn->query($sql1);   
    
    $conn->close();
    header("Location: update-user.php?succesfullyUpdated");
    exit;
   }
?>