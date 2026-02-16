<?php
include_once 'src/views/partials/header.php';
?>
<style>
    :root {
        --forest-green: #1a3020; /* Vert forêt du modèle */
        --cream-bg: #f9f7f2;    /* Beige crème du modèle */
        --gold-accent: #c4a47c;  /* Doré pour les interactions */
        --soft-green: #2d5a3d;   /* Vert doux pour les sous-titres */
    }

    /* Changement du fond de TOUTE la page */
    body {
        background-color: var(--cream-bg) !important;
    }

    .custom-card {
        background-color: #ffffff !important;
        border-left: 5px solid var(--gold-accent) !important;
    }

    /* Titre principal avec gradient */
    .custom-card h1 {
        color: var(--forest-green) !important;
        font-weight: 800 !important;
        letter-spacing: -0.5px;
    }

    /* Sous-titre avec couleur dorée */
    .custom-card .lead {
        color: var(--gold-accent) !important;
        font-size: 1.3rem !important;
    }

    /* Titres secondaires */
    .custom-card h2 {
        color: var(--soft-green) !important;
        font-weight: 700 !important;
        border-bottom: 3px solid var(--gold-accent);
        display: inline-block;
        padding-bottom: 8px;
    }

    /* Texte normal */
    .custom-card p {
        color: #4a4a4a !important;
        line-height: 1.8;
        font-size: 1.05rem;
    }

    /* Mots en gras avec couleur verte */
    .custom-card strong {
        color: var(--forest-green) !important;
        font-weight: 700;
    }

    /* Liste avec icônes personnalisées */
    .custom-card .list-group-item {
        color: var(--soft-green) !important;
        transition: all 0.3s ease;
        padding-left: 0;
        font-weight: 500;
    }

    .custom-card .list-group-item:hover {
        color: var(--gold-accent) !important;
        transform: translateX(10px);
    }

    /* Section footer de la carte */
    .tech-footer {
        background: linear-gradient(135deg, var(--forest-green) 0%, var(--soft-green) 100%);
        color: white !important;
        border-radius: 8px;
        padding: 20px;
        margin-top: 30px;
    }

    .tech-footer p, .tech-footer strong {
        color: white !important;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            
            <div class="card border-0 custom-card shadow-sm rounded-4 p-4 p-md-5">
                
                <div class=" mb-5">
                    <h1 class="display-4 fw-bold">Qui sommes-nous ?</h1>
                    <p class="lead fw-bold text-dark">Une équipe de trois étudiants en Bachelor 2 informatique.</p>
                </div>

                <div class="mb-5">
                    <p>Dans le cadre de notre cours de <strong>PHP</strong>, nous réalisons un projet pédagogique visant à mettre en pratique le développement web et la gestion de bases de données.</p>
                    <p>Ce projet nous permet de travailler en équipe, de comprendre le fonctionnement d’un site dynamique et d’appliquer les bases du développement back-end et front-end.</p>
                </div>

                <div class="mt-4">
                    <h2 class="h1 fw-bold mb-4">Notre projet</h2>
                    <p>Nous développons un site e-commerce de vente de vêtements en ligne, conçu pour mettre en relation vendeurs et acheteurs.</p>
                    
                    <p class="fw-bold mt-4">L’objectif est de créer une plateforme simple et fonctionnelle permettant :</p>
                    <ul class="list-group list-group bg-transparent mb-4">
                        <li class="list-group-item bg-transparent border-0 "> - de consulter des articles de vêtements</li>
                        <li class="list-group-item bg-transparent border-0 "> - de s’inscrire et de se connecter</li>
                        <li class="list-group-item bg-transparent border-0 "> - de gérer un panier d’achat</li>
                        <li class="list-group-item bg-transparent border-0 "> - de passer des commandes</li>
                        <li class="list-group-item bg-transparent border-0 "> - d’administrer le site via un back-office</li>
                    </ul>
                </div>

                <div class="tech-footer">
                    <p class="mb-1">Développé en <strong>PHP</strong> & <strong>SQL</strong></p>
                    <p class="mb-0">Environnement : XAMPP</p>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
// Inclusion du footer commun (liens, scripts)
include_once 'src/views/partials/footer.php';
?>