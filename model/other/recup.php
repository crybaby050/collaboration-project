<?php
//fonction qui me permettent de transformer les données json en donée php exploitable
function jsonToArray(){
    $path = __DIR__ . '/../../data/users.json';
    $json = file_get_contents($path);
    return json_decode($json, true);
}

//fonction qui me permettent de transformer des données php en données completment exploitable en json
function arrayToJson($array){
    $path = __DIR__ . '/../../data/users.json';
    $tab = json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($path,$tab);
}

//fonction qui me retourne tous les utilisateur
function findAllUsers(){
    return jsonToArray();
}

//==============================================================
//LEs informations de connexion
//==============================================================


//fonction qui utilise les regex pour verifier si ce qui est saisie est un email
function validerEmail($email) {
    // Nettoyer l'email (supprimer les espaces avant/après)
    $email = trim($email);
    
    // Expression régulière pour valider l'email
    // Format: quelquechose@domaine.extension (2 à 4 lettres pour l'extension)
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    
    // Vérifier si l'email correspond au pattern
    if (preg_match($pattern, $email)) {
        return true;
    } else {
        return false;
    }
}

//fonction qui verifie si le mail est correct
function verifEmail($mail){
    $allUsers = findAllUsers();
    foreach($allUsers['users'] as $users){
        if($users['email'] === $mail){
            return $users;
        }
    }
    return [];
}

//fonction qui verifie le mot de passe est correcte
function verifPassword($pswd){
    $allUsers = findAllUsers();
    foreach($allUsers['users'] as $users){
        if($users['password'] === $pswd){
            return $users;
        }
    }
    return [];
}

//fonction qui verifie l'authentification en entier
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
    // Connexion réussie
    return true;
}

//==============================================================
//LEs informations d'inscription
//==============================================================


    //$allUsers = findAllUsers();
    //var_dump($allUsers)
?>