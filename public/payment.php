<?php
require_once '../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    
    // Success and cancel URLs
    $success_url = "http://yourwebsite.com/success.php";
    $cancel_url = "http://yourwebsite.com/cancel.php";

    // Create the payment link
    $payment_link_data = create_payment_link($price, $product_name, $success_url, $cancel_url);

    if (isset($payment_link_data['data'])) {
        // Redirect to PayMongo payment link
        $payment_url = $payment_link_data['data']['attributes']['checkout_url'];
        header("Location: $payment_url");
        exit;
    } else {
        echo "Error creating payment link: " . $payment_link_data['error'];
    }
} else {
    echo "Invalid request";
}
?>
