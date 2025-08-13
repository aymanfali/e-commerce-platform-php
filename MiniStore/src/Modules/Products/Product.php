<?php

namespace MiniStore\Modules\Products;

class Product {

    private string $name;
    private float $price;
    private int $stock;

    public function __construct(string $name, float $price, int $stock) {
        $this->name = $name;
        $this->setPrice($price);
        $this->setStock($stock);
    }

    private function validatePrice(float $price): void {
        if ($price < 0) {
            throw new \InvalidArgumentException("Product price cannot be negative.");
        }
    }

    private function validateStock(int $stock): void {
        if ($stock < 0) {
            throw new \InvalidArgumentException("Product stock cannot be negative.");
        }
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getStock(): int {
        return $this->stock;
    }

    public function setPrice(float $price): void {
        $this->validatePrice($price);
        $this->price = $price;
    }

    public function setStock(int $stock): void {
        $this->validateStock($stock);
        $this->stock = $stock;
    }

    public function decreaseStock(int $quantity): void {
        if ($this->stock >= $quantity) {
            $this->stock -= $quantity;
        } else {
            throw new \Exception("Insufficient stock for product '{$this->name}'.");
        }
    }
}