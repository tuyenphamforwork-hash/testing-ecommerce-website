<?php
include "includes/config.php";

// Only process if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = true;

    if (isset($_FILES['prod-img']) && $_FILES['prod-img']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['prod-img']['name'];
        $file_size = $_FILES['prod-img']['size'];
        $file_tmp = $_FILES['prod-img']['tmp_name'];
        $tmp = explode('.', $file_name);
        $file_ext = strtolower(end($tmp));
        $extensions = array("jpeg", "jpg", "png");

        if (!in_array($file_ext, $extensions)) {
            echo "This extension isn't allowed, please choose a jpg, jpeg or png file.";
            exit;
        } elseif ($file_size >= 2097152) {
            echo "File size must be less than 2MB.";
            exit;
        } else {
            $error = false;
            move_uploaded_file($file_tmp, "upload/" . $file_name);
        }
    } else {
        echo "Please upload a product image.";
        exit;
    }

    if ($error === false) {
        session_start();
        $today_date = date("j,n,Y");
        $author = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : '';

        // Escape POST variables to prevent SQL injection
        $prod_category = mysqli_real_escape_string($conn, $_POST['prod-category']);
        $prod_title = mysqli_real_escape_string($conn, $_POST['prod-title']);
        $prod_price = mysqli_real_escape_string($conn, $_POST['prod-price']);
        $prod_discount = mysqli_real_escape_string($conn, $_POST['prod-discount']);
        $prod_desc = mysqli_real_escape_string($conn, $_POST['prod-desc']);
        $noofitem = mysqli_real_escape_string($conn, $_POST['noofitem']);

        $next_id = 1;
        $result_id = $conn->query("SELECT MAX(product_id) AS max_id FROM products");
        if ($result_id && $row_id = $result_id->fetch_assoc()) {
            $next_id = (int)$row_id['max_id'] + 1;
        }

        $sql = "INSERT INTO products 
                      (product_id,product_catag,product_title,product_price,discounted_price,product_desc,product_date,product_img,product_left,product_author,image_1)
               VALUES ('{$next_id}','{$prod_category}','{$prod_title}','{$prod_price}','{$prod_discount}','{$prod_desc}','{$today_date}','{$file_name}','{$noofitem}','{$author}','{$file_name}')";

        $result = $conn->query($sql);
        if (!$result) {
            echo "Database error: " . $conn->error;
            $conn->close();
            exit;
        }

        $conn->close();
        header("Location: post.php?success");
        exit;
    }
}
?>
