
<?php
// Vue : liste des articles
include_once 'src/views/partials/header.php';
require_once __DIR__ . '/../../Repositories/ArticleRepository.php';

// Récupérer tous les vêtements depuis la BDD
$repo = new \Repositories\ArticleRepository();
$articles = $repo->getAll();
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

    /* Style du cadre blanc des filtres */
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

    /* Style de la carte produit cliquable */
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
        shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    /* Personnalisation des boutons de taille */
    .btn-check:checked + .btn-outline-dark {
        background-color: var(--forest-green);
        color: #fff;
        border-color: var(--forest-green);
    }
</style>

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold">Nos Articles</h1>

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
                        <label class="btn btn-outline-dark btn-sm rounded-0" for="sizeS">S</label>

                        <input type="checkbox" class="btn-check" id="sizeM">
                        <label class="btn btn-outline-dark btn-sm rounded-0" for="sizeM">M</label>

                        <input type="checkbox" class="btn-check" id="sizeL">
                        <label class="btn btn-outline-dark btn-sm rounded-0" for="sizeL">L</label>
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
                <?php // Boucle sur tous les vêtements récupérés depuis la base de données
                foreach ($articles as $article): ?>
                <div class="col-6 col-md-4 mb-4">
                    <a href="index.php?page=details-produit&id=<?= $article['id'] ?>" class="product-link">
                        <div class="card h-100 shadow-sm product-card rounded-4">
                            <img src="<?= htmlspecialchars($article['image']) ?>" class="card-img-top img-fluid" alt="<?= htmlspecialchars($article['titre']) ?>">
                            <div class="card-body text-center p-3">
                                <h6 class="fw-bold mb-1"><?= htmlspecialchars($article['titre']) ?></h6>
                                <p class="mb-0 fw-bold" style="color: var(--gold-accent);"><?= number_format($article['prix'], 2, ',', ' ') ?> €</p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php
// Inclusion du footer commun
include_once 'src/views/partials/footer.php';
?>