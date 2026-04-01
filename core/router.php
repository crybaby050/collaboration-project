<?php

// Inclure le modèle
require_once __DIR__ . '/../model/other/recup.php';

// Récupérer la page demandée
$page = $_GET['page'] ?? 'login';

// Pages publiques
$publicPages = ['login', 'register'];

// Vérifier l'authentification
if (!isset($_SESSION['userConnect']) && !in_array($page, $publicPages)) {
    redirect('?page=login');
    exit;
}

// Si l'utilisateur est connecté, charger le header
if ($page !== 'login' && $page !== 'register') {
    require_once __DIR__ . '/../view/header.php';
    $nameUser = $_SESSION['userConnect']['prenom'] . " " . $_SESSION['userConnect']['nom'];
}

// Routage
switch ($page) {
    case 'login':
        require_once __DIR__ . '/../controller/loginController.php';
        loginPage();
        break;
        
    case 'dashboard':
        require_once __DIR__ . '/../controller/dashboardController.php';
        dashboardPage();
        break;

    case 'logout':
        session_destroy();
        redirect('?page=login');
        exit;

    default:
        require_once __DIR__ . '/../controller/loginController.php';
        loginPage();
        break;
}

// Si l'utilisateur est connecté, charger le footer
if ($page !== 'login' && $page !== 'register') {
    require_once __DIR__ . '/../view/footer.php';
}

// TEST TEMPORAIRE
echo "<!-- ROUTER TERMINÉ -->";