<?php

namespace Models;

class Article
{
    private string $name;
    private float $price;
    private string $description;
    private string $imagePath;

    public function __construct(string $name, float $price, string $description, string $imagePath)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->imagePath = $imagePath;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }
}
