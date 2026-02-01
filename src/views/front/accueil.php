<?php 

include '../partials/header.php'; 

?>

<style>
.home-banner {
    
    background-image: 
        linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
        url('../../public/img/banniere.jpg');
    
    background-size: cover;
    background-position: center;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<section class="home-banner text-white p-5 text-center shadow-sm">
    <div class="container py-5">
        <h1 class="display-3 fw-bold">Nouvelle Collection</h1>
        <p class="lead fs-3">Découvrez les tendances</p>
        <a href="articles.php" class="btn btn-light btn-lg mt-3">Voir les articles</a>
    </div>
</section>

<div class="container my-5">
    <h1 class="text-center">Bienvenue sur ma boutique</h1>
    <h2 class="text-center mb-5 text-muted">Nos Articles</h2>
    
    <div class="row">
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="../../public/img/banniere.jpg" class="card-img-top" alt="Vêtement 1">
                <div class="card-body text-center">
                    <h5 class="card-title">Robe d'été</h5>
                    <p class="card-text text-primary fw-bold">49,99 €</p>
                    <a href="#" class="btn btn-outline-dark">Détails</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="../../public/img/banniere.jpg" class="card-img-top" alt="Vêtement 2">
                <div class="card-body text-center">
                    <h5 class="card-title">Chemise en lin</h5>
                    <p class="card-text text-primary fw-bold">35,00 €</p>
                    <a href="#" class="btn btn-outline-dark">Détails</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="../../public/img/banniere.jpg" class="card-img-top" alt="Vêtement 3">
                <div class="card-body text-center">
                    <h5 class="card-title">Pantalon Chino</h5>
                    <p class="card-text text-primary fw-bold">55,90 €</p>
                    <a href="#" class="btn btn-outline-dark">Détails</a>
                </div>
            </div>
        </div>

    </div> </div> 
</div>

<?php 

include '../partials/footer.php'; 
?>