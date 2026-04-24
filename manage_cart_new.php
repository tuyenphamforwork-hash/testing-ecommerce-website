<?php
session_start();
require_once './functions/functions.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php?login_required=1');
    exit;
}

if(isset($_POST['add_to_cart'])) {
    $customer_id = $_SESSION['id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['product_qty'] ?? 1;

    // Add to database cart
    add_to_cart($customer_id, $product_id, $quantity);

    header('location:viewdetail.php?id='.$product_id.'&category='.$_POST['product_category']);
}
?>