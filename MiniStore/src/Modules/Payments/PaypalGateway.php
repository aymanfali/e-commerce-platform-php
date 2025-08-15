<?php

namespace MiniStore\Modules\Payments;

require "MiniStore\Modules\Core\LoggerTrait.php";

use MiniStore\Modules\Core\LoggerTrait;

class PaypalGateway implements PaymentGateway
{

    use LoggerTrait;

    public function processPayment(float $amount): bool
    {
        $this->log("Processing Paypal payment of $" . $amount);
        if ($amount > 0) {
            $this->log("Paypal payment successful.");
            return true;
        }
        $this->log("Paypal payment failed.");
        return false;
    }
}
