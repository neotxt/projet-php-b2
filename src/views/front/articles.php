<?php
// Vue : liste des articles
// Inclusion du header (menu, CSS commun)
include '../partials/header.php';
?>

<div class="container my-5">
    <h1 class="text-center mb-5">Nos Articles</h1>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="../../public/img/banniere.jpg" class="card-img-top" alt="Produit">
                <div class="card-body text-center">
                    <h5 class="card-title">Article Mode 1</h5>
                    <p class="card-text text-primary fw-bold">29,99 €</p>
                    <a href="details-produit.php?id=1" class="btn btn-dark">Détails</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="../../public/img/banniere.jpg" class="card-img-top" alt="Produit">
                <div class="card-body text-center">
                    <h5 class="card-title">Article Mode 2</h5>
                    <p class="card-text text-primary fw-bold">39,99 €</p>
                    <a href="details-produit.php?id=2" class="btn btn-dark">Détails</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="../../public/img/banniere.jpg" class="card-img-top" alt="Produit">
                <div class="card-body text-center">
                    <h5 class="card-title">Article Mode 3</h5>
                    <p class="card-text text-primary fw-bold">19,99 €</p>
                    <a href="details-produit.php?id=3" class="btn btn-dark">Détails</a>
                </div>
            </div>
        </div>
        
        </div>
</div>

<?php
// Inclusion du footer (scripts, informations de bas de page)
include '../partials/footer.php';
?>