<?php
function dashboardPage() {
    // Les informations utilisateur sont déjà dans $_SESSION['userConnect']
    $user = $_SESSION['userConnect'];
    
    // Variables pour l'affichage
    $pageTitle = 'Tableau de bord';
    $pageSubtitle = 'Bienvenue sur votre espace de travail';
    $userName = $user['nom'];
    $userInitials = strtoupper(substr($user['nom'], 0, 1));
    
    // Inclure la vue du dashboard
    require_once __DIR__ . '/../view/dashboard.php';
}