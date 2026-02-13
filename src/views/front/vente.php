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
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success text-center">
                    <?= $_SESSION['success']; ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
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
                            <p class="mb-0 mt-2 text-muted">Ajoutez une photo de votre article</p>
                            <input type="file" id="fileInput" name="image" style="display: none;" required
                                onchange="previewImage(event)">
                            <div id="imagePreview" class="mt-3 d-none">
                                <img id="preview" src="#" alt="Aperçu" style="max-width: 100px; border-radius: 8px;">
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">2. Détails de l'annonce</h5>

                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="title" class="form-control form-control-lg border-0 bg-light"
                                placeholder="Ex: pantalon" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control border-0 bg-light" rows="4"
                                placeholder="Décrivez l'état, la matière, la coupe..." required></textarea>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">3. Catégorie, État & Prix</h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Catégorie</label>
                                <select name="category" class="form-select border-0 bg-light" required>
                                    <option value="">Choisir une catégorie</option>
                                    <option value="pantalon">Pantalon</option>
                                    <option value="tshirt">T-shirt</option>
                                    <option value="robe">Robe</option>
                                    <option value="accessoires">Accessoires</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">État</label>
                                <select name="condition" class="form-select border-0 bg-light" required>
                                    <option value="">Choisir l'état</option>
                                    <option value="neuf">Neuf avec étiquette</option>
                                    <option value="tres_bon">Très bon état</option>
                                    <option value="bon">Bon état</option>
                                    <option value="satisfaisant">Satisfaisant</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label class="form-label">Taille</label>
                                <select name="size" class="form-select border-0 bg-light" required>
                                    <option value="">Choisir une taille</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label class="form-label">Prix de vente (€)</label>
                                <div class="input-group">
                                    <input type="number" name="price" class="form-control border-0 bg-light"
                                        placeholder="0.00" step="0.01" required>
                                    <span class="input-group-text border-0 bg-light">€</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-custom btn-lg w-100 py-3 fw-bold rounded-3 shadow">
                            Ajouter mon article
                        </button>
                        <p class="text-muted small mt-3">En publiant, vous acceptez nos conditions générales de
                            vente.
                        </p>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('preview');
            output.src = reader.result;
            document.getElementById('imagePreview').classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?php
// Inclusion du footer commun (liens, scripts)
include_once __DIR__ . '/../partials/footer.php';
?>