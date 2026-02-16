<?php

namespace Services;

use Repositories\OrderRepository;
use Repositories\ArticleRepository;
use Models\Order;

class OrderService
{
    private OrderRepository $orderRepository;
    private ArticleRepository $articleRepository;

    public function __construct(OrderRepository $orderRepository, ArticleRepository $articleRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->articleRepository = $articleRepository;
    }

    public function createOrder(array $orderInfo)
    {
        $cart = $orderInfo['cart'];

        $order = new Order(
            0,
            $orderInfo['buyer_id'],
            'payée',
            date('Y-m-d H:i:s'),
            $cart

        );

        $this->orderRepository->create($order);

        foreach ($cart as $article) {
            $this->articleRepository->updateStatus($article->getId(), 'vendu');
        }

        return $order;
    }
}
