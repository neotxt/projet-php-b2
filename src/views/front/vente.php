<?php
// Inclusion du header (menu, CSS commun)
include_once __DIR__ . '/../partials/header.php';
?>

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

    /* Style de la carte du formulaire */
    .sell-card {
        background-color: #ffffff !important;
        border: none !important;
    }

    /* Style des labels pour l'élégance */
    .form-label {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }

    /* Bouton personnalisé Vert Forêt */
    .btn-custom {
        background-color: var(--forest-green) !important;
        border-color: var(--forest-green) !important;
        color: #ffffff !important;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background-color: var(--gold-accent) !important;
        border-color: var(--gold-accent) !important;
        transform: translateY(-2px);
    }

    /* Zone d'upload d'image façon Vinted */
    .upload-zone {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 40px;
        text-align: center;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: border-color 0.3s;
    }

    .upload-zone:hover {
        border-color: var(--gold-accent);
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold">Vendre un article</h1>
                <p class="lead">Donnez une seconde vie à vos vêtements en quelques clics.</p>
            </div>

            <div class="card sell-card shadow-sm rounded-4 p-4 p-md-5">
                <form action="index.php?action=submit_vendre" method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-5">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">1. Photo de l'article</h5>
                        <div class="upload-zone" onclick="document.getElementById('fileInput').click();">
                            <span class="fs-1 text-muted"></span>
                            <p class="mb-0 mt-2 text-muted">Ajoutez jusqu'à 5 photos</p>
                            <input type="file" id="fileInput" name="images[]" style="display: none;" multiple required>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">2. Détails de l'annonce</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="nom" class="form-control form-control-lg border-0 bg-light" placeholder="Ex: Robe à fleurs Zara" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control border-0 bg-light" rows="4" placeholder="Décrivez l'état, la matière, la coupe..." required></textarea>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">3. Catégorie & Prix</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Catégorie</label>
                                <select name="categorie" class="form-select border-0 bg-light" required>
                                    <option value="">Choisir une catégorie</option>
                                    <option value="femme">Femme</option>
                                    <option value="homme">Homme</option>
                                    <option value="enfant">Enfant</option>
                                    <option value="accessoires">Accessoires</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">État</label>
                                <select name="etat" class="form-select border-0 bg-light" required>
                                    <option value="">Choisir l'état</option>
                                    <option value="neuf">Neuf avec étiquette</option>
                                    <option value="tres_bon">Très bon état</option>
                                    <option value="bon">Bon état</option>
                                    <option value="satisfaisant">Satisfaisant</option>
                                </select>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="form-label">Prix de vente (€)</label>
                                <div class="input-group">
                                    <input type="number" name="prix" class="form-control form-control-lg border-0 bg-light" placeholder="0.00" step="0.01" required>
                                    <span class="input-group-text border-0 bg-light">€</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-custom btn-lg w-100 py-3 fw-bold rounded-3 shadow">
                            Ajouter mon article
                        </button>
                        <p class="text-muted small mt-3">En publiant, vous acceptez nos conditions générales de vente.</p>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<?php
// Inclusion du footer commun (liens, scripts)
include_once __DIR__ . '/../partials/footer.php';
?>