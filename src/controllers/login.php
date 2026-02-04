<?php
session_start();
require_once '../config/database.php';


#page pour la connexion des utilisateurs

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /projet-php-b2/src/views/front/connexion.php');
    exit();
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    $_SESSION['error'] = "Tous les champs sont obligatoires.";
    header('Location: /projet-php-b2/src/views/front/connexion.php');
    exit();
}

$conn = getDbConnection();
$stmt = $conn->prepare('SELECT id, email, password FROM Users WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Connexion réussie puis redirection vers la page d'accueil
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    header('Location: /projet-php-b2/src/views/front/accueil.php');
    exit();
} else {
    //Si mdp ou mail incorect se message s'affiche
    $_SESSION['error'] = "Email ou mot de passe incorrect.";
    header('Location: /projet-php-b2/src/views/front/connexion.php');
    exit();
}
