<?php
/*
Fichier d'initialisation des pages
Contient les fonctions pour charger header et footer
 */

// Fonction pour initialiser l'affichage d'une page
function initPage($title, $subtitle) {
    $user = $_SESSION['userConnect'];
    
    // Définir les variables globales pour le header
    $GLOBALS['pageTitle'] = $title;
    $GLOBALS['pageSubtitle'] = $subtitle;
    $GLOBALS['userName'] = $user['nom'];
    $GLOBALS['userRole'] = $user['role'] == 'admin' ? 'Administrateur' : 'Utilisateur';
    $GLOBALS['userInitials'] = strtoupper(substr($user['nom'], 0, 1));
    
    // Inclure le header
    require_once __DIR__ . '/../header.php';
}

// Fonction pour fermer la page
function closePage() {
    require_once __DIR__ . '/../footer.php';
}

// Fonction alternative qui retourne le contenu sans l'afficher immédiatement
function startPage($title, $subtitle) {
    $user = $_SESSION['userConnect'];
    
    ob_start(); // Commence la mise en tampon de sortie
    
    $GLOBALS['pageTitle'] = $title;
    $GLOBALS['pageSubtitle'] = $subtitle;
    $GLOBALS['userName'] = $user['nom'];
    $GLOBALS['userRole'] = $user['role'] == 'admin' ? 'Administrateur' : 'Utilisateur';
    $GLOBALS['userInitials'] = strtoupper(substr($user['nom'], 0, 1));
    
    require_once __DIR__ . '/../header.php';
}

function endPage() {
    require_once __DIR__ . '/../footer.php';
    ob_end_flush(); // Envoie le tampon
}