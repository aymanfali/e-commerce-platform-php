<?php


namespace MiniStore\Modules\Core;

trait OrderStatusTrait
{
    private string $status;

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
