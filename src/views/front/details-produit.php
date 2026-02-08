
<?php
include_once 'src/views/partials/header.php';
require_once __DIR__ . '/../../Repositories/ArticleRepository.php';

// Récupérer l'id du produit depuis l'URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
// je creer une instance de ArticleRepository pour utitiliser read()
$repo = new \Repositories\ArticleRepository();
// Récupérer les détails du produit depuis la base de données
$article = ($id > 0) ? $repo->read($id) : null;
?>

<div class="container my-5">
    <div class="row g-4 align-items-center">
        <div class="col-12 col-md-6">
            <div class="bg-light rounded p-4 p-md-5 text-center shadow-sm">
                <img src="<?= htmlspecialchars($article['image']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($article['titre']) ?>">
                <p class="mt-3 text-muted d-md-none">L'image du produit</p>
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

            <h1 class="display-5 fw-bold"><?= htmlspecialchars($article['titre']) ?></h1>
            <p class="fs-2 text-primary mb-4"><?= number_format($article['prix'], 2, ',', ' ') ?> €</p>

            <div class="mb-4">
                <h5 class="fw-bold">Description du produit</h5>
                <p><?= htmlspecialchars($article['description']) ?></p>
            </div>

            <button class="btn btn-dark btn-lg w-100 py-3 shadow-sm">
                Ajouter au panier
            </button>
        </div>
    </div>
</div>

<?php
// 7. Inclure le footer
include_once 'src/views/partials/footer.php';
?>