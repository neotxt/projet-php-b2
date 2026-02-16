<?php

namespace Services;

use Repositories\OrderRepository;
use Models\Order;

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(array $orderInfo)
    {
        $order = new Order(
            0,
            $orderInfo['buyer_id'],
            'payée',
            date('Y-m-d H:i:s'),
            $orderInfo['cart']

        );
        $this->orderRepository->create($order);
        return $order;
    }
}
