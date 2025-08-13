<?php

namespace MiniStore\Modules\Users;

abstract class User 
{
    protected string $name;
    protected string $email;

    public function __construct(string $name, string $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    abstract public function getRole(): string;
}