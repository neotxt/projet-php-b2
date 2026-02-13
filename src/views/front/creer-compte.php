<?php
include_once 'src/views/partials/header.php';
?>

<style>
 body {
        background-color: var(--cream-bg) !important;
    }

    .custom-card {
        background-color: var(--cream-bg) !important;
        color: var(--forest-green) !important;
    }

    /* Style personnalisé pour assortir le bouton au thème Forest & Gold */
    .btn-custom {
        background-color: var(--forest-green) !important;
        border-color: var(--forest-green) !important;
        color: #ffffff !important;
        transition: all 0.3s ease;
    }

    /* Effet doré au survol comme sur le header et le panier */
    .btn-custom:hover {
        background-color: var(--gold-accent) !important;
        border-color: var(--gold-accent) !important;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Créer un compte</h2>

            <!-- affiche le message d'erreur -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            
            <form action="index.php?action=submit_register" method="POST">
                <div class="mb-2">
                    <label>Nom</label>
                    <input type="text" name="lastName" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Prénom</label>
                    <input type="text" name="firstName" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" name="confirmPassword" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-custom w-100">
                    Créer mon compte
                </button>
            </form>

            <p class="text-center mt-3">
                Déjà un compte ?
               <a href="index.php?page=login">Connectez-vous</a>
            </p>
        </div>
    </div>
</div>

<?php include_once 'src/views/partials/footer.php'; ?>