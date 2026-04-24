<?php
require_once './vendor/autoload.php';
require_once './includes/config.php';
require_once './functions/functions.php';

\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['session_id'])) {
    try {
        $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);

        if ($session->payment_status === 'paid') {
            // Payment successful, save order to DB
            $customer_id = $_SESSION['id'];
            $total = $session->amount_total / 100; // in dollars
            $address = $session->metadata['first_name'] . ' ' . $session->metadata['last_name'] . ', ' . $session->metadata['address'];
            $phone = $session->metadata['phone'];
            $email = $session->customer_email;

            // Insert order
            $sql = "INSERT INTO orders (customer_id, total, address, phone, email, status) VALUES (?, ?, ?, ?, ?, 'paid')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('idsss', $customer_id, $total, $address, $phone, $email);
            $stmt->execute();
            $order_id = $stmt->insert_id;

            // Insert order items
            $cart_items = get_cart_items($_SESSION['id']);
            while($item = $cart_items->fetch_assoc()) {
                $price = $item['discounted_price'] > 0 ? $item['discounted_price'] : $item['product_price'];
                $sql_item = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
                $stmt_item = $conn->prepare($sql_item);
                $stmt_item->bind_param('iiid', $order_id, $item['product_id'], $item['quantity'], $price);
                $stmt_item->execute();
            }

            // Clear cart
            clear_cart($_SESSION['id']);

            // Redirect to home after success
            header("Location: http://localhost:81/Project/E-Commerce/index.php?order_success=1");
            exit;
        } else {
            echo "<h1>Payment Failed</h1>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit;
}
?>