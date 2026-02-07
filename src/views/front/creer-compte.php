<?php
include_once 'src/views/partials/header.php';
?>

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

            <form action="/projet-php-b2/index.php?action=submit_register" method="POST">
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

                <button type="submit" class="btn btn-primary w-100">
                    Créer mon compte
                </button>
            </form>

            <p class="text-center mt-3">
                Déjà un compte ?
                <a href="/projet-php-b2/src/views/front/connexion.php">Connectez-vous</a>
            </p>
        </div>
    </div>
</div>

<?php include_once 'src/views/partials/footer.php'; ?>