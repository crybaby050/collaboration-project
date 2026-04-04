<?php

// Inclure le modèle
require_once __DIR__ . '/../model/init.php';
require_once __DIR__ . '/allController.php';

// Récupérer la page demandée
$page = $_GET['page'] ?? 'login';

// ============================================
// TRAITER LA DÉCONNEXION EN PREMIER
// ============================================
if ($page === 'logout') {
    session_destroy();
    redirect('?page=login');
    exit;
}

// ============================================
// SUITE DU ROUTAGE
// ============================================

// Pages publiques
$publicPages = ['login', 'register'];

// Vérifier l'authentification
if (!isset($_SESSION['userConnect']) && !in_array($page, $publicPages)) {
    redirect('?page=login');
    exit;
}

// Routage
// NOTE : Le header est maintenant inclus dans chaque controller APRÈS
// la préparation des variables, pour qu'elles soient disponibles dans header.php
switch ($page) {
    case 'login':
        loginPage();
        break;

    case 'dashboard':
        dashboardPage();
        break;

    default:
        loginPage();
        break;
}

// Si l'utilisateur est connecté, charger le footer
if ($page !== 'login' && $page !== 'register') {
    require_once dirname(__DIR__) . '/view/footer.php';
}