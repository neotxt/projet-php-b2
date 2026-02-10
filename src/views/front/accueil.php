<?php

use Config\Database;
use Repositories\VetementsRepository;

// Récupération des produits
$products = [];
try {
    $pdo = (new Database())->getConnection();
    $repo = new VetementsRepository($pdo);
    $products = $repo->getDerniersArticles(12);
} catch (Throwable $e) {
    // Décommente pour debug :
    echo 'Erreur: ' . htmlspecialchars($e->getMessage()); 
    exit;
}

// Inclusion du header
include_once __DIR__ . '/../partials/header.php';
?>

<style>
    :root {
        --forest-green: #1a3020;
        --cream-bg: #f9f7f2;
        --gold-accent: #c4a47c;
    }

    body {
        background-color: var(--cream-bg) !important;
        color: var(--forest-green) !important;
    }

    .home-banner {
        background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('src/public/img/banniere.jpg');
        background-size: cover;
        background-position: center;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-link {
        text-decoration: none !important;
        color: inherit !important;
        display: block;
        transition: transform 0.3s ease;
    }

    .product-card {
        background-color: #ffffff !important;
        border: none !important;
        overflow: hidden;
    }

    .product-link:hover {
        transform: translateY(-10px);
    }

    .product-link:hover .product-card {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>

<section class="home-banner text-white p-5 text-center shadow-sm">
    <div class="container py-5">
        <h1 class="display-3 fw-bold">Nouvelle Collection</h1>
        <p class="lead fs-3">Découvrez les tendances</p>
        <a href="index.php?page=articles" class="btn btn-light btn-lg mt-3 px-4 rounded-pill">Voir les articles</a>
    </div>
</section>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Bienvenue sur ma boutique</h1>
        <p class="fs-4 opacity-75">Nos Articles</p>
    </div>

    <div class="row g-3 g-md-4">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $p): ?>
                <?php
                    $id = (int) ($p['id'] ?? 0);
                    $nom = htmlspecialchars($p['nom'] ?? 'Produit');
                    $prix = isset($p['prix']) ? number_format((float)$p['prix'], 2, ',', ' ') . ' €' : '';
                    $image = $p['image'] ?? 'src/public/img/banniere.jpg';
                    $imgSrc = htmlspecialchars($image);
                ?>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <a href="index.php?page=details-produit&id=<?php echo $id; ?>" class="product-link">
                        <div class="card h-100 shadow-sm product-card rounded-4">
                            <img src="<?php echo $imgSrc; ?>" class="card-img-top img-fluid" alt="<?php echo $nom; ?>">
                            <div class="card-body text-center p-3">
                                <h6 class="fw-bold mb-1"><?php echo $nom; ?></h6>
                                <p class="mb-0 fw-bold" style="color: var(--gold-accent);"><?php echo $prix; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">Aucun produit trouvé.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
include_once __DIR__ . '/../partials/footer.php';
?>