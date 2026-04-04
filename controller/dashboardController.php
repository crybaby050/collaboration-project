<?php
function dashboardPage() {
    // Les informations utilisateur sont déjà dans $_SESSION['userConnect']
    $user = $_SESSION['userConnect'];
    $userId = $user['id'];

    // Récupère toutes les données pour le tableau de bord
    $projetsData = getProjetsForDashboard($userId);

    // Récupère les statistiques globales
    $globalStats = getGlobalStats($userId);

    // Calcule la productivité globale
    $productiviteGlobale = 0;
    if ($globalStats['total_taches'] > 0) {
        $productiviteGlobale = round(($globalStats['taches_termine'] / $globalStats['total_taches']) * 100);
    }

    // Variables pour les cards du dashboard
    $nbProjet      = $globalStats['total_projets'];
    $nbProjetEnded = countProjetsTermines();
    $nbTache       = $globalStats['total_taches'];
    $nbTacheEnCours = $globalStats['taches_en_cours'];

    // ============================================
    // VARIABLES POUR L'AFFICHAGE DANS LE HEADER
    // ============================================
    $pageTitle    = 'Tableau de bord';
    $pageSubtitle = 'Bienvenue sur votre espace de travail';
    $userRole     = $user['role'] == 'admin' ? 'Administrateur' : 'Utilisateur';
    
    // Génère les initiales : première lettre du prénom + première lettre du nom
    $userName     = $user['nom'];
    $nameParts    = explode(' ', trim($user['nom']));
    $userInitials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));

    // ============================================
    // INCLURE LE HEADER APRÈS LES VARIABLES
    // (les variables $pageTitle, $userName, etc. sont maintenant disponibles)
    // ============================================
    require_once __DIR__ . '/../view/header.php';

    // Inclure la vue du dashboard
    require_once __DIR__ . '/../view/dashboard.php';
}