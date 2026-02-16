<?php

namespace Models;


class Order
{
    private int $id;
    private int $buyerId;
    private string $orderDate;
    private string $orderStatus;

    private array $shoppingCart;

    public function __construct(int $id, int $buyerId, string $orderStatus, string $orderDate, array $shoppingCart)
    {
        $this->id = $id;
        $this->buyerId = $buyerId;
        $this->orderStatus = $orderStatus;
        $this->orderDate = $orderDate;
        $this->shoppingCart = $shoppingCart;
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

    public function getShoppingCart()
    {
        return $this->shoppingCart;
    }

    public function setId(int $newId)
    {
        $this->id = $newId;
    }
}
