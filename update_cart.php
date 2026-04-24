<?php
session_start();
require_once './functions/functions.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(array('success' => false, 'message' => 'Not logged in'));
    exit;
}

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $customer_id = $_SESSION['id'];

    switch ($action) {
        case 'update_quantity':
            $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $change = isset($_POST['change']) ? (int)$_POST['change'] : 0;

            if ($product_id > 0) {
                // Get current quantity
                $cart_items = get_cart_items($customer_id);
                $current_qty = 0;
                while($item = $cart_items->fetch_assoc()) {
                    if($item['product_id'] == $product_id) {
                        $current_qty = $item['quantity'];
                        break;
                    }
                }

                $new_qty = $current_qty + $change;

                // Ensure quantity is at least 1 and max 10
                if ($new_qty >= 1 && $new_qty <= 10) {
                    update_cart_quantity($customer_id, $product_id, $new_qty);
                    $response['success'] = true;
                }
            }
            break;

        case 'remove':
            $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

            if ($product_id > 0) {
                remove_from_cart($customer_id, $product_id);
                $response['success'] = true;
            }
            break;
    }
}

echo json_encode($response);
?>