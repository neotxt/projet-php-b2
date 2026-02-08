<?php
// 1. On récupère l'ID qui est dans l'URL
$id_article = $_GET['id'] ?? null;

// 2. Simulation de données (En attendant ta base de données SQL)
// Normalement, ici on fait une requête SQL : "SELECT * FROM articles WHERE id = $id_article"
$articles = [
    1 => ['nom' => "Robe d'été", 'prix' => "49,99 €", 'image' => "banniere.jpg", 'desc' => "Une robe légère pour l'été."],
    2 => ['nom' => "Chemise en lin", 'prix' => "35,00 €", 'image' => "banniere.jpg", 'desc' => "Le confort du lin."],
    3 => ['nom' => "Pantalon Chino", 'prix' => "55,90 €", 'image' => "banniere.jpg", 'desc' => "Un classique élégant."]
];

// 3. On sélectionne les infos de l'article cliqué
$produit = $articles[$id_article] ?? null;

// Si l'article n'existe pas, on peut rediriger ou afficher une erreur
if (!$produit) {
    echo "Produit introuvable !";
    exit;
}

include '../partials/header.php';
?>

<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-6">
            <img src="src/public/img/<?= $produit['image'] ?>" class="img-fluid rounded-4 shadow" alt="<?= $produit['nom'] ?>">
        </div>
        <div class="col-md-6">
            <h1 class="display-5 fw-bold"><?= $produit['nom'] ?></h1>
            <p class="fs-2 text-primary fw-bold"><?= $produit['prix'] ?></p>
            <div class="mb-4">
                <h5 class="fw-bold">Description</h5>
                <p class="text-muted"><?= $produit['desc'] ?></p>
            </div>
            <button class="btn btn-dark btn-lg w-100 py-3">Ajouter au panier</button>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>