<?php

namespace MiniStore\Modules\Payments;

class PaypalGateway implements PaymentGateway {

    public function processPayment(float $amount): bool {
        echo ("Processing Paypal payment of $" . $amount);
        if ($amount > 0) {
            echo "Paypal payment successful.";
            return true;
        }
        echo "Paypal payment failed.";
        return false;
    }
}