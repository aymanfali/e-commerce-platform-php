<?php

namespace MiniStore\Modules\Orders;

use MiniStore\Modules\Users\User;
use MiniStore\Modules\Products\Product;

class Order {

    private User $customer;
    private array $products = [];
    private float $totalPrice = 0.0;

    public function __construct(User $customer) {
        $this->customer = $customer;
    }

    public function getCustomer(){
        $this->customer->getName();
    }

    public function addProduct(Product $product, int $quantity): void {
        if ($quantity > 0) {
            try {
                $product->decreaseStock($quantity);
                $this->products[] = ['product' => $product, 'quantity' => $quantity];
                $this->totalPrice += $product->getPrice() * $quantity;
            } catch (\Exception $e) {
                
            }
        }
    }
}