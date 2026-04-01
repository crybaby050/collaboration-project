<?php

// ==================== FONCTIONS DE BASE JSON ====================

// Récupère toutes les tâches depuis le fichier JSON
function getAllTaches() {
    $path = __DIR__ . '/../data/taches.json';
    if (!file_exists($path)) {
        return [];
    }
    $json = file_get_contents($path);
    $data = json_decode($json, true);
    return $data['taches'] ?? [];
}

// Sauvegarde toutes les tâches dans le fichier JSON
function saveTaches($taches) {
    $path = __DIR__ . '/../data/taches.json';
    $data = ['taches' => $taches];
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($path, $json);
}

// ==================== FONCTIONS DE RÉCUPÉRATION AVEC TRI ====================

// Récupère les tâches d'un projet, avec filtre par statut possible
// Les tâches sont triées par priorité (haute > moyenne > basse)
function getTachesByProjet($projetId, $filtre = null) {
    $taches = getAllTaches();
    $projetTaches = [];
    
    // Récupère les tâches du projet
    foreach ($taches as $tache) {
        if ($tache['projetId'] == $projetId) {
            $projetTaches[] = $tache;
        }
    }
    
    // Filtre par statut si demandé
    if ($filtre && $filtre !== 'tous') {
        $projetTaches = array_filter($projetTaches, function($tache) use ($filtre) {
            return $tache['statut'] == $filtre;
        });
    }
    
    // Trie par priorité (haute d'abord)
    usort($projetTaches, function($a, $b) {
        $priorites = ['haute' => 3, 'moyenne' => 2, 'basse' => 1];
        return $priorites[$b['priorite']] - $priorites[$a['priorite']];
    });
    
    return $projetTaches;
}

// Récupère les tâches assignées à un utilisateur, avec filtre par statut possible
function getTachesByUser($userId, $filtre = null) {
    $taches = getAllTaches();
    $userTaches = [];
    
    // Récupère les tâches assignées à l'utilisateur
    foreach ($taches as $tache) {
        if ($tache['assigneId'] == $userId) {
            $userTaches[] = $tache;
        }
    }
    
    // Filtre par statut si demandé
    if ($filtre && $filtre !== 'tous') {
        $userTaches = array_filter($userTaches, function($tache) use ($filtre) {
            return $tache['statut'] == $filtre;
        });
    }
    
    return $userTaches;
}

// Récupère les statistiques d'un projet (pour le dashboard)
function getTachesStatistiques($projetId) {
    $taches = getTachesByProjet($projetId);
    
    $stats = [
        'total' => count($taches),
        'a_faire' => 0,
        'en_cours' => 0,
        'termine' => 0,
        'haute' => 0,
        'moyenne' => 0,
        'basse' => 0
    ];
    
    foreach ($taches as $tache) {
        $stats[$tache['statut']]++;      // Compte par statut
        $stats[$tache['priorite']]++;    // Compte par priorité
    }
    
    return $stats;
}

// Récupère les statistiques globales pour tous les projets d'un utilisateur
function getGlobalStats($userId) {
    $projets = getProjetsByUser($userId);
    $stats = [
        'total_projets' => count($projets),
        'total_taches' => 0,
        'taches_a_faire' => 0,
        'taches_en_cours' => 0,
        'taches_termine' => 0,
        'taches_haute' => 0
    ];
    
    foreach ($projets as $projet) {
        $projetStats = getTachesStatistiques($projet['id']);
        $stats['total_taches'] += $projetStats['total'];
        $stats['taches_a_faire'] += $projetStats['a_faire'];
        $stats['taches_en_cours'] += $projetStats['en_cours'];
        $stats['taches_termine'] += $projetStats['termine'];
        $stats['taches_haute'] += $projetStats['haute'];
    }
    
    return $stats;
}

// ==================== FONCTIONS DE CRÉATION ET MODIFICATION ====================

