<!-- PHP include header commented out -->

<div class="container my-5">
    <h1 class="mb-5">Mon Panier</h1>

    <div class="row g-5"> <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="border-0">Produit</th>
                            <th scope="col" class="border-0">Prix</th>
                            <th scope="col" class="border-0">Quantité</th>
                            <th scope="col" class="border-0">Total</th>
                            <th scope="col" class="border-0"></th> </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/80" class="img-fluid rounded me-3 border" style="width: 80px; height: 80px; object-fit: cover;" alt="T-shirt">
                                    <div>
                                        <h6 class="mb-1">T-shirt en Coton Bio</h6>
                                        <small class="text-muted">Taille: M, Couleur: Blanc</small>
                                    </div>
                                </div>
                            </td>
                            <td>25,00 €</td>
                            <td style="width: 120px;">
                                <input type="number" class="form-control text-center" value="1" min="1">
                            </td>
                            <td class="fw-bold">25,00 €</td>
                            <td class="text-end">
                                <button class="btn btn-outline-danger btn-sm border-0 p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                      <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/80" class="img-fluid rounded me-3 border" style="width: 80px; height: 80px; object-fit: cover;" alt="Jean">
                                    <div>
                                        <h6 class="mb-1">Jean Slim Bleu</h6>
                                        <small class="text-muted">Taille: 40</small>
                                    </div>
                                </div>
                            </td>
                            <td>49,98 €</td>
                            <td style="width: 120px;">
                                <input type="number" class="form-control text-center" value="1" min="1">
                            </td>
                            <td class="fw-bold">49,98 €</td>
                            <td class="text-end">
                                <button class="btn btn-outline-danger btn-sm border-0 p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                      <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
             <div class="mt-4">
                <a href="articles.php" class="text-decoration-none text-muted">
                    <i class="bi bi-arrow-left me-2"></i>Continuer mes achats
                </a>
            </div>
        </div>

        <div class="col-lg-4">
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
                         <span class="text-success">Offerte</span>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total TTC</span>
                        <span class="fw-bold fs-4 text-primary">89,98 €</span>
                    </div>

                    <button class="btn btn-primary btn-lg w-100 py-3 fw-bold rounded-3 shadow-sm">
                        Passer au paiement
                    </button>

                    <div class="text-center mt-3 small text-muted">
                        <i class="bi bi-shield-lock me-1"></i>Paiement 100% sécurisé
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PHP include footer commented out -->