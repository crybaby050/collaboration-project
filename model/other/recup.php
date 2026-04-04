<?php
function redirect($url) {
    header("Location:" . WEBROOT . $url);
    exit;
}

function sanitize($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES);
}

// fonction qui permet de transformer les données json en données php exploitables
function jsonToArray(){
    $path = __DIR__ . '/../../data/users.json';
    if (!file_exists($path)) {
        return ['users' => []];
    }
    $json = file_get_contents($path);
    return json_decode($json, true);
}

// fonction qui permet de transformer des données php en json
function arrayToJson($array){
    $path = __DIR__ . '/../../data/users.json';
    $tab = json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($path, $tab);
}

// fonction qui retourne tous les utilisateurs
function findAllUsers(){
    $data = jsonToArray();
    return $data['users'] ?? [];
}



//==============================================================
//LEs informations de connection
//==============================================================



// fonction qui utilise les regex pour vérifier si c'est un email
function validerEmail($email) {
    $email = trim($email);
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email) === 1;
}

// fonction qui vérifie si le mail existe et retourne l'utilisateur
function verifEmail($mail){
    $allUsers = findAllUsers();
    foreach($allUsers as $user){
        if($user['email'] === $mail){
            return $user;
        }
    }
    return [];
}

// fonction qui vérifie le mot de passe
function verifPassword($pswd){
    $allUsers = findAllUsers();
    foreach($allUsers as $user){
        if($user['password'] === $pswd){
            return $user;
        }
    }
    return [];
}

// fonction qui vérifie l'authentification complète
function verifConnexion($email, $password) {
    $email = trim($email);
    $password = trim($password);
    
    if (empty($email) || empty($password)) {
        return false;
    }
    
    $user = verifEmail($email);
    
    if (empty($user) || $user['password'] !== $password) {
        return false;
    }
    
    // Vérifier si le compte est actif
    if (isset($user['statut']) && $user['statut'] !== 'actif') {
        return false;
    }
    
    return true;
}

// fonction pour récupérer un utilisateur par son ID
function findUserById($id){
    $allUsers = findAllUsers();
    foreach($allUsers as $user){
        if($user['id'] == $id){
            return $user;
        }
    }
    return [];
}


// Alias pour la compatibilité avec tacheModel.php
function getUserById($id) {
    return findUserById($id);
}
//==============================================================
//LEs informations d'inscription
//==============================================================


    //$allUsers = findAllUsers();
    //var_dump($allUsers)
?>