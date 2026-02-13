<?php
include_once 'src/views/partials/header.php';

// --- LOGIQUE FRONT-END : CALCUL DES TOTAUX ---
$sousTotalHT = 0;
// On vérifie si la variable $articlesPanier existe et n'est pas vide
if (!empty($articlesPanier)) {
    foreach ($articlesPanier as $item) {
        $sousTotalHT += $item->getPrice();
    }
}
$tva = $sousTotalHT * 0.20;
$totalTTC = $sousTotalHT + $tva;
// --------------------------------------------
?>

<style>
    :root {
        --forest-green: #1a3020;
        --cream-bg: #f9f7f2;
        --gold-accent: #c4a47c;
    }

    body {
        background-color: var(--cream-bg) !important;
    }

    .custom-card {
        background-color: var(--cream-bg) !important;
        color: var(--forest-green) !important;
    }

    .btn-checkout {
        background-color: var(--forest-green) !important;
        border-color: var(--forest-green) !important;
        color: #ffffff !important;
        transition: all 0.3s ease;
    }

    .btn-checkout:hover {
        background-color: var(--gold-accent) !important;
        border-color: var(--gold-accent) !important;
        transform: translateY(-2px);
    }

    .text-total {
        color: var(--forest-green) !important;
    }
</style>


<div class="container my-5">
    <h1 class="mb-5 text-center text-md-start fw-bold">Mon Panier</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="row g-4 g-lg-5">
        <div class="col-12 col-lg-8">
            <div class="table-responsive shadow-sm rounded border bg-white">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="py-3 ps-3">Produit</th>
                            <th scope="col" class="py-3">Prix</th>
                            <th scope="col" class="py-3">Total</th>
                            <th scope="col" class="py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($articlesPanier)): ?>
                            <tr>
                                <td colspan="5" class="py-5 text-center">
                                    <div class="py-4">
                                        <i class="bi bi-cart-x fs-1 text-muted"></i>
                                        <p class="mt-3 fs-5">Votre panier est vide</p>
                                        <a href="index.php?page=articles" class="btn btn-outline-dark rounded-pill px-4">Voir nos articles</a>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($articlesPanier as $item): ?>
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= htmlspecialchars($item->getImagePath()) ?>"
                                                class="img-fluid rounded me-3 border shadow-sm"
                                                style="width: 60px; height: 60px; object-fit: cover;" 
                                                alt="<?= htmlspecialchars($item->getTitle()) ?>">
                                            <div>
                                                <h6 class="mb-0 fw-bold"><?= htmlspecialchars($item->getTitle()) ?></h6>
                                                <small class="text-muted d-none d-md-block">Taille: <?= htmlspecialchars($item->getSize()) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= number_format($item->getPrice(), 2, ',', ' ') ?> €</td>
                                    <td class="fw-bold"><?= number_format($item->getPrice(), 2, ',', ' ') ?> €</td>
                                    <td class="text-end pe-3">
                                                     <a href="index.php?action=supprimer_panier&id=<?= $item->getId() ?>" 
                                                         class="btn btn-sm btn-outline-danger border-0" 
                                                         title="Supprimer l'article">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-center text-md-start">
                <a href="index.php?page=articles" class="btn btn-link text-decoration-none text-muted p-0">
                    ← Continuer mes achats
                </a>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 fw-bold">Résumé de la commande</h5>

                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <span>Sous-total HT</span>
                        <span><?= number_format($sousTotalHT, 2, ',', ' ') ?> €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <span>TVA (20%)</span>
                        <span><?= number_format($tva, 2, ',', ' ') ?> €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 text-muted">
                        <span>Livraison</span>
                        <span class="text-success fw-bold">Payante</span>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total TTC</span>
                        <span class="fw-bold fs-4 text-total"><?= number_format($totalTTC, 2, ',', ' ') ?> €</span>
                    </div>

                    <!-- Le bouton ne permet pas la navigation, on le remplace par un lien stylisé -->
                    <!-- Lien simple vers la page paiement, désactivé si panier vide -->
                    <a href="<?= !empty($articlesPanier) ? 'index.php?page=paiement' : '#' ?>" class="btn btn-checkout btn-lg w-100 py-3 fw-bold rounded-3 shadow-sm <?= empty($articlesPanier) ? 'disabled' : '' ?>">
                        Passer au paiement
                    </a>

                    <div class="text-center mt-3 small text-muted">
                        Paiement 100% sécurisé
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'src/views/partials/footer.php';
?>