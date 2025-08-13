<?php

namespace MiniStore\Modules\Users;

class Customer extends User {
    public function getRole(): string {
        return 'Customer';
    }
}