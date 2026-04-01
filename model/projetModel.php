<?php

// ==================== FONCTIONS DE BASE JSON ====================

// Récupère tous les projets depuis le fichier JSON
function getAllProjets() {
    $path = __DIR__ . '/../data/projets.json';
    if (!file_exists($path)) {
        return [];
    }
    $json = file_get_contents($path);
    $data = json_decode($json, true);
    return $data['projets'] ?? [];
}

// Sauvegarde tous les projets dans le fichier JSON
function saveProjets($projets) {
    $path = __DIR__ . '/../data/projets.json';
    $data = ['projets' => $projets];
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($path, $json);
}

// ==================== FONCTIONS DE RÉCUPÉRATION ====================

// Récupère un projet par son ID
function getProjetById($id) {
    $projets = getAllProjets();
    foreach ($projets as $projet) {
        if ($projet['id'] == $id) {
            return $projet;
        }
    }
    return null;
}

// Récupère tous les projets dont un utilisateur est membre
function getProjetsByUser($userId) {
    $projets = getAllProjets();
    $userProjets = [];
    foreach ($projets as $projet) {
        if (in_array($userId, $projet['membres'])) {
            $userProjets[] = $projet;
        }
    }
    return $userProjets;
}

// Récupère tous les projets dont un utilisateur est administrateur
function getProjetsByAdmin($userId) {
    $projets = getAllProjets();
    $adminProjets = [];
    foreach ($projets as $projet) {
        if ($projet['adminId'] == $userId) {
            $adminProjets[] = $projet;
        }
    }
    return $adminProjets;
}

// ==================== FONCTIONS DE CRÉATION ET MODIFICATION ====================

// Crée un nouveau projet
function createProjet($nom, $description, $dateEcheance, $adminId, $membres = []) {
    $projets = getAllProjets();
    $newId = count($projets) + 1;
    
    // Ajoute l'admin aux membres s'il n'y est pas
    if (!in_array($adminId, $membres)) {
        $membres[] = $adminId;
    }
    
    $nouveauProjet = [
        'id' => $newId,
        'nom' => $nom,
        'description' => $description,
        'dateCreation' => date('Y-m-d'),
        'dateEcheance' => $dateEcheance,
        'statut' => 'planifie',
        'adminId' => $adminId,
        'membres' => $membres,
        'couleur' => getRandomColor()
    ];
    
    $projets[] = $nouveauProjet;
    saveProjets($projets);
    return $nouveauProjet;
}

// Met à jour un projet existant
function updateProjet($id, $data) {
    $projets = getAllProjets();
    foreach ($projets as $key => $projet) {
        if ($projet['id'] == $id) {
            $projets[$key] = array_merge($projet, $data);
            saveProjets($projets);
            return true;
        }
    }
    return false;
}

// Supprime un projet et toutes ses tâches associées
function deleteProjet($id, $userId) {
    $projet = getProjetById($id);
    // Vérifie que l'utilisateur est admin du projet
    if (!$projet || $projet['adminId'] != $userId) {
        return false;
    }
    
    $projets = getAllProjets();
    foreach ($projets as $key => $projet) {
        if ($projet['id'] == $id) {
            unset($projets[$key]);
            saveProjets(array_values($projets));
            
            // Supprime les tâches du projet (fonction du modèle tache)
            $taches = getAllTaches();
            $taches = array_filter($taches, function($tache) use ($id) {
                return $tache['projetId'] != $id;
            });
            saveTaches(array_values($taches));
            return true;
        }
    }
    return false;
}

// ==================== FONCTIONS DE GESTION DES MEMBRES ====================

// Ajoute un membre à un projet
function addMemberToProjet($projetId, $userId, $adminId) {
    $projet = getProjetById($projetId);
    // Seul l'admin peut ajouter des membres
    if (!$projet || $projet['adminId'] != $adminId) {
        return false;
    }
    
    if (!in_array($userId, $projet['membres'])) {
        $projet['membres'][] = $userId;
        return updateProjet($projetId, ['membres' => $projet['membres']]);
    }
    return true;
}

// Retire un membre d'un projet
function removeMemberFromProjet($projetId, $userId, $adminId) {
    $projet = getProjetById($projetId);
    // Seul l'admin peut retirer des membres
    if (!$projet || $projet['adminId'] != $adminId) {
        return false;
    }
    
    // Empêche de retirer l'admin
    if ($userId == $projet['adminId']) {
        return false;
    }
    
    $projet['membres'] = array_filter($projet['membres'], function($id) use ($userId) {
        return $id != $userId;
    });
    
    return updateProjet($projetId, ['membres' => array_values($projet['membres'])]);
}

// ==================== FONCTIONS DE VÉRIFICATION ====================

// Vérifie si un utilisateur est admin du projet
function isProjetAdmin($projetId, $userId) {
    $projet = getProjetById($projetId);
    return $projet && $projet['adminId'] == $userId;
}

// Vérifie si un utilisateur est membre du projet
function isProjetMember($projetId, $userId) {
    $projet = getProjetById($projetId);
    return $projet && in_array($userId, $projet['membres']);
}

// ==================== FONCTIONS UTILITAIRES ====================

// Génère une couleur aléatoire pour un projet
function getRandomColor() {
    $colors = ['#2B88D9', '#F2B705', '#F29F05', '#99D0F2', '#BDE3F2', '#1e6bb3', '#e67e22', '#27ae60', '#8e44ad', '#e74c3c'];
    return $colors[array_rand($colors)];
}

function countProjet(){
    $projets = getAllProjets();
    $onGoing = [];
    foreach($projets as $projet){
        if($projet['statut'] == 'en_cours'){
            $onGoing[]=$projet;
        }
    }
    return count($onGoing);
}