<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique de Vêtements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/projet-php-b2/src/public/style.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php?page=accueil">LOGO</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=articles">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=a-propos">Qui sommes-nous ?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=panier">Panier</a>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- affichage du profil de l'utilisateur en haut a droite de la page -->
                        <?php if (!empty($_SESSION['user_email'])):
                            $initials = strtoupper(substr($_SESSION['user_email'], 0, 2)); ?>
                            <a class="nav-link dropdown-toggle p-0" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="display:inline-block;">
                                <span class="d-inline-block rounded-circle bg-primary text-white text-center"
                                    style="width:40px; height:40px; line-height:40px; font-weight:bold; font-size:1.1rem;">
                                    <?= htmlspecialchars($initials) ?>
                                </span>
                            </a>
                            <!-- menu de déconnexion -->
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><span
                                        class="dropdown-item-text small text-muted"><?= htmlspecialchars($_SESSION['user_email']) ?></span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?action=logout">Déconnexion</a></li>
                            </ul>
                        <?php else: ?>
                            <a class="nav-link" href="index.php?page=connexion">Connexion / Inscription</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>