<?php
include_once 'src/views/partials/header.php';
?>

<div class="container my-5">
    <h1 class="mb-5 text-center text-md-start fw-bold">Mon Panier</h1>

    <div class="row g-4 g-lg-5">
        <div class="col-12 col-lg-8">
            <div class="table-responsive shadow-sm rounded border">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="py-3 ps-3">Produit</th>
                            <th scope="col" class="py-3">Prix</th>
                            <th scope="col" class="py-3 text-center">Quantité</th>
                            <th scope="col" class="py-3">Total</th>
                            <th scope="col" class="py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/80"
                                        class="img-fluid rounded me-3 border shadow-sm"
                                        style="width: 60px; height: 60px; object-fit: cover;" alt="T-shirt">
                                    <div>
                                        <h6 class="mb-0 fw-bold">T-shirt en Coton Bio</h6>
                                        <small class="text-muted d-none d-md-block">Taille: M, Couleur: Blanc</small>
                                    </div>
                                </div>
                            </td>
                            <td>25,00 €</td>
                            <td style="min-width: 100px;">
                                <input type="number" class="form-control form-control-sm text-center" value="1" min="1">
                            </td>
                            <td class="fw-bold">25,00 €</td>
                            <td class="text-end pe-3">
                                <button class="btn btn-sm btn-outline-danger border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/80"
                                        class="img-fluid rounded me-3 border shadow-sm"
                                        style="width: 60px; height: 60px; object-fit: cover;" alt="Jean">
                                    <div>
                                        <h6 class="mb-0 fw-bold">Jean Slim Bleu</h6>
                                        <small class="text-muted d-none d-md-block">Taille: 40</small>
                                    </div>
                                </div>
                            </td>
                            <td>49,98 €</td>
                            <td>
                                <input type="number" class="form-control form-control-sm text-center" value="1" min="1">
                            </td>
                            <td class="fw-bold">49,98 €</td>
                            <td class="text-end pe-3">
                                <button class="btn btn-sm btn-outline-danger border-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-center text-md-start">
                <a href="articles.php" class="btn btn-link text-decoration-none text-muted p-0">
                    ← Continuer mes achats
                </a>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 bg-light">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 fw-bold">Résumé de la commande</h5>

                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <span>Sous-total HT</span>
                        <span>74,98 €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <span>TVA (20%)</span>
                        <span>15,00 €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 text-muted">
                        <span>Livraison</span>
                        <span class="text-success fw-bold">Offerte</span>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total TTC</span>
                        <span class="fw-bold fs-4 text-primary">89,98 €</span>
                    </div>

                    <button class="btn btn-primary btn-lg w-100 py-3 fw-bold rounded-3 shadow">
                        Passer au paiement
                    </button>

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