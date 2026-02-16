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

    .mes-articles-scroll {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 1.5rem;
        padding-bottom: 1rem;
    }
    .mes-articles-scroll .card {
        min-width: 260px;
        max-width: 260px;
        flex: 0 0 auto;
    }
</style>
<?php
include_once 'src/views/partials/header.php';
?>

<div class="container my-5">
        <?php if (!empty($mesArticles)): ?>
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="fw-bold mb-0">Mon Vide Dressing</h1>
                <a href="index.php?page=vente" class="btn btn-outline-dark">Commencer à vendre</a>
            </div>
        <?php else: ?>
            <div class="text-center mb-4">
                <h1 class="fw-bold mb-3">Mon Vide Dressing</h1>
                <a href="index.php?page=vente" class="btn btn-outline-dark mt-3">Commencer à vendre</a>
            </div>
        <?php endif; ?>

    <?php if (empty($mesArticles)): ?>
        <div class="text-center py-5 bg-white rounded shadow-sm">
            <p class="text-muted">Vous n'avez pas encore d'articles en vente.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($mesArticles as $article): ?>
                    <tr>
                        <td style="width:120px"><img src="<?= htmlspecialchars($article->getImagePath()) ?>" alt="Vêtement" style="height:80px; width:auto; object-fit:cover;"></td>
                        <td><?= htmlspecialchars($article->getTitle()) ?></td>
                        <td><?= number_format($article->getPrice(), 2) ?> €</td>
                        <td>
                            <a href="index.php?page=details-produit&id=<?= $article->getId() ?>" class="btn btn-sm btn-outline-secondary">Voir</a>
                            <a href="index.php?action=supprimer_article&id=<?= $article->getId() ?>" class="btn btn-sm btn-outline-danger ms-2" onclick="return confirm('Es-tu sûr de vouloir supprimer cet article ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include_once 'src/views/partials/footer.php'; ?>
