<?php

namespace MiniStore\Modules\Users;

use MiniStore\Modules\Core\LoggerTrait;

abstract class User 
{
    use LoggerTrait;

    protected string $name;
    protected string $email;

    public function __construct(string $name, string $email) {
        $this->name = $name;
        $this->email = $email;
        $this->log("User '{$this->name}' created.");
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    abstract public function getRole(): string;
}