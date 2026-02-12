<?php
include_once 'src/views/partials/header.php';
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="fw-bold">Mon Vide Dressing</h1>
        <a href="index.php?page=vente" class="btn btn-custom px-4 py-2">Vendre un nouvel article</a>
    </div>

    <?php if (empty($mesArticles)): ?>
        <div class="text-center py-5 bg-white rounded shadow-sm">
            <p class="text-muted">Vous n'avez pas encore d'articles en vente.</p>
            <a href="index.php?page=vente" class="btn btn-outline-dark">Commencer à vendre</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($mesArticles as $article): ?>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <img src="<?= htmlspecialchars($article->getImagePath()) ?>" class="card-img-top" alt="Vêtement" style="height: 250px; object-fit: cover;">
                        
                        <div class="card-body">
                            <h6 class="fw-bold mb-1"><?= htmlspecialchars($article->getTitre()) ?></h6>
                            <p class="text-primary fw-bold mb-2"><?= number_format($article->getPrix(), 2) ?> €</p>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between">
                                <a href="index.php?page=details-produit&id=<?= $article->getId() ?>" class="btn btn-sm btn-outline-secondary">Voir</a>
                                
                                <a href="index.php?action=supprimer_article&id=<?= $article->getId() ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Es-tu sûr de vouloir supprimer cet article ?')">Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include_once 'src/views/partials/footer.php'; ?>
