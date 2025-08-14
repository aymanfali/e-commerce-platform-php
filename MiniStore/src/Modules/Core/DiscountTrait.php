<?php 

namespace MiniStore\Modules\Core;

trait DiscountTrait {
    public function applyDiscount(float $price, float $discountPercentage): float {
        return $price * (1 - $discountPercentage);
    }
}