<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique de Vêtements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/projet-php-b2/src/public/style.css">

    <style>
        :root {
            --forest-green: #1a3020; /* Le vert profond du modèle */
            --cream-bg: #f9f7f2;    /* Le fond beige très clair */
            --gold-accent: #c4a47c;  /* L'accent sable/doré */
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #fff;
        }

        /* Style de la barre de navigation */
        .custom-navbar {
            background-color: var(--forest-green) !important;
        }

        .custom-navbar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: color 0.3s;
        }

        .custom-navbar .nav-link:hover {
            color: var(--gold-accent) !important;
        }

        .custom-navbar .navbar-brand {
            color: #ffffff !important;
            letter-spacing: 1px;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar border-bottom border-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php?page=accueil">
                <img src="src/public/img/logo.png" alt="Logo" style="height:40px; width:auto; vertical-align:middle;">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="index.php?page=accueil">Accueil</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="index.php?page=articles">Articles</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="index.php?page=mes-articles">Mon Vide Dressing</a>
                    </li>
                    <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    <li class="nav-item me-3">
                        <a class="nav-link text-warning fw-bold" href="index.php?page=admin">Espace Admin</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="index.php?page=a-propos">Qui sommes-nous ?</a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link me-lg-3 d-inline-flex align-items-center position-relative" href="index.php?page=panier" style="padding-right: 1.8em;">
                            Panier
                            <?php
                                $nbArticles = isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0;
                                if ($nbArticles > 0) {
                            ?>
                                
                                <span class="badge bg-danger text-white rounded-circle position-absolute" style="right:0.2em; top:0.2em; min-width:1.3em; height:1.3em; font-size:0.9em; display:flex; align-items:center; justify-content:center; z-index:2;">
                                    <?= $nbArticles ?>
                                </span>
                                
                            <?php } ?>
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <!-- affichage du profil de l'utilisateur en haut a droite de la page -->
                        <?php if (!empty($_SESSION['user_email'])):
                            $initials = strtoupper(substr($_SESSION['user_email'], 0, 2)); ?>
                            <a class="nav-link dropdown-toggle p-0" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-inline-block rounded-circle text-white text-center shadow-sm"
                                    style="width:40px; height:40px; line-height:40px; font-weight:bold; background-color: var(--gold-accent);">
                                    <?= htmlspecialchars($initials) ?>
                                </span>
                            </a>
                            <!-- menu de déconnexion -->
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
                                <li><span class="dropdown-item-text small text-muted"><?= htmlspecialchars($_SESSION['user_email']) ?></span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="index.php?action=logout">Déconnexion</a></li>
                            </ul>
                        <?php else: ?>
                            <a class="btn btn-outline-light btn-sm px-3 rounded-pill" href="index.php?page=connexion">Connexion</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>