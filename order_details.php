<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo 'Unauthorized';
    exit;
}

include "includes/config.php";

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $customer_id = $_SESSION['id'];

    // Verify order belongs to user
    $sql_order = "SELECT * FROM orders WHERE id = ? AND customer_id = ?";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param('ii', $order_id, $customer_id);
    $stmt_order->execute();
    $result_order = $stmt_order->get_result();

    if ($result_order->num_rows > 0) {
        $order = $result_order->fetch_assoc();
        echo '<h5>Order #' . $order['id'] . '</h5>';
        echo '<p><strong>Total:</strong> $' . number_format($order['total'], 2) . '</p>';
        echo '<p><strong>Status:</strong> ' . ucfirst($order['status']) . '</p>';
        echo '<p><strong>Address:</strong> ' . htmlspecialchars($order['address']) . '</p>';
        echo '<p><strong>Phone:</strong> ' . htmlspecialchars($order['phone']) . '</p>';
        echo '<p><strong>Email:</strong> ' . htmlspecialchars($order['email']) . '</p>';
        echo '<p><strong>Date:</strong> ' . date('Y-m-d H:i', strtotime($order['created_at'])) . '</p>';
        echo '<h6>Items:</h6><ul>';

        $sql_items = "SELECT oi.*, p.product_title FROM order_items oi JOIN products p ON oi.product_id = p.product_id WHERE oi.order_id = ?";
        $stmt_items = $conn->prepare($sql_items);
        $stmt_items->bind_param('i', $order_id);
        $stmt_items->execute();
        $result_items = $stmt_items->get_result();

        while ($item = $result_items->fetch_assoc()) {
            echo '<li>' . htmlspecialchars($item['product_title']) . ' - Qty: ' . $item['quantity'] . ' - $' . number_format($item['price'], 2) . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Order not found.';
    }
    $stmt_order->close();
    $conn->close();
} else {
    echo 'Invalid request.';
}
?>