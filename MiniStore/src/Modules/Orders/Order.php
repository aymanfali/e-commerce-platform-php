<?php

namespace MiniStore\Modules\Orders;

use MiniStore\Modules\Core\LoggerTrait;
use MiniStore\Modules\Users\User;
use MiniStore\Modules\Products\Product;

class Order
{

    use LoggerTrait;

    private User $customer;
    private array $products = [];
    private float $totalPrice = 0.0;

    public function __construct(User $customer)
    {
        $this->customer = $customer;
        $this->log("Order created for customer: {$customer->getName()}");
    }

    public function getCustomer()
    {
        $this->customer->getName();
    }

    public function addProduct(Product $product, int $quantity): void
    {
        if ($quantity > 0) {
            try {
                $product->decreaseStock($quantity);
                $this->products[] = ['product' => $product, 'quantity' => $quantity];
                $this->totalPrice += $product->getPrice() * $quantity;
                $this->log("Added {$quantity}x {$product->getName()} to the order. Current total: {$this->totalPrice}");
            } catch (\Exception $e) {
                $this->log("Failed to add product: " . $e->getMessage());
            }
        }
    }
}
