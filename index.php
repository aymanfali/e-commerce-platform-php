<?php


// Include autoloader and config file
require 'autoloader.php';
require 'config.php';

use MiniStore\Modules\Products\Product;
use MiniStore\Modules\Users\Customer;
use MiniStore\Modules\Orders\Order;
use MiniStore\Modules\Payments\StripeGateway;


// Create products
$product1 = new Product("Laptop", 2500.00, 10);
$product2 = new Product("Mouse", 10.00, 50);
$product3 = new Product("Keyboard", 50.00, 20);

// Create a customer
$customer = new Customer("John Doe", "john.doe@example.com");

// Create an order and add products
$order = new Order($customer);
$order->addProduct($product1, 1);
$order->addProduct($product2, 2);

// Apply discount
$order->applyDiscount(DISCOUNT_PERCENTAGE);

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


