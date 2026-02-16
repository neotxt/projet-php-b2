
# projet-php-b2

## Présentation

Ce projet est un site e-commerce développé en PHP (architecture MVC) permettant la vente de vêtements entre utilisateurs. Il inclut :
- Un espace utilisateur (inscription, connexion, gestion de ses articles)
- Un espace administrateur (gestion des utilisateurs, suppression d'articles, gestion des droits)
- Un panier, un système de paiement, et la génération de factures (invoices)

## Structure du projet

```
src/
	config/         # Configuration (connexion PDO à la base de données)
	controllers/    # Contrôleurs (logique métier, routage)
	models/         # Modèles (représentation des entités, accès aux données)
	Repositories/   # Requêtes SQL et gestion des entités
	Services/       # Logique métier avancée
	Utils/          # Utilitaires (logger, etc.)
	Validators/     # Validation des formulaires
	views/          # Vues (pages PHP dynamiques, partiels)
public/           # Fichiers statiques (CSS, images)
sql/              # Script de création de la base de données
logs/             # Logs d'activité
index.php         # Point d'entrée principal (routeur)
```

## Fonctionnalités principales

- Inscription et connexion utilisateur
- Mise en vente, affichage et suppression d'articles
- Panier d'achat et passage de commande
- Paiement sécurisé (simulation)
- Génération automatique d'une facture après paiement (table Invoice)
- Espace administrateur : gestion des utilisateurs et des articles

## Paiement et facturation

Lorsqu'un utilisateur valide son panier, il renseigne ses informations de livraison et de paiement. Une commande est créée, puis une facture est générée automatiquement avec les informations saisies (adresse, ville, code postal, montant total, date, etc.).

## Lancement du projet

1. Cloner le dépôt et placer le dossier dans `htdocs` de XAMPP
2. Importer le fichier `sql/database.sql` dans phpMyAdmin
3. Adapter les paramètres de connexion dans `src/config/database.php` si besoin
4. Démarrer Apache/MySQL via XAMPP
5. Accéder au site via `http://localhost/projet-php-b2`

## Accès admin

Un compte admin est présent dans la base de données (voir `database.sql`).

---
Projet réalisé en février 2026