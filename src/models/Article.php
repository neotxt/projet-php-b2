<?php

namespace Models;

class Article
{
    private int $id;
    private string $title;
    private float $price;
    private string $description;
    private string $imagePath;

    public function __construct(int $id, string $title, float $price, string $description, string $imagePath)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
        $this->imagePath = $imagePath;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->title;
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

