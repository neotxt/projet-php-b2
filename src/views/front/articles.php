<?php
// Vue : liste des articles
// Inclusion du header (menu, CSS commun)
include_once 'src/views/partials/header.php';
?>

<div class="container my-5">
    <h1 class="text-center mb-5">Nos Articles</h1>

    <div class="row g-3 g-md-4 justify-content-center">

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="src/public/img/banniere.jpg" class="card-img-top img-fluid" alt="Produit">
                <div class="card-body text-center p-2 p-md-3">
                    <h5 class="card-title fs-6 fs-md-5">Article Mode 1</h5>
                    <p class="card-text text-primary fw-bold mb-2">29,99 €</p>
                    <a href="index.php?page=details-produit&id=1" class="btn btn-dark btn-sm w-100">Détails</a>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="src/public/img/banniere.jpg" class="card-img-top img-fluid" alt="Produit">
                <div class="card-body text-center p-2 p-md-3">
                    <h5 class="card-title fs-6 fs-md-5">Article Mode 2</h5>
                    <p class="card-text text-primary fw-bold mb-2">39,99 €</p>
                    <a href="index.php?page=details-produit&id=2" class="btn btn-dark btn-sm w-100">Détails</a>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="src/public/img/banniere.jpg" class="card-img-top img-fluid" alt="Produit">
                <div class="card-body text-center p-2 p-md-3">
                    <h5 class="card-title fs-6 fs-md-5">Article Mode 3</h5>
                    <p class="card-text text-primary fw-bold mb-2">19,99 €</p>
                    <a href="index.php?page=details-produit&id=3" class="btn btn-dark btn-sm w-100">Détails</a>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
// Inclusion du footer (scripts, informations de bas de page)
include_once 'src/views/partials/footer.php';
?>