// Crée une nouvelle tâche (seul l'admin du projet peut créer)
function createTache($titre, $description, $projetId, $createurId, $assigneId, $dateEcheance, $priorite = 'moyenne') {
    // Vérifie que le créateur est admin du projet
    if (!isProjetAdmin($projetId, $createurId)) {
        return ['error' => 'Seul l\'administrateur du projet peut créer des tâches'];
    }
    
    // Vérifie que l'assigné est membre du projet
    if (!isProjetMember($projetId, $assigneId)) {
        return ['error' => 'L\'utilisateur assigné n\'est pas membre du projet'];
    }
    
    $taches = getAllTaches();
    $newId = count($taches) + 1;
    
    $nouvelleTache = [
        'id' => $newId,
        'titre' => $titre,
        'description' => $description,
        'projetId' => $projetId,
        'createurId' => $createurId,
        'assigneId' => $assigneId,
        'statut' => 'a_faire',
        'priorite' => $priorite,
        'dateCreation' => date('Y-m-d H:i:s'),
        'dateEcheance' => $dateEcheance,
        'commentaires' => []
    ];
    
    $taches[] = $nouvelleTache;
    saveTaches($taches);
    return $nouvelleTache;
}

// Met à jour une tâche (l'admin peut tout, l'assigné peut changer le statut)
function updateTache($tacheId, $userId, $data) {
    $taches = getAllTaches();
    $tache = null;
    $tacheIndex = null;
    
    // Cherche la tâche
    foreach ($taches as $key => $t) {
        if ($t['id'] == $tacheId) {
            $tache = $t;
            $tacheIndex = $key;
            break;
        }
    }
    if (!$tache) return false;
    
    $isAdmin = isProjetAdmin($tache['projetId'], $userId);
    $isAssigne = $tache['assigneId'] == $userId;
    
    // L'admin peut tout modifier
    if ($isAdmin) {
        foreach ($data as $field => $value) {
            $taches[$tacheIndex][$field] = $value;
        }
        saveTaches($taches);
        return true;
    }
    
    // L'assigné peut seulement changer le statut
    if ($isAssigne && isset($data['statut'])) {
        $taches[$tacheIndex]['statut'] = $data['statut'];
        saveTaches($taches);
        return true;
    }
    
    return false;
}

// Change le statut d'une tâche
function updateTacheStatut($tacheId, $userId, $nouveauStatut) {
    return updateTache($tacheId, $userId, ['statut' => $nouveauStatut]);
}

// Change la priorité d'une tâche (admin uniquement)
function updateTachePriorite($tacheId, $userId, $nouvellePriorite) {
    return updateTache($tacheId, $userId, ['priorite' => $nouvellePriorite]);
}

// Supprime une tâche (admin uniquement)
function deleteTache($tacheId, $userId) {
    $taches = getAllTaches();
    $tacheIndex = null;
    
    // Cherche la tâche
    foreach ($taches as $key => $tache) {
        if ($tache['id'] == $tacheId) {
            // Vérifie que l'utilisateur est admin du projet
            if (!isProjetAdmin($tache['projetId'], $userId)) {
                return false;
            }
            $tacheIndex = $key;
            break;
        }
    }
    
    if ($tacheIndex === null) return false;
    
    unset($taches[$tacheIndex]);
    saveTaches(array_values($taches));
    return true;
}

// ==================== FONCTIONS DE COMMENTAIRES ====================

// Ajoute un commentaire à une tâche
function addCommentaire($tacheId, $userId, $commentaire) {
    $taches = getAllTaches();
    foreach ($taches as $key => $tache) {
        if ($tache['id'] == $tacheId) {
            // Vérifie que l'utilisateur est membre du projet
            if (!isProjetMember($tache['projetId'], $userId)) {
                return false;
            }
            
            $nouveauCommentaire = [
                'id' => count($tache['commentaires']) + 1,
                'userId' => $userId,
                'contenu' => $commentaire,
                'date' => date('Y-m-d H:i:s')
            ];
            $taches[$key]['commentaires'][] = $nouveauCommentaire;
            saveTaches($taches);
            return true;
        }
    }
    return false;
}

// Récupère tous les commentaires d'une tâche
function getCommentairesByTache($tacheId) {
    $taches = getAllTaches();
    foreach ($taches as $tache) {
        if ($tache['id'] == $tacheId) {
            return $tache['commentaires'];
        }
    }
    return [];
}

function countTaches(){
    $taches = getAllTaches();
    $onGoing = [];
    foreach($taches as $tache){
        if($tache['statut'] == 'en_cours'){
            $onGoing[] = $tache;
        }
    }
    return count($onGoing);
}