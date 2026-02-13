<?php

namespace Models;

class Article
{
    private int $id;
    private int $idSeller;
    private string $title;
    private float $price;
    private string $description;
    private string $category;
    private string $size;
    private string $brand;
    private string $condition;
    private string $imagePath;

    public function __construct(
        int $id,
        int $idSeller,
        string $title,
        string $description,
        float $price,
        string $category,
        string $size,
        string $brand,
        string $condition,
        string $imagePath
    ) {
        $this->id = $id;
        $this->idSeller = $idSeller;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->size = $size;
        $this->brand = $brand;
        $this->condition = $condition;
        $this->imagePath = $imagePath;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSellerId()
    {
        return $this->idSeller;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getCondition()
    {
        return $this->condition;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

