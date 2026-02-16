<?php

namespace Controllers;

use Services\OrderService;

class OrderController
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createOrder()
    {
        $orderInfo = [
            'buyer_id' => $_SESSION['user_id'],
            'cart' => $_SESSION['panier']
        ];

        $this->orderService->createOrder($orderInfo);
        $_SESSION['panier'] = [];
        header('Location: index.php?page=accueil');
        exit();
    }
}
