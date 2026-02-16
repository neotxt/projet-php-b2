<?php

namespace Controllers;

use Services\OrderService;
use Repositories\InvoiceRepository;
use Config\Database;

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

        $order = $this->orderService->createOrder($orderInfo);

        // Insertion de la facture après la commande
        $db = new Database();
        $invoiceRepo = new InvoiceRepository($db->getConnection());

        // Utiliser les vrais champs du formulaire de paiement
        $amount = isset($_POST['total_final']) ? floatval($_POST['total_final']) : 0;
        $address = isset($_POST['adresse']) ? $_POST['adresse'] : '';
        $city = isset($_POST['ville']) ? $_POST['ville'] : '';
        $postalCode = isset($_POST['code_postal']) ? $_POST['code_postal'] : '';

        $invoiceRepo->insertInvoice($order->getId(), $amount, $address, $city, $postalCode);

        $_SESSION['panier'] = [];
        header('Location: index.php?page=accueil');
        exit();
    }
}
