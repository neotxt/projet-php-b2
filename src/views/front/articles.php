<?php
// Vue : liste des articles
include_once 'src/views/partials/header.php';
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

    /* Correction : box-shadow au lieu de shadow */
    .product-link:hover .product-card {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-check:checked+.btn-outline-dark {
        background-color: var(--forest-green);
        color: #fff;
        border-color: var(--forest-green);
    }
</style>

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold">Nos Articles</h1>

    <div class="row">
        <div class="col-lg-3 mb-5">
            <form action="index.php" method="GET">
                <input type="hidden" name="page" value="articles">

                <div class="card filter-card shadow-sm border-0 rounded-4 p-4">
                    <h5 class="mb-4 fw-bold">Filtrer par</h5>

                    <div class="mb-4">
                        <p class="filter-title">Catégories</p> 
                        
                        <div class="form-check mb-2 small">
                            <input class="form-check-input" type="checkbox" name="categorie[]" value="pantalon" id="cat1" 
                                <?= (isset($_GET['categorie']) && in_array('pantalon', $_GET['categorie'])) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="cat1">Jeans & Pantalons</label>
                        </div>

                        <div class="form-check mb-2 small">
                            <input class="form-check-input" type="checkbox" name="categorie[]" value="tshirt" id="cat2"
                                <?= (isset($_GET['categorie']) && in_array('tshirt', $_GET['categorie'])) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="cat2">T-shirts & Tops</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="filter-title">Taille</p>
                        <div class="d-flex flex-wrap gap-2">
                            <input type="checkbox" class="btn-check" name="taille[]" value="S" id="sizeS"
                                <?= (isset($_GET['taille']) && in_array('S', $_GET['taille'])) ? 'checked' : '' ?>>
                            <label class="btn btn-outline-dark btn-sm rounded-0" for="sizeS">S</label>

                            <input type="checkbox" class="btn-check" name="taille[]" value="M" id="sizeM"
                                <?= (isset($_GET['taille']) && in_array('M', $_GET['taille'])) ? 'checked' : '' ?>>
                            <label class="btn btn-outline-dark btn-sm rounded-0" for="sizeM">M</label>

                             <input type="checkbox" class="btn-check" name="taille[]" value="L" id="sizeL"
                                <?= (isset($_GET['taille']) && in_array('L', $_GET['taille'])) ? 'checked' : '' ?>>
                            <label class="btn btn-outline-dark btn-sm rounded-0" for="sizeL">L</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="filter-title">Prix maximum</p>
                        <input type="range" class="form-range" name="prix_max" id="priceRange" min="0" max="200" 
                               value="<?= $_GET['prix_max'] ?? 200 ?>"
                               oninput="this.nextElementSibling.querySelector('#currentPriceValue').innerText = this.value">
                   
                        <div class="d-flex justify-content-between small opacity-75">
                            <span>0 €</span>
                            <span><span id="currentPriceValue"><?= $_GET['prix_max'] ?? 200 ?></span> €</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 mt-2 py-2 fw-bold small rounded-3">APPLIQUER</button>
                    <a href="index.php?page=articles" class="btn btn-link w-100 mt-2 text-decoration-none text-muted small">Réinitialiser</a>
                </div>
            </form> 
        </div>

        <div class="col-lg-9">
            <div class="row g-3 g-md-4">
                
                <?php if (empty($articles)): ?>
                    <div class="col-12 text-center py-5">
                        <h4 class="fw-bold">Aucun article trouvé</h4>
                        <p class="text-muted">Essayez de modifier vos filtres pour trouver votre bonheur.</p>
                    </div>
                <?php else: ?>

                    <?php foreach ($articles as $article): ?>
                        <div class="col-6 col-md-4 mb-4">
                            <a href="index.php?page=details-produit&id=<?= $article->getId() ?>" class="product-link">
                                <div class="card h-100 shadow-sm product-card rounded-4">
                                    <img src="<?= htmlspecialchars($article->getImagePath()) ?>" class="card-img-top img-fluid"
                                        alt="<?= htmlspecialchars($article->getTitle()) ?>">
                                    <div class="card-body text-center p-3">
                                        <h6 class="fw-bold mb-1"><?= htmlspecialchars($article->getTitle()) ?></h6>
                                        <p class="mb-0 fw-bold" style="color: var(--gold-accent);">
                                            <?= number_format($article->getPrice(), 2, ',', ' ') ?> €
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'src/views/partials/footer.php';
?>