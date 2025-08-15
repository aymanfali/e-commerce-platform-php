<?php
require 'config.php';
require 'vendor/autoload.php';
require "MiniStore/src/Modules/Products/Product.php";
require "MiniStore/src/Modules/Users/Customer.php";
require "MiniStore/src/Modules/Orders/Order.php";
require "MiniStore/src/Modules/Payments/StripeGateway.php";

use MiniStore\Modules\Orders\Order;
use MiniStore\Modules\Payments\StripeGateway;
use MiniStore\Modules\Products\Product;
use MiniStore\Modules\Users\Customer;

$product1 = new Product("Laptop", 2500.00, 10);
echo '<br>';
$product2 = new Product("Mouse", 10.00, 50);
echo '<br>';
$product3 = new Product("Keyboard", 50.00, 20);
echo '<br>';

$customer = new Customer("Ayman", "ayman4swd@gmail.com");
echo '<br>';

// Create an order and add products
$order = new Order($customer);
$order->addProduct($product1, 1);
echo '<br>';
$order->addProduct($product2, 2);
echo '<br>';


// Apply discount
$order->applyDiscounts(DISCOUNT_PERCENTAGE);


// Process payment using polymorphism
echo "\n--- Processing Payment ---\n";
$paymentGateway = new StripeGateway();
$isPaid = $paymentGateway->processPayment($order->getTotalPrice());

if ($isPaid) {
    $order->setStatus('processed');
    $order->log("Order status updated to: {$order->getStatus()}");
    echo "\nPayment processed successfully. Final order total: $" . number_format($order->getTotalPrice(), 2) . "\n";
} else {
    $order->setStatus('failed');
    $order->log("Order status updated to: {$order->getStatus()}");
    echo "\nPayment failed. Please try again.\n";
}
