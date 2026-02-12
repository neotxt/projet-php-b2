<?php
include_once 'src/views/partials/header.php';

$articlesPanier = $articlesPanier ?? [];
$sousTotalHT = 0;

if (!empty($articlesPanier)) {
    foreach ($articlesPanier as $item) {
        $sousTotalHT += $item->getPrice();
    }
}

$tva = $sousTotalHT * 0.20;
$totalTTC = $sousTotalHT + $tva;
$fraisLivraison = 5.90;
$totalFinal = $totalTTC + $fraisLivraison;
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

    .payment-container {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        color: var(--forest-green);
        font-weight: 700;
        border-bottom: 2px solid var(--gold-accent);
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .form-label {
        color: var(--forest-green);
        font-weight: 600;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--gold-accent);
        box-shadow: 0 0 0 0.2rem rgba(196, 164, 124, 0.25);
    }

    .payment-method {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .payment-method:hover {
        border-color: var(--gold-accent);
        background-color: #fafafa;
    }

    .payment-method.selected {
        border-color: var(--forest-green);
        background-color: rgba(26, 48, 32, 0.05);
    }

    .payment-method input[type="radio"] {
        accent-color: var(--forest-green);
    }

    .order-summary {
        background-color: var(--cream-bg);
        border-radius: 8px;
        padding: 20px;
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        color: var(--forest-green);
    }

    .summary-line.total {
        font-size: 1.25rem;
        font-weight: 700;
        border-top: 2px solid var(--gold-accent);
        padding-top: 15px;
        margin-top: 15px;
    }

    .btn-pay {
        background-color: var(--forest-green) !important;
        border-color: var(--forest-green) !important;
        color: #ffffff !important;
        font-weight: 600;
        padding: 15px 30px;
        transition: all 0.3s ease;
    }

    .btn-pay:hover {
        background-color: var(--gold-accent) !important;
        border-color: var(--gold-accent) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .secure-badge {
        background-color: #e8f5e9;
        color: #2e7d32;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }
</style>

<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?page=accueil" class="text-decoration-none">Accueil</a></li>
            <li class="breadcrumb-item"><a href="index.php?page=panier" class="text-decoration-none">Panier</a></li>
            <li class="breadcrumb-item active" aria-current="page">Paiement</li>
        </ol>
    </nav>

    <!-- Titre principal -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: var(--forest-green);">Finaliser votre commande</h1>
        <p class="text-muted">Remplissez vos informations de paiement et de livraison</p>
        <div class="d-flex justify-content-center mt-3">
            <span class="secure-badge">
                 Paiement 100% sécurisé
            </span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="payment-container p-4">
                <form id="paymentForm" action="index.php?page=confirmation-commande" method="POST">
                    
                    <section class="mb-5">
                        <h3 class="section-title"> Informations de livraison</h3>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom *</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom *</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-12">
                                <label for="adresse" class="form-label">Adresse *</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="12 rue de la Paix" required>
                            </div>
                            <div class="col-md-6">
                                <label for="codePostal" class="form-label">Code postal *</label>
                                <input type="text" class="form-control" id="codePostal" name="code_postal" pattern="[0-9]{5}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ville" class="form-label">Ville *</label>
                                <input type="text" class="form-control" id="ville" name="ville" required>
                            </div>
                            <div class="col-12">
                                <label for="telephone" class="form-label">Téléphone *</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" pattern="[0-9]{10}" placeholder="0612345678" required>
                            </div>
                        </div>
                    </section>

                    <section class="mb-5">
                        <h3 class="section-title"> Mode de livraison</h3>
                        
                        <div class="payment-method mb-3 selected" onclick="selectShipping(this)">
                            <div class="d-flex align-items-center">
                                <input type="radio" name="livraison" value="standard" id="standard" checked>
                                <label for="standard" class="ms-3 mb-0 flex-grow-1">
                                    <strong>Livraison standard (5-7 jours)</strong>
                                    <div class="text-muted small">Colissimo - Suivi de colis</div>
                                </label>
                                <span class="fw-bold">5,90 €</span>
                            </div>
                        </div>

                        <div class="payment-method" onclick="selectShipping(this)">
                            <div class="d-flex align-items-center">
                                <input type="radio" name="livraison" value="express" id="express">
                                <label for="express" class="ms-3 mb-0 flex-grow-1">
                                    <strong>Livraison express (2-3 jours)</strong>
                                    <div class="text-muted small">Chronopost - Livraison rapide</div>
                                </label>
                                <span class="fw-bold">12,90 €</span>
                            </div>
                        </div>
                    </section>

                    <section class="mb-4">
                        <h3 class="section-title">Méthode de paiement</h3>
                        
                        <div class="payment-method mb-3 selected" onclick="selectPayment(this)">
                            <div class="d-flex align-items-center">
                                <input type="radio" name="payment_method" value="carte" id="carte" checked>
                                <label for="carte" class="ms-3 mb-0">
                                    <strong>Carte bancaire</strong>
                                </label>
                            </div>
                        </div>

                        <div id="carteForm" class="mt-3 ms-5">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="cardNumber" class="form-label">Numéro de carte *</label>
                                    <input type="text" class="form-control" id="cardNumber" name="card_number" 
                                           placeholder="1234 5678 9012 3456" maxlength="19" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cardExpiry" class="form-label">Date d'expiration *</label>
                                    <input type="text" class="form-control" id="cardExpiry" name="card_expiry" 
                                           placeholder="MM/AA" maxlength="5" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cardCVC" class="form-label">CVV *</label>
                                    <input type="text" class="form-control" id="cardCVC" name="card_cvc" 
                                           placeholder="123" maxlength="3" required>
                                </div>
                            </div>
                        </div>

                        <div class="payment-method mt-3" onclick="selectPayment(this)">
                            <div class="d-flex align-items-center">
                                <input type="radio" name="payment_method" value="paypal" id="paypal">
                                <label for="paypal" class="ms-3 mb-0">
                                    <strong>PayPal</strong>
                                    <div class="text-muted small">Vous serez redirigé vers PayPal</div>
                                </label>
                            </div>
                        </div>
                    </section>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="cgu" required>
                        <label class="form-check-label" for="cgu">
                            J'accepte les <a href="#" class="text-decoration-none">conditions générales de vente</a> *
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-pay btn-lg">
                             Payer <?= number_format($totalFinal, 2, ',', ' ') ?> €
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="order-summary position-sticky" style="top: 20px;">
                <h3 class="section-title"> Récapitulatif</h3>
                
                <?php if (!empty($articlesPanier)): ?>
                    <div class="mb-3">
                        <?php foreach ($articlesPanier as $item): ?>
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold"><?= htmlspecialchars($item->getTitle()) ?></div>
                                    <div class="text-muted small">Taille : <?= htmlspecialchars($item->getSize()) ?></div>
                                </div>
                                <div class="text-end fw-semibold">
                                    <?= number_format($item->getPrice(), 2, ',', ' ') ?> €
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center">Votre panier est vide</p>
                <?php endif; ?>

                <div class="summary-line">
                    <span>Sous-total HT</span>
                    <span><?= number_format($sousTotalHT, 2, ',', ' ') ?> €</span>
                </div>
                <div class="summary-line">
                    <span>TVA (20%)</span>
                    <span><?= number_format($tva, 2, ',', ' ') ?> €</span>
                </div>
                <div class="summary-line">
                    <span>Frais de livraison</span>
                    <span id="fraisLivraison"><?= number_format($fraisLivraison, 2, ',', ' ') ?> €</span>
                </div>
                <div class="summary-line total">
                    <span>Total TTC</span>
                    <span id="totalFinal"><?= number_format($totalFinal, 2, ',', ' ') ?> €</span>
                </div>

                <div class="mt-4 p-3 bg-white rounded">
                    <h6 class="fw-bold mb-3" style="color: var(--forest-green);">✨ Vos avantages</h6>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">✓ Retour gratuit sous 30 jours</li>
                        <li class="mb-2">✓ Service client 7j/7</li>
                        <li class="mb-2">✓ Paiement 100% sécurisé</li>
                        <li>✓ Livraison suivie</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function selectPayment(element) {
        var methods = document.querySelectorAll('.payment-method');
        for (var i = 0; i < methods.length; i++) {
            methods[i].classList.remove('selected');
        }
        element.classList.add('selected');
        element.querySelector('input[type="radio"]').checked = true;

        var carteForm = document.getElementById('carteForm');
        var carteRadio = document.getElementById('carte');
        if (carteRadio.checked) {
            carteForm.style.display = 'block';
        } else {
            carteForm.style.display = 'none';
        }
    }

    function selectShipping(element) {
        var methods = document.querySelectorAll('.payment-method');
        for (var i = 0; i < methods.length; i++) {
            var input = methods[i].querySelector('input[name="livraison"]');
            if (input) {
                methods[i].classList.remove('selected');
            }
        }
        element.classList.add('selected');
        element.querySelector('input[type="radio"]').checked = true;

        var value = element.querySelector('input[type="radio"]').value;
        var frais = value === 'express' ? 12.90 : 5.90;
        
        var sousTotalHT = <?= $sousTotalHT ?>;
        var tva = <?= $tva ?>;
        var totalTTC = sousTotalHT + tva + frais;
        
        document.getElementById('fraisLivraison').textContent = frais.toFixed(2).replace('.', ',') + ' €';
        document.getElementById('totalFinal').textContent = totalTTC.toFixed(2).replace('.', ',') + ' €';
        document.querySelector('.btn-pay').innerHTML = '🔒 Payer ' + totalTTC.toFixed(2).replace('.', ',') + ' €';
    }

    document.getElementById('cardNumber').addEventListener('input', function(e) {
        var value = e.target.value.replace(/\s/g, '');
        var formatted = '';
        for (var i = 0; i < value.length; i++) {
            if (i > 0 && i % 4 === 0) {
                formatted += ' ';
            }
            formatted += value[i];
        }
        e.target.value = formatted;
    });

    document.getElementById('cardExpiry').addEventListener('input', function(e) {
        var value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        e.target.value = value;
    });

    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!document.getElementById('cgu').checked) {
            alert('Veuillez accepter les conditions générales de vente');
            return;
        }

        if (document.getElementById('paypal').checked) {
            alert('Redirection vers PayPal...');
            return;
        }

        alert('Paiement en cours de traitement...');
        this.submit();
    });
</script>

<?php
include_once 'src/views/partials/footer.php';
?>
