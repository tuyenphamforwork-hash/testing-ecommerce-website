<?php
require_once './vendor/autoload.php';
require_once './includes/config.php';

\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $house_number = mysqli_real_escape_string($conn, $_POST['house_number']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $town_city = mysqli_real_escape_string($conn, $_POST['town_city']);
    $post_code = mysqli_real_escape_string($conn, $_POST['post_code']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    require_once './functions/functions.php';

    // Check if user has items in cart
    $cart_items = get_cart_items($_SESSION['id']);
    if ($cart_items->num_rows == 0) {
        header("Location: cart.php");
        exit;
    }

    $line_items = [];
    $total = 0;
    while($item = $cart_items->fetch_assoc()) {
        $price = $item['discounted_price'] > 0 ? $item['discounted_price'] : $item['product_price'];
        $line_items[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $item['product_title'],
                ],
                'unit_amount' => $price * 100, // in cents
            ],
            'quantity' => $item['quantity'],
        ];
        $total += $price * $item['quantity'];
    }

    try {
        $successUrl = 'http://localhost:81/Project/E-Commerce/success.php?session_id={CHECKOUT_SESSION_ID}';
        $cancelUrl = 'http://localhost:81/Project/E-Commerce/checkout.php';

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => $successUrl,
            'cancel_url' => $cancelUrl,
            'customer_email' => $email,
            'metadata' => [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'address' => $house_number . ', ' . $street . ', ' . $town_city . ', ' . $post_code . ', ' . $country,
                'phone' => $phone,
            ],
        ]);

        header("Location: " . $checkout_session->url);
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: checkout.php");
    exit;
}
?>