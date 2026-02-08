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

    .filter-card {
        background-color: #ffffff !important;
        color: var(--forest-green) !important;
    }

    .filter-title {
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.85rem;
        margin-bottom: 1.2rem;
        border-bottom: 1px solid rgba(26, 48, 32, 0.1);
        padding-bottom: 0.5rem;
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

    <div class="row">
        <div class="col-lg-3 mb-5">
            <div class="card filter-card shadow-sm border-0 rounded-4 p-4">
                <h5 class="mb-4 fw-bold">Filtrer par</h5>

                <div class="mb-4">
                    <p class="filter-title">Vêtements</p>
                    <div class="form-check mb-2 small">
                        <input class="form-check-input" type="checkbox" id="cat1">
                        <label class="form-check-label" for="cat1">T-shirts & Tops</label>
                    </div>
                    <div class="form-check mb-2 small">
                        <input class="form-check-input" type="checkbox" id="cat2">
                        <label class="form-check-label" for="cat2">Robes</label>
                    </div>
                    <div class="form-check mb-2 small">
                        <input class="form-check-input" type="checkbox" id="cat3">
                        <label class="form-check-label" for="cat3">Jeans & Pantalons</label>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="filter-title">Taille</p>
                    <div class="d-flex flex-wrap gap-2">
                        <input type="checkbox" class="btn-check" id="sizeS">
                        <label class="btn btn-outline-dark btn-sm rounded-1" for="sizeS">S</label>

                        <input type="checkbox" class="btn-check" id="sizeM">
                        <label class="btn btn-outline-dark btn-sm rounded-1" for="sizeM">M</label>

                        <input type="checkbox" class="btn-check" id="sizeL">
                        <label class="btn btn-outline-dark btn-sm rounded-1" for="sizeL">L</label>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="filter-title">Prix</p>
                    <input type="range" class="form-range" id="priceRange" min="0" max="200">
                    <div class="d-flex justify-content-between small opacity-75">
                        <span>0 €</span>
                        <span>200 €</span>
                    </div>
                </div>

                <button class="btn btn-dark w-100 mt-2 py-2 fw-bold small rounded-3">APPLIQUER</button>
            </div>
        </div>

        <div class="col-lg-9">
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
                        <div class="col-6 col-md-4 mb-4">
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
    </div>
</div>

<?php
include_once __DIR__ . '/../partials/footer.php';
?>