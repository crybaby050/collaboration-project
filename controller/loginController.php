<?php

function loginPage() {
    $errors = [];
    
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['log'])) {
        $email = $_POST['mail'] ?? '';
        $password = $_POST['mdp'] ?? '';
        
        // Validation des champs vides
        if (empty($email) || empty($password)) {
            $errors[] = 'Veuillez remplir tous les champs';
        } 
        // Validation du format email
        elseif (!validerEmail($email)) {
            $errors[] = 'Veuillez entrer une adresse email valide (ex: nom@domaine.com)';
        }
        // Vérification des identifiants
        else {
            // Appel de la fonction verifConnexion du modèle
            if (verifConnexion($email, $password)) {
                // Récupérer les informations complètes de l'utilisateur
                $user = verifEmail($email);
                
                // Stocker les informations de l'utilisateur en session
                $_SESSION['userConnect'] = [
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'statut' => $user['statut'],
                    'telephone' => $user['telephone'] ?? '',
                    'photoProfil' => $user['photoProfil'] ?? null,
                    'dateCreation' => $user['dateCreation'] ?? ''
                ];
                
                // Redirection vers le dashboard
                redirect('?page=dashboard');
                exit;
            } else {
                // Vérifier si l'email existe pour personnaliser le message
                $userExists = !empty(verifEmail($email));
                if (!$userExists) {
                    $errors[] = 'Aucun compte trouvé avec cette adresse email';
                } else {
                    $errors[] = 'Mot de passe incorrect';
                }
            }
        }
    }
    
    // Inclure la vue de connexion
    require_once __DIR__ . '/../view/login.php';
}
?>