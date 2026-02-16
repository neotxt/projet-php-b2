<?php
// src/views/front/admin.php
include_once 'src/views/partials/header.php';
?>

<div class="container my-5">
    <h1 class="fw-bold mb-4">Espace Administration</h1>
    <p>lieux de gestion des utilisateurs et articles</p>
    <hr>
    <h2 class="h4 mt-4">Gestion des utilisateurs</h2>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->getId() ?></td>
                        <td><?= htmlspecialchars($user->getLastName()) ?></td>
                        <td><?= htmlspecialchars($user->getFirstName()) ?></td>
                        <td><?= htmlspecialchars($user->getEmail()) ?></td>
                        <td>
                            <?= $user->isAdmin() ? '<span class="badge bg-success">Oui</span>' : '<span class="badge bg-secondary">Non</span>' ?>
                            <?php if (!$user->isAdmin()): ?>
                                <form action="index.php?action=supprimer_user&id=<?= $user->getId() ?>" method="POST" style="display:inline; margin-left:10px;">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet utilisateur ? Cette action est irréversible.')">Supprimer</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2 class="h4 mt-4">Liste de tous les articles</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Vendeur</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $article->getId() ?></td>
                        <td><?= htmlspecialchars($article->getTitle()) ?></td>
                        <td><?= $article->getSellerId() ?></td>
                        <td><?= number_format($article->getPrice(), 2, ',', ' ') ?> €</td>
                        <td>
                            <a href="index.php?page=details-produit&id=<?= $article->getId() ?>" class="btn btn-sm btn-outline-secondary">Voir</a>
                            <form action="index.php?action=supprimer_article&id=<?= $article->getId() ?>" method="POST" style="display:inline;">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet article ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once 'src/views/partials/footer.php'; ?>
