<?php

namespace Repositories;

use Models\Order;

use PDO;

class OrderRepository implements Repository
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function create(object $order)
    {
        $newId = $this->createOrder($order);

        $order->setId($newId);

        $this->createOrderItems($order);
    }

    private function createOrder(object $order)
    {
        $sql = 'INSERT INTO Orders (buyer_id, order_date, order_status)
                VALUES (:buyer_id, :order_date, :order_status)';

        $stmt = $this->db->prepare($sql);

        $stmt->execute([

            'buyer_id' => $order->getBuyerId(),
            'order_date' => $order->getOrderDate(),
            'order_status' => $order->getOrderStatus()

        ]);

        return (int) $this->db->lastInsertId();
    }

    private function createOrderItems(object $order)
    {
        $articles = $order->getShoppingCart();
        foreach ($articles as $article) {
            $sql = 'INSERT INTO Order_Items (order_id, item_id, quantity)
                    VALUES (:order_id, :item_id, :quantity)';

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                'order_id' => $order->getId(),
                'item_id' => $article->getId(),
                'quantity' => 1
            ]);
        }
    }

    public function read(int $id)
    {
        $sql = 'SELECT * FROM Orders WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $orderData = $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function update(object $order)
    {

    }

    public function delete(int $id)
    {

    }

    public function getAll()
    {

    }

    private function dataToObject($orderData)
    {
        return new Order(
            id: $orderData['id'],
            buyerId: $orderData['buyer_id'],
            orderStatus: $orderData['order_status'],
            orderDate: $orderData['order_date'],
            shoppingCart: null
        );
    }
}