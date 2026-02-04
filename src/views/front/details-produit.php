<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../partials/header.php';
?>

<div class="container my-5">
    <div class="row g-4 align-items-center">
        
        <div class="col-12 col-md-6">
            <div class="bg-light rounded p-4 p-md-5 text-center shadow-sm">
                <img src="../../public/img/banniere.jpg" class="img-fluid rounded" alt="Produit">
                <p class="mt-3 text-muted d-md-none">L'image du produit</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="articles.php" class="text-decoration-none text-dark">Articles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>

            <h1 class="display-5 fw-bold">Nom de l'article</h1>
            <p class="fs-2 text-primary mb-4">0€</p>
            
            <div class="mb-4">
                <h5 class="fw-bold">Description du produit</h5>
            </div>

            <button class="btn btn-dark btn-lg w-100 py-3 shadow-sm">
                Ajouter au panier
            </button>
        </div>
    </div>
</div>

<?php
include '../partials/footer.php';
?>