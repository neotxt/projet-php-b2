<?php
include_once 'src/views/partials/header.php';
?>

<?php if (isset($article) && $article): ?>

    <div class="container my-5">
        <div class="row g-4 align-items-center">
            <div class="col-12 col-md-6">
                <div class="bg-light rounded p-4 p-md-5 text-center shadow-sm">
                    <img src="<?= htmlspecialchars($article->getImagePath()) ?>" class="img-fluid rounded"
                        alt="<?= htmlspecialchars($article->getTitle()) ?>">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=articles"
                                class="text-decoration-none text-dark">Articles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Détails</li>
                    </ol>
                </nav>

                <h1 class="display-5 fw-bold"><?= htmlspecialchars($article->getTitle()) ?></h1>
                <p class="fs-2 text-primary mb-4"><?= number_format($article->getPrice(), 2, ',', ' ') ?> €</p>

                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Catégorie :</strong> <?= htmlspecialchars($article->getCategory()) ?></li>
                    <li class="list-group-item"><strong>Taille :</strong> <?= htmlspecialchars($article->getSize()) ?></li>
                    <li class="list-group-item"><strong>Marque :</strong> <?= htmlspecialchars($article->getBrand()) ?></li>
                    <li class="list-group-item"><strong>État :</strong> <?= htmlspecialchars($article->getCondition()) ?></li>
                </ul>

                <div class="mb-4">
                    <h5 class="fw-bold">Description du produit</h5>
                    <p><?= htmlspecialchars($article->getDescription()) ?></p>
                </div>
                <button class="btn btn-dark btn-lg w-100 py-3">Ajouter au panier</button>
            </div>
        </div>
    </div>

<?php endif ?>

<?php
// Inclure le footer
include_once 'src/views/partials/footer.php';
