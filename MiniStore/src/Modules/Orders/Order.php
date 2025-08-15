<?php

namespace MiniStore\Modules\Orders;

require "MiniStore\src\Modules\Core\DiscountTrait.php";
require "MiniStore\src\Modules\Core\OrderStatusTrait.php";

use MiniStore\Modules\Core\DiscountTrait;
use MiniStore\Modules\Core\LoggerTrait;
use MiniStore\Modules\Core\OrderStatusTrait;
use MiniStore\Modules\Users\User;
use MiniStore\Modules\Products\Product;

class Order
{
    use LoggerTrait, DiscountTrait, OrderStatusTrait;

    private User $customer;
    private array $products = [];
    private float $totalPrice = 0.0;

    public function __construct(User $customer)
    {
        $this->customer = $customer;
        $this->setStatus('pending');

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

    public function getTotalPrice(): float {
        return $this->totalPrice;
    }

    public function applyDiscounts(float $discountPercentage): void
    {
        $this->totalPrice = $this->applyDiscount($this->totalPrice, $discountPercentage) ?? 0;
        $this->log("Discount applied. New total: {$this->totalPrice}");
    }
}
