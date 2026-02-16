<?php

namespace Repositories;

use PDO;

class InvoiceRepository
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function insertInvoice(int $orderId, float $amount, string $address, string $city, string $postalCode): int
    {
        $sql = 'INSERT INTO Invoice (buyer_id, transaction_date, amount, address, city, postal_code, order_id) VALUES (:buyer_id, :transaction_date, :amount, :address, :city, :postal_code, :order_id)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'buyer_id' => $_SESSION['user_id'],
            'transaction_date' => date('Y-m-d H:i:s'),
            'amount' => $amount,
            'address' => $address,
            'city' => $city,
            'postal_code' => $postalCode,
            'order_id' => $orderId
        ]);
        return (int)$this->db->lastInsertId();
    }
}
