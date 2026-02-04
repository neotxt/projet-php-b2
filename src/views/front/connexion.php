<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../partials/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Connexion</h2>

            <?php if (!empty($_SESSION['register_success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['register_success']; unset($_SESSION['register_success']); ?>
                </div>
            <?php endif; ?>

            <form action="/projet-php-b2/src/controllers/login.php" method="POST">
                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Se connecter</button>
            </form>

            <p class="text-center mt-3">
                Pas encore de compte ?
                <a href="/projet-php-b2/src/views/front/creer-compte.php">Créer un compte</a>
            </p>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>