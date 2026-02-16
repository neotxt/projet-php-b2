<?php

namespace Controllers;


use Models\Article;

class OrderController
{
    private int $id;
    private int $buyerId;
    private string $orderDate;
    private string $orderStatus;

    private Article[] $shoppingCart;

    public function __construct(int $id, int $buyerId, string $orderStatus,string $orderDate)
    {
        $this->id = $id;
        $this->buyerId = $buyerId;
        $this->orderStatus = $orderStatus;
        $this->orderDate = $orderDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBuyerId(): int
    {
        return $this->buyerId;
    }

    public function getOrderDate(): string
    {
        return $this->orderDate;
    }

    public function getOrderStatus(): string
    {
        return $this->orderStatus;
    }
}
