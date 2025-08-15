<?php

namespace MiniStore\Modules\Users;

require "MiniStore/src/Modules/Users/User.php";


class Customer extends User {
    public function getRole(): string {
        return 'Customer';
    }
}
