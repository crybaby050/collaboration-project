<?php

// Inclure le modèle
require_once __DIR__ . '/../model/other/recup.php';

// Récupérer la page demandée
$page = $_GET['page'] ?? 'login';
echo "<!-- DEBUG: page = $page -->\n";  // AJOUTER CETTE LIGNE

// Pages publiques
$publicPages = ['login', 'register'];

// Vérifier l'authentification
if (!isset($_SESSION['userConnect']) && !in_array($page, $publicPages)) {
    redirect('?page=login');
    exit;
}

// Si l'utilisateur est connecté, charger le header
if ($page !== 'login' && $page !== 'register') {
    echo "<!-- DEBUG: Chargement du header -->\n";  // AJOUTER CETTE LIGNE
    require_once __DIR__ . '/../view/header.php';
    $nameUser = $_SESSION['userConnect']['prenom'] . " " . $_SESSION['userConnect']['nom'];
}

// Routage
switch ($page) {
    case 'login':
        echo "<!-- DEBUG: Chargement de loginPage -->\n";  // AJOUTER CETTE LIGNE
        require_once __DIR__ . '/../controller/loginController.php';
        loginPage();
        break;
        
    case 'dashboard':
        echo "<!-- DEBUG: Chargement de dashboardPage -->\n";  // AJOUTER CETTE LIGNE
        require_once __DIR__ . '/../controller/dashboardController.php';
        dashboardPage();
        break;
        
    default:
        echo "<!-- DEBUG: Chargement par défaut (login) -->\n";  // AJOUTER CETTE LIGNE
        require_once __DIR__ . '/../controller/loginController.php';
        loginPage();
        break;
}

// Si l'utilisateur est connecté, charger le footer
if ($page !== 'login' && $page !== 'register') {
    echo "<!-- DEBUG: Chargement du footer -->\n";  // AJOUTER CETTE LIGNE
    require_once __DIR__ . '/../view/footer.php';
}