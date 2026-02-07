
<?php
// Vue : liste des articles
include_once 'src/views/partials/header.php';
require_once __DIR__ . '/../../models/Article.php';

// Récupérer tous les vêtements depuis la BDD
$articles = \Models\getArticles::getAll();
?>

<div class="container my-5">
    <h1 class="text-center mb-5">Nos Articles</h1>
    <div class="row g-3 g-md-4 justify-content-center">
        <?php // Boucle sur tous les vêtements récupérés depuis la base de données
        // Chaque $article correspond à un vêtement 
        foreach ($articles as $article): ?>
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <?php //je suis pas sur du nom de la page de la description des produits a voire avexx loulia ?>
            <a href="index.php?page=details-produit&id=<?= $article['id'] ?>" style="text-decoration: none; color: inherit;">
                <div class="card h-100 shadow-sm border-0">
                    <img src="<?= htmlspecialchars($article['image']) ?>" class="card-img-top img-fluid img-vetement" alt="<?= htmlspecialchars($article['titre']) ?>">
                    <div class="card-body text-center p-2 p-md-3">
                        <h5 class="card-title fs-6 fs-md-5"><?= htmlspecialchars($article['titre']) ?></h5>
                        <p class="card-text text-primary fw-bold mb-2"><?= number_format($article['prix'], 2, ',', ' ') ?> €</p>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>

    </div>
</div>

<?php
include_once 'src/views/partials/footer.php';
?>