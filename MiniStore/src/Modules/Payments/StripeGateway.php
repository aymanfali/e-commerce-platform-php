<?php

namespace MiniStore\Modules\Payments;

require "PaymentGateway.php";

use MiniStore\Modules\Core\LoggerTrait;

class StripeGateway implements PaymentGateway
{
    use LoggerTrait;

    public function processPayment(float $amount): bool
    {
        $this->log("Processing Stripe payment of $" . $amount);
        if ($amount > 0) {
            $this->log("Stripe payment successful.");
            return true;
        }
        $this->log("Stripe payment failed.");
        return false;
    }
}
