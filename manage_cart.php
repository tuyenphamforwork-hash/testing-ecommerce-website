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

if(isset($_POST['buy_now'])) {
    $customer_id = $_SESSION['id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['product_qty'] ?? 1;

    // Add to database cart
    add_to_cart($customer_id, $product_id, $quantity);

    header('location:checkout.php');
}
?><?php
            session_start();
            require_once './functions/functions.php';

            if (!isset($_SESSION['id'])) {
                header('Location: login.php?login_required=1');
                exit;
            }

            if(isset($_POST['add_to_cart']))
            {    
               
                     
            if(isset($_SESSION['mycart']))
            {
               $item_id = array_column($_SESSION['mycart'],'product_id');
               $item_check_id = in_array($_POST['product_id'],$item_id);
               
               if($item_check_id==true)
               {
                header('location:viewdetail.php?id='.$_POST['product_id'].'&category='.$_POST['product_category'].'');

               }else{
                $count_card = count($_SESSION['mycart']);
                $_SESSION['mycart'][$count_card]=array('name'=>$_POST['product_name'],'price'=>$_POST['product_price'],'product_id'=>$_POST['product_id'],'category'=>$_POST['product_category'],'product_qty'=>$_POST['product_qty'],'product_img'=>$_POST['product_img']);

                header('location:viewdetail.php?id='.$_POST['product_id'].'&category='.$_POST['product_category'].'');

               }

                

              


            }else{
              $_SESSION['mycart'][0]=array('name'=>$_POST['product_name'],'price'=>$_POST['product_price'],'product_id'=>$_POST['product_id'],'category'=>$_POST['product_category'],'product_qty'=>$_POST['product_qty'],'product_img'=>$_POST['product_img']);
             
              header('location:viewdetail.php?id='.$_POST['product_id'].'&category='.$_POST['product_category'].'');
            }

            }

            if(isset($_POST['buy_now']))
            {    
               
                     
            if(isset($_SESSION['mycart']))
            {
               $item_id = array_column($_SESSION['mycart'],'product_id');
               $item_check_id = in_array($_POST['product_id'],$item_id);
               
               if($item_check_id==true)
               {
                header('location:checkout.php');

               }else{
                $count_card = count($_SESSION['mycart']);
                $_SESSION['mycart'][$count_card]=array('name'=>$_POST['product_name'],'price'=>$_POST['product_price'],'product_id'=>$_POST['product_id'],'category'=>$_POST['product_category'],'product_qty'=>$_POST['product_qty'],'product_img'=>$_POST['product_img']);

                header('location:checkout.php');

               }

                

              


            }else{
              $_SESSION['mycart'][0]=array('name'=>$_POST['product_name'],'price'=>$_POST['product_price'],'product_id'=>$_POST['product_id'],'category'=>$_POST['product_category'],'product_qty'=>$_POST['product_qty'],'product_img'=>$_POST['product_img']);
             
              header('location:checkout.php');
            }

            }





             ?>
