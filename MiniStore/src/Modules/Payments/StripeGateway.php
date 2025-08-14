<?php

namespace MiniStore\Modules\Payments;

class StripeGateway implements PaymentGateway {

    public function processPayment(float $amount): bool {
        echo ("Processing Stripe payment of $" . $amount);
        if ($amount > 0) {
            echo "Stripe payment successful.";
            return true;
        }
        echo "Stripe payment failed.";
        return false;
    }
}