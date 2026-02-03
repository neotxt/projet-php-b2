<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /projet-php-b2/src/views/front/creer-compte.php');
    exit();
}

// Récupération des données
$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Validation basique
if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($confirm_password)) {
    $_SESSION['error'] = "Tous les champs sont obligatoires.";
    header('Location: /projet-php-b2/src/views/front/creer-compte.php');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Email invalide.";
    header('Location: /projet-php-b2/src/views/front/creer-compte.php');
    exit();
}

if ($password !== $confirm_password) {
    $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
    header('Location: /projet-php-b2/src/views/front/creer-compte.php');
    exit();
}

// Mot de passe fort
if (
    strlen($password) < 12 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[0-9]/', $password) ||
    !preg_match('/[^A-Za-z0-9]/', $password)
) {
    $_SESSION['error'] = "Mot de passe trop faible.";
    header('Location: /projet-php-b2/src/views/front/creer-compte.php');
    exit();
}

// Connexion BDD
$conn = getDbConnection();

// Vérifier email unique
$stmt = $conn->prepare('SELECT id FROM Users WHERE email = ?');
$stmt->execute([$email]);

if ($stmt->fetch()) {
    $_SESSION['error'] = "Cet email est déjà utilisé.";
    header('Location: /projet-php-b2/src/views/front/creer-compte.php');
    exit();
}

// Hash du mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertion utilisateur
$stmt = $conn->prepare(
    'INSERT INTO Users (nom, prenom, email, password) VALUES (?, ?, ?, ?)'
);

if ($stmt->execute([$nom, $prenom, $email, $hashed_password])) {
    $_SESSION['register_success'] = "Compte créé avec succès. Connectez-vous.";
    header('Location: /projet-php-b2/src/views/front/connexion.php');
    exit();
}

$_SESSION['error'] = "Erreur lors de la création du compte.";
header('Location: /projet-php-b2/src/views/front/creer-compte.php');
exit();